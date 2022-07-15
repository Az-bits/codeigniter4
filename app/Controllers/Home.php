<?php

namespace App\Controllers;

use App\Models\MovieModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
    public function my_database()
    {
        $db = \Config\Database::connect();
        $dataHeader = [
            'title' => 'Base de datos data'
        ];
        echo view("dashboard/templates/header", $dataHeader);
        echo view("home/my_database", ['db' => $db]);
        echo view("dashboard/templates/footer");
    }
    public function my_request()
    {
        $dataHeader = [
            'title' => 'Request'
        ];
        $r = $this->request;
        $r = \Config\Services::request();
        // var_dump($r);
        echo view("dashboard/templates/header", $dataHeader);
        echo view("home/my_request", ['request' => $r]);
        echo view("dashboard/templates/footer");
    }
    public function my_transaction()
    {
        $db = \Config\Database::connect();
        $movie = new MovieModel();
        $db->transStart();
        $movie->update(1, [
            'title' => 'New title 1111'
        ]);

        $movie->update(3, [
            'title' => 'New title 3333'
        ]);/*
		var_dump($db->transStatus());
		if($db->transStatus()){
			echo 'exito';
			$db->transRollback();
		}*/
        $db->transComplete();
    }


    public function image($movieId = null, $image = null)
    {
        if (!$movieId) {
            $movieId = $this->request->getGet('movie_id');
        }

        if (!$image) {
            $image = $this->request->getGet('image');
        }
        if ($movieId == '' | $image == '') {
            throw PageNotFoundException::forPageNotFound();
        }
        $name = WRITEPATH . 'uploads/movies/' . $movieId . '/' . $image;
        if (!file_exists($name)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $fp = fopen($name, 'rb');

        // envía las cabeceras correctas
        header("Content-Type: image/png");
        header("Content-Length: " . filesize($name));

        // vuelca la imagen y detiene el script
        fpassthru($fp);
        exit;
    }
    public function contacto($name = "Pepe")
    {
        $dataHeader = [
            'title' => 'Contacto ' . $name
        ];

        echo view("dashboard/templates/header", $dataHeader);
        echo view('welcome_message');
        echo view("dashboard/templates/footer");
    }
}
