<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
		var $template_data      = array();
		var $template_directory = "layouts/";
		var $template_default   = "template_default";
		
		public function __construct(){
			
			$this->template = $this->template_directory.$this->template_default;
		}
		
		public function set($name, $value){
			$this->template_data[$name] = $value;
		}
		
	    public function set_template($my_template){
	    	$this->template = $this->template_directory.$my_template;
	    }
	
		public function load($template = '', $view = '' , $view_data = array(), $return = FALSE){               
			$this->CI =& get_instance();
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
			return $this->CI->load->view($template, $this->template_data, $return);
		}
		
		/** Load a default template 'template.php' */
	    public function view($view = '' , $view_data = array(), $return = FALSE){
	        $this->CI =& get_instance();
	        
// 	        $this->set('position_align', '');
	        $this->set('position_align', 'valign = "top"');

	        /** Set default header title */
	        if ( ! isset($this->template_data["header_title"]))  $this->template_data["header_title"] = 'EWPCI';
	        
	        $this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
	        return $this->CI->load->view($this->template, $this->template_data, $return);
	    }
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */