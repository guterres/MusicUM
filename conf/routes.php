<?php
  $controllers = array(
                  'obra' => ['index', 'register', 'create', 'destroy', 'show', 'edit', 'update'],
                  'aluno' => ['index', 'register', 'create', 'destroy', 'show', 'edit', 'update', 'import'],
                  'professor' => ['index', 'register', 'create', 'destroy', 'show', 'edit', 'update', 'import'],
                  'atuacao' => ['register', 'create', 'destroy', 'show', 'edit', 'update'],
                  'audicao' => ['index', 'register', 'create', 'destroy', 'show', 'edit', 'update', 'search', 'import', 'export', 'pdf'],
                  'home' => ['index']
                );
  if(array_key_exists($controller, $controllers)){
    if(in_array($action, $controllers[$controller])){
      call($controller, $action);
    }else{
      include_once('views/error.php');
    }
  }else{
    include_once('views/error.php');
  }

  function call($controller, $action){
    include_once('controllers/'.$controller.'Controller.php');
    switch ($controller) {
      case 'obra':
        $controlador = new ObraController();
        break;
      case 'aluno':
        $controlador = new AlunoController();
        break;
      case 'professor':
        $controlador = new ProfessorController();
        break;
      case 'atuacao':
        $controlador = new AtuacaoController();
        break;
      case 'audicao':
        $controlador = new AudicaoController();
        break;
      case 'home':
        $controlador = new HomeController();
        break;
    }
    $controlador->$action();
  }
?>
