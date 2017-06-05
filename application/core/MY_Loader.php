<?php

class MY_Loader extends CI_Loader {
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
            $content  = $this->view('templates/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('templates/footer', $vars, $return);

            return $content;
        else:
            $this->view('templates/header', $vars);
            $this->view($template_name, $vars);
            $this->view('templates/footer', $vars);
        endif;
    }

    public function templateAdmin($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
            $content  = $this->view('templates/admin_header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('templates/admin_footer', $vars, $return);

            return $content;
        else:
            $this->view('templates/admin_header', $vars);
            $this->view($template_name, $vars);
            $this->view('templates/admin_footer', $vars);
        endif;
    }
}