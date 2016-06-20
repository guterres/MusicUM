<?php
  include_once('models/audicao.php');
  include_once('models/professor.php');
  include_once('models/atuacao.php');
  include_once('models/audicaoXML.php');

  class AudicaoController{

    public function index(){
      $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
      $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
      $filter = (isset($_GET['filter'])) ? $_GET['filter'] : 'all';

      $audicoes = Audicao::filter($limit, $page, $filter);
      if($audicoes){
        $paginator = Audicao::getPage($filter);
        $paginator->getData($limit, $page);
        include_once('views/audicao/index.php');
      }else{
        include_once('views/error.php');
      }

    }

    public function search(){
      $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
      $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
      $search = (isset($_POST['q'])) ? $_POST['q'] : '';

      $audicoes = Audicao::search($limit, $page, $search);

      $paginator = Audicao::getSearch($search);
      $paginator->getData($limit, $page);

      include_once('views/audicao/index.php');
    }

    public function register(){
      $profs = Professor::all();
      include_once('views/audicao/register.php');
    }

    public function create(){
      if(isset($_POST['enviar'])){
        $last_id = Audicao::generateId();
        $id = "Au".($last_id+1);
        $r = Audicao::insert($id, $_POST['titulo'], $_POST['subtitulo'], $_POST['tema'], $_POST['data'], $_POST['hora'], $_POST['organizador']);
        if($r){
          echo self::message("success", "Registo efetuado com sucesso");
          self::index();
        }else{
          echo self::message("danger", "Não foi registado com sucesso");
          self::register();
        }
      }
    }

    public function destroy(){
      if(isset($_GET['id'])){
        $res = Audicao::delete($_GET['id']);
        if($res){
          echo self::message("success", "Removido com sucesso");
        }else{
          echo self::message("danger", "Não foi removido com sucesso");
        }
      }
      self::index();
    }

    public function show(){
      if(isset($_GET['id'])){
        $audicao = Audicao::find($_GET['id']);
        if(!empty($audicao)){
          include_once('views/audicao/show.php');
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }
    }

    public function edit(){
      if(isset($_GET['id'])){
        $audicao = Audicao::find($_GET['id']);
        if((!empty($audicao)) && ($audicao->notHappened())){
          $profs = Professor::all();
          $atuacoes = Atuacao::all();
          include_once('views/audicao/edit.php');
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }
    }

    public function update(){
      if(isset($_POST['enviar'])){
        $res = Audicao::update($_POST['id'], $_POST['titulo'], $_POST['subtitulo'], $_POST['tema'], $_POST['data'],
                              $_POST['hora'], $_POST['organizador']);
        if($res){
          echo self::message('success', "Edição efetuado com sucesso");
          self::index();
        }else{
          echo self::message("danger", "Não foi editado com sucesso");
          self::edit();
        }
      }
    }

    public function import(){
      if(!$_FILES['xml']['error'] > 0){
        move_uploaded_file($_FILES['xml']['tmp_name'], 'views/assets/uploads/audicao.xml');
        if(AudicaoXML::validateXML()){
          if(AudicaoXML::importXML()){
            echo self::message("success", "XML importado com sucesso");
            self::show();
          }else{
            echo self::message("danger", "Ficheiro XML não foi carregado");
            self::index();
          }
        }else{
          echo self::message("danger", "Ficheiro XML inválido");
          self::index();
        }
        @unlink('views/assets/uploads/audicao.xml');

      }
    }

    public function export(){
      if(isset($_GET['id'])){
        AudicaoXML::exportXML($_GET['id']);
        header('Location: audicao_export.xml');
      }
    }

    public function pdf(){
      if(isset($_GET['id'])){
        AudicaoXML::exportPDF($_GET['id']);
        header('Location: audicao.pdf');
      }
    }

    private function message($type, $message){
      return "<p class='alert alert-{$type} alert-dismissible fade in' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
              {$message}
          </p>";
    }
  }

?>
