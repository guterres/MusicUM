  <?php
  include_once('conf/connection.php');
  include_once('models/pagination.php');
  include_once('models/professor.php');

  class Audicao{
    public $id;
    public $titulo;
    public $subtitulo;
    public $tema;
    public $data;
    public $hora;
    public $organizador;
    public $duracao;
    public $pagination;

    public function __construct($id, $titulo, $subtitulo, $tema, $data, $hora, $organizador, $duracao){
      $this->id = $id;
      $this->titulo = $titulo;
      $this->subtitulo = $subtitulo;
      $this->tema = $tema;
      $this->data = $data;
      $this->hora = $hora;
      $this->organizador = $organizador;
      $this->duracao = $duracao;
    }

    public function filter($limit, $page, $filter){
      $this->pagination = self::getPage($filter);
      if($this->pagination){
          $list = [];
        foreach($this->pagination->getData($limit,$page)->data as $row){
            $list[] = new Audicao($row['id'], $row['Titulo'], $row['Subtitulo'], $row['Tema'], $row['Data'],
                          $row['Hora'], Professor::find($row['Organizador']), $row['Duracao']);
        }
        return $list;
      }else{
        return false;
      }

    }

    public function getPage($filter){
      if($filter == 'all'){
        return new Pagination("SELECT * FROM Audicao");
      }elseif($filter == 'ocorr'){
        return new Pagination("SELECT * FROM Audicao WHERE now() > TIMESTAMP(Data, Hora)");
      }elseif($filter == 'notocorr'){
        return new Pagination("SELECT * FROM Audicao WHERE now() < TIMESTAMP(Data, Hora)");
      }else{
        return false;
      }
    }

    public function getSearch($search){
      return new Pagination("SELECT * FROM Audicao WHERE Titulo Like '%{$search}%'");
    }

    public function search($limit, $page, $search){
      $list = [];
      $this->pagination = self::getSearch($search);
      foreach($this->pagination->getData($limit,$page)->data as $row){
          $list[] = new Audicao($row['id'], $row['Titulo'], $row['Subtitulo'], $row['Tema'], $row['Data'],
                        $row['Hora'], Professor::find($row['Organizador']), $row['Duracao']);
      }
      return $list;
    }

    public function insert($id, $titulo, $subtitulo, $tema, $data, $hora, $organizador){
      try {
        $db = Database::getInstance();
        $db->beginTransaction();
        $sql = "INSERT INTO Audicao VALUES ('{$id}', '{$titulo}', '{$subtitulo}', '{$tema}', '{$data}', '{$hora}', '{$organizador}', '00:00:00')";
        $db->exec($sql);
        $db->commit();
        return true;
      } catch (Exception $e) {
        $db->rollback();
        echo "error audicao {$e}";
        return false;
      }
    }

    public function delete($id){
      try {
        $db = Database::getInstance();
        $sql = "DELETE FROM Audicao WHERE id = '{$id}'";
        $db->query($sql);
        return true;
      } catch (Exception $e) {
        echo "error audicao {$e}";
        return false;
      }
    }

    public function find($id){
      $db = Database::getInstance();
      $sql = "SELECT * FROM Audicao WHERE id = '{$id}' LIMIT 1";
      $req = $db->prepare($sql);
      $req->execute(array('id' => $id));
      $row = $req->fetch();
      if(!empty($row)){
        return new Audicao($row['id'], $row['Titulo'], $row['Subtitulo'], $row['Tema'], $row['Data'],
                      $row['Hora'], Professor::find($row['Organizador']), $row['Duracao']);
      }else{
        return null;
      }
    }

    public function update($id, $titulo, $subtitulo, $tema, $data, $hora, $organizador){
      try {
        $db = Database::getInstance();
        $db->beginTransaction();
        $sql = "UPDATE Audicao SET Titulo = '{$titulo}', Subtitulo = '{$subtitulo}', Tema = '{$tema}', Data = '{$data}',
                Hora = '{$hora}', Organizador = '{$organizador}' WHERE id = '{$id}'";
        $db->exec($sql);
        $db->commit();
        return true;
      } catch (Exception $e) {
        $db->rollback();
        echo "error audicao {$e}";
        return false;
      }
    }

    public function updateDuracao($id){
      try {
        $db = Database::getInstance();
        $duracao = self::getTotalDuracao($id);
        $sql = "UPDATE Audicao SET Duracao = '{$duracao}' WHERE id = '{$id}'";
        $db->query($sql);
        return true;
      } catch (Exception $e) {
        $db->rollback();
        echo "error audicao {$e}";
        return false;
      }
    }

    private function getTotalDuracao($id){
      try {
        $db = Database::getInstance();
        $sql = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(Obra.Duracao))) AS Duracao
                FROM Audicao
                INNER JOIN Atuacao ON Audicao.id = Atuacao.Audicao
                INNER JOIN Atuacao_Obra ON Atuacao.id = Atuacao_Obra.Atuacao
                INNER JOIN Obra ON Atuacao_Obra.Obra = Obra.id
                WHERE Audicao.id =  '{$id}' LIMIT 1";
        $req = $db->prepare($sql);
        $req->execute(array('id' => $id));
        $row = $req->fetch();
        return $row['Duracao'];
      } catch (Exception $e) {
        return null;
      }
    }

    public function atuacoes(){
      try {
        $db = Database::getInstance();
        $sql = "SELECT * FROM Atuacao WHERE Audicao = '{$this->id}'";
        $res = $db->prepare($sql);
        $res->execute(array('Audicao' => $this->id));
        foreach($res->fetchAll() as $row){
          $list[] = new Atuacao($row['id'], Grupo::find($row['Grupo']), Audicao::find($row['Audicao']), AtuacaoAluno::findAlunos($row['id'], $row['Audicao']),
                    AtuacaoProfessor::findProfessores($row['id'], $row['Audicao']), AtuacaoObra::findObras($row['id'], $row['Audicao']));
        }
        if(isset($list)){
          return $list;
        }
        else return null;
      } catch (Exception $e) {
        return false;
      }
    }

    public function findProfAudicoes($professor){
      $list = [];
      $db = Database::getInstance();
      $sql = "SELECT * FROM Audicao WHERE Organizador = '{$professor}'";
      $res = $db->prepare($sql);
      $res->execute(array('Organizador' => $professor));
      foreach($res->fetchAll() as $row){
        $list[] = new Audicao($row['id'], $row['Titulo'], $row['Subtitulo'], $row['Tema'], $row['Data'],
                      $row['Hora'], Professor::find($row['Organizador']), $row['Duracao']);
      }
      return $list;
    }

    public function notHappened(){
      $date = "{$this->data} {$this->hora}";
      $now = date('Y-m-d H:i:s');
      return strtotime($date) > strtotime($now);
    }

    public function generateId(){
      $list = self::filter('all', 0, 'all');
      $ids = [];
      foreach($list as $l){
        $ids[] = substr($l->id,2);
      }
      sort($ids);
      return end($ids);
    }


  }
?>
