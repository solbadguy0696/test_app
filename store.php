<?php
require('functions.php');
//create($_POST);
checkReferer();
header('location: ./index.php');  //リダイレクト先の指定を行う
?>