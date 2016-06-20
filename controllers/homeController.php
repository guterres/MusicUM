<?php
include_once('models/audicao.php');

class HomeController{

  public function index(){
    $ocorr = Audicao::filter('all', 0, 'ocorr');
    $notocorr = Audicao::filter('all', 0, 'notocorr');
    $result = array_merge($ocorr, $notocorr);
    $json = json_encode(array("ocorr" => $ocorr, "notocorr" => $notocorr));
    include_once('views/home/index.php');
  }
}
?>
