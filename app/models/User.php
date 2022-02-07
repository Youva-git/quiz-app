<?php
  //le model de la table users.
  class User extends Model{
    
    //public $dataBase;

    public function __construct(){

        //creation de la connaxion.
        $this->db = new Database();     
    }

    // connect d'un utilisateur 
    public function connect($username, $password){

      $this->db->preRequest('SELECT * FROM users WHERE username = :username');
      $this->db->bindvalue(':username', $username);

      //récuperer l'enregestrement
      $row = $this->db->getRow();

      //verification de password   
      if(password_verify($password, $row->password)){

        return $row;

      } else {

        return null;
      }
    }

    // enregestrement d'un utilisateur
    public function signup($data){

      //préparation de la requete
      $this->db->preRequest('INSERT INTO users (username, email, password, admin) VALUES(:username, :email, :password, :admin)');
      
      //association des valeurs
      $this->db->bindvalue(':username', $data['username']);
      $this->db->bindvalue(':email', $data['email']);
      $this->db->bindvalue(':password', $data['password']);
      $this->db->bindvalue(':admin', 0);

      // executer la requete
      if($this->db->executeData()){

        return true;

      } else {

        return false;
      }
    }

    //verifier si l'utilisateur est admin ou non
    public function isAdmin($username, $password){


      $row = $this->connect($username, $password);

      if(!empty($row)){
          $admin = $row->admin;
          //if admin = 1 et non siono.
          return $admin; 
      }

    }

    //verification par username
    public function findByUsername($username){

     $this->db->preRequest('SELECT * FROM users WHERE username = :username');
      

      $this->db->bindvalue(':username', $username);

      $fetch = $this->db->executeData();

      // Check row
      if($this->db->countRow() > 0){
        return true;
      } else {
        return false;
      }

    }


    //verification par mail
    public function findByEmail($email){

     $this->db->preRequest('SELECT * FROM users WHERE email = :email');
      
      // Bind value
     //print_r($password);

      $this->db->bindvalue(':email', $email);

      $fetch = $this->db->executeData();

      // Check row
      if($this->db->countRow() > 0){
        return true;
      } else {
        return false;
      }

    }

  }