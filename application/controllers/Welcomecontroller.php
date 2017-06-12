<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcomecontroller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->library('form_validation');
        $this->load->helper('url_helper');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $dvd = new Crud_model();
        $dvd->setOptions('dvd', 'numD');
        $data['lastDvd'] = $dvd->getJoin(4, "numD", "dvd");
        $dvd = new Crud_model();
        $dvd->setOptions('notesmoyenne', 'dvdN');
        $data['moyennes'] = $dvd->getTopMoyenne();
        $this->load->template('welcome_message', $data);
	}

    public function abonnements() {
        $this->load->template('abonnements_view');
	}

    public function contact() {
        $this->load->template('contact_view');
    }

    public function magasins() {
        $magasins = new Crud_model();
        $magasins->setOptions('societe', 'numS');
        $data['magasins'] = $magasins->get();

        $this->load->template('magasins_view',$data);
    }

    public function catalogue()
    {
        $dvds = new Crud_model();
        $dvds->setOptions('dvd', 'numD');
        $data['dvds'] = $dvds->getJoin(null, "numD", "dvd", "numD,titreD,auteurD,anneeD,nomG");
        $genres = new Crud_model();
        $genres->setOptions('genre', 'numG');
        $data['genres'] = $genres->get();

        $this->load->library('table');
        $this->table->set_heading('Id', 'Titre', 'Auteur', 'Année', 'Genre');
        $template = array(
            'table_open'            => '<table border="0" class="col-md-12">'
        );



        $this->table->set_template($template);
        $data['tab'] = $this->table->generate($data['dvds']);

        $this->load->template('catalogue_view', $data);
    }

    public function dvdGenre()
    {
        $dvds = new Crud_model();
        $dvds->setOptions('dvd', 'numD');
        $idgenre = $_POST['id'];
        if ($idgenre == "*") {
            $data = $dvds->get();
        } else { $data = $dvds->get(array('genre_numG'=>$idgenre)); }

        $this->load->library('table');
        $this->table->set_heading('Id', 'Titre', 'Auteur', 'Année', 'Genre');
        $template = array(
            'table_open'            => '<table border="0" class="col-md-12">'
        );

        $this->table->set_template($template);
        $data['tab'] = $this->table->generate($data);

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }

    public function detaildvd()
    {
        $id = $this->uri->segment(2);
        $dvds = new Crud_model();
        $dvds->setOptions('dvd', 'numD');
        $data['dvd'] = $dvds->getByJoin($id, "dvd","titreD,auteurD,anneeD,nomG,dateAchatD,nombreD,consultationsD,nomS,numD");

        $notes = new Crud_model();
        $notes->setOptions('notes', 'numN');
        $total = $notes->notes($id);
        if (count($total)>0) {
            $moyenne = new Crud_model();
            $moyenne->setOptions('notesmoyenne', 'dvdN');
            $data['moyenne'] = $moyenne->getTopMoyenne($id);
            $data['moyenne'] = intval(round($data['moyenne'][0]['moyenne']));
            if(isset($_SESSION['numC'])) {
                $data['anote'] = $notes->get_total(array('dvdN' => $id, 'clientN' => $_SESSION['numC'])); }
            $consult = $data['dvd'][0]['consultationsD'] + 1;
            $dvds->update($id, null, ['consultationsD' => $consult]);
        }

        $remarques = new Crud_model();
        $remarques->setOptions('remarques', 'numR');
        $data['listeremarques'] = $remarques->remarques($id);

        $this->load->library('table');
        $this->table->set_heading('Titre', 'Auteur', 'Année', 'Genre', 'Date d\'achat', 'Nombre(s) disponible(s)', 'Consultation(s)', 'Société');
        $template = array(
            'table_open'            => '<table border="0" class="col-md-12">'
        );
        $this->table->set_template($template);
        $data['tab'] = $this->table->generate($data['dvd']);
        if($this->session->userdata('isUserLoggedIn')){ $data['isUserLoggedIn'] = true; } else { $data['isUserLoggedIn'] = false; }

        $this->load->template('detaildvd_view',$data);
    }

    public function note()
    {
        $notes = new Crud_model();
        $notes->setOptions('notes', 'numN');
        $data['n'] = $_POST['note'];
        $data['i'] = $_POST['dvd'];
        $data['c'] = $_SESSION['numC'];
        $notes->insert(['dvdN' => $_POST['dvd'],'noteN' => $_POST['note'],'clientN' => $_SESSION['numC']]);
        $total = $notes->notes($_POST['dvd']);
            $data['moyenne'] = (array_sum(array_map(function ($arr) {
                    return $arr['noteN'];
                }, $total))) / count($total);
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }

    public function remarque()
    {
        $data['test'] = "test";
        $data['dvd'] = $_POST['dvd'];
        $data['remarque'] = $_POST['remarque'];
        $remarque = new Crud_model();
        $remarque->setOptions('remarques', 'numR');
        $remarque->insert(['dvdR' => $_POST['dvd'],'commentairesR' => $_POST['remarque']]);

        $listeremarques = $remarque->remarques($_POST['dvd']);

        $this->load->library('table');
        $data['rem'] = $this->table->generate($listeremarques);

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }

    public function checkSession()
    {
        if($this->session->userdata('isUserLoggedIn')){ $data = $_SESSION['isUserLoggedIn']; }
        else{
            $data = "ko";
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }

    public function test() {
        $_POST['id'] = 1000;
        $dvds = new Crud_model();
        $dvds->setOptions('dvd', 'numD');
        $data['dvd'] = $dvds->getByJoin($_POST['id'], "dvd","titreD,auteurD,anneeD,nomG,dateAchatD,nombreD,consultationsD,nomS");

        $notes = new Crud_model();
        $notes->setOptions('notes', 'numN');
        $total = $notes->notes($_POST['id']);
        if (count($total)>0) {
            $moyenne = new Crud_model();
            $moyenne->setOptions('notesmoyenne', 'dvdN');
            $data['moyenne'] = $moyenne->getTopMoyenne($_POST['id']);
            if(isset($_SESSION['numC'])) {
                $data['anote'] = $notes->get_total(array('dvdN' => $_POST['id'], 'clientN' => $_SESSION['numC'])); }
            $consult = $data['dvd'][0]['consultationsD'] + 1;
            $dvds->update($_POST['id'], null, ['consultationsD' => $consult]);
        }

        $remarques = new Crud_model();
        $remarques->setOptions('remarques', 'numR');
        $listeremarques = $remarques->remarques($_POST['id']);

        $this->load->library('table');
        $this->table->set_heading('Titre', 'Auteur', 'Année', 'Genre', 'Date d\'achat', 'Nombre(s) disponible(s)', 'Consultation(s)', 'Société');
        $template = array(
            'table_open'            => '<table border="0" class="col-md-12">'
        );
        $this->table->set_template($template);
        $data['tab'] = $this->table->generate($data['dvd']);

        $this->table->set_heading('Id remarque', 'Id Dvd', 'Remarque');
        $data['rem'] = $this->table->generate($listeremarques);

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }
}
