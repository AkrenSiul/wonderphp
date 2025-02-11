<?php

namespace App\Models;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'rol','email'];

//    public function checkUser($user, $pass)
//    {
//     return $this->where(['username' => $user, 'password'=> $pass])->find();
//    }

    public function checkUser($user, $pass) // array[bool|object|string|null
    {
        // Obtener usuario y password SOLAMENTE SIN HASEAR LA CONTRASEÑA (La password escrita sin encriptar)
        // return $this->where(['username' => $user, 'password' => $pass])->find();

        $sql = $this->where(['username' => $user])->find();

        if (!empty($sql)) {
            $passwordHash = $sql[0]['password'];

            //Verifica la contraseña
            if (password_verify($pass,$passwordHash)) {
                echo "Credenciales correctas";
                return $sql;
            } else {
                $msg = "Error";
                return $msg;
            }
        }else {
            // $msg = "Error";
            // return $msg;
            return false;

        }
    }

    public function getById($id = false){
        if($id === false){
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}