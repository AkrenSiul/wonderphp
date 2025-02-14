<?php

namespace App\Models;
use CodeIgniter\Model;

class LibrosModel extends Model
{
    protected $table = 'libros';
    protected $primaryKey = 'id_libro';

    protected $allowedFields = ['titulo', 'autor', 'precio', 'portada'];

}