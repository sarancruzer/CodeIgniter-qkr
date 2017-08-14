<?php
class User extends CI_model {

  public function __construct()
  {
    parent::__construct();
  }
  public function insertUser($user)
  {
    $this->db->insert('users', $user);
    return $this->db->insert_id();
  }
  public function insertFA($fa)
  {
    $this->db->insert('fa_users', $fa);
    return $this->db->insert_id();   
  }
  public function signIn()
  {

  }
  public function signOut()
  {

  }
}

