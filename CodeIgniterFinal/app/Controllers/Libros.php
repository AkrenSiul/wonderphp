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

    public function show($location, $id_libro) {


        $libros_model = model(LibrosModel::class);

        $data['libros'] = $libros_model->findAll();


        $data['libro_selected'] = $libros_model->where(['id_libro' => $id_libro])->first();

        $data['title'] = 'Books of wonders of the Ancient World';

        if($location == 'frontend') {
            return view('frontend/header')
                . view('frontend/libros/view', $data)
                . view('frontend/footer');
        }else {
            $session = session();
            if(empty($session->get('user'))){
                return redirect()->to(base_url('admin/loginForm'));
            }
            return view('templates/header')
                . view('backend/wonders/view', $data)
                . view('templates/footer');
        }

    }

}