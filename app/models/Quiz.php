<?php
  //le model de la table quiz
  class Quiz extends Model{
    
    public function __construct(){

        //creation de la connaxion.
        $this->db = new Database();     
    }

    //ajouter un quiz
    public function addquiz($data){

      //préparation de la requete
      $this->db->preRequest('INSERT INTO quiz (title, description, public, user) VALUES(:title, :description, :public, :user)');
      
      //association des valeurs
      $this->db->bindvalue(':title', $data['title']);
      $this->db->bindvalue(':description', $data['description']);
      $this->db->bindvalue(':public', $data['public']);
       $this->db->bindvalue(':user', $data['user']);

      // executer la requete
      if($this->db->executeData()){

        return true;

      } else {

        return false;
      }
    }

    //modifier title un quiz
    public function updatequiztitle($id, $title){

      //préparation de la requete
      $this->db->preRequest('UPDATE quiz SET title = :title WHERE id = :id');
      
      //association des valeurs
      $this->db->bindvalue(':title',$title);
      $this->db->bindvalue(':id', $id);

      // executer la requete
      if($this->db->executeData()){

        return true;

      } else {

        return false;
      }
    }

    //modifier description un quiz
    public function updatequizdesc($id, $description){

      //préparation de la requete
      $this->db->preRequest('UPDATE quiz SET description = :description WHERE id = :id');
      
      //association des valeurs
      $this->db->bindvalue(':description',$description);
      $this->db->bindvalue(':id', $id);

      // executer la requete
      if($this->db->executeData()){

        return true;

      } else {

        return false;
      }
    }

    //supprimer un quiz
    public function deletequiz($id){

      //préparation de la requete
      $this->db->preRequest('DELETE FROM quiz WHERE id = :id');
      
      //association des valeurs
      $this->db->bindvalue(':id', $id);

      // executer la requete
      if($this->db->executeData()){

        return true;

      } else {

        return false;
      }
    }

    //rendre publique un quiz
    public function publicquiz($id){

      //préparation de la requete
      $this->db->preRequest('UPDATE quiz SET public = :public WHERE id = :id');
      
      //association des valeurs
      $this->db->bindvalue(':public',$public);
      $this->db->bindvalue(':id', $id);

      // executer la requete
      if($this->db->executeData()){

        return true;

      } else {

        return false;
      }
    }

    public function listquiz($iduser){

        //preparation de la requete
       $this->db->preRequest('SELECT * FROM quiz WHERE user = ' . $iduser);

       $rows = $this->db->getRowsTable();

       return $rows;
    }

    //nom quiz
    public function nomquiz($idquiz){

        //preparation de la requete
       $this->db->preRequest('SELECT title FROM quiz WHERE id = ' . $idquiz);

       $rows = $this->db->getRowsTable();

       return $rows;
    }

    //
    public function listquizpublic(){

        //preparation de la requete
       $this->db->preRequest('SELECT * FROM quiz WHERE public = 1');

       $rows = $this->db->getRowsTable();

       return $rows;
    }

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
