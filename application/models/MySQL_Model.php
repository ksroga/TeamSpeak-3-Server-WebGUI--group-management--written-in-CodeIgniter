<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MySQL_Model extends CI_Model {

	public function addArticle($title, $text, $author) {
		$this->db->query("INSERT INTO `articles`(`topic`, `contents`, `author`, `date`) VALUES ('".$title."', '".$text."', '".$author."', UNIX_TIMESTAMP());");
	}

	public function getArticle($id) {
		$article = mysqli_fetch_row($this->db->query("SELECT * FROM `articles` WHERE `id` = ".$id.";"));
		if($article) {
			return $article;
		} else {
			return 0;
		}
	}

	public function updateArticle($id, $title, $text, $author) {
		$exists = $this->db->query("SELECT * FROM `articles` WHERE `id`=".$id."");
		$this->db->query("UPDATE `articles` SET `topic`='".$title."', `contents`='".$text."' WHERE `id`=".$id.";");
		$this->db->query("INSERT INTO `editions`(`article_id`, `author`, `date`) VALUES (".$id.", '".$author."', UNIX_TIMESTAMP());");
		if($exists) {
			return 1;
		} else {
			return 0;
		}
	}

	public function getAllArticles() {
		$articles = $this->db->query("SELECT * FROM `articles`;");
		return $articles;
	}

	public function removeArticle($id) {
		$this->db->query("DELETE FROM `articles` WHERE `id`=".$id."");
	}


	public function addVisit($visitor, $profile) {
		$this->db->query("INSERT INTO `visits` (`visitor_dbid`, `profile_dbid`, `date`) VALUES (".$visitor.", ".$profile.", UNIX_TIMESTAMP());");
	}

	public function getVisits($profile) {
		$query = $this->db->query("SELECT DISTINCT `visitor_dbid`, `date` FROM `visits` WHERE `profile_dbid` = ".$profile." AND `visitor_dbid` != 0 ORDER BY `date` DESC LIMIT 5;");
		$return = array();
		foreach($query->result() as $row) {
			$return[] = array(
				'dbid' => $row->visitor_dbid,
				'date' => $row->date
				);
		}
		return $return;
	}

	public function updateOnlineUsers($data) {
		$this->db->query("DELETE FROM `online` WHERE 1;");

		foreach ($data as $client) {
			$this->db->query("INSERT INTO `online`(`clid`, `cid`, `cl_db_id`, `client_nickname`, `client_type`, `client_ip`, `client_avatar`) VALUES (".$client['clid'].",".$client['cid'].",".$client['client_database_id'].",'".$client['client_nickname']."',".$client['client_type'].",'".$client['connection_client_ip']."','".$client['avatar']."');");
		}
	}

	public function getOnlineUsers() {
		$this->db->select('*');
		$this->db->from('online');

		$users = $this->db->get();
		
		return $users->result();
	}
}