<div class="panel panel-default">
  <div class="panel-heading text-center">
    <a style="margin-top:-4px;" href="?controller=obra&action=register" class="btn btn-success btn-circle btn-lg pull-right"  data-toggle="tooltip" data-placement="top" title="Adicionar"><span class="glyphicon glyphicon-plus"></span></a>
    <strong class="text-center">Obras</strong>
  </div>
<div class="panel-body">
  <?php if($obras){  ?>
<table border="1" id="table_gestao" class="display">
  <thead>
    <th>ID</th>
    <th>Nome</th>
    <th>Ano</th>
    <th>Periodo</th>
    <th>Compositor</th>
    <th>Duracao</th>
    <th>Accao</th>
  </thead>
  <tbody>
    <?php foreach($obras as $o){ ?>
      <tr>
        <td><?= $o->id ?></td>
        <td><?= $o->nome ?></td>
        <td><?= $o->anoCriacao ?></td>
        <td><?= $o->compositor->periodo->nome ?></td>
        <td><?= $o->compositor->nome ?></td>
        <td><?= $o->duracao ?></td>
        <td>
          <a href="?controller=obra&action=show&id=<?= $o->id ?>" data-toggle="tooltip" data-placement="top" title="Visualizar"><span class="glyphicon glyphicon-eye-open"></span></a>
          <a href="?controller=obra&action=edit&id=<?= $o->id ?>" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
          <a href="?controller=obra&action=destroy&id=<?= $o->id ?>" data-toggle="tooltip" data-placement="top" id="confirm-delete" title="Remover"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<?php }else{ echo "<p class='text-center'>Sem registos disponíveis</p>"; } ?>
</div>
</div>
