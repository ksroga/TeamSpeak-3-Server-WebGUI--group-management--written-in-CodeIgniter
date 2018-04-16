<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

	public function index($password = NULL) {
		if(!$password || $password !== 'R3XM4gnum')
			die("Nieprawidłowe hasło!");


	}

}