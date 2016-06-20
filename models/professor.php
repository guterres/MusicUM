  <?php
  include_once('conf/connection.php');
  include_once('models/curso.php');
  include_once('models/atuacaoProfessor.php');

  class Professor{
    public $id;
    public $nome;
    public $dataNasc;
    public $habilitacaos;
    public $curso;

    public function __construct($id, $nome, $dataNasc, $habilitacao, $curso){
      $this->id = $id;
      $this->nome = $nome;
      $this->dataNasc = $dataNasc;
      $this->habilitacao = $habilitacao;
      $this->curso = $curso;
    }

    public function all(){
      $list = [];
      $db = Database::getInstance();
      $sql = "SELECT * FROM Professor";
      $res = $db->query($sql);
      foreach($res->fetchAll() as $row){
        $list[] = new Professor($row['id'], $row['Nome'], $row['DataNasc'], $row['Habilitacao'], Curso::find($row['Curso']));
      }
      return $list;
    }

    public function insert($id, $nome, $dataNasc, $habilitacao, $curso){
      $db = Database::getInstance();
      $sql = "INSERT INTO Professor VALUES ('{$id}', '{$nome}', '{$dataNasc}', '{$habilitacao}', '{$curso}')";
      return $db->query($sql);
    }

    public function delete($id){
      $db = Database::getInstance();
      $sql = "DELETE FROM Professor WHERE id = '{$id}'";
      return $db->query($sql);
    }

    public function find($id){
      $db = Database::getInstance();
      $sql = "SELECT * FROM Professor WHERE id = '{$id}' LIMIT 1";
      $req = $db->query($sql);
      $row = $req->fetch();
      if(!empty($row)){
        return new Professor($row['id'], $row['Nome'], $row['DataNasc'], $row['Habilitacao'], Curso::find($row['Curso']));
      }else{
        return null;
      }
    }

    public function findCurso($idCurso){
      $db = Database::getInstance();
      $sql = "SELECT * FROM Professor WHERE Curso = '{$idCurso}'";
      $res = $db->prepare($sql);
      $res->execute(array('Curso' => $idCurso));
      foreach($res->fetchAll() as $row){
        $list[] = new Professor($row['id'], $row['Nome'], $row['DataNasc'], $row['Habilitacao'], Curso::find($row['Curso']));
      }
      return $list;
    }

    public function update($id, $nome, $dataNasc, $habilitacao, $curso){
      $db = Database::getInstance();
      $sql = "UPDATE Professor SET nome = '{$nome}', DataNasc = '{$dataNasc}', Habilitacao = '{$habilitacao}',
              Curso = '{$curso}' WHERE id = '{$id}'";
      return $db->query($sql);
    }

    public function findAtuacoes(){
      return AtuacaoProfessor::findAtuacoes($this->id);
    }

    public function findAudicoes(){
      return Audicao::findProfAudicoes($this->id);
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
      $xml->load('views/assets/uploads/professor.xml');
      return @$xml->schemaValidate('views/assets/xsd/professores.xsd');
    }

    public function importXML(){
      try {
        $professores = simplexml_load_file('views/assets/uploads/professor.xml');
        foreach($professores->professor as $p){
          $last_id = self::generateId();
          $id = "P".($last_id+1);
          self::insert($id, (string) $p->nome, (string) $p->dataNasc, (string) $p->habilitacoes, (string) $p->curso);
        }
        return true;
      } catch (Exception $e) {
        echo $e->getMessage();
        return false;
      }
    }
  }
?>
