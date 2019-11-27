<?php
if(isset($_POST["action"])){
    if($_POST["action"] == 'addNew'){
        $data = array(
            'description'     => $_POST["description"],
            'date_creation'      => $_POST["date_creation"],
            'date_expiration'      => $_POST["date_expiration"],
            'priority'      => $_POST["priority"]
        );
        $client = curl_init('http://restapicrud.000webhostapp.com/api/apiHandler.php?action=addNew');
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
 
    }
    if($_POST["action"] == 'deleteToDo'){
        $data = array(
            'id'     => $_POST["id"]
        );
        $client = curl_init('http://restapicrud.000webhostapp.com/api/apiHandler.php?action=deleteToDo');
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
 
    }
}
?>