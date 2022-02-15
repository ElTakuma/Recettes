<?php

namespace App\Models;

class RecetteModel extends \CodeIgniter\Model
{
    protected $table = 'recette';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
//    protected $useSoftDeletes = true;

    protected $allowedFields = ['titre', 'instructions', 'slug'];

    protected $useTimestamps = false;
//    protected $deletedField = false;
    protected $skipValidation = false;
}