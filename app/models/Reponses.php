<?php
  //le model de la table reponses.
  class Reponses extends Model{
    
    public function __construct(){

        //creation de la connaxion.
        $this->db = new Database();     
    }

    //ajouter un question
    public function addreponse($data){

      //préparation de la requete
      $this->db->preRequest('INSERT INTO reponses (reponse, bonne, question) VALUES(:reponse, :bonne, :question)');
      
      //association des valeurs
      $this->db->bindvalue(':reponse', $data['reponse']);
      $this->db->bindvalue(':bonne', $data['bonne']);
      $this->db->bindvalue(':question', $data['question']);

      // executer la requete
      if($this->db->executeData()){

        return true;

      } else {

        return false;
      }
    }

     //supprimer un reponse
    public function deleterep($id){

      //préparation de la requete
      $this->db->preRequest('DELETE FROM reponses WHERE id = :id');
      
      //association des valeurs
      $this->db->bindvalue(':id', $id);

      // executer la requete
      if($this->db->executeData()){

        return true;

      } else {

        return false;
      }
    }

      //supprimer un reponse
    public function bonnerep($id, $rep){

      //préparation de la requete
      $this->db->preRequest('SELECT * FROM reponses WHERE question = :id AND bonne = 1' );
      
      //association des valeurs
      $this->db->bindvalue(':id', $id);

      //récuperer l'enregestrement
      $row = $this->db->getRow();
      if (!empty($row)){
        if (strcmp($row->reponse , $rep) == 0) {

          return true;
        }
      }
      // executer la requete
        return false;
    }


        //list question
    public function listeReponses($idquestion){

      //préparation de la requete
      $this->db->preRequest('SELECT * FROM reponses WHERE question = '.$idquestion);

      $rows = $this->db->getRowsTable();

       return $rows;
    }


/*
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
  */

  }