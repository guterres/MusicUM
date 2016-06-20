<div class="panel panel-default">
  <div class="panel-heading text-center">
    <a style="margin-top:-4px;" href="?controller=professor&action=register"  class="btn btn-success btn-circle btn-lg pull-right"  data-toggle="tooltip" data-placement="top" title="Adicionar"><span class="glyphicon glyphicon-plus"></span></a>
    <a id="import" style="margin-top:-4px; margin-right:4px;" href="?controller=professor&action=import" class="btn btn-primary btn-circle pull-right"  data-toggle="tooltip" data-placement="top" title="Importar"><span class="glyphicon glyphicon-import"></span></a>
    <strong class="text-center">Professores</strong>
  </div>
  <div class="panel-body">
    <?php if($professores){ ?>
<table border="1" id="table_gestao" class="display">
  <thead>
    <th>ID</th>
    <th>Nome</th>
    <th>Data Nasc</th>
    <th>Habilitacao</th>
    <th>Curso</th>
    <th>Accao</th>
  </thead>
  <tbody>
    <?php foreach($professores as $p){ ?>
      <tr>
        <td><?= $p->id ?></td>
        <td><?= $p->nome ?></td>
        <td><?= $p->dataNasc ?></td>
        <td><?= $p->habilitacao ?></td>
        <td><?= $p->curso->nome ?></td>
        <td>
          <a href="?controller=professor&action=show&id=<?= $p->id ?>" data-toggle="tooltip" data-placement="top" title="Visualizar"><span class="glyphicon glyphicon-eye-open"></span></a>
          <a href="?controller=professor&action=edit&id=<?= $p->id ?>" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
          <a href="?controller=professor&action=destroy&id=<?= $p->id ?>" data-toggle="tooltip" data-placement="top" id="confirm-delete" title="Remover"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<?php }else{ echo "<p class='text-center'>Sem registos disponíveis</p>"; } ?>
</div>
</div>

<script>
function isXml(input){
   var value = input.value;
   var res = value.substr(value.lastIndexOf('.')) == '.xml';
   if(!res){
     input.value = "";
     bootbox.alert("Ficheiro inválido");
   }
   return res;
 }
 </script>
