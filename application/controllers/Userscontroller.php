<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userscontroller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->library('form_validation');
        $this->load->helper('url_helper');
    }

    public function updateabo(){
        $clients = new CRUD_model();
        $clients->setOptions('clients', 'numC');
        $data = array(
            'abonnement'=>$this->input->post('idabo'),
            'nomC' => $this->input->post('nomC'),
            'prenomC'=>$this->input->post('prenomC'),
            'emailC' => $this->input->post('emailC'),
            'adresseC'=>$this->input->post('adresseC')
        );
        $clients->update($_POST['iduser'],null,$data);
//        $data['client'] = $clients->get($_POST['iduser']);
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }

    /*
     * User account information
     */
    public function account(){
        $data = array();
        if($this->session->userdata('isUserLoggedIn')){
            $client = new CRUD_model();
            $client->setOptions('clients', 'numC');
            $data['user'] = $client->getByJoin($this->session->userdata('numC'),"client");

            $dvdEmprunt = new CRUD_model();
            $dvdEmprunt->setOptions('emprunt', 'numE');
            $data['emprunts'] = $dvdEmprunt->empruntClient($this->session->userdata('numC'));

            $this->load->library('table');
            $template = array(
                'table_open'            => '<table border="0" class="col-md-12">'
            );
            $this->table->set_heading('Titre', 'Date d\'emprunt', 'Durée');

            $this->table->set_template($template);
            $data['tab'] = $this->table->generate($data['emprunts']);

            $data['user'] = $data['user'][0];

            $abonnements = new CRUD_model();
            $abonnements->setOptions('abonnement', 'numAbo');
            $data['abonnements'] = $abonnements->get();
            //load the view
            $data['view'] = "user";
            $this->load->template('users/account', $data);
        }else{
            redirect('users');
        }
    }

    /*
     * User login
     */
    public function login(){
        $data = array();
        if($this->input->post('emailC') && $this->input->post('motdepasseC')){
            $this->form_validation->set_rules('emailC', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('motdepasseC', 'password', 'required');
            if ($this->form_validation->run() == true) {
                $con = array(
                    'emailC'=>$this->input->post('emailC'),
                    'motdepasseC' => $this->input->post('motdepasseC')
                );
                $client = new CRUD_model();
                $client->setOptions('clients', 'numC');
                $checkLogin = $client->get($con);
                $data['test'] = $this->input->post('motdepasseC');
                if($checkLogin){
                    $this->session->set_userdata('isUserLoggedIn',TRUE);
                    $this->session->set_userdata('prenom',$checkLogin[0]['prenomC']);
                    $this->session->set_userdata('numC',$checkLogin[0]['numC']);
                    $data['isUserLoggedIn'] = true;
                    $data['prenom'] = $checkLogin[0]['prenomC'];
                }else{
                    $data['isUserLoggedIn'] = false;
                    $data['error_msg'] = 'Wrong email or password, please try again.';
                }
            }
        }


        //load the view
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }

    /*
     * User registration.php
     */
    public function registration(){
        $data = array();
        $userData = array();
        $test=0;
        if($this->input->post('nomC')){
            $this->form_validation->set_rules('nomC', 'Nom', 'required');
            $this->form_validation->set_rules('prenomC', 'Prénom', 'required');
            $this->form_validation->set_rules('adresseC', 'Adresse', 'required');
            $this->form_validation->set_rules('emailC', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('motdepasseC', 'Mot de passe', 'required');

            $userData = array(
                'nomC' => strip_tags($this->input->post('nomC')),
                'prenomC' => strip_tags($this->input->post('prenomC')),
                'adresseC' => strip_tags($this->input->post('adresseC')),
                'emailC' => strip_tags($this->input->post('emailC')),
                'motdepasseC' => strip_tags($this->input->post('motdepasseC')),
            );

            if($this->form_validation->run() == true){
                $test = 1;
                $client = new CRUD_model();
                $client->setOptions('clients', 'numC');
                $insert = $client->save($userData);
                $numc = $client->lastid();
                if($insert){
                    $this->session->set_userdata('success_msg', 'Votre compte à bien été créé');
                    $this->session->set_userdata('isUserLoggedIn',TRUE);
                    $this->session->set_userdata('prenom',$userData['prenomC']);
                    $this->session->set_userdata('numC',$numc);
                    $data['prenom'] = $userData['prenomC'];
                    $data['isUserCreated'] = true;
                }else{
                    $data['isUserCreated'] = false;
                    $data['error_msg'] = "Il y a eu un problème à l'enregistrement de votre compte";
                }
            } else {
                $data['isUserCreated'] = false;
                $data['error_msg'] = "Problème sur le formulaire";
            }
        }
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }

    /*
     * User logout
     */
    public function logout(){
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
    }

    /*
     * Existing email check during validation
     */
    public function email_check($str){
        $client = new CRUD_model();
        $client->setOptions('clients', 'numC');
        $con = array('emailC'=>$str);
        $checkEmail = $client->get($con);
        if(count($checkEmail) > 0){
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}