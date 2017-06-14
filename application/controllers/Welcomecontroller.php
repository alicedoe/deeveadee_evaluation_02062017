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
        $data['lastDvd'] = $dvd->getJoin(5, "numD", "dvd");
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

    public function catalogue($page=null)
    {
        $this->load->library('pagination');
        $dvds = new Crud_model();
        $dvds->setOptions('dvd', 'numD');
        $count = $dvds->get_total();

        $config['base_url'] = 'http://deeveadee.my/catalogue/page/';
        $config['total_rows'] = $count;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = '10';

        $config['next_link'] = 'Page suivante';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = 'Page précédente';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['per_page'] = 100;
        $config['first_url'] = '/catalogue/page/1';
        $config['full_tag_open'] = '<div id ="pagination" class="col-lg-12"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';


        if ($page==null) {
            $data['dvds'] = $dvds->catalogue($config['per_page'],1);
        } else {
            $deb = $config['per_page'] * $page - $config['per_page'];
            $data['dvds'] = $dvds->catalogue($config['per_page'],$deb);
        }
        $genres = new Crud_model();
        $genres->setOptions('genre', 'numG');
        $data['genres'] = $genres->get();
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();

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

        $data['totalnotes'] = $notes->get_total(array('dvdN' => $id));
        $data['numc'] = $this->session->userdata('numC');
        $data['prenom'] = $this->session->userdata('prenom');

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
            $data['total'] = $total;
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
        $remarque->insert(['dvdR' => $_POST['dvd'],'commentairesR' => $_POST['remarque'],'clientR' => $_POST['client']]);

        $data['prenom'] = $this->session->userdata('prenom');

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
        $dvds = new Crud_model();
        $dvds->setOptions('dvd', 'numD');
        $cb = 50;
        $deb = 100;
        $data['dvds'] = $dvds->catalogue($cb,$deb);

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }
}
