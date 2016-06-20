<h1 class="text-center">Editar Aluno</h1>
<form action="?controller=aluno&action=update" method="POST" role="form">
  <input type="hidden" name="id" value="<?= $aluno->id ?>">
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" name="nome" value="<?= $aluno->nome ?>" placeholder="Insere o nome do aluno" required="required">
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="dataNasc">Data de Nascimento</label>
      <input type="text" class="form-control" id='datepicker' value="<?= $aluno->dataNasc ?>" name="dataNasc" placeholder="Insere a data de nascimento do aluno" required="required">
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-6">
      <label for="ano">Ano</label>
      <input type="text" class="form-control" value="<?= $aluno->anoCurso ?>" name="anoCurso" placeholder="Insere o ano do curso do aluno" required="required">
    </div>
    <div class="col-md-6">
      <label for="curso">Curso</label>
      <select class="form-control" id="selectpicker" data-live-search="true" name="curso">
        <?php
          foreach($cursos as $c){
            if($c->id == $aluno->curso->id){
              echo "<option value='{$c->id}' selected>{$c->nome}</option>";
            }else{
              echo "<option value='{$c->id}'>{$c->nome}</option>";
            }
          }
        ?>
      </select>
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-6">
      <input class="btn btn-primary pull-right" type="submit" name="enviar" value="Editar">
    </div>
    <div class="col-md-6">
      <a href="?controller=aluno&action=index" class="btn btn-default">Cancelar</a>
    </div>
  </fieldset>
</form>
