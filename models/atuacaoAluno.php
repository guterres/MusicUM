<?php
include_once('models/aluno.php');
include_once('models/atuacao.php');

class AtuacaoAluno{
  public $atuacao;
  public $aluno;

  public function __construct($atuacao, $aluno){
    $this->atuacao = $atuacao;
    $this->aluno = $aluno;
  }

  public function insert($atuacao, $alunos){
    $db = Database::getInstance();
    if($alunos){
      foreach($alunos as $al){
        $sql = "INSERT INTO Aluno_Atuacao VALUES ('{$atuacao}', '{$al}')";
        $db->exec($sql);
      }
    }
  }

  public function delete($atuacao){
    $db = Database::getInstance();
    $sql = "DELETE FROM Aluno_Atuacao WHERE Atuacao = '{$atuacao}'";
    $db->exec($sql);
  }

  public function update($atuacao, $alunos){
    $db = Database::getInstance();
    self::delete($atuacao);
    self::insert($atuacao, $alunos);
  }

  public function findAlunos($atuacao){
    $list = [];
    $db = Database::getInstance();
    $sql = "SELECT Aluno FROM Aluno_Atuacao WHERE Atuacao = '{$atuacao}'";
    $res = $db->prepare($sql);
    $res->execute(array('Atuacao' => $atuacao));
    foreach($res->fetchAll() as $row){
      $list[] = Aluno::find($row['Aluno']);
    }
    return $list;
  }

  public function findAtuacoes($aluno){
    $list = [];
    $db = Database::getInstance();
    $sql = "SELECT Atuacao FROM Aluno_Atuacao WHERE Aluno = '{$aluno}'";
    $res = $db->prepare($sql);
    $res->execute(array('Aluno' => $aluno));
    foreach($res->fetchAll() as $row){
      $list[] = Atuacao::find($row['Atuacao']);
    }
    return $list;
  }
}
?>
