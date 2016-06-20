<?php
include_once('models/obra.php');

class AtuacaoObra{
  public $atuacao;
  public $obra;

  public function __construct($atuacao, $obra){
    $this->atuacao = $atuacao;
    $this->obra = $obra;
  }

  public function insert($atuacao, $obras){
     $db = Database::getInstance();
    foreach($obras as $o){
      $sql = "INSERT INTO Atuacao_Obra VALUES ('{$atuacao}', '{$o}')";
      $db->exec($sql);
    }
  }

  public function delete($atuacao){
    $db = Database::getInstance();
    $sql = "DELETE FROM Atuacao_Obra WHERE Atuacao = '{$atuacao}'";
    $db->exec($sql);
  }

  public function update($atuacao, $obras){
    $db = Database::getInstance();
    self::delete($atuacao);
    self::insert($atuacao, $obras);
  }

  public function findObras($atuacao){
    $list = [];
    $db = Database::getInstance();
    $sql = "SELECT Obra FROM Atuacao_Obra WHERE Atuacao = '{$atuacao}'";
    $res = $db->prepare($sql);
    $res->execute(array('Atuacao' => $atuacao));
    foreach($res->fetchAll() as $row){
      $list[] = Obra::find($row['Obra']);
    }
    return $list;
  }

}
?>
