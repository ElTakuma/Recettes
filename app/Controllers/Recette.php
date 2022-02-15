<?php

namespace App\Controllers;

use App\Models\IngredientModel;
use App\Models\RecetteModel;

class Recette extends BaseController
{
    public function index()
    {
        $page = 'Mes recettes';
        $recetteModel = new RecetteModel();

        $data = [
            'head_title' => $page,
            'body_title' => $page,
            'body_title_mention' => 'Je vous presente mes recettes favorites...',

            'recettes' => $recetteModel->paginate(25),
            'pager' => $recetteModel->pager
            ];

        echo view('template/header', $data);
        echo view('recette/index', $data);
        echo view('template/footer', $data);
    }

    public function new() {
        $page = 'Créé une recette';

        $data = [
            'head_title' => $page,
            'body_title' => $page,
            'body_title_mention' => '',
        ];

        echo view('template/header', $data);
        echo view('recette/new', $data);
        echo view('template/footer', $data);
    }

    public function create(){

        $recetteModel = new RecetteModel();

        $recette = [
            "titre" => $this->request->getVar('titre', FILTER_SANITIZE_STRING),
            "instructions" => $this->request->getVar('instructions', FILTER_SANITIZE_STRING),
            "slug" => $this->request->getVar('slug', FILTER_SANITIZE_STRING)
        ];

        if ($recetteModel->save($recette) === true) {
            $saved_recette_id = $recetteModel->getInsertID();

            $redirectWithError = false;
            /**
             * saving ingredients
             */
            $ingredientModel = new IngredientModel();

            for ($i=0; $i<7; $i++) {

                // Select only field containing values
                $j = $i+1;

                if ($this->request->getVar('quantite_'. $j) !== null) {

                    $id_ingredient = $this->request->getVar('id_'. $i, FILTER_SANITIZE_NUMBER_INT);
                    $ingredient = [
                        "quantite" => $this->request->getVar('quantite_'. $i, FILTER_SANITIZE_STRING),
                        "nom" => $this->request->getVar('nom_'. $i, FILTER_SANITIZE_STRING)
                    ];

                    if (!empty($ingredient['quantite']) && !empty($ingredient['nom'])) {
                        $ingredient['id_recette'] = $saved_recette_id;
                        $ingredientModel->save($ingredient);
                    } else {
                        $data = ["error_new_ingerdient" => "Une erreur est survenue lors de l'ajoute d'une nouvel ingredient"];
                        $redirectWithError = true;
                    }
                }
            }
        } else {
            $redirectWithError = true;
            $data = ["error_update_recette" => "Une erreur est survenue lors de la creation de la recette"];
        }

        if (!$redirectWithError) {
            $data = ["success" => "Création effectuer avec succès"];
        }
        return redirect()->to("/recette/". $saved_recette_id)->with("success", "Création effectuer avec succès");
    }

    /**
     * Retourne une recette
     * @param null $id
     */
    public function show($id = null){
        $page = 'Recette';
        $recetteModel = new RecetteModel();
        $ingredientModel = new IngredientModel();

        $recette = $recetteModel->find($id);
        $ingredients = $ingredientModel->where('id_recette', $recette['id'])->findAll();

        $data = [
            'head_title' => $page,
            'body_title' => $page,
            'body_title_mention' => $recette['titre'],
            'recette' => $recette,
            'ingredients' => $ingredients,
        ];

        echo view('template/header', $data);
        echo view('recette/show', $data);
        echo view('template/footer', $data);
    }

    public function edit($id = null) {
        $page = 'Modifier une recette';
        $recetteModel = new RecetteModel();
        $ingredientModel = new IngredientModel();

        $recette = $recetteModel->find($id);
        $ingredients = $ingredientModel->where('id_recette', $recette['id'])->findAll();

        $data = [
            'head_title' => $page,
            'body_title' => $page,
            'body_title_mention' => '',
            'recette' => $recette,
            'ingredients' => $ingredients,
        ];

        echo view('template/header', $data);
        echo view('recette/edit', $data);
        echo view('template/footer', $data);
    }

    public function update($id = null) {

        $redirectWithError = false;

        $recetteModel = new RecetteModel();

        $recette = [
            "titre" => $this->request->getVar('titre', FILTER_SANITIZE_STRING),
            "instructions" => $this->request->getVar('instructions', FILTER_SANITIZE_STRING),
            "slug" => $this->request->getVar('slug', FILTER_SANITIZE_STRING)
        ];

        if ($recetteModel->update($id, $recette) === true) {
            $redirectWithError = false;
            /**
             * saving ingredients
             */
            $ingredientModel = new IngredientModel();

            for ($i=0; $i<7; $i++) {

                // Select only field containing values
                $j = $i+1;

                if ($this->request->getVar('quantite_'. $j) !== null) {

                    $id_ingredient = $this->request->getVar('id_'. $i, FILTER_SANITIZE_NUMBER_INT);
                    $ingredient = [
                        "quantite" => $this->request->getVar('quantite_'. $i, FILTER_SANITIZE_STRING),
                        "nom" => $this->request->getVar('nom_'. $i, FILTER_SANITIZE_STRING)
                    ];

                    // Update if ID exist and create ew if ID is not defined
                    if ($id_ingredient) {
                        if ($ingredientModel->update($id_ingredient,$ingredient) === false) {
                            $redirectWithError = true;
                            $data = [ "error_ingredient"=>$ingredientModel->errors() ];
                        }
                    } else {
                        if (!empty($ingredient['quantite']) && !empty($ingredient['nom'])) {
                            $ingredient['id_recette'] = $id;
                            $ingredientModel->save($ingredient);
                        } else {
                            $data = ["error_new_ingerdient" => "Une erreur est survenue lors de l'ajoute d'une nouvel ingredient"];
                            $redirectWithError = true;
                        }
                    }
                }
            }
        } else {
            $redirectWithError = true;
            $data = ["error_update_recette" => "Une erreur est survenue lors de la mise a jour de la recette"];
        }

        if (!$redirectWithError) {
            $data = ["success" => "Mise a jour effectuer avec succès"];
        }
        return redirect()->to("/recette/". $id)->with("success", "succès");
    }

    public function delete($id = null) {
        $ingredientModel = new IngredientModel();
        $ingredients = $ingredientModel->select('id')->where('id_recette', $id)->findAll();

        foreach ($ingredients as $ingredient) {
            print_r($ingredient);
            if ($ingredientModel->delete($ingredient['id']) === false) {
                exit();
            }
        }

        $recetteModel = new RecetteModel();
        if ($recetteModel->delete($id) === true) {
            return redirect()->to("/recette/")->with("success", "succès");
        }

    }

    public function delete_ingredient($id = null){
        $ingredientModel = new IngredientModel();
        $ingredient = $ingredientModel->find($id);
        $id_recette = $ingredient['id_recette'];
        
        if ($ingredientModel->delete($id) === true) {
            return redirect()->to('/recette/' . $id_recette);
        }
    }
}