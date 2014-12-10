<?php

class Welcome extends CI_Controller {

	public function index()
	{
		$views['content_view'] = 'welcome';
		$views['section'] = 'welcome';
		$this->load->view('template', $views);
	}
}
