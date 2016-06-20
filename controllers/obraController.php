<?php
  include_once('models/obra.php');
  include_once('models/compositor.php');

  class ObraController{

    public function index(){
      $obras = Obra::all();
      include_once('views/obra/index.php');
    }

    public function register(){
      $comps = Compositor::all();
      include_once('views/obra/register.php');
    }

    public function create(){
        if(isset($_POST['enviar'])){
          $last_id = Obra::generateId();
          $id = "O".($last_id+1);
          $r = Obra::insert($id, $_POST['nome'], $_POST['descricao'], $_POST['anoCriacao'], $_POST['compositor'], $_POST['duracao']);
          if($r){
            echo self::message("success", "Nova obra registado com sucesso");
          }else{
            echo self::message("danger", "Não foi registado com sucesso");
          }
          self::index();
        }
    }

    public function destroy(){
      $res = Obra::delete($_GET['id']);
      if($res){
        echo self::message("success", "Obra removido com sucesso");
      }else{
        echo self::message("danger", "Não foi removido com sucesso");
      }
      self::index();
    }

    public function show(){
      if(isset($_GET['id'])){
        $obra = Obra::find($_GET['id']);
        if(!empty($obra)){
          include_once('views/obra/show.php');
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }
    }

    public function edit(){
      if(isset($_GET['id'])){
        $obra = Obra::find($_GET['id']);
        if(!empty($obra)){
          $comps = Compositor::all();
          include_once('views/obra/edit.php');
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }
    }

    public function update(){
      if(isset($_POST['enviar'])){
        $res = Obra::update($_POST['id'], $_POST['nome'], $_POST['descricao'], $_POST['anoCriacao'], $_POST['duracao'], $_POST['compositor']);
        if($res){
          echo self::message("success", "Obra editado com sucesso");
        }else{
          echo self::message("danger", "Não foi editado com sucesso");
        }
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
