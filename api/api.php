<?php

class API{

    private $connect = '';

    function __construct(){

        $this->dbConnection();

    }

    function dbConnection(){

        $this->connect = new PDO("mysql:host=localhost;dbname=id11315983_restapicrud", "id11315983_miqueias", "19restapicrud9812");
    }

    function outputData(){

        $select = $this->connect->prepare("SELECT * FROM todo ORDER BY id");
        if($select->execute()){
            while($row = $select->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            return $data;
        }
    }

    function addNewToDo(){
        if(isset($_POST["description"])){
            $data = array(
                ':description'      => $_POST["description"],
                ':date_creation'    => $_POST["date_creation"],
                ':date_expiration'  => $_POST["date_expiration"],
                ':priority'         => $_POST["priority"]
            );
            $insert = $this->connect->prepare("INSERT INTO todo (description, date_creation,date_expiration,priority) VALUES (:description, :date_creation,:date_expiration,:priority)");
            $insert->execute($data);
        }
    }
    function deleteToDo(){
        if(isset($_POST["description"])){
            $data = array(
                ':id'      => $_POST["id"]
            );
            $delete = $this->connect->prepare("DELETE * FROM todo WHERE ID=:id");
            $delete->execute($data);
        }
    }
    
    
    
    
    
}



?>