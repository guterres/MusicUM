<?php

class Periodo{
  public $id;
  public $nome;
  public $ano;

  public function __construct($id, $nome, $ano){
    $this->id = $id;
    $this->nome = $nome;
    $this->ano = $ano;
  }

  public function all(){
    $list = [];
    $db = Database::getInstance();
    $sql = "SELECT * FROM Periodo";
    $res = $db->query($sql);
    foreach($res->fetchAll() as $row){
      $list[] = new Periodo($row['id'], $row['Nome'], $row['Ano']);
    }
    return $list;
  }

  public function find($id){
    $db = Database::getInstance();
    $sql = "SELECT * FROM Periodo WHERE id = '{$id}' LIMIT 1";
    $res = $db->prepare($sql);
    $res->execute(array('id' => $id));
    $row = $res->fetch();
    return new Periodo($row['id'], $row['Nome'], $row['Ano']);
  }

  public function search($ano){
    $db = Database::getInstance();
    $sql = "SELECT * FROM Periodo WHERE Ano < '{$ano}' ORDER BY Ano DESC LIMIT 1";
    $res = $db->prepare($sql);
    $res->execute(array('ano' => $ano));
    $row = $res->fetch();
    return new Periodo($row['id'], $row['Nome'], $row['Ano']);
  }
}
?>
