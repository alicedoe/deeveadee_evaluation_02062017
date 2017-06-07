<?php

class Admincontroller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $this->load->templateAdmin('admin_view');

    }

    public function getCrudModel ($db,$verb,$id=null,$data=null) {
        switch ($db) {
            case "societe":
                $societes = new CRUD_model();
                $societes->setOptions('societe', 'numS');
                if ($verb == "get") { $data["resultsql"] = $societes->get(); return $data["resultsql"];}
                elseif ($verb == "delete") { $societes->delete($id); }
                elseif ($verb == "update") { $societes->insertUpdate($id, null, $data); }
                break;
            case "acteur":
                $acteurs = new CRUD_model();
                $acteurs->setOptions('acteur', 'numA');
                if ($verb == "get") { $data["resultsql"] = $acteurs->get(); return $data["resultsql"];}
                elseif ($verb == "delete") { $acteurs->delete($id);  }
                break;
            case "clients":
                $clients = new CRUD_model();
                $clients->setOptions('clients', 'numC');
                if ($verb == "get") { $data["resultsql"] = $clients->get(); return $data["resultsql"];}
                elseif ($verb == "delete") { $data[$db] = $clients->delete($id); }
                break;
            case "dvd":
                $dvd = new CRUD_model();
                $dvd->setOptions('dvd', 'numD');
                if ($verb == "get") { $data["resultsql"] = $dvd->getJoin(10, "numD", "dvd");
                    $genres = new CRUD_model();
                    $genres->setOptions('genre', 'numG');
                    $data["genres"] = $genres->get();
                return $data;}
                elseif ($verb == "delete") { $dvd->delete($id); }
                break;
            case "employe":
                $employes = new CRUD_model();
                $employes->setOptions('employe', 'numSecu');
                if ($verb == "get") { $data["resultsql"] = $employes->get(); return $data["resultsql"];}
                elseif ($verb == "delete") { $data[$db] = $employes->delete($id); }
                break;
            case "emprunt":
                $emprunts = new CRUD_model();
                $emprunts->setOptions('emprunt', 'numE');
                if ($verb == "get") { $data["resultsql"] = $emprunts->getJoin(null, "numE", "emprunt"); return $data["resultsql"];}
                elseif ($verb == "delete") { $data[$db] = $emprunts->delete($id); }
                break;
            case "genre":
                $genres = new CRUD_model();
                $genres->setOptions('genre', 'numG');
                if ($verb == "get") { $data["resultsql"] = $genres->get(); return $data["resultsql"];}
                elseif ($verb == "delete") { $data[$db] = $genres->delete($id); }
                break;
            case "notes":
                $notes = new CRUD_model();
                $notes->setOptions('notes', 'numN');
                if ($verb == "get") { $data["resultsql"] = $notes->getJoin(null, "numN", "notes"); return $data["resultsql"];}
                elseif ($verb == "delete") { $data[$db] = $notes->delete($id); }
                break;
            case "remarques":
                $remarques = new CRUD_model();
                $remarques->setOptions('remarques', 'numR');
                if ($verb == "get") { $data["resultsql"] = $remarques->getJoin(null, "numR", "remarques"); return $data["resultsql"];}
                elseif ($verb == "delete") { $data[$db] = $remarques->delete($id); }
                break;
        }
    }



    public function crud()
    {
        $data = $this->getCrudModel($_POST['db'],"get");
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));

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
        $db = "societe";
        $data = $this->getCrudModel($db,"get");
        var_dump($data);

    }
}
