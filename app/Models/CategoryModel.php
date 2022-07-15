<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primarykey = 'id';
    protected $allowedFields = ['title'];

    // public function get($id = null)
    // {
    //     if ($id === null) {
    //         //triple igualdad pregunta por el tipo de dato.Si es doble no!
    //         return $this->findAll();
    //     }
    //     //asArray devuelde todo los datos de la base de datos asosciados a un array.
    //     return $this->asArray()
    //         //Al usar asObject puedes ingresar asus valores como si fuera un objeto
    //         //al usar asArray no puedes ingresar asus valores como si fuera un objeto, sino como si fuera un array
    //         ->where(['id' => $id])
    //         ->first();
    // }
}
