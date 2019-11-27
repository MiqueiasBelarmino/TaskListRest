<?php

include("api.php");

$apiObject = new API();

if($_GET["action"] == 'outputData'){
    $data = $apiObject->outputData();
}
if($_GET["action"] == 'addNew'){
    $data = $apiObject->addNewToDo();
}

if($_GET["action"] == 'delete'){
    $data = $apiObject->deleteToDo();
}

echo json_encode($data);

?>