<h1 class="text-center">Nova Audição</h1>
<form action="?controller=audicao&action=create" method="POST" role="form">
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="nome">Título</label>
      <input type="text" class="form-control" name="titulo" placeholder="Insere o titulo da audição" required="required">
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="nome">Subtítulo</label>
      <input type="text" class="form-control" name="subtitulo" placeholder="Insere o subtitulo da audição" required="required">
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="nome">Tema</label>
      <input type="text" class="form-control" name="tema" placeholder="Insere o tema da audição" required="required">
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-6">
      <label for="dataNasc">Data</label>
      <input type="text" class="form-control readonly" id='datepicker' name="data" placeholder="Insere a data da audição" required="required">
    </div>
    <div class="col-md-6">
      <label for="dataNasc">Hora</label>
      <input type="text" class="form-control readonly" id="timepicker" name="hora" placeholder="Insere a hora da audição" required="required">
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="curso">Organizador</label>
      <select class="form-control" id="selectpicker" data-live-search="true" name="organizador">
        <?php
          foreach($profs as $p){
              echo "<option value='{$p->id}'>{$p->nome}</option>";
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
      <a href="?controller=audicao&action=index" class="btn btn-default">Cancelar</a>
    </div>
  </fieldset>
</form>
