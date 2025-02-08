<?php

namespace App\Models;

use CodeIgniter\Model;

class FactsModel extends Model
{
    protected $table = 'facts';

    protected $primaryKey = 'fact_id';

    protected $allowedFields = ['wonder_id','fact_text'];

    public function getFacts($id = false){

        if($id === false){
            $sql = $this->findAll();
            return $sql;
        }

        $sql = $this->findAll();
        $sql = $this->where(['id' => $id]);
        $sql = $this->first();
        return $sql;
    }

    public function getById($id) {
        return $this->where(['id' => $id])->first();
    }

}