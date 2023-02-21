<?php


if (isset($_POST["action"]) && !empty($_POST['action'])) {
  $action = $_POST['action'];
  switch($action) {
      case 'register' : register();     break;
      case 'change'   : value();        break;
      case 'email'    : validEmail();   break;    
      case 'cedula'   : validCedula();  break;
      case 'auth'     : auth();         break;
      case 'export'   : createCvs();    break;
      case 'dataNo'   : getDataNo();    break;

  }
}

function register(){
  $server="10.0.0.164";
  $username="wwwblue_dataUser";
  $password="DigitalPartner2017$";
  $db='wwwblue_users';
  $conn = mysqli_connect($server, $username, $password,$db);
  $conn->query('SET CHARACTER SET utf8');

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $Nombre = $_POST["Nombre"];
  $Cedula = $_POST["Cedula"];
  $Telefono = $_POST["Telefono"];
  $Email = $_POST["Email"];
  $last = $_POST["last"];
  $date = date("Y-m-d");
  $fecha;
  
  switch($_POST["fecha"]){
      case 1:
          $fecha = "13 de marzo, 7:00pm - Jazz Café Escazú";
      break;
  }
    //$random_string = chr(rand(65,90)) . rand(1,9) . chr(rand(65,90)) . rand(1,9) . chr(rand(65,90)); // random(ish) 5 character strin
    /*do{
        $random_string = chr(rand(65,90)) . rand(1,9) . chr(rand(65,90)) . rand(1,9) . chr(rand(65,90)); // random(ish) 5 character strin
        $array = $conn->query("SELECT ramdom_data FROM datauser WHERE ramdom_data='".$random_string."' limit 1");
    }while($array->num_rows!==0);*/
    $conn->query("INSERT INTO datauser(name,email,idNumber,telephone,horario_selected,daydate,lastfour) VALUES('". $Nombre ."','". $Email ."',". $Cedula .",". $Telefono .",'".$fecha."','".$date."','".$last."')");
  echo "Registro insertado";
  $conn->close();
}

function value(){
  $server="10.0.0.164";
  $username="wwwblue_dataUser";
  $password="DigitalPartner2017$";
  $db='wwwblue_users';
  $conn = mysqli_connect($server, $username, $password,$db);
  $conn->query('SET CHARACTER SET utf8');

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  switch($_POST["fecha"]){
      case 1:
          $fecha = "13 de marzo, 7:00pm - Jazz Café Escazú";
      break;
  }

  $array = $conn->query("SELECT horario_selected FROM dataUser_Confirmed WHERE horario_selected='".$fecha."' AND aprobado=1");
  echo $array->num_rows;

  $conn->close();
}

function validEmail(){
    $server="10.0.0.164";
  $username="wwwblue_dataUser";
  $password="DigitalPartner2017$";
  $db='wwwblue_users';
  $conn = mysqli_connect($server, $username, $password,$db);
  $conn->query('SET CHARACTER SET utf8');
  
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  $email = $_POST["email"];
  $array = $conn->query("SELECT email FROM dataUser_Confirmed WHERE email='".$email."' and aprobado=1");
  echo $array->num_rows;

  $conn->close();
}

function validCedula(){
    $server="10.0.0.164";
    $username="wwwblue_dataUser";
    $password="DigitalPartner2017$";
    $db='wwwblue_users';
    $conn = mysqli_connect($server, $username, $password,$db);
    $conn->query('SET CHARACTER SET utf8');
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $email = $_POST["cedula"];
    $array = $conn->query("SELECT idNumber FROM dataUser_Confirmed WHERE idNumber='".$email."' and aprobado=1");
    echo $array->num_rows;
    
    $conn->close();
}

function auth(){
    
    $pass = $_POST['value'];
    
    
    if($pass=='MediSmart2019'){
        echo "autorizado";
    }else{
        http_response_code(403);
        die("No Autorizado");
    }
}

function createCvs(){
    $server="10.0.0.164";
    $username="wwwblue_dataUser";
    $password="DigitalPartner2017$";
    $db='wwwblue_users';
    $conn = mysqli_connect($server, $username, $password, $db);
    $conn->query('SET CHARACTER SET utf8');
    $db_record="datauser";
    
    switch($_POST["value"]){
        case "none":
            $fecha = "";
        break;
        case "13/3":
          $fecha = "horario_selected='13 de marzo, 7:00pm - Jazz Café Escazú' AND ";
        break;
    }
    $where ='where '.$fecha.'daydate="'.$_POST['daydate'].'"';
    $csv_filename = 'db_export_'.date('Y-m-d').'.csv';
// create var to be filled with export data
    $csv_export = '';
    // query to get data from database
    $query = $conn->query("SELECT * FROM ".$db_record." ".$where);
    $field = mysqli_num_fields($query);
    
    // create line with field names
    for($i = 0; $i < $field; $i++) {
        $title=mysqli_fetch_field_direct($query,$i);
      $csv_export.= $title->name.',';
    }
    // newline (seems to work both on Linux & Windows servers)
    $csv_export.= '
    ';
    
    while($row = mysqli_fetch_array($query)) {
      // create line with field values
      for($i = 0; $i < $field; $i++) {
          $title=mysqli_fetch_field_direct($query,$i);
        $csv_export.= '"'.$row[$title->name].'",';
      }	
      $csv_export.= '
    ';	
    }
    
    // Export the data and prompt a csv file for download
    header("Content-type: text/x-csv");
    header("Content-Disposition: attachment; filename=".$csv_filename."");
    echo($csv_export);
    
    $conn->close();
}

function getDataNo() {
    $server="10.0.0.164";
    $username="wwwblue_dataUser";
    $password="DigitalPartner2017$";
    $db='wwwblue_users';
    $conn = mysqli_connect($server, $username, $password, $db);
    $conn->query('SET CHARACTER SET utf8');
    
    $data = "";
    $array = $conn->query("SELECT datauser.idUser FROM datauser LEFT JOIN dataUser_Confirmed on datauser.idUser=dataUser_Confirmed.idUser WHERE dataUser_Confirmed.idUser IS NULL");
    while($row = mysqli_fetch_array($array)){
        $data .= $row['idUser'];
    }
    
    echo '{"records":['.$data.']}';
    $conn->close();
}
?>
