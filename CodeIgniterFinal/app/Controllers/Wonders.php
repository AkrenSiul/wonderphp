<?php

namespace App\Controllers;

use App\Models\FactsModel;
use App\Models\WondersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Wonders extends BaseController
{

    public function index($location) {

        $wonder_model = model(WondersModel::class);
        $fact_model = model(FactsModel::class);

        $data = [
            'wonders' => $wonder_model->findAll(),
            'title' => 'Wonders of the Ancient World',
        ];

//            $data = [
//                'new_wonders' => $wonder_model->getWonders(),
//                'facts_text' => $fact_model->getFacts(),
//                'title' => 'Seven Wonders',
//            ];
        if($location == 'frontend') {
            return view('frontend/header.php', $data)
                . view('frontend/index.php')
                . view('frontend/footer.php');
        } else {
            return view('templates/header.php', $data)
            . view('backend/wonders/index.php')
            . view('templates/footer.php');
        }

    }


    public function show($location, $id_wonder) {
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/loginForm'));
        }

        //Obtener maravilla del id dado
        $wonder_model = model(WondersModel::class);
        $facts_model = model(FactsModel::class);

        $data['wonders'] = $wonder_model->findAll();

        $data['wonder_selected'] = $wonder_model->where(['id' => $id_wonder])->first();

        // Obtener los facts de la maravilla $id_wonder
        $data['wonder_facts'] = $facts_model->where(['wonder_id' => $id_wonder])->find();

        $data['title'] = 'Wonders of the Ancient World';

        if($location == 'frontend') {
            return view('frontend/header')
                . view('frontend/wonder', $data)
                . view('frontend/footer');
        }else {
            return view('templates/header')
                . view('backend/wonders/view', $data)
                . view('templates/footer');
        }

    }

    public function createForm()
    {
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/loginForm'));
        }
        helper('form');
        $model_wonder = model(WondersModel::class);

        if($data['wonder'] = $model_wonder->findAll()){
            return view('templates/header', ['title' => 'Create a new wonder'])
                . view('backend/wonders/create',$data)
                . view('templates/footer');
        }
    }
    public function createWonder()
    {
        helper('form');

        if(empty($_FILES['image']['name'])){
            throw new PageNotFoundException('Hay que insertar maravilla con imagen');
        }

        $data = $this->request->getPost(['wonder', 'location', 'image']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'wonder' => 'required|max_length[255]|min_length[3]',
            'location'  => 'required|max_length[200]|min_length[2]',
            'image' => 'is_image[image]',
        ])) {
            // The validation fails, so returns the form.
            return $this->createForm();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $wonder_model = model(WondersModel::class);

        // Recoger archivo temporal
        $file = $this->request->getFile('image');
        // Obtenemos el nombre
        $wonder_image = $file->getName();
        // Mover el archivo temporal a la ruta
        $file->move(ROOTPATH.'public/assets/img/',$wonder_image);

        $wonder_model->save([
            'wonder' => $post['wonder'],
            'location'  => $post['location'],
            'image' => $wonder_image,
        ]);


        return redirect()->to(base_url('admin/wonders'));
    }
    public function new()
    {
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/loginForm'));
        }
        helper('form');
        $model_wonder = model(WondersModel::class);

        if($data['wonder'] = $model_wonder->findAll()){
            return view('templates/header', ['title' => 'Create a new wonder'])
                . view('frontend/create',$data)
                . view('templates/footer');
        }
    }
    public function create()
    {
        helper('form');


        if(empty($_FILES['image']['name'])){
            throw new PageNotFoundException('Hay que insertar maravilla con imagen');
        }

        $data = $this->request->getPost(['wonder', 'location', 'image']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'wonder' => 'required|max_length[255]|min_length[3]',
            'location'  => 'required|max_length[200]|min_length[2]',
            'image' => 'is_image[image]',
        ])) {
            // The validation fails, so returns the form.
            return $this->createForm();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $wonder_model = model(WondersModel::class);

        // Recoger archivo temporal
        $file = $this->request->getFile('image');
        // Obtenemos el nombre
        $wonder_image = $file->getName();
        // Mover el archivo temporal a la ruta
        $file->move(ROOTPATH.'public/assets/img/',$wonder_image);

        $wonder_model->save([
            'wonder' => $post['wonder'],
            'location'  => $post['location'],
            'image' => $wonder_image,
        ]);

        return redirect()->to(base_url('wonders/create'));
    }

    public function delete($id)
    {
        if ($id == null){
            throw new PageNotFoundException('Cannot delete the item');
        }

        $wonders_model = model(WondersModel::class);

        $facts_model = model(FactsModel::class);

        // Comprobar si hay facts asociados a la wonder a eliminar
        if($facts_model->where(['wonder_id' => $id])->find()){
            throw new PageNotFoundException('No se puede eliminar la maravilla porque está asociado con los facts');
        }else {
            if($data['image'] = $wonders_model->where('id',$id)->findColumn('image'))
            {
                unlink(ROOTPATH.'public/assets/img/'.$data['image'][0]);
                $wonders_model->where('id',$id)->delete();
            }
        }

        return redirect()->to(base_url('admin/wonders'));
    }

//    public function delete($id)
//    {
//        if ($id == null){
//            throw new PageNotFoundException('Cannot delete the item');
//        }
//
//        $model = model(WondersModel::class);
//
//         if($model->where('id',$id)->find())
//         {
//             $model->where('id',$id)->delete();
//         }else {
//             throw new PageNotFoundException('Selected item does not exist in database');
//         }
//
//
//        /*return view('templates/header', ['title' => 'Create a news item'])
//            . view('news/success')
//            . view('templates/footer');
//        */
//        return redirect()->to(base_url('/'));
//    }

    public function updateForm($id)
    {
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/wonders'));
        }
        helper('form');

        if($id == null) {
            throw new PageNotFoundException('El id no es correcto');
        }

        $wonders_model = model(WondersModel::class);


        if($wonders_model->where('id',$id)->find()){
            $data = [
                'wonders' => $wonders_model->getById($id),
                'title' => 'Update Wonder',
            ];
        }else {
            throw new PageNotFoundException('Wonder no encontrada');
        }
        return view('templates/header',$data)
            . view('backend/wonders/update')
            . view('templates/footer');

    }

    public function updateWonder($id)
    {
        helper('form');

        if(empty($_FILES['image']['name'])){
            // Mantener imagen de la base de datos

            $data = $this->request->getPost(['wonder', 'location', 'img_wonder']);

            // Checks whether the submitted data passed the validation rules.
            if (! $this->validateData($data, [
                'wonder' => 'required|max_length[255]|min_length[3]',
                'location'  => 'required|max_length[100]|min_length[2]',
                'img_wonder' => 'max_length[80]|min_length[1]',
            ])) {
                // The validation fails, so returns the form.
                return $this->updateForm($id);
            }

            $wonders_model = model(WondersModel::class);
            // Gets the validated data.
            $post = $this->validator->getValidated();

            $wonders_model->save([
                'id' => $id,
                'wonder' => $post['wonder'],
                'location'  => $post['location'],
                'image' => $post['img_wonder'],
            ]);

            return redirect()->to(base_url('admin/wonders'));

        }else {
            // Si pulsamos el botón examinar (cargar img nueva)
            $data = $this->request->getPost(['wonder', 'location', 'image']);

            // Checks whether the submitted data passed the validation rules.
            if (! $this->validateData($data, [
                'wonder' => 'required|max_length[255]|min_length[3]',
                'location'  => 'required|max_length[100]|min_length[2]',
                'image' => 'is_image[image]',
            ])) {
                // The validation fails, so returns the form.
                return $this->updateForm($id);
            }

            // Gets the validated data.
            $post = $this->validator->getValidated();

            $wonders_model = model(WondersModel::class);

            // Recoger archivo temporal
            $file = $this->request->getFile('image');
            // Obtenemos el nombre
            $news_wonder_image = $file->getName();
            // Mover el archivo temporal a la ruta
            $file->move(ROOTPATH.'public/assets/img/',$news_wonder_image);

            // Eliminamos la imagen anterior para subir la nueva
            if($data['image'] = $wonders_model->where('id',$id)->findColumn('image'))
            {
                unlink(ROOTPATH.'public/assets/img/'.$data['image'][0]);
            }

            $wonders_model->save([
                'id' => $id,
                'wonder' => $post['wonder'],
                'location'  => $post['location'],
                'image' => $news_wonder_image,
            ]);

            return redirect()->to(base_url('admin/wonders'));

        }
    }

}