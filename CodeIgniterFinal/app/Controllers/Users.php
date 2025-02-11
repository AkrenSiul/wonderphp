<?php

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\UsersModel;

class Users extends BaseController
{

    public function loginForm($error = null)
    {
        helper('form');
        if($error == null){
            return view('templates/header', ['title' => 'Private Access'])
                . view('users/login', ['error' => ''])
                . view('templates/footer');
        }else{
            return view('templates/header', ['title' => 'Private Access'])
                . view('users/login', ['error'=> 'Credenciales incorrectas'])
                . view('templates/footer');
        }
    }

    public function checkUser()
    {
        helper('form');
        $data = $this->request->getPost(['username', 'password']);

        if(! $this->validate([
            'username' => 'required',
            'password'=> 'required',
        ]))
        {
            //Si la validación falla, volvemos a mostrar el formulario
            return $this->loginForm();
        }
        //Obtenemos los datos validados
        $post = $this->validator->getValidated();
        $model = model(UsersModel::class);

        //comprobamos si existe el usuario y contraseña en la base de datos
        if($data['user'] = $model->checkUser($post['username'],$post['password']))
        {
            $session = session(); //Inicializamos sesión
            $session->set('user',$post['username']); //Crear sesión

            return view('templates/header', ['title' => 'Acceso Privado Admin'])
                . view('users/admin', $data)
                . view('templates/footer');
        }else {
            return $this->loginForm("Error");
        }
    }

    public function closeSession(){
        $session = session();

        //Eliminar variable de sesión específica
        $session->remove('user');

        // Eliminar toda la información de la sesión, todas las sesiones
        // $session->destroy();

        return redirect()->to(base_url('/'));

    }

    // ABRIR LOS HELPERS Y REDIRIGIR A LA VISTA CREATE
    public function new()
    {
        helper('form');
        helper('password');

        return view('templates/header', ['title' => 'New User'])
            .view('users/create')
            .view('templates/footer');
    }

    public function create() {
        helper('form');
        helper('password');

        $data = $this->request->getPost(['username', 'password', 'rol', 'email']);
        if (! $this->validateData($data, [
            'username' => 'required|max_length[255]|min_length[4]',
            'password' => 'required|max_length[255]|min_length[4]',
            'rol' => 'required',
            'email' => 'required',
        ])) {
            return $this->new();
        }

        $post = $this->validator->getValidated();

        $model = model(UsersModel::class);

        // PARA HASEAR LA CONTRASEÑA. FUNCIONA PORQUE ESTÁ EL HELPER('password')
        $hashedPassword = password_hash($post['password'], PASSWORD_DEFAULT);

        $model->save([
            'username' => $post['username'],
            'password' => $hashedPassword,
            'rol' => $post['rol'],
            'email' => $post['email'],
        ]);

        return redirect()->to(base_url('/'));
    }
}