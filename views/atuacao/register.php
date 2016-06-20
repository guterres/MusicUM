<h1 class="text-center">Nova Atuação para Audição <strong><?= $audicao->titulo ?></strong></h1>
<form action="?controller=atuacao&action=create" method="POST" role="form">
  <input type="hidden" name="audicao" value="<?= $audicao->id ?>">
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="grupo">Grupo</label>
      <select class="form-control" id="selectpicker" name="grupo">
        <option value="NULL">Sem grupo</option>
        <?php
          foreach($grupos as $g){
              echo "<option value='{$g->id}'>{$g->nome}</option>";
          }
        ?>
      </select>
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="alunos">Alunos</label>
      <select multiple class="form-control" id="selectpicker1" name="alunos[]" required>
        <?php
          foreach($alunos as $a){
              echo "<option value='{$a->id}'>{$a->nome}</option>";
          }
        ?>
      </select>
    </div>
  </fieldset>
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="maestros">Maestros</label>
      <select multiple class="form-control" id="selectpicker2" name="maestros[]" required>
        <?php
          foreach($profs as $p){
              echo "<option value='{$p->id}'>{$p->nome}</option>";
          }
        ?>
      </select>
    </div>
  </fieldset>
  <fieldset class="form-group">
      <div class="col-md-12">
      <label for="obras">Obras</label>
      <select multiple class="form-control" id="selectpicker3" name="obras[]" required>
        <?php
          foreach($obras as $o){
              echo "<option value='{$o->id}'>{$o->nome}</option>";
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
      <a href="?controller=audicao&action=show&id=<?= $audicao->id ?>" class="btn btn-default">Cancelar</a>
    </div>
  </fieldset>
</form>

<script>
  $('#selectpicker1').selectpicker({
   size: 5,
   noneSelectedText: 'Nenhum selecionado',
   liveSearch: true
  });
  $('#selectpicker2').selectpicker({
   size: 5,
   noneSelectedText: 'Nenhum selecionado',
   liveSearch: true
 });
 $('#selectpicker3').selectpicker({
  size: 5,
  noneSelectedText: 'Nenhum selecionado',
  liveSearch: true
});
</script>
