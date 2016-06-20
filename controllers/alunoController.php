<?php
  include_once('models/aluno.php');

  class AlunoController{

    public function index(){
      $alunos = Aluno::all();
      include_once('views/aluno/index.php');
    }

    public function register(){
      $cursos = Curso::all();
      include_once('views/aluno/register.php');
    }

    public function create(){
        if(isset($_POST['enviar'])){
          $last_id = Aluno::generateId();
          $id = "A".($last_id+1);
          $r = Aluno::insert($id, $_POST['nome'], $_POST['dataNasc'], $_POST['anoCurso'], $_POST['curso']);
          if($r){
            echo self::message("success", "Novo aluno registado com sucesso");
          }else{
            echo self::message("danger", "Não foi registado com sucesso");
          }
          self::index();
        }
    }

    public function destroy(){
        $res = Aluno::delete($_GET['id']);
        if($res){
          echo self::message("success", "Aluno removido com sucesso");
        }else{
          echo self::message("danger", "Não foi removido com sucesso");
        }
        self::index();
    }

    public function show(){
      if(isset($_GET['id'])){
        $aluno = Aluno::find($_GET['id']);
        if(!empty($aluno)){
          include_once('views/aluno/show.php');
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }
    }

    public function edit(){
      if(isset($_GET['id'])){
        $aluno = Aluno::find($_GET['id']);
        if(!empty($aluno)){
          $cursos = Curso::all();
          include_once('views/aluno/edit.php');
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }
    }

    public function update(){
      if(isset($_POST['enviar'])){
        $res = Aluno::update($_POST['id'], $_POST['nome'], $_POST['dataNasc'], $_POST['anoCurso'], $_POST['curso']);
        if($res){
          echo self::message("success", "Aluno editado com sucesso");
        }else{
          echo self::message("danger", "Não foi editado com sucesso");
        }
        self::index();
      }
    }

    public function import(){
      if(!$_FILES['xml']['error'] > 0){
        move_uploaded_file($_FILES['xml']['tmp_name'], 'views/assets/uploads/aluno.xml');
        if(Aluno::validateXML()){
          if(Aluno::importXML()){
            echo self::message("success", "XML importado com sucesso");
          }else{
            echo self::message("danger", "Ficheiro XML não foi carregado");
          }
        }else{
          echo self::message("danger", "Ficheiro XML inválido");
        }
        @unlink('views/assets/uploads/aluno.xml');
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
