<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use CodeIgniter\Files\File;
use App\Controllers\BaseController;

class MyLibraries extends BaseController
{
    public function curl_get()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->get('https://codeigniter4.github.io/userguide/libraries/curlrequest.html', [
            'allow_redirects' => false
        ]);

        // echo $response->getStatusCode();

        var_dump($response);
    }
    public function agent()
    {

        // $agent = $this->request->getUserAgent();
        $dataHeader = [
            'title' => 'Agent'
        ];
        echo view("dashboard/templates/header", $dataHeader);
        // echo view("home/my_agent", ['agent' => $agent]);
        echo view("dashboard/templates/footer");
    }
    public function email()
    {
        $email =  \Config\Services::email();
        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'smtp.mailtrap.io';
        $config['SMTPPort']  = '2525';
        $config['SMTPUser'] = 'cfc208211dca84';
        $config['SMTPPass'] = 'c3def2e06a570a';
        $config['CRLF'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['mailType'] = "html";


        $email->initialize($config);
        $email->setFrom('edwin@gmail.com', 'Edwin');
        $email->setTo('someone@example.com');

        $email->setSubject('Hola pichon');
        $email->setMessage('<h1>Hola, Bienvenido pichon!</h1> <p>Mueve la macarena.</p>');

        $email->send();
    }
    public function encrypter()
    {
        $encrypter = \Config\Services::encrypter();
        $text = 'Hola pichones como estan.';
        $ciphertext = $encrypter->encrypt($text);
        echo ($ciphertext);
        $ciphertext = $encrypter->decrypt($ciphertext);
        echo ($ciphertext);
    }
    public function time()
    {
        // $myTime = new Time('-4 year');
        $current = Time::parse('March 10, 2017', 'America/Chicago');
        $now = Time::parse('now');
        $diff  = $now->difference($current);

        echo ($diff->humanize());
    }
    public function uri()
    {
        // $uri = $this->request->uri;

        $uri = new \CodeIgniter\HTTP\URI('https://www.facebook.com:80/watch?user=miki&pass=contrasena#pichon');
        $dataHeader = [
            'title' => 'Uri'
        ];
        echo view("dashboard/templates/header", $dataHeader);
        echo view("home/uri", ['uri' => $uri]);
        echo view("dashboard/templates/footer");
    }

    public function file()
    {
        // C:\laragon\www\codeigniter4\writable\uploads\imagemanipulation\image_quality
        // echo dirname(__DIR__, 2);
        // $file  = new File(dirname(__DIR__, 2) . '\public\image.png');
        $file  = new File(dirname(__DIR__, 2) . '\writable\uploads\imagemanipulation\image_quality.png');

        // var_dump($file->getRealPath());
        $dataHeader = [
            'title' => 'File'
        ];
        echo view("dashboard/templates/header", $dataHeader);
        echo view("home/file", ['file' => $file]);
        echo view("dashboard/templates/footer");
    }
}
