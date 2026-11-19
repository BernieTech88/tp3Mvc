<?php

namespace App\Controllers;

use App\Models\Voiture;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

/** Contrôleur de gestion des véhicules **/
/** crud pour voiture */
class VoitureController
{
    public function index()
    {
        $voiture = new Voiture();
        /** recupere tous les voitures de la bd**/
        $voitures = $voiture->select();

            /**transmet la liste de voitures à la vue **/
           /** et retourne la vue */
            return View::render(
                'voiture/index',
                [
                    'voitures' => $voitures
                ]
            );


    }

    public function show($data = [])
    {
        if (isset($data['id'])) {
         /** si id est inclut **/
            $id = $data['id'];

            $voiture = new Voiture();
       /**Recherche d une voiture à partir de son id **/
            $result = $voiture->selectId($id);

            if ($result) {
           /** s il y a une boiture */
       /** retourne la vue avec les donnees de la voiture  */
                return View::render(
                    'voiture/show',
                    [
                        'voiture' => $result
                    ]
                );

            } else {

                View::redirect('voitures');

            }

        } else {

            View::redirect('voitures');

        }
    }

    public function create()
    {   Auth::admin();
        return View::render('voiture/create');
    }

    public function store(array $data)
    {   Auth::admin();
        $validator = new Validator();

        $validator->field(
            'marque',
            $data['marque'] ?? ''
        )
        ->required()
        ->min(2)
        ->max(100);

        $validator->field(
            'modele',
            $data['modele'] ?? ''
        )
        ->required()
        ->min(2)
        ->max(100);

        $validator->field(
            'annee',
            $data['annee'] ?? ''
        )
        ->required()
        ->int();

        $validator->field(
            'immatriculation',
            $data['immatriculation'] ?? ''
        )
        ->required()
        ->min(2)
        ->max(50);

        $validator->field(
            'prix_jour',
            $data['prix_jour'] ?? ''
        )
        ->required();

        if ($validator->isSuccess()) {

            $voiture = new Voiture();

            $insert = $voiture->insert($data);

            if ($insert) {

                return View::redirect(
                    'voiture/show?id=' . $insert
                );

            } else {

                echo "Erreur d'insertion";

            }

        } else {

            return View::render(
                'voiture/create',
                [
                    'errors' => $validator->getErrors(),
                    'voiture' => $data
                ]
            );

        }
    }

    public function edit($data = [])
    {    Auth::admin();
        if (isset($data['id'])) {

            $id = $data['id'];

            $voiture = new Voiture();

            $result = $voiture->selectId($id);

            if ($result) {

                return View::render(
                    'voiture/edit',
                    [
                        'voiture' => $result
                    ]
                );

            } else {

                View::redirect('voitures');

            }

        } else {

            View::redirect('voitures');

        }
    }

    public function update(array $data)
    {      Auth::admin();
        if (!isset($data['id'])) {

            return View::redirect('voitures');

        }

        $id = $data['id'];

        $validator = new Validator();

        $validator->field(
            'marque',
            $data['marque'] ?? ''
        )
        ->required()
        ->min(2)
        ->max(100);

        $validator->field(
            'modele',
            $data['modele'] ?? ''
        )
        ->required()
        ->min(2)
        ->max(100);

        $validator->field(
            'annee',
            $data['annee'] ?? ''
        )
        ->required()
        ->int();

        $validator->field(
            'immatriculation',
            $data['immatriculation'] ?? ''
        )
        ->required()
        ->min(2)
        ->max(50);

        $validator->field(
            'prix_jour',
            $data['prix_jour'] ?? ''
        )
        ->required();

        if ($validator->isSuccess()) {

            $voiture = new Voiture();

            $update = $voiture->update(
                $data,
                $id
            );

            if ($update) {

                return View::redirect(
                    'voiture/show?id=' . $id
                );

            } else {

                echo "Erreur lors de la mise à jour.";

            }

        } else {

            return View::render(
                'voiture/edit',
                [
                    'errors' => $validator->getErrors(),
                    'voiture' => $data
                ]
            );

        }
    }

    public function delete(array $data)
    {     Auth::admin();
        if (!isset($data['id'])) {

            return View::redirect('voitures');

        }

        $id = $data['id'];

        $voiture = new Voiture();

        $delete = $voiture->delete($id);

        if ($delete) {

            return View::redirect('voitures');

        } else {

            echo "Erreur lors de la suppression.";

        }
    }



    public function catalogue()
{
    $voiture = new Voiture();

    $voitures = $voiture->select();

    return View::render(
        'voiture/catalogue',
        [
            'voitures' => $voitures
        ]
    );
}
}
