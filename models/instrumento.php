<?php

class Instrumento{
  public $id;
  public $nome;

  public function __construct($id, $nome){
    $this->id = $id;
    $this->nome = $nome;
  }

  public function all(){
    $list = [];
    $db = Database::getInstance();
    $sql = "SELECT * FROM Instrumento";
    $res = $db->query($sql);
    foreach($res->fetchAll() as $row){
      $list[] = new Instrumento($row['id'], $row['Nome']);
    }
    return $list;
  }

  public function find($id){
    $db = Database::getInstance();
    $sql = "SELECT * FROM Instrumento WHERE id = '{$id}' LIMIT 1";
    $res = $db->prepare($sql);
    $res->execute(array('id' => $id));
    $row = $res->fetch();
    return new Instrumento($row['id'], $row['Nome']);
  }
}
?>
