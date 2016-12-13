<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('orm/Register.php');
require_once('orm/UserInfo.php');

if (isset( $_SERVER['PATH_INFO'])) {
    $path_components = explode('/', $_SERVER['PATH_INFO']);
    //$action=$_GET['action'];

}
else{
    $path_components =null;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if($_POST['action']=='register'){
      $email=$_POST['email'];
      $username=$_POST['user'];
      $password=$_POST['pass'];//md5 encoding
      $register=Register::create($email,$username,$password);
      $info=UserInfo::create($username);
      header("Content-type: application/json");
      print(json_encode("$register"));
      exit();}
      };
?>