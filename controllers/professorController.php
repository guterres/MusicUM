<?php
  include_once('models/professor.php');

  class ProfessorController{

    public function index(){
      $professores = Professor::all();
      include_once('views/professor/index.php');
    }

    public function register(){
      $cursos = Curso::all();
      include_once('views/professor/register.php');
    }

    public function create(){
        if(isset($_POST['enviar'])){
          $last_id = Professor::generateId();
          $id = "P".($last_id+1);
          $r = Professor::insert($id, $_POST['nome'], $_POST['dataNasc'], $_POST['habilitacao'], $_POST['curso']);
          if($r){
            echo self::message("success", "Novo professor registado com sucesso");
          }else{
            echo self::message("danger", "Não foi registado com sucesso");
          }
          self::index();
        }
    }

    public function destroy(){
        $res = Professor::delete($_GET['id']);
        if($res){
          echo self::message("success", "Professor removido com sucesso");
        }else{
          echo self::message("danger", "Não foi removido com sucesso");
        }
        self::index();

    }

    public function show(){
      if(isset($_GET['id'])){
        $professor = Professor::find($_GET['id']);
        if(!empty($professor)){
          include_once('views/professor/show.php');
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }
    }

    public function edit(){
      if(isset($_GET['id'])){
        $professor = Professor::find($_GET['id']);
        if(!empty($professor)){
          $cursos = Curso::all();
          include_once('views/professor/edit.php');
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }
    }

    public function update(){
      if(isset($_POST['enviar'])){
        $res = Professor::update($_POST['id'], $_POST['nome'], $_POST['dataNasc'], $_POST['habilitacao'], $_POST['curso']);
        if($res){
          echo self::message("success", "Professor editado com sucesso");
        }else{
          echo self::message("danger", "Não foi editado com sucesso");
        }
        self::index();
      }
    }

    public function import(){
      if(!$_FILES['xml']['error'] > 0){
        move_uploaded_file($_FILES['xml']['tmp_name'], 'views/assets/uploads/professor.xml');
        if(Professor::validateXML()){
          if(Professor::importXML()){
            echo self::message("success", "XML importado com sucesso");
          }else{
            echo self::message("danger", "Ficheiro XML não foi carregado");
          }
        }else{
          echo self::message("danger", "Ficheiro XML inválido");
        }
        @unlink('views/assets/uploads/professor.xml');
        self::index();
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
