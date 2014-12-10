<?php
class App_Controller extends CI_Controller {

	protected $_user = null;
	
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('user')) {
			$this->_user = $this->session->userdata('user');
		} else {
			redirect('admin/login', 'refresh');
		}
    }
}
