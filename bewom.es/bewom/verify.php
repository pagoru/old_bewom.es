<?php
include 'include/general/functions.php';

$verificacion = $_GET["param1"];

$result = MysqlOpen ( "SELECT * FROM `users_info` WHERE `verificacion`='$verificacion' AND `active`='0'" );
$row = mysql_fetch_array ( $result );

echo $verificacion;

if(!empty($row["mail"])){
	
	$mail = $row["mail"];
	
	MysqlOpen("UPDATE `users_info` SET `active`='1' WHERE `mail`='$mail' ");
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=".WEB."crear/result/verify/acierto '>";
	
} else {
	
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=".WEB."crear/result/verify/error '>";
	
}
?>