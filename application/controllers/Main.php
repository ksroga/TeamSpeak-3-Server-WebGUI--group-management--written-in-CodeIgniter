<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->model(array('TS3_Model', 'XSSClean_Model'));
		$serverInfo = $this->TS3_Model->serverInfo();
		$clientInfo = $this->TS3_Model->getUserInfoByIP($this->input->ip_address());

		$data['status'] = array(
			'online' => $serverInfo['data']['virtualserver_clientsonline'],
			'maxclients' => $serverInfo['data']['virtualserver_maxclients']
		);

		$data['view'] = array(
			'title' => "Strona Główna",
			'client' => $clientInfo,
			'news' => $this->getServerNews(),
			'avatar' => $this->TS3_Model->getUserAvatar($clientInfo['client_unique_identifier'])
			);

		if($data['view']['client']) {
			$data['view']['client']['client_nickname'] = $this->XSSClean_Model->clean_input($data['view']['client']['client_nickname']);
			$data['view']['client']['client_servergroups'] = explode(",", $data['view']['client']['client_servergroups']);
		}

		$this->load->view('header', $data['status']);
		$this->load->view('menu');
		$this->load->view('home', $data['view']);
		$this->load->view('footer');
	}





	private function getServerNews() 
	{
		$channelInfo = $this->TS3_Model->channelInfo($this->config->item('cID_news'));
		return $this->TS3_Model->BBCode($channelInfo['data'][0]['channel_description']);
	}
}
