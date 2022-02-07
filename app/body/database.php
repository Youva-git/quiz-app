<?php

   // DB Params
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', 'passe');
  define('DB_NAME', 'projett');
  
  /*
   * création la base de donnée. 
   */
  class Database {

    //les paramatres de la base de donnée.
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    //$stmt
    private $data;
    private $error;

    public function __construct(){
      
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
      $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      // création de la PDO 
      try{

        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);

      } catch(PDOException $e){

        $this->error = $e->getMessage();

        echo $this->error;

        die($e);
      }
    }

    // Préparer l'instruction avec la requête
    public function preRequest($sql){
        $this->data = $this->dbh->prepare($sql);
    }

    //la derniere insertion.
    public function getLastInserted(){
      return  $this->dbh->lastInsertId();
      
    }

    //Associe une valeur à un paramètre
    public function bindvalue($param, $value, $type = null){

      if(is_null($type)){
        switch(true){
          case is_int($value):
            $type = PDO::PARAM_INT;
            break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
          default:
            $type = PDO::PARAM_STR;
        }
      }

      $this->data->bindValue($param, $value, $type);

    }

    //executer la requete
    public function executeData(){

      return $this->data->execute();
    }

    // Obtenir résultats sous forme de tableau d'objets
    public function getRowsTable(){

      $this->executeData();

      return $this->data->fetchAll(PDO::FETCH_OBJ);
    }

    // Récupère la ligne d'un enregestrement 
    public function getRow(){

      $this->executeData();

      return $this->data->fetch(PDO::FETCH_OBJ);
    }

    //compter les nombres des lignes.
    public function countRow(){

      return $this->data->rowCount();
    }
    
  }
