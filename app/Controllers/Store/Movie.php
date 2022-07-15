<?php

namespace App\Controllers\Store;

use App\Models\MovieModel;
use App\Models\PaymentModel;
use App\Models\MovieImageModel;
use App\Controllers\BaseController;
use \CodeIgniter\Exceptions\PageNotFoundException;

class Movie extends BaseController
{
    public function index()

    {
        helper('text');
        $movie = new MovieModel();
        $data = [

            'movies' => $movie->asObject()
                ->select('movies.*, categories.title as category,any_value(movie_images.image) as image')
                ->join('categories', 'categories.id = movies.category_id')
                ->join('movie_images', 'movies.id = movie_id', 'left')
                // ->paginate(10)
                ->groupBy('movies.id'),
            // 
            'pager' => $movie->pager
        ];
        $this->_loadDefaultView(lang('Form.movies_list'), $data, 'index');
    }


    public function show($id = null)
    {
        $movieModel = new MovieModel();
        $imageModel = new MovieImageModel();
        $movie = $movieModel->asObject()->find($id);

        if ($movie == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->_loadDefaultView(
            $movie->title,
            [
                'movie' => $movie,
                'images' => $imageModel->getByMovieId($id)
            ],
            'show'
        );
    }
    public function buy_success($id = null)
    {
        echo "buy_success";
        $movie = new PaymentModel();
        $id = $movie->insert([
            'user_id' => 1,
            'e_id' => 7,
            'model' => 'movie',
            'price' => 50.0
        ]);
    }
    public function buy_cancel($id = null)
    {
        echo "buy_cancel";
    }
    public function buy($id = null)
    {
        helper('text');
        $movieModel = new MovieModel();
        $imageModel = new MovieImageModel();
        $movie = $movieModel->asObject()->find($id);

        if ($movie == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        // After Step 1
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AUUo74dMHcy0fFnFoTiXGtDmGQHz1uOOtQjdE_VxjBWTmh9P5GHBV-wivnxrmMGMLNl1Hi1uv-9Uma9H',     // ClientID
                'EMX_P_KXCyOWW0W03hfB4PWKUrU1g95m5b-k0BdVC84p8vvLlHm3Qz660ypjkyUqULxwje8W3tnoG1Bj'      // ClientSecret
            )
        );
        // After Step 2
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal($movie->price);
        $amount->setCurrency('USD');

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        // echo base_url() . route_to('store_movie_boy_success', $id);

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(base_url() . route_to('store_movie_buy_success', $id))
            ->setCancelUrl(base_url() . route_to('store_movie_buy_cancel', $id));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        // After Step 3
        try {
            $payment->create($apiContext);
            echo $payment->id;
            $this->_loadDefaultView(
                null,
                [
                    'movie' => $movie,
                    'images' => $imageModel->getByMovieId($id),
                    'approval' => $payment->getApprovalLink()
                ],
                'buy'
            );

            // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
    }


    private function _loadDefaultView($title, $data, $view)
    {
        $dataHeader = [
            'title' => $title
        ];
        echo view("store/templates/header", $dataHeader);
        echo view("store/movie/$view", $data);
        echo view("store/templates/footer");
    }
}
