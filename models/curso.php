  <?php
  include_once('models/instrumento.php');

  class Curso{
    public $id;
    public $nome;
    public $duracao;
    public $instrumento;

    public function __construct($id, $nome, $duracao, $instrumento){
      $this->id = $id;
      $this->nome = $nome;
      $this->duracao = $duracao;
      $this->instrumento = $instrumento;
  }

    public function all(){
      $list = [];
      $db = Database::getInstance();
      $sql = "SELECT * FROM Curso";
      $res = $db->query($sql);
      foreach($res->fetchAll() as $row){
        $list[] = new Curso($row['id'], $row['Nome'], $row['Duracao'], Instrumento::find($row['Instrumento']));
      }
      return $list;
    }

    public function find($id){
      $db = Database::getInstance();
      $sql = "SELECT * FROM Curso WHERE id = '{$id}' LIMIT 1";
      $res = $db->prepare($sql);
      $res->execute(array('id' => $id));
      $row = $res->fetch();
      return new Curso($row['id'], $row['Nome'], $row['Duracao'], Instrumento::find($row['Instrumento']));
    }
  }
?>
