<?php
$server="localhost";
$username="msnet_mainuser";
$password="#.l(Ova0^?Y3";
$db='msnet_leads';
$conn = mysqli_connect($server, $username, $password, $db);
$conn->query('SET CHARACTER SET utf8');

$input = json_decode(file_get_contents('php://input'), true);

if(isset($input)){
        $conn->query('UPDATE datauser SET called = 1 WHERE id = '.$input["Id"].';');
        echo "Registro modificado";
    
    
}else{
    $data = "";
    $array = $conn->query("SELECT DISTINCT datauser.name, datauser.telephone, datauser.fecha, datauser.email FROM datauser ORDER BY datauser.fecha");
    while($row = mysqli_fetch_array($array)){
        if ($data != "") {$data .= ",";}
        $data .= '{"Name":"'.$row['name']. '",';
        $data .= '"Telephone":"'.$row['telephone'].'",';
        $data .= '"Fecha":"'.$row['fecha']. '",';
        $data .= '"Email":"'.$row['email']. '",';
        if($row['called']==1){
            $data .= '"called":"Si"}';
        }else{
            $data .= '"called":"No"}';
        }
    }
    
    echo '{"records":['.$data.']}';
    $conn->close();
}


?>