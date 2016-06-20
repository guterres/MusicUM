  <?php
  include_once('conf/connection.php');
  include_once('models/compositor.php');

  class Obra{
    public $id;
    public $nome;
    public $descricao;
    public $anoCriacao;
    public $duracao;
    public $compositor;

    public function __construct($id, $nome, $descricao, $anoCriacao, $duracao, $compositor){
      $this->id = $id;
      $this->nome = $nome;
      $this->descricao = $descricao;
      $this->anoCriacao = $anoCriacao;
      $this->duracao = $duracao;
      $this->compositor = $compositor;
    }

    public function all(){
      $list = [];
      $db = Database::getInstance();
      $sql = "SELECT * FROM Obra";
      $res = $db->query($sql);
      foreach($res->fetchAll() as $row){
        $list[] = new Obra($row['id'], $row['Nome'], $row['Descricao'], $row['AnoCriacao'],
                      $row['Duracao'], Compositor::find($row['Compositor']));
      }
      return $list;
    }

    public function insert($id, $nome, $descricao, $anoCriacao, $compositor, $duracao){
      $db = Database::getInstance();
      $sql = "INSERT INTO Obra VALUES ('{$id}', '{$nome}', '{$descricao}', '{$anoCriacao}', '{$compositor}', '{$duracao}')";
      return $db->query($sql);
    }

    public function delete($id){
      $db = Database::getInstance();
      $sql = "DELETE FROM Obra WHERE id = '{$id}'";
      return $db->query($sql);
    }

    public function find($id){
      $db = Database::getInstance();
      $sql = "SELECT * FROM Obra WHERE id = '{$id}' LIMIT 1";
      $req = $db->prepare($sql);
      $req->execute(array('id' => $id));
      $row = $req->fetch();
      if(!empty($row)){
        return new Obra($row['id'], $row['Nome'], $row['Descricao'], $row['AnoCriacao'],
                      $row['Duracao'], Compositor::find($row['Compositor']));
      }else{
        return null;
      }
    }

    public function update($id, $nome, $descricao, $anoCriacao, $duracao, $compositor){
      $db = Database::getInstance();
      $sql = "UPDATE Obra SET Nome = '{$nome}', Descricao = '{$descricao}', AnoCriacao = '{$anoCriacao}',
              Duracao = '{$duracao}', Compositor = '{$compositor}' WHERE id = '{$id}'";
      return $db->query($sql);
    }

  /*  public function age(){
      $date = new DateTime($this->anoCriacao);
      $now = new DateTime();
      $interval = $now->diff($date);
      return $interval->y;
    }*/

    public function generateId(){
      $list = self::all();
      $ids = [];
      foreach($list as $l){
        $ids[] = substr($l->id,1);
      }
      sort($ids);
      return end($ids);
    }
  }
?>
