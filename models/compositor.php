  <?php
  include_once("models/periodo.php");

  class Compositor{
    public $id;
    public $nome;
    public $dataNasc;
    public $dataMorte;
    public $bio;
    public $periodo;


    public function __construct($id, $nome, $dataNasc, $dataMorte, $bio, $periodo){
      $this->id = $id;
      $this->nome = $nome;
      $this->dataNasc = $dataNasc;
      $this->dataMorte = $dataMorte;
      $this->bio = $bio;
      $this->periodo = $periodo;
    }

    public function all(){
      $list = [];
      $db = Database::getInstance();
      $sql = "SELECT * FROM Compositor";
      $res = $db->query($sql);
      foreach($res->fetchAll() as $row){
        $list[] = new Compositor($row['id'], $row['Nome'], $row['DataNasc'], $row['DataMorte'], $row['Bio'], Periodo::find($row['Periodo']));
      }

      return $list;
    }

    public function find($id){
      $db = Database::getInstance();
      $sql = "SELECT * FROM Compositor WHERE id = '{$id}' LIMIT 1";
      $res = $db->prepare($sql);
      $res->execute(array('id' => $id));
      $row = $res->fetch();
      return new Compositor($row['id'], $row['Nome'], $row['DataNasc'], $row['DataMorte'], $row['Bio'], Periodo::find($row['Periodo']));
    }
  }
?>
