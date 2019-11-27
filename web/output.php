<?php
$client = curl_init('http://restapicrud.000webhostapp.com/api/apiHandler.php?action=outputData');
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($client);
$result = array();
$result = json_decode($response);

$output = '';

$pkCount = (is_array($result) ? count($result) : 0);

// if(count($result) > 0){
if($pkCount > 0){
    foreach($result as $row){
        $output .= '
            <tr>
                <td>'.$row->id.'</td>
                <td>'.$row->description.'</td>
                <td>'.$row->date_expiration.'</td>
                <form method="POST" name="deleteForm" id="deleteForm">
                <input type="hidden" value='.$row->id.'>
                    <input type="hidden" value='.$row->id.'>
                    <input type="hidden" value="deleteToDo">
                <td><input type="submit" value="Deletar"></td>
                </form>
            </tr>
        ';
    }
}else{
    $output .= '<tr><td colspan="3" align="center">Not found!</td></tr>';
}

echo $output;
?>