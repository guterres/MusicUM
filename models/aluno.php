  <?php
  include_once('conf/connection.php');
  include_once('models/curso.php');
  include_once('models/professor.php');
  include_once('models/atuacaoAluno.php');

  class Aluno{
    public $id;
    public $nome;
    public $dataNasc;
    public $anoCurso;
    public $curso;

    public function __construct($id, $nome, $dataNasc, $anoCurso, $curso){
      $this->id = $id;
      $this->nome = $nome;
      $this->dataNasc = $dataNasc;
      $this->anoCurso = $anoCurso;
      $this->curso = $curso;
    }

    public function all(){
      $list = [];
      $db = Database::getInstance();
      $sql = "SELECT * FROM Aluno";
      $res = $db->query($sql);
      foreach($res->fetchAll() as $row){
        $list[] = new Aluno($row['id'], $row['Nome'], $row['DataNasc'], $row['AnoCurso'], Curso::find($row['Curso']));
      }
      return $list;
    }

    public function insert($id, $nome, $dataNasc, $anoCurso, $curso){
      $db = Database::getInstance();
      $sql = "INSERT INTO Aluno VALUES ('{$id}', '{$nome}', '{$dataNasc}', '{$anoCurso}', '{$curso}')";
      return $db->query($sql);
    }

    public function delete($id){
      $db = Database::getInstance();
      $sql = "DELETE FROM Aluno WHERE id = '{$id}'";
      return $db->query($sql);
    }

    public function find($id){
      $db = Database::getInstance();
      $sql = "SELECT * FROM Aluno WHERE id = '{$id}' LIMIT 1";
      $req = $db->prepare($sql);
      $req->execute(array('id' => $id));
      $row = $req->fetch();
      if(!empty($row)){
        return new Aluno($row['id'], $row['Nome'], $row['DataNasc'], $row['AnoCurso'], Curso::find($row['Curso']));
      }else{
        return null;
      }
    }

    public function update($id, $nome, $dataNasc, $anoCurso, $curso){
      $db = Database::getInstance();
      $sql = "UPDATE Aluno SET Nome = '{$nome}', DataNasc = '{$dataNasc}', AnoCurso = '{$anoCurso}',
              Curso = '{$curso}' WHERE id = '{$id}'";
      return $db->query($sql);
    }

    public function findProfCurso(){
        return Professor::findCurso($this->curso->id);
    }

    public function findAtuacoes(){
      return AtuacaoAluno::findAtuacoes($this->id);
    }

    public function age(){
      $date = new DateTime($this->dataNasc);
      $now = new DateTime();
      $interval = $now->diff($date);
      return $interval->y;
    }

    public function generateId(){
      $list = self::all();
      $ids = [];
      foreach($list as $l){
        $ids[] = substr($l->id,1);
      }
      sort($ids);
      return end($ids);
    }

    public function validateXML(){
      $xml = new DOMDocument();
      $xml->load('views/assets/uploads/aluno.xml');
      return @$xml->schemaValidate('views/assets/xsd/alunos.xsd');
    }

    public function importXML(){
      try {
        $alunos = simplexml_load_file('views/assets/uploads/aluno.xml');
        foreach($alunos->aluno as $a){
          $last_id = self::generateId();
          $id = "A".($last_id+1);
          self::insert($id, (string) $a->nome, (string) $a->dataNasc, (string) $a->anoCurso, (string) $a->curso);
        }
        return true;
      } catch (Exception $e) {
        echo $e->getMessage();
        return false;
      }
    }
  }
?>
