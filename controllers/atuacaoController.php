<?php
  include_once('models/atuacao.php');
  include_once('models/grupo.php');
  include_once('models/aluno.php');
  include_once('models/professor.php');
  include_once('models/obra.php');
  include_once('models/audicao.php');
  include_once('controllers/audicaoController.php');

  class AtuacaoController{

    public function register(){
      $grupos = Grupo::all();
      $alunos = Aluno::all();
      $profs = Professor::all();
      $obras = Obra::all();
      $audicao = Audicao::find($_GET['au']);
      include_once('views/atuacao/register.php');
    }

    public function create(){
      if(isset($_POST['enviar'])){
        $last_id = Atuacao::generateId();
        $id = "At".($last_id+1);
        $r = Atuacao::insert($id, $_POST['grupo'], $_POST['alunos'], $_POST['maestros'], $_POST['obras'], $_POST['audicao']);
        if($r){
          echo self::message("success", "Registo efetuado com sucesso");
        }else{
          echo self::message("danger", "Não foi registado");
        }
        $_GET['id'] = $_POST['audicao'];
        AudicaoController::show();
      }
    }

    public function destroy(){
      if((isset($_GET['id'])) && (isset($_GET['au']))){
        $atuacao = Atuacao::find($_GET['id']);
        if((!empty($atuacao)) && ($atuacao->audicao->notHappened())){
          $res = Atuacao::delete($_GET['id'], $_GET['au']);
          if($res){
            echo self::message("success", "Removido com sucesso");
          }else{
            echo self::message("danger", "Não foi removido");
          }
          $_GET['id'] = $_GET['au'];
          AudicaoController::show();
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }


    }

    public function show(){
      if(isset($_GET['id'])){
        $atuacao = Atuacao::find($_GET['id']);
        if(!empty($atuacao)){
          include_once('views/atuacao/show.php');
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }
    }

    public function edit(){
      if(isset($_GET['id'])){
        $atuacao = Atuacao::find($_GET['id']);
        if((!empty($atuacao)) && ($atuacao->audicao->notHappened())){
          $grupos = Grupo::all();
          $alunos = Aluno::all();
          $profs = Professor::all();
          $obras = Obra::all();
          $audicao = Audicao::find($_GET['au']);
          include_once('views/atuacao/edit.php');
        }else{
          include_once('views/error.php');
        }
      }else{
        include_once('views/error.php');
      }
    }

    public function update(){
      if(isset($_POST['enviar'])){
        $res = Atuacao::update($_POST['id'], $_POST['grupo'], $_POST['alunos'], $_POST['maestros'], $_POST['obras'], $_POST['audicao']);
        if($res){
          echo self::message("succes", "Edição efetuado com sucesso");
        }else{
          echo self::message("danger", "Não foi editado com sucesso");
        }
        $_GET['id'] = $_POST['audicao'];
        AudicaoController::show();
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
