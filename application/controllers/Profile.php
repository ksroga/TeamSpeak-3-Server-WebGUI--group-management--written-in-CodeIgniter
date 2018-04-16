<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('TS3_Model', 'MySQL_Model', 'XSSClean_Model'));
        $this->load->helper('url');
    }

    public function _remap($method)
    {
        	$this->index($method);
    }

	public function index($dbid)
	{
		$serverInfo = $this->TS3_Model->serverInfo();
		$clientInfo = $this->TS3_Model->getUserInfoByIP($this->input->ip_address());
		$data = array(
			'online' => $serverInfo['data']['virtualserver_clientsonline'],
			'maxclients' => $serverInfo['data']['virtualserver_maxclients'],
			'client' => $clientInfo,
			'profileInfo' => $this->TS3_Model->clientDbInfo($dbid)['data']
			);
		$data['profileAvatar'] = $this->TS3_Model->getUserAvatar($data['profileInfo']['client_unique_identifier']);
		$data['profileInfo']['client_nickname'] = $this->XSSClean_Model->clean_input($data['profileInfo']['client_nickname']);
		$data['profileInfo']['client_description'] = $this->XSSClean_Model->clean_input($data['profileInfo']['client_description']);

		if(is_numeric($dbid) && $data['profileInfo']) {
			if(!$data['client']['client_database_id']) $data['client']['client_database_id'] = 0;
			if($data['client']['client_database_id'] != $dbid) $this->MySQL_Model->addVisit($data['client']['client_database_id'], $dbid);
			$data['visits'] = $this->getVisitorsInfo($this->MySQL_Model->getVisits($dbid));
			$this->load->view('profile', $data);
			$this->load->view('footer');
		} else {
			$this->load->view('profile_error', $data);
		}

	}

	private function getVisitorsInfo($visitors) {
		$visits = array();
		foreach($visitors as $visitor) {
			$visits[$visitor['dbid']] = $this->TS3_Model->clientDbInfo($visitor['dbid'])['data'];
			$visits[$visitor['dbid']]['profileAvatar'] = $this->TS3_Model->getUserAvatar($visits[$visitor['dbid']]['client_unique_identifier']);
			$visits[$visitor['dbid']]['date'] = gmdate('d-m-Y H:i', $visitor['date']+3600);
			$visits[$visitor['dbid']]['client_nickname'] = $this->XSSClean_Model->clean_input($visits[$visitor['dbid']]['client_nickname']);
		}
		return $visits;
	}


}
