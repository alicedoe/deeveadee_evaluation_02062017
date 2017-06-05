<?php

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->templateAdmin('admin');

    }

    public function crud()
    {
        $db = $_POST['db'];
        switch ($db) {
            case "societes":
                $societes = new CRUD_model();
                $societes->setOptions('societes', 'numS');
                $data[$db] = $societes->get();
                break;
            case "acteur":
                $acteurs = new CRUD_model();
                $acteurs->setOptions('acteur', 'numA');
                $data[$db] = $acteurs->get();
                break;
            case "clients":
                $clients = new CRUD_model();
                $clients->setOptions('clients', 'numC');
                $data[$db] = $clients->get();
                break;
            case "dvd":
                $dvd = new CRUD_model();
                $dvd->setOptions('dvd', 'numD');
                $data[$db] = $dvd->getJoin(null, "numD", "dvd");
                break;
            case "employe":
                $employes = new CRUD_model();
                $employes->setOptions('employe', 'numSecu');
                $data[$db] = $employes->get();
                break;
            case "emprunt":
                $emprunts = new CRUD_model();
                $emprunts->setOptions('emprunt', 'numE');
                $data[$db] = $emprunts->getJoin(null, "numE", "emprunt");
                break;
            case "genres":
                $genres = new CRUD_model();
                $genres->setOptions('genres', 'numG');
                $data[$db] = $genres->get();
                break;
            case "notes":
                $notes = new CRUD_model();
                $notes->setOptions('notes', 'numN');
                $data[$db] = $notes->getJoin(null, "numN", "notes");
                break;
            case "remarques":
                $remarques = new CRUD_model();
                $remarques->setOptions('remarques', 'numR');
                $data[$db] = $remarques->getJoin(null, "numR", "remarques");
                break;
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data[$db]));

    }

    public function crud_delete()
    {
        $data['db'] = $_POST['db'];
        $data['id'] = $_POST['id'];
        $this->deleteId($data['db'],$data['id']);
        $this->output->set_output($data['db']);
    }

    public function crud_update()
    {
        var_dump($_POST);
        $this->output->set_output(json_encode($_POST));
//        $societes = new CRUD_model();
//        $societes->setOptions('societes', 'numS');
//        $societes->insertUpdate($_POST[0], null, $_POST);
    }

    public function test()
    {
        $test["numS"] = 1;
        $test["nomS"] = "undefinedDVD store 1";
        $test["rueS"] = "undefinedrue des chevaliers blancs";
        $test["villeS"] = "undefinedtrifouillis les oies";
        $test["directeurS"] = "undefinedLe roi arthur";
        var_dump($test);
        $societes = new CRUD_model();
        $societes->setOptions('societes', 'numS');
        $societes->insertUpdate($test["numS"], null, $test);

    }

    public function deleteId($db,$id) {
        switch ($db) {
            case "societes":
                $societes = new CRUD_model();
                $societes->setOptions('societes', 'numS');
                $societes->delete($id);
                break;
            case "acteur":
                $acteurs = new CRUD_model();
                $acteurs->setOptions('acteur', 'numA');
                $acteurs->delete($id);
                break;
            case "clients":
                $clients = new CRUD_model();
                $clients->setOptions('clients', 'numC');
                $clients->delete($id);
                break;
            case "dvd":
                $dvd = new CRUD_model();
                $dvd->setOptions('dvd', 'numD');
                $dvd->delete($id);
                break;
            case "employe":
                $employes = new CRUD_model();
                $employes->setOptions('employe', 'numSecu');
                $employes->delete($id);
                break;
            case "emprunt":
                $emprunts = new CRUD_model();
                $emprunts->setOptions('emprunt', 'numE');
                $emprunts->delete($id);
                break;
            case "genres":
                $genres = new CRUD_model();
                $genres->setOptions('genres', 'numG');
                $genres->delete($id);
                break;
            case "notes":
                $notes = new CRUD_model();
                $notes->setOptions('notes', 'numN');
                $notes->delete($id);
                break;
            case "remarques":
                $remarques = new CRUD_model();
                $remarques->setOptions('remarques', 'numR');
                $remarques->delete($id);
                break;
        }
    }

    public function updateId($db,$id,$data) {
        switch ($db) {
            case "societes":
                $societes = new CRUD_model();
                $societes->setOptions('societes', 'numS');
                $societes->delete($id);
                break;
            case "acteur":
                $acteurs = new CRUD_model();
                $acteurs->setOptions('acteur', 'numA');
                $acteurs->delete($id);
                break;
            case "clients":
                $clients = new CRUD_model();
                $clients->setOptions('clients', 'numC');
                $clients->delete($id);
                break;
            case "dvd":
                $dvd = new CRUD_model();
                $dvd->setOptions('dvd', 'numD');
                $dvd->delete($id);
                break;
            case "employe":
                $employes = new CRUD_model();
                $employes->setOptions('employe', 'numSecu');
                $employes->delete($id);
                break;
            case "emprunt":
                $emprunts = new CRUD_model();
                $emprunts->setOptions('emprunt', 'numE');
                $emprunts->delete($id);
                break;
            case "genres":
                $genres = new CRUD_model();
                $genres->setOptions('genres', 'numG');
                $genres->delete($id);
                break;
            case "notes":
                $notes = new CRUD_model();
                $notes->setOptions('notes', 'numN');
                $notes->delete($id);
                break;
            case "remarques":
                $remarques = new CRUD_model();
                $remarques->setOptions('remarques', 'numR');
                $remarques->delete($id);
                break;
        }
    }
}
