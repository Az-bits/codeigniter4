<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MyHelper extends BaseController
{
    public function array()
    {
        helper('array');

        $data = [
            'uno' => [
                'dos' => [
                    'tres' => 4
                ]
            ]
        ];
        $fizz = dot_array_search('uno.dos.tres', $data);
        $fizz = dot_array_search('uno.*.tres', $data);
        var_dump($fizz);
    }
    public function filesystem()
    {
        helper('filesystem');
        // $map = directory_map('.');
        // $map = directory_map('./bootstrap', 1);
        // $map = directory_map('../app', 1);
        // var_dump($map);
        write_file('./bootstrap/customcss.css', 'body{color:red}');
    }
    public function number()
    {
        helper('number');
        /* 
        echo number_to_size(456); // Returns 456 Bytes
        echo number_to_size(4567); // Returns 4.5 KB
        echo number_to_size(45678); // Returns 44.6 KB
        echo number_to_size(456789); // Returns 447.8 KB
        echo number_to_size(3456789); // Returns 3.3 MB
        echo number_to_size(12345678912345); // Returns 1.8 GB
        echo number_to_size(123456789123456789); // Returns 11,228.3 TB*/
        echo number_to_amount(1234567898);
    }
    public function text()
    {
        helper('text');
        /* echo random_string('alpha', 20);
        echo increment_string('file', '_'); // "file_1"
        echo increment_string('file', '-', 2); // "file-2"
        echo increment_string('file_4'); // "file_5"*/
        for ($i = 0; $i < 20; $i++) {
            echo alternator(' uno', ' dos', ' tres');
        }
    }
    public function url()
    {
        // echo site_url('news/local/123');
        $segments = ['news', 'local', '1234'];
        // echo site_url($segments);

        // echo base_url($segments);
        echo uri_string();
    }
}
