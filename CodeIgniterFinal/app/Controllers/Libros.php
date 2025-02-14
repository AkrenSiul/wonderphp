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
            return view('templates/header', $data)
                . view('backend/libros/index')
                . view('templates/footer');
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
                . view('backend/libros/view', $data)
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
        $model_libros = model(LibrosModel::class);

        if($data['libros'] = $model_libros->findAll()){
            return view('templates/header', ['title' => 'Create a new book'])
                . view('backend/libros/create',$data)
                . view('templates/footer');
        }
    }
    public function createBook()
    {
        helper('form');

        if(empty($_FILES['image']['name'])){
            throw new PageNotFoundException('Hay que insertar el libro con imagen');
        }

        $data = $this->request->getPost(['titulo', 'autor', 'portada', 'precio']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'titulo' => 'required|max_length[60]|min_length[3]',
            'autor'  => 'required|max_length[60]|min_length[2]',
            'portada' => 'is_image[image]',
            'precio' => 'required'
        ])) {
            // The validation fails, so returns the form.
            return $this->createForm();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $libros_model = model(LibrosModel::class);

        // Recoger archivo temporal
        $file = $this->request->getFile('image');
        // Obtenemos el nombre
        $libros_image = $file->getName();
        // Mover el archivo temporal a la ruta
        $file->move(ROOTPATH.'public/assets/img/',$libros_image);

        $libros_model->save([
            'titulo' => $post['titulo'],
            'autor'  => $post['autor'],
            'portada' => $libros_image,
            'precio'  => $post['precio'],
        ]);


        return redirect()->to(base_url('admin/libros'));
    }

    public function delete($id_libro)
    {
        if ($id_libro == null){
            throw new PageNotFoundException('Cannot delete the book');
        }

        $libros_model = model(LibrosModel::class);


        if($data['portada'] = $libros_model->where('id_libro',$id_libro)->findColumn('portada'))
            {
                unlink(ROOTPATH.'public/assets/img/'.$data['portada'][0]);
                $libros_model->where('id_libro',$id_libro)->delete();
        }else {
            throw new PageNotFoundException('No se encuentra el id');
        }

        return redirect()->to(base_url('admin/libros'));
    }

    public function updateForm($id_libro)
    {
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/libros'));
        }
        helper('form');

        if($id_libro == null) {
            throw new PageNotFoundException('El id no es correcto');
        }

        $libros_model = model(LibrosModel::class);



        if($libros_model->where('id_libro',$id_libro)->find()){
            $data = [
                'libros' => $libros_model->where(['id_libro' => $id_libro])->first(),
                'title' => 'Update Book',
            ];
        }else {
            throw new PageNotFoundException('Book not found');
        }
        return view('templates/header',$data)
            . view('backend/libros/update')
            . view('templates/footer');

    }

    public function updateBook($id_libro)
    {
        helper('form');

        if(empty($_FILES['image']['name'])){
            // Mantener imagen de la base de datos

            $data = $this->request->getPost(['titulo', 'autor', 'img_libro', 'precio']);

            // Checks whether the submitted data passed the validation rules.
            if (! $this->validateData($data, [
                'titulo' => 'required|max_length[60]|min_length[3]',
                'autor'  => 'required|max_length[60]|min_length[2]',
                'img_libro' => 'max_length[80]|min_length[1]',
                'precio'  => 'required',
            ])) {
                // The validation fails, so returns the form.
                return $this->updateForm($id_libro);
            }

            $libros_model = model(LibrosModel::class);
            // Gets the validated data.
            $post = $this->validator->getValidated();

            $libros_model->save([
                'id_libro' => $id_libro,
                'titulo' => $post['titulo'],
                'autor'  => $post['autor'],
                'image' => $post['img_libro'],
                'precio'  => $post['precio'],
            ]);

            return redirect()->to(base_url('admin/libros'));

        }else {
            // Si pulsamos el botón examinar (cargar img nueva)
            $data = $this->request->getPost(['titulo', 'autor', 'img_portada', 'precio']);

            // Checks whether the submitted data passed the validation rules.
            if (! $this->validateData($data, [
                'titulo' => 'required|max_length[60]|min_length[3]',
                'autor'  => 'required|max_length[60]|min_length[2]',
                'img_portada' => 'is_image[image]',
                'precio'  => 'required',
            ])) {
                // The validation fails, so returns the form.
                return $this->updateForm($id_libro);
            }

            // Gets the validated data.
            $post = $this->validator->getValidated();

            $libros_model = model(LibrosModel::class);

            // Recoger archivo temporal
            $file = $this->request->getFile('image');
            // Obtenemos el nombre
            $news_libro_image = $file->getName();
            // Mover el archivo temporal a la ruta
            $file->move(ROOTPATH.'public/assets/img/',$news_libro_image);

            // Eliminamos la imagen anterior para subir la nueva
            if($data['img_portada'] = $libros_model->where('id_libro',$id_libro)->findColumn('portada'))
            {
                unlink(ROOTPATH.'public/assets/img/'.$data['img_portada'][0]);
            }

            $libros_model->save([
                'id_libro' => $id_libro,
                'titulo' => $post['titulo'],
                'autor'  => $post['autor'],
                'portada' => $news_libro_image,
                'precio'  => $post['precio'],
            ]);

            return redirect()->to(base_url('admin/libros'));
        }
    }

}