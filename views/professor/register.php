<h1 class="text-center">Novo Professor</h1>

<form action="?controller=professor&action=create" method="POST" role="form">
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" name="nome" placeholder="Insere o nome do professor" required="required">
    </div>
  </fieldset>

  <fieldset class="form-group" >
    <div class="col-md-12">
      <label for="dataNasc">Data de Nascimento</label>
      <input type="text" id='datepicker' class="form-control" name="dataNasc" placeholder="Insere a data de nascimento do professor" required="required">
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="habilitacao">Habilitação</label>
      <input type="text" class="form-control" name="habilitacao" placeholder="Insere a habilitação do professor" required="required">
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="curso">Curso</label>
      <select class="form-control" id="selectpicker" data-live-search="true" name="curso">
        <?php
          foreach($cursos as $c){
              echo "<option value='{$c->id}'>{$c->nome}</option>";
          }
        ?>
      </select>
    </div>
  </fieldset>

  <fieldset class="form-group">
    <div class="col-md-6">
      <input class="btn btn-primary pull-right" type="submit" name="enviar" value="Registar">
    </div>
    <div class="col-md-6">
      <a href="?controller=professor&action=index" class="btn btn-default">Cancelar</a>
    </div>
  </fieldset>
</form>
