<?php

$param = $_GET["param1"];

$p = explode("/", $param);

$session = $p[0];
$mail = $p[1];

setcookie("bewom_session", $session, 2147483647, "/");
setcookie("bewom_mail", $mail, 2147483647, "/");

echo "<META HTTP-EQUIV='refresh' CONTENT='0;/'>";
?>