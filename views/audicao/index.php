<ul style="list-style-type: none; margin-top:-65px;">
  <li><a href="?controller=audicao&action=register" class="btn btn-success btn-circle pos"  data-toggle="tooltip" data-placement="top" title="Adicionar"><span class="glyphicon glyphicon-plus"></span></a></li>
  <li><a id="import" href="?controller=audicao&action=import" class="btn btn-primary btn-circle pos"  data-toggle="tooltip" data-placement="top" title="Importar"><span class="glyphicon glyphicon-import"></span></a></li>
</ul>
<div class="text-center">
  <a href="?controller=audicao&action=index&filter=all" class="btn btn-default" title="Visualizar">Todos</a>
  <a href="?controller=audicao&action=index&filter=ocorr" class="btn btn-default" title="Visualizar">Ocorridos</a>
  <a href="?controller=audicao&action=index&filter=notocorr" class="btn btn-default" title="Visualizar">Não Ocorridos</a>
</div>
<?php if($audicoes){ ?>

  <div id="audicoes" style="margin-top:45px;">
<?php  foreach($audicoes as $a){ ?>
  <div class="col-md-12">
      <div class="thumbnail">
        <div class="caption">
          <div class="pull-right" style="margin-top:25px; margin-right: 30px;">
            <a href="?controller=audicao&action=show&id=<?= $a->id ?>" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="top" title="Visualizar"><span class="glyphicon glyphicon-eye-open"></span></a>
            <?php if($a->notHappened()){ ?>
            <a href="?controller=audicao&action=edit&id=<?= $a->id ?>" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
            <?php } ?>
            <a href="?controller=audicao&action=destroy&id=<?= $a->id ?>" class="btn btn-danger btn-circle" data-toggle="tooltip" id="confirm-delete" data-placement="top"  title="Remover"><span class="glyphicon glyphicon-trash"></span></a>
          </div>
          <table style="margin-left:15px;">
          <tbody>
            <tr>
              <td><h2 style="margin-bottom:-5px;"><small><?= $a->id ?></small> <?= $a->titulo ?></h2></td>
            </tr>
            <tr>
              <td><h4 style="margin-bottom:35px;"><?= $a->subtitulo ?>(<small><?= $a->tema ?></small>)</h4></td>
            </tr>
          </tbody>
        </table>
          <table class="pull-right">
            <tbody>
              <tr>
                <td><strong>Atuações:</strong></td>
                <td><?= count($a->atuacoes()) ?></td>
              </tr>
              <tr>
                <td><strong>Duração:</strong></td>
                <td><?= $a->duracao ?></td>
              </tr>
            </tbody>
          </table>
            <p class="col-md-6"><strong>Organizador: </strong><?= $a->organizador->nome ?></p>

            <div class="col-md-6">
              <p class="pull-left"><strong>Data: </strong><?= $a->data ?> <strong>Hora: </strong><?= $a->hora ?></p>
            </div>
          <p></p>
        </div>
      </div>
    </div>

<?php } ?>
<div class="text-center">
<?php if(isset($_GET['filter'])){
  echo $paginator->createLinks(4, 'pagination pagination-sm', "?controller=audicao&action=index&filter={$_GET['filter']}");
}else{
  echo $paginator->createLinks(4, 'pagination pagination-sm', '?controller=audicao&action=index');
}
?>
</div>
 <?php }else{ echo "<h3 class='text-center' style='margin-top:50px;'>Sem registos disponíveis</h3>"; } ?>
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
