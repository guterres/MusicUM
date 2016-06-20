<h1 class="text-center">Editar Atuação para Audição de <strong><?= $audicao->titulo ?></strong></h1>
<form action="?controller=atuacao&action=update" method="POST" role="form">
  <input type="hidden" name="id" value="<?= $atuacao->id ?>">
  <input type="hidden" name="audicao" value="<?= $audicao->id ?>">
  <fieldset class="form-group">
    <div class="col-md-12">
      <label for="grupo">Grupo</label>
      <select class="form-control" id="selectpicker" name="grupo">
        <option value="NULL">Sem grupo</option>
        <?php
          foreach($grupos as $g){
            if($g->id == $atuacao->grupo->id){
              echo "<option value='{$g->id}' selected>{$g->nome}</option>";
            }else{
              echo "<option value='{$g->id}'>{$g->nome}</option>";
            }
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
            if(in_array($a,$atuacao->alunos)){
              echo "<option value='{$a->id}' selected>{$a->nome}</option>";
            }else{
              echo "<option value='{$a->id}'>{$a->nome}</option>";
            }
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
            if(in_array($p, $atuacao->maestros)){
              echo "<option value='{$p->id}' selected>{$p->nome}</option>";
            }else{
              echo "<option value='{$p->id}'>{$p->nome}</option>";
            }
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
            if(in_array($o, $atuacao->obras)){
              echo "<option value='{$o->id}' selected>{$o->nome}</option>";
            }else{
              echo "<option value='{$o->id}'>{$o->nome}</option>";
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
