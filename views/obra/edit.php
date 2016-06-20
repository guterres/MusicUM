<h1 class="text-center">Editar Obra</h1>
<form action="?controller=obra&action=update" method="POST" role="form">
  <input type="hidden" name="id" value="<?= $obra->id ?>">
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" name="nome" placeholder="Insere o nome da obra" value="<?= $obra->nome ?>" required="required">
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="descricao">Descrição</label>
      <textarea class="form-control" rows="5" name="descricao" placeholder="Insere a descrição da obra" required="required"><?= $obra->descricao ?></textarea>
    </div>
  </fieldset>

  <fieldset class="form-group">
    <div class="col-md-6">
      <label for="anoCriacao">Ano</label>
      <input type="number" class="form-control" name="anoCriacao" placeholder="Insere o ano da obra"  value="<?= $obra->anoCriacao ?>" required="required">
    </div>
    <div class="col-md-6">
      <label for="duracao">Duração</label>
      <input type="text" id="timepicker" name="duracao" class="form-control readonly" placeholder="Insere a duração da obra" value="<?=  $obra->duracao ?>" required />
    </div>
  </fieldset>

  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="compositor">Compositor</label>
      <select class="form-control" id="selectpicker" data-live-search="true" name="compositor">
        <?php
          foreach($comps as $c){
            if($c->id == $obra->compositor->id){
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
      <a href="?controller=obra&action=index" class="btn btn-default">Cancelar</a>
    </div>
  </fieldset>
</form>
