<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class my_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->helper(array('global_helper','form','url'));
		$this->config->load('page_restrictions');

		/* CHECK IF USER IS LOGGED IN */
        if(!isset($_SESSION['rs_user'])){
            redirect('login', 'refresh');
        }

		/* CHECK PAGE RESTRICTIONS */
		$current_page = $this->router->fetch_class()."/".$this->router->fetch_method();

		if(in_array($current_page, $this->config->item('restricted_pages')) || in_array(uri_string(), $this->config->item('restricted_pages'))){
		    redirect('home/dashboard', 'refresh');
		}

// 		/* Load Caching Driver */
// 		$this->load->driver('cache',
// 				array('adapter' => 'memcached', 'backup' => 'file', 'key_prefix' => 'my_')
// 				);
	}

	public function __destruct() {
        
	}

}
