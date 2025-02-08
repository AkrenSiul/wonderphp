<?php

namespace App\Models;
use CodeIgniter\Model;

class WondersModel extends Model
{
    protected $table = '7wonders';
    protected $primaryKey = "id";

    protected $allowedFields = ['wonder', 'location', 'image'];

    public function getWonders($id = false){

        if($id === false){
            // $sql = $this->join('facts', 'wonders.id=facts.wonder_id')->where(['id' => $id])->findAll();
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

