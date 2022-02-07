<?php

class Model{

	//attrubirt de base de donnée
   public $db;

    public function __construct(){
    
    }

    //trouver un enregestrement par ID
    public function findById($table, $id){
       //preparation de la requete
      $this->db->preRequest('SELECT * FROM '.$table.' WHERE id = :id');
      //association de la valeur
      $this->db->bindvalue(':id', $id);

      $stmt = $this->db->getRow();

      //retourner l'enregestrement
      return $stmt;
    }

        //trouver un enregestrement par ID
    public function findByAttr($table, $attr, $val){
       //preparation de la requete
      $this->db->preRequest('SELECT * FROM '.$table.' WHERE '.$attr.' = '.$val);

      //retourner l'enregestrement
      $tabrow = $this->db->getRowsTable();
      return $tabrow;
    }
    
    public function getAllTable($table){

        //preparation de la requete
       $this->db->preRequest('SELECT * FROM ' . $table);

       $rows = $this->db->getRowsTable();

       return $rows;
    }

    public function getAllUsers(){

     $this->db->preRequest('SELECT id,username,email FROM users where admin <> 1');

     $rows=$this->db->getRowsTable();
     return $rows;
    }

    public function deleteByID($table, $id){

     $this->db->preRequest('DELETE FROM '. $table .' WHERE id = '.$id);

     $this->db->bindvalue(':id', $id);

     // executer la requete
      if($this->db->executeData()){

        return true;

      } else {

        return false;
      }

    }    
}
