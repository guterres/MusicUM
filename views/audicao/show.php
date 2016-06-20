<div >
  <?php if($audicao->notHappened()){ ?>
  <a href="?controller=audicao&action=edit&id=<?= $audicao->id ?>" class="btn btn-warning btn-circle pos" style="top:50px;" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
  <?php } ?>
  <a id="confirm-delete" href="?controller=audicao&action=destroy&id=<?= $audicao->id?>" class="btn btn-danger btn-circle pos" style="top:50px;" data-toggle="tooltip" data-placement="top" title="Remover"><span class="glyphicon glyphicon-trash"></span></a>
  <a href="?controller=audicao&action=export&id=<?= $audicao->id ?>" class="btn btn-default btn-circle pos" style="top:50px; left: -30px;" data-toggle="tooltip" data-placement="top" title="Exportar"><span class="glyphicon glyphicon-export"></span></a>
  <a href="?controller=audicao&action=pdf&id=<?= $audicao->id?>" class="btn btn-info btn-circle pos" style="top:50px; left:-30px;" data-toggle="tooltip" data-placement="top" title="PDF"><span class="glyphicon glyphicon-file"></span></a>
</div>
 <div class="jumbotron">

    <div class="text-center title">
      <h1><small style="color:white;"><?= $audicao->id ?></small> <?= $audicao->titulo ?></h1>
      <h3><?= $audicao->subtitulo ?><small class="text-center" style="color:grey;">(<?= $audicao->tema ?>)</small></h3>
    </div>

    <div class="show">
      <p class="col-md-12"><strong>Organizador: </strong><?= $audicao->organizador->nome ?></p>
      <div class="col-md-6">
        <p class="pull-left"><strong>Data: </strong><?= $audicao->data ?> <strong>Hora: </strong><?= $audicao->hora ?></p>
      </div>
      <div class="col-md-6">
        <p class="pull-right"><strong>Duração: </strong><?= $audicao->duracao ?></p>
      </div>
    </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading text-center">
    <?php if($audicao->notHappened()){ ?>
    <a style="margin-top:-4px;" href="?controller=atuacao&action=register&au=<?= $audicao->id ?>" class="btn btn-success btn-circle pull-right"  data-toggle="tooltip" data-placement="top" title="Adicionar"><span class="glyphicon glyphicon-plus"></span></a>
    <?php } ?>
    <strong class="text-center">Atuações</strong>
  </div>
  <div class="panel-body">
    <?php if($audicao->atuacoes()){ ?>
    <table border="1" id="table_atuacoes" class="display">
      <thead>
        <th>ID</th>
        <th>Grupo</th>
        <th>Alunos</th>
        <th>Maestros</th>
        <th>Obras</th>
        <th>Accao</th>
      </thead>
      <tbody>

        <?php if(is_array($audicao->atuacoes())){
          foreach($audicao->atuacoes() as $a){ ?>

          <tr>
            <td><?= $a->id ?></td>
            <td><?= $a->grupo->nome ?></td>
            <td><?= count($a->alunos) ?></td>
            <td><?= count($a->maestros) ?></td>
            <td><?= count($a->obras) ?></td>
            <td>
              <a href="?controller=atuacao&action=show&id=<?= $a->id ?>" data-toggle="tooltip" data-placement="top" title="Visualizar"><span class="glyphicon glyphicon-eye-open"></span></a>
              <?php if($audicao->notHappened()){ ?>
              <a href="?controller=atuacao&action=edit&id=<?= $a->id ?>&au=<?= $audicao->id ?>" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
              <a href="?controller=atuacao&action=destroy&id=<?= $a->id ?>&au=<?= $audicao->id ?>" data-toggle="tooltip" id="confirm-delete" data-placement="top"  title="Remover"><span class="glyphicon glyphicon-trash"></span></a>
              <?php } ?>
            </td>
          </tr>
        <?php }} ?>
      </tbody>
    </table>
  <?php }else{ echo "<p class='text-center'>Sem registos disponíveis</p>"; } ?>
  </div>
</div>
<script>
  $('#table_atuacoes').dataTable({
    bFilter: false,
    bInfo: false,
    "language": {
        "lengthMenu":       "Mostrar _MENU_ registos por página",
        "info":             "Mostrar a página _PAGE_ de _PAGES_",
        "infoEmpty":        "Sem registos disponíveis",
        "emptyTable":       "Sem registos disponíveis",
        "zeroRecords":      "Sem registos disponíveis",
        "infoFiltered":     "(Filtrar _MAX_ registos)",
        "decimal":          "",
        "infoPostFix":      "",
        "thousands":        ",",
        "search":           "Pesquisa:",
        "paginate": {
            "first":        "Primeiro",
            "last":         "Último",
            "next":         "Próximo",
            "previous":     "Anterior"
        },
        "loadingRecords":   "A carregar...",
        "processing":       "A processar...",
        "aria": {
          "sortAscending":  ": ordenar crescente",
          "sortDescending": ": ordenar decrescente"
      }
    }
  });
</script>
