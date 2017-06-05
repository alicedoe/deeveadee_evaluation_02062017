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

    public function getCrudModel ($db,$verb,$id=null,$data=null) {
        switch ($db) {
            case "societes":
                $societes = new CRUD_model();
                $societes->setOptions('societes', 'numS');
                if ($verb == "get") { $data[$db] = $societes->get(); return $data[$db];}
                elseif ($verb == "delete") { $societes->delete($id); }
                elseif ($verb == "update") { $societes->insertUpdate($id, null, $data); }
                break;
            case "acteur":
                $acteurs = new CRUD_model();
                $acteurs->setOptions('acteur', 'numA');
                if ($verb == "get") { $data[$db] = $acteurs->get(); return $data[$db];}
                elseif ($verb == "delete") { $acteurs->delete($id);  }
                break;
            case "clients":
                $clients = new CRUD_model();
                $clients->setOptions('clients', 'numC');
                if ($verb == "get") { $data[$db] = $clients->get(); return $data[$db];}
                elseif ($verb == "delete") { $data[$db] = $clients->delete($id); }
                break;
            case "dvd":
                $dvd = new CRUD_model();
                $dvd->setOptions('dvd', 'numD');
                if ($verb == "get") { $data[$db] = $dvd->getJoin(null, "numD", "dvd"); return $data[$db];}
                elseif ($verb == "delete") { $dvd->delete($id); }
                break;
            case "employe":
                $employes = new CRUD_model();
                $employes->setOptions('employe', 'numSecu');
                if ($verb == "get") { $data[$db] = $employes->get(); }
                elseif ($verb == "delete") { $data[$db] = $employes->delete($id); }
                break;
            case "emprunt":
                $emprunts = new CRUD_model();
                $emprunts->setOptions('emprunt', 'numE');
                if ($verb == "get") { $data[$db] = $emprunts->getJoin(null, "numE", "emprunt"); return $data[$db];}
                elseif ($verb == "delete") { $data[$db] = $emprunts->delete($id); }
                break;
            case "genres":
                $genres = new CRUD_model();
                $genres->setOptions('genres', 'numG');
                if ($verb == "get") { $data[$db] = $genres->get(); return $data[$db];}
                elseif ($verb == "delete") { $data[$db] = $genres->delete($id); }
                break;
            case "notes":
                $notes = new CRUD_model();
                $notes->setOptions('notes', 'numN');
                if ($verb == "get") { $data[$db] = $notes->getJoin(null, "numN", "notes"); return $data[$db];}
                elseif ($verb == "delete") { $data[$db] = $notes->delete($id); }
                break;
            case "remarques":
                $remarques = new CRUD_model();
                $remarques->setOptions('remarques', 'numR');
                if ($verb == "get") { $data[$db] = $remarques->getJoin(null, "numR", "remarques"); return $data[$db];}
                elseif ($verb == "delete") { $data[$db] = $remarques->delete($id); }
                break;
        }
    }



    public function crud()
    {
        $db = $_POST['db'];
        $data[$db] = $this->getCrudModel($db,"get");

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data[$db]));

    }

    public function crud_delete()
    {
        $this->getCrudModel($_POST['db'],"delete", $_POST['id']);
        $this->output->set_output($_POST['db']);
    }

    public function crud_update()
    {
        $id = $_POST['data'][0]["value"];
        foreach ($_POST['data'] as $key => $value) {
            $data[$value["name"]] = $value["value"];
        }

        $this->getCrudModel($_POST['db'],"update", $id, $data);
        $this->output->set_output($_POST['db']);
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
}
