<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userscontroller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->library('form_validation');
        $this->load->helper('url_helper');
    }

    /*
     * User account information
     */
    public function account(){
        $data = array();
        if($this->session->userdata('isUserLoggedIn')){
            $client = new CRUD_model();
            $client->setOptions('clients', 'numC');
            $data['user'] = $client->get(array('numC'=>$this->session->userdata('numC')));
            $data['user'] = $data['user'][0];
            //load the view
            $this->load->view('users/account', $data);
        }else{
            redirect('users/login');
        }
    }

    /*
     * User login
     */
    public function login(){
        $data = array();
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        if($this->input->post('loginSubmit')){
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
                $checkLogin = $checkLogin[0];
                if($checkLogin){
                    $this->session->set_userdata('isUserLoggedIn',TRUE);
                    $this->session->set_userdata('numC',$checkLogin['numC']);
                    redirect('users/account/');
                }else{
                    $data['error_msg'] = 'Wrong email or password, please try again.';
                }
            }
        }
        //load the view
        $this->load->template('users/login', $data);
    }

    /*
     * User registration.php
     */
    public function registration(){
        $data = array();
        $userData = array();
        if($this->input->post('regisSubmit')){
            $this->form_validation->set_rules('nomC', 'Nom', 'required');
            $this->form_validation->set_rules('prenomC', 'Prénom', 'required');
            $this->form_validation->set_rules('adresseC', 'Adresse', 'required');
            $this->form_validation->set_rules('emailC', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('motdepasseC', 'Mot de passe', 'required');
            $this->form_validation->set_rules('conf_password', 'Confirmation mot de passe', 'required|matches[motdepasseC]');

            $userData = array(
                'nomC' => strip_tags($this->input->post('nomC')),
                'prenomC' => strip_tags($this->input->post('prenomC')),
                'adresseC' => strip_tags($this->input->post('adresseC')),
                'emailC' => strip_tags($this->input->post('emailC')),
                'motdepasseC' => strip_tags($this->input->post('motdepasseC')),
            );

            if($this->form_validation->run() == true){
                $client = new CRUD_model();
                $client->setOptions('clients', 'numC');
                $insert = $client->save($userData);
                if($insert){
                    $this->session->set_userdata('success_msg', 'Your registration.php was successfully. Please login to your account.');
                    redirect('users/login');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }
        $data['user'] = $userData;
        //load the view
        $this->load->template('users/registration.php', $data);
    }

    /*
     * User logout
     */
    public function logout(){
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('users/login/');
    }

    /*
     * Existing email check during validation
     */
    public function email_check($str){
        $con['returnType'] = 'count';
        $con['conditions'] = array('email'=>$str);
        $checkEmail = $this->user->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}