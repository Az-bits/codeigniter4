<?php

namespace App\Controllers\Store;

use App\Models\MovieModel;
use App\Models\PaymentModel;
use App\Models\MovieImageModel;
use App\Controllers\BaseController;
use \CodeIgniter\Exceptions\PageNotFoundException;

class Buyed extends BaseController
{
    public function index()

    {
        helper('text');
        $session = session();
        $paymentModel = new PaymentModel();
        $payments = $paymentModel->asObject()
            ->select('payments.*, movies.title as movie')
            ->join('movies', 'movies.id = e_id')
            ->where('model', 'movie')
            ->where('user_id', $session->id)
            ->findAll();

        $data = [
            'payments' => $payments
        ];
        $this->_loadDefaultView(lang('Form.shopping'), $data, 'index');
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
    private function _loadDefaultView($title, $data, $view)
    {
        $dataHeader = [
            'title' => $title
        ];
        echo view("store/templates/header", $dataHeader);
        echo view("store/buyed/$view", $data);
        echo view("store/templates/footer");
    }
}
