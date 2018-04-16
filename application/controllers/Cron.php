<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('TS3_Model', 'MySQL_Model', 'XSSClean_Model'));
        $this->load->helper('url');
    }

	public function updateUsers($pass) {
		if($pass != "cron69")
			die();
		$clients = $this->TS3_Model->clientList("-ip -client_database_id -uid -groups");
		foreach($clients['data'] as $key => $client) {
			$clients['data'][$key]['avatar'] = $this->TS3_Model->getUserAvatar($client['client_unique_identifier']);
		}
		$this->MySQL_Model->updateOnlineUsers($clients['data']);
	}

}
