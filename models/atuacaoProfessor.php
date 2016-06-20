<?php
include_once('models/atuacao.php');

class AtuacaoProfessor{
  public $atuacao;
  public $professsor;

  public function __construct($atuacao, $professor){
    $this->atuacao = $atuacao;
    $this->professor = $professor;
  }

  public function insert($atuacao, $professores){
    $db = Database::getInstance();
    foreach($professores as $p){
      $sql = "INSERT INTO Atuacao_Professor VALUES ('{$atuacao}', '{$p}')";
      $db->exec($sql);
    }
  }

  public function delete($atuacao){
    $db = Database::getInstance();
    $sql = "DELETE FROM Atuacao_Professor WHERE Atuacao = '{$atuacao}'";
    $db->exec($sql);
  }

  public function update($atuacao, $professores){
    $db = Database::getInstance();
    self::delete($atuacao);
    self::insert($atuacao, $professores);
  }

  public function findProfessores($atuacao){
    $list = [];
    $db = Database::getInstance();
    $sql = "SELECT Professor FROM Atuacao_Professor WHERE Atuacao = '{$atuacao}'";
    $res = $db->prepare($sql);
    $res->execute(array('Atuacao' => $atuacao));
    foreach($res->fetchAll() as $row){
      $list[] = Professor::find($row['Professor']);
    }
    return $list;
  }

  public function findAtuacoes($professor){
    $list = [];
    $db = Database::getInstance();
    $sql = "SELECT Atuacao FROM Atuacao_Professor WHERE Professor = '{$professor}'";
    $res = $db->prepare($sql);
    $res->execute(array('Professor' => $professor));
    foreach($res->fetchAll() as $row){
      $list[] = Atuacao::find($row['Atuacao']);
    }
    return $list;
  }
}
?>
