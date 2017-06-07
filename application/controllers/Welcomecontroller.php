<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcomecontroller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
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
        $societes = new Crud_model();
        $societes->setOptions('societe', 'numS');
        $data['societes'] = $societes->get();
        $dvd = new Crud_model();
        $dvd->setOptions('dvd', 'numD');
        $data['lastDvd'] = $dvd->getJoin(6, "numD", "dvd");
        $this->load->template('welcome_message', $data);
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
        $dvds = new Crud_model();
        $dvds->setOptions('dvd', 'numD');
        $data = $dvds->getByJoin($_POST['id'], "dvd","titreD,auteurD,anneeD,nomG,dateAchatD,	nombreD,consultationsD,nomS");
        $consult = $data[0]['consultationsD'] + 1;
        $dvds->update($_POST['id'], null, ['consultationsD' => $consult]);
        $this->load->library('table');
        $this->table->set_heading('Titre', 'Auteur', 'Année', 'Genre', 'Date d\'achat', 'Nombre(s) disponible(s)', 'Consultation(s)', 'Société');
        $template = array(
            'table_open'            => '<table border="0" class="col-md-12">'
        );
        $this->table->set_template($template);
        $data['tab'] = $this->table->generate($data);//
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
}
