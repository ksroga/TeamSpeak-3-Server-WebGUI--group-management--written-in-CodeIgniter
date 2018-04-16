<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('TS3_Model','XSSClean_Model'));
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
    }

	public function index()
	{
		$this->add();
	}

	public function add()
	{
		$serverInfo = $this->TS3_Model->serverInfo();
		$clients = $this->TS3_Model->clientList("-ip -client_database_id");
		$groups = $this->TS3_Model->serverGroupList();
		$client_ranks = Array();

		$data = array(
			'title' => "Dodaj Grupy",
			'online' => $serverInfo['data']['virtualserver_clientsonline'],
			'maxclients' => $serverInfo['data']['virtualserver_maxclients'],
			'client_connected' => false,
			'client_dbid' => '',
			'groups' => Array()
			);

		foreach($clients['data'] as $client) {
			if($client['connection_client_ip'] == $this->input->ip_address()) { // find user
				$data['client_connected'] = true;
				$data['client_dbid'] = $client['client_database_id'];
				$client_groups = $this->TS3_Model->serverGroupsByClientID($data['client_dbid']);

				foreach($client_groups['data'] as $cgroup) {
					if( !($this->TS3_Model->isAdminGroup($cgroup['sgid']))) { 
						$client_ranks += Array($cgroup['sgid'] => $cgroup['sgid']); // save user ranks
					}
				}

				foreach($groups['data'] as $group) {
					if( !($this->TS3_Model->isAdminGroup($group['sgid']))) {
						if( !(in_array($group['sgid'],$client_ranks)) && !(strstr($group['name'],'==='))) {
							$data['groups'] += Array($group['sgid'] => Array($group['sgid'], $group['name'], $this->TS3_Model->icon($group['iconid'])));
						}
					}
				}
			}
		}

		if($_POST && $data['client_connected']) {
			$this->addGroups($data['client_dbid']);
			$this->load->view('g_success', $data);	
		} elseif($data['client_connected'] && count($client_ranks) < 10) {
			$this->load->view('g_add', $data);
		} else {
			$this->load->view('g_error', $data);
		}
		$this->load->view('footer');	
	}

	public function rem()
	{
		$serverInfo = $this->TS3_Model->serverInfo();
		$clients = $this->TS3_Model->clientList("-ip -client_database_id");
		$groups = $this->TS3_Model->serverGroupList();
		$client_ranks = Array();

		$data = array(
			'title' => "Usuń Grupy",
			'online' => $serverInfo['data']['virtualserver_clientsonline'],
			'maxclients' => $serverInfo['data']['virtualserver_maxclients'],
			'client_connected' => false,
			'client_dbid' => '',
			'groups' => Array()
			);

		foreach($clients['data'] as $client) {
			if($client['connection_client_ip'] == $this->input->ip_address()) { // find user
				$data['client_connected'] = true;
				$data['client_dbid'] = $client['client_database_id'];
				$client_groups = $this->TS3_Model->serverGroupsByClientID($data['client_dbid']);

				foreach($client_groups['data'] as $cgroup) {
					if( !($this->TS3_Model->isAdminGroup($cgroup['sgid']))) { 
						$client_ranks += Array($cgroup['sgid'] => $cgroup['sgid']); // save user ranks
					}
				}

				foreach($groups['data'] as $group) { 
					if( !($this->TS3_Model->isAdminGroup($group['sgid']))) { 
						if(in_array($group['sgid'],$client_ranks) && !(strstr($group['name'],'==='))) { 
							$data['groups'] += Array($group['sgid'] => Array($group['sgid'], $group['name'], $this->TS3_Model->icon($group['iconid'])));
						}
					}
				}
			}
		}

		if($_POST && $data['client_connected']) {
			$this->remGroups($data['client_dbid']);
			$this->load->view('g_success', $data);	
		} elseif($data['client_connected']  && count($client_ranks) != 0) {
			$this->load->view('g_rem', $data);	
		} else {
			$this->load->view('g_error', $data);
		}
		$this->load->view('footer');	
	}

	private function addGroups($dbid) 
	{
		foreach($_POST as $group) {
			if(!$this->TS3_Model->isAdminGroup($group) && is_numeric($group)) {
				$group = $this->XSSClean_Model->clean_input($group);
				$this->TS3_Model->serverGroupAddClient($group, $dbid);
			}
		}
	}

	private function remGroups($dbid)
	{
		foreach($_POST as $group) {
			if(!$this->TS3_Model->isAdminGroup($group) && is_numeric($group))  {
				$group = $this->XSSClean_Model->clean_input($group);
				$this->TS3_Model->serverGroupDeleteClient($group, $dbid);
			}
		}	
	}


}
