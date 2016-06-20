<?php
  if(count($_GET)){
    if(isset($_GET['controller']) && isset($_GET['action'])){
      $controller = $_GET['controller'];
      $action = $_GET['action'];
    }else{
      $controller = '';
      $action = '';
    }
    include_once('views/layout.php');
  }else{
    $controller = 'home';
    $action = 'index';
    include_once('conf/routes.php');
  }
?>
