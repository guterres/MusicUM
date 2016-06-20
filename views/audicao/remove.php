Deseja eliminar o <?= $audicao->id ?> ?

<form action="?controller=audicao&action=destroy" method="POST">
  <input type="hidden" name="id" value="<?= $audicao->id ?>" />
  <input type="submit" name="enviar" value="Eliminar" />
</form>
