<?php if($_SERVER["HTTP_X_FORWARDED_FOR"]){
echo "Proxy ip : {$_SERVER['REMOTE_ADDR']}<br>";
echo "Real IP : {$_SERVER['HTTP_X_FORWARDED_FOR']}";
}else{
echo "Real IP: {$_SERVER['REMOTE_ADDR']}";}
?>