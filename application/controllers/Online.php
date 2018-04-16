<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Online extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('TS3_Model', 'MySQL_Model', 'XSSClean_Model'));
        $this->load->helper('url');
    }

	public function index()
	{
		$serverInfo = $this->TS3_Model->serverInfo();
		$clientInfo = $this->TS3_Model->getUserInfoByIP($this->input->ip_address());
		$data = array(
			'title' => "Osoby Online",
			'client' => $clientInfo,
			'clients' => $this->getOnlineUsers()
			);

		$data['status'] = array(
			'online' => $serverInfo['data']['virtualserver_clientsonline'],
			'maxclients' => $serverInfo['data']['virtualserver_maxclients']
		);
		
		$this->load->view('header', $data['status']);
		$this->load->view('menu');
		$this->load->view('online', $data);
		$this->load->view('footer');
	}

	private function getOnlineUsers() {
		$users = $this->MySQL_Model->getOnlineUsers();

		foreach($users as $user) {
			$user->client_nickname = $this->XSSClean_Model->clean_input($user->client_nickname);
		}

		return $users;
	}


}
