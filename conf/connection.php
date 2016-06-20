
<?php
  class Database {

    private static $instance = NULL;

    private function __construct() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
      self::$instance = new PDO('mysql:host=localhost;dbname=Audicao', 'root', 'root');
      }
      return self::$instance;
    }
  }
?>
