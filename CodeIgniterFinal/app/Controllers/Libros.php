<?php

namespace App\Controllers;
use App\Models\LibrosModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Libros extends BaseController
{
    public function index($location) {

        $libros_model = model(LibrosModel::class);

        $data = [
            'libros' => $libros_model->findAll(),
            'title' => 'Libros relacionados con las maravillas',
        ];


        if($location == 'frontend') {
            return view('frontend/header.php', $data)
                . view('frontend/libros/index.php')
                . view('frontend/footer.php');
        } else {
            return view('templates/header.php', $data)
                . view('backend/wonders/index.php')
                . view('templates/footer.php');
        }

    }

}