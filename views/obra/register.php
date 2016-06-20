<h1 class="text-center">Nova Obra</h1>

<form action="?controller=obra&action=create" method="POST" role="form">
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" name="nome" placeholder="Insere o nome da obra" required="required">
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="descricao">Descrição</label>
      <textarea class="form-control" rows="5" name="descricao" placeholder="Insere a descrição da obra" required="required"></textarea>
    </div>
  </fieldset>

  <fieldset class="form-group">
    <div class="col-md-6">
      <label for="anoCriacao">Ano</label>
      <input type="number" class="form-control" name="anoCriacao" placeholder="Insere o ano da obra" required="required">
    </div>
    <div class="col-md-6">
      <label for="duracao">Duração</label>
      <input type="text" id="timepicker" name="duracao" class="form-control readonly" placeholder="Insere a duração da obra" required />
    </div>
  </fieldset>

  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="compositor">Compositor</label>
      <select class="form-control" id="selectpicker" data-live-search="true" name="compositor">
        <?php
          foreach($comps as $c){
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
      <a href="?controller=obra&action=index" class="btn btn-default">Cancelar</a>
    </div>
  </fieldset>
</form>
