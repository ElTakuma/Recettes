<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model
{
    protected $table = 'ingredient';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['id_recette', 'nom', 'quantite'];
    protected $returnType = "array";

    protected $useTimestamps = false;
    protected $skipValidation = false;
}