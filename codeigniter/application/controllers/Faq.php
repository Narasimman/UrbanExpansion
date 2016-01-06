<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Faq extends CI_Controller {
	public function view($page = 'faq') {
		 if ( ! file_exists(APPPATH.'/views/'.$page.'.php')) {
                // Whoops, we don't have a page for that!
                show_404();
        	}

        	$data['title'] = ucfirst($page); // Capitalize the first letter

	        $this->load->view('templates/header', $data);
        	$this->load->view($page, $data);
	        $this->load->view('templates/footer', $data);

	}
}
