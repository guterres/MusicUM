<?php

class Grupo{
  public $id;
  public $nome;

  public function __construct($id, $nome){
    $this->id = $id;
    if($nome)
      $this->nome = $nome;
    else{
      $this->nome = 'n/a';
    }
  }

  public function all(){
    $list = [];
    $db = Database::getInstance();
    $sql = "SELECT * FROM Grupo";
    $res = $db->query($sql);
    foreach($res->fetchAll() as $row){
      $list[] = new Grupo($row['id'], $row['Nome']);
    }
    return $list;
  }

  public function find($id){
    $db = Database::getInstance();
    $sql = "SELECT * FROM Grupo WHERE id = '{$id}' LIMIT 1";
    $res = $db->prepare($sql);
    $res->execute(array('id' => $id));
    $row = $res->fetch();
    return new Grupo($row['id'], $row['Nome']);
  }
}
?>
