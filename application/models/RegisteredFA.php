<?php
class User extends CI_model {

  public function __construct()
  {
    parent::__construct();
  }
  public function insertUser($user)
  {
    $this->db->insert('users', $user);
  } 
}

