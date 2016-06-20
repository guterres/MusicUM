  <?php
  include_once('conf/connection.php');
  include_once('models/grupo.php');
  include_once('models/atuacaoAluno.php');
  include_once('models/atuacaoProfessor.php');
  include_once('models/atuacaoObra.php');
  include_once('models/audicao.php');

  class Atuacao{
    public $id;
    public $grupo;
    public $audicao;
    public $alunos;
    public $maestros;
    public $obras;

    public function __construct($id, $grupo, $audicao, $alunos, $maestros, $obras){
      $this->id = $id;
      $this->grupo = $grupo;
      $this->audicao = $audicao;
      $this->alunos = $alunos;
      $this->maestros = $maestros;
      $this->obras = $obras;
    }

    public function all(){
      $list = [];
      $db = Database::getInstance();
      $sql = "SELECT * FROM Atuacao";
      $res = $db->query($sql);
      foreach($res->fetchAll() as $row){
        $list[] = new Atuacao($row['id'], Grupo::find($row['Grupo']), Audicao::find($row['Audicao']), AtuacaoAluno::findAlunos($row['id'], $row['Audicao']),
                  AtuacaoProfessor::findProfessores($row['id'], $row['Audicao']), AtuacaoObra::findObras($row['id'], $row['Audicao']));
      }
      return $list;
    }

    public function insert($id, $grupo, $alunos, $maestros, $obras, $audicao){
      try {
        $db = Database::getInstance();
        $db->beginTransaction();
        if($grupo == 'NULL'){
          $sql = "INSERT INTO Atuacao VALUES ('{$id}', NULL, '{$audicao}')";
        }else{
          $sql = "INSERT INTO Atuacao VALUES ('{$id}', '{$grupo}', '$audicao')";
        }
        $db->exec($sql);
        AtuacaoAluno::insert($id, $alunos, $audicao);
        AtuacaoProfessor::insert($id, $maestros, $audicao);
        AtuacaoObra::insert($id, $obras, $audicao);
        $db->commit();
        Audicao::updateDuracao($audicao);
        return true;
      } catch (Exception $e) {
        $db->rollback();
        echo "error atuacao {$e}";
        return false;
      }
    }

    public function delete($id, $audicao){
      try {
        $db = Database::getInstance();
        $db->beginTransaction();
        AtuacaoAluno::delete($id, $audicao);
        AtuacaoProfessor::delete($id, $audicao);
        AtuacaoObra::delete($id, $audicao);
        $sql = "DELETE FROM Atuacao WHERE id = '{$id}' AND Audicao = '{$audicao}'";
        $db->exec($sql);
        $db->commit();
        Audicao::updateDuracao($audicao);
        return true;
      } catch (Exception $e) {
        $db->rollback();
        echo "error atuacao s{$e}";
        return false;
      }
    }

    public function find($id){
      $db = Database::getInstance();
      $sql = "SELECT * FROM Atuacao WHERE id = '{$id}' LIMIT 1";
      $req = $db->prepare($sql);
      $req->execute(array('id' => $id));
      $row = $req->fetch();
      if(!empty($row)){
        return new Atuacao($row['id'], Grupo::find($row['Grupo']), Audicao::find($row['Audicao']), AtuacaoAluno::findAlunos($row['id'], $row['Audicao']),
                  AtuacaoProfessor::findProfessores($row['id'], $row['Audicao']), AtuacaoObra::findObras($row['id'], $row['Audicao']));
      }else{
        return null;
      }
    }

    public function update($id, $grupo, $alunos, $maestros, $obras, $audicao){
      try {
        $db = Database::getInstance();
        $db->beginTransaction();
        if($grupo == 'NULL'){
          $sql = "UPDATE Atuacao SET Grupo = NULL WHERE id = '{$id}'";
        }else{
          $sql = "UPDATE Atuacao SET Grupo = '{$grupo}' WHERE id = '{$id}'";
        }
        $db->exec($sql);
        AtuacaoAluno::update($id, $alunos, $audicao);
        AtuacaoProfessor::update($id, $maestros, $audicao);
        AtuacaoObra::update($id, $obras, $audicao);
        $db->commit();
        Audicao::updateDuracao($audicao);
        return true;
      } catch (Exception $e) {
        $db->rollback();
        echo "error atuacao s{$e}";
        return false;
      }
    }

    public function generateId(){
      $list = self::all();
      $ids = [];
      foreach($list as $l){
        $ids[] = substr($l->id,2);
      }
      sort($ids);
      return end($ids);
    }
  }
?>
