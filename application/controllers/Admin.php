<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('TS3_Model');
	}

	public function index()
	{
		$info = $this->loadInfo();
		$data = array(
			'title' => "Panel Administratora",
			'online' => $info['server']['data']['virtualserver_clientsonline'],
			'maxclients' => $info['server']['data']['virtualserver_maxclients'],
			'client' => $info['client']
			);

		if($this->isAllowed($info['client']['client_servergroups'], $data)) {
			$this->load->view('admin_index', $data);
		}
	}

	public function article()
	{
		$this->load->helper(array('form', 'url'));
		$info = $this->loadInfo();
		$data = array(
			'online' => $info['server']['data']['virtualserver_clientsonline'],
			'maxclients' => $info['server']['data']['virtualserver_maxclients'],
			'client' => $info['client']
			);
		if($this->uri->segment(3) == "add") {
			$data['title'] = "Dodaj nowy post";
			if(!$this->input->post()) {
				if($this->isAllowed($info['client']['client_servergroups'], $data)) {
						$this->load->view('admin_article_add', $data);
				}
			} else {
				if(strlen($this->input->post('title')) != 0  && strlen($this->input->post('text')) != 0) {
					if($this->isAllowed($info['client']['client_servergroups'], $data)) {
						$this->load->model('MySQL_Model');
						$data['title'] = $this->input->post('title');
						$data['text'] = $this->input->post('text');
						$this->load->view('admin_article_success', $data);
						$this->MySQL_Model->addArticle($data['title'], $data['text'], $data['client']['client_unique_identifier']);
					}
				} else {
					if($this->isAllowed($info['client']['client_servergroups'], $data)) {
						$this->load->view('admin_article_error', $data);
					}
				}
			}
		} else if ($this->uri->segment(3) == "edit" && $this->uri->segment(4)) {
			$data['title'] = "Edytuj istniejący artykuł";
			$this->load->model('MySQL_Model');
			if(!$this->input->post()) {
				if($this->isAllowed($info['client']['client_servergroups'], $data)) {
						$data['article'] = $this->MySQL_Model->getArticle($this->uri->segment(4));
						if($data['article']) {
							$this->load->view('admin_article_edit', $data);
						} else {
							die("Wystąpił błąd. Skontaktuj się z administratorem.");
						}
						
				}
			} else {
				if(strlen($this->input->post('title')) != 0  && strlen($this->input->post('text')) != 0) {
					if($this->isAllowed($info['client']['client_servergroups'], $data)) {
						$data['title'] = $this->input->post('title');
						$data['text'] = $this->input->post('text');
						$data['id'] = $this->uri->segment(4);
						if($this->MySQL_Model->updateArticle($data['id'], $data['title'], $data['text'], $data['client']['client_unique_identifier'])) {
							$this->load->view('admin_article_edit_success', $data);
						} else {
							die("Wystąpił błąd. Skontaktuj się z administratorem.");
						}
					}
				} else {
					if($this->isAllowed($info['client']['client_servergroups'], $data)) {
						$this->load->view('admin_article_error', $data);
					}
				}
			}
		} else if ($this->uri->segment(3) == "remove" && $this->uri->segment(4)) {
			if($this->isAllowed($info['client']['client_servergroups'], $data)) {
				$this->load->model('MySQL_Model');
				$data['id'] = $this->uri->segment(4);
				$data['article'] = $this->MySQL_Model->getArticle($data['id']);
				if($data['article']) {
					if(!$this->input->post()) {
						$this->load->view('admin_article_remove', $data);
					} else {
						$this->MySQL_Model->removeArticle($this->input->post('id'));
						$this->load->view('admin_article_remove_success', $data);
					}
				} else {
					die("Wystąpił błąd. Skontaktuj się z administratorem.");
				}
			}
		} else {
			if($this->isAllowed($info['client']['client_servergroups'], $data)) {
				$this->load->model('MySQL_Model');
				$data['articles'] = $this->MySQL_Model->getAllArticles();
				$this->load->view('admin_articles', $data);
			}
		}
	}

	public function settings() 
	{
		$this->load->helper(array('form', 'url'));
		$info = $this->loadInfo();
		$data = array(
			'online' => $info['server']['data']['virtualserver_clientsonline'],
			'maxclients' => $info['server']['data']['virtualserver_maxclients'],
			'client' => $info['client'],
			'title' => "Ustawienia"
			);
		if($this->uri->segment(3) == "box") {
			if(!$this->input->post()) {
				if($this->isAllowed($info['client']['client_servergroups'], $data)) {
						$this->load->view('admin_settings_box', $data);
				}
			} else {

			}
		} else {
			die("Wystąpił błąd. Skontaktuj się z administratorem.");
		}

	}


	public function register()
	{
		$info = $this->loadInfo();
		$this->load->helper(array('form','url'));
		$data = array(
			'title' => "Rejestracja nowych użytkowników",
			'online' => $info['server']['data']['virtualserver_clientsonline'],
			'maxclients' => $info['server']['data']['virtualserver_maxclients'],
			'client' => $info['client'],
			'clients' => $this->TS3_Model->clientList("-groups -times")['data'],
			'channels' => Array()
			);
		if(!$this->uri->segment(3)) {
			if($this->isAllowed($info['client']['client_servergroups'], $data)) $this->load->view('admin_regusers', $data);
		} else {
			$data['registered_client'] = $this->TS3_Model->clientInfo($this->uri->segment(3))['data'];
			if($this->isAllowed($info['client']['client_servergroups'], $data)) $this->load->view('admin_regsuccess', $data);
			$this->TS3_Model->sendMessage(1, $this->uri->segment(3), $this->replaceMsg($this->config->item('register_msg'), $data['client']['client_nickname'], $data['registered_client']['client_nickname']));
			$this->TS3_Model->serverGroupAddClient($this->config->item('gid_REGISTERED'), $data['registered_client']['client_database_id']);
		}

	}

	private function isAllowed($groups, $data) 
	{
		$groups = explode(",", $groups);
		if(in_array($this->config->item('gid_ROOT'), $groups) || in_array($this->config->item('gid_ADMIN'), $groups) || in_array($this->config->item('gid_SUPP'), $groups)) {
			return true;
		} else {
			$this->load->view('admin_error', $data);
			return false;
		}

	}

	private function loadInfo() {
		$info['server'] = $this->TS3_Model->serverInfo();
		$info['client'] = $this->TS3_Model->getUserInfoByIP($this->input->ip_address());
		return $info;
	}

	private function replaceMsg($msg, $admin, $client) {
		$msg = str_replace("%a", $admin, $msg);
		$msg = str_replace("%u", $client, $msg);
		return $msg;
	}


}
