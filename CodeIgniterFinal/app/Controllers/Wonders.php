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


    public function show($location,$id_wonder) {

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
            return view('frontend/header')
                . view('frontend/wonder', $data)
                . view('frontend/footer');
        }

    }
    public function new()
    {
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('/'));
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


        $data = $this->request->getPost(['wonder', 'location', 'image']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'wonder' => 'required|max_length[100]|min_length[3]',
            'location'  => 'required|max_length[100]|min_length[4]',
            'image' => 'required',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(WondersModel::class);


        $model->save([
            'wonder' => $post['wonder'],
            'location'  => $post['location'],
            'image' => $post['image'],
        ]);

        /*return view('templates/header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/footer');
        */

        // Redirecciona a la url base_url('news');
        return redirect()->to(base_url('/'));
    }

    public function delete($id)
    {
        if ($id == null){
            throw new PageNotFoundException('Cannot delete the item');
        }
        $wonders_model = model(WondersModel::class);




        $facts_model = model(FactsModel::class);

        if($facts_model->where(['wonder_id' => $id])->find()){
            throw new PageNotFoundException('No se puede eliminar la maravilla');
        }else {
            if($data['image'] = $wonders_model->where('id',$id)->findColumn('image'))
            {
                unlink(ROOTPATH.'public/assets/img/'.$data['image'][0]);
                $wonders_model->where('id',$id)->delete();
            }
        }


        /*return view('templates/header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/footer');
        */
        return redirect()->to(base_url('/'));
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

}