<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {


	public function __construct() {

		parent::__construct();
		$this->load->model('TS3_Model');

	}


	public function rules() {
		$data = $this->getServerData();
		$data['rules'] = $this->getChannelDesc($this->config->item('cID_rules'));
		$data['content_box_name'] = "Regulamin serwera";
		$this->load->view('page', $data);
		$this->load->view('footer');	
	}


	private function getServerData() {
		$serverInfo = $this->TS3_Model->serverInfo();
		$clientInfo = $this->TS3_Model->getUserInfoByIP($this->input->ip_address());
		$data = array(
			'title' => "Strona Główna",
			'online' => $serverInfo['data']['virtualserver_clientsonline'],
			'maxclients' => $serverInfo['data']['virtualserver_maxclients'],
			'client' => $clientInfo,
			);
		return $data;
	}

	private function getChannelDesc($cID) {
		$channelInfo = $this->TS3_Model->channelInfo($cID);
		return $this->TS3_Model->BBCode($channelInfo['data'][0]['channel_description']);
	} 
}
