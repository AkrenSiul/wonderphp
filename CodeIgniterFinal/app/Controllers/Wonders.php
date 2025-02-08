<?php

namespace App\Controllers;

use App\Models\FactsModel;
use App\Models\WondersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Wonders extends BaseController
{

    public function index() {

        $wonder_model = model(WondersModel::class);
        $fact_model = model(FactsModel::class);

        $data = [
            'wonders' => $wonder_model->findAll(),
            'title' => 'Seven Wonders',
        ];

//            $data = [
//                'new_wonders' => $wonder_model->getWonders(),
//                'facts_text' => $fact_model->getFacts(),
//                'title' => 'Seven Wonders',
//            ];
        //if($location == 'frontend') {
            return view('frontend/header.php', $data)
                . view('frontend/index.php')
                . view('frontend/footer.php');
        //} else {
        //    return view('frontend/header.php');
        //}

    }

    public function show($id_wonder) {

        //Obtener maravilla del id dado
        $wonder_model = model(WondersModel::class);
        $facts_model = model(FactsModel::class);

        $data['wonder_selected'] = $wonder_model->where(['id' => $id_wonder])->first();

        // Obtener los facts de la maravilla $id_wonder
        $data['wonder_facts'] = $facts_model->where(['wonder_id' => $id_wonder])->find();

            return view('frontend/header')
            .view('frontend/wonder', $data)
            .view('frontend/footer');

    }

}