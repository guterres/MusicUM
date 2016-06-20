
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $obra->id ?> : <?= $obra->nome ?></h3>
          <div class="pull-right" style=" margin-top: -25px; margin-right: -15px;">
            <a href="?controller=obra&action=edit&id=<?= $obra->id ?>" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="?controller=obra&action=destroy&id=<?= $obra->id ?>" class="btn btn-danger btn-circle" data-toggle="tooltip" id="confirm-delete" data-placement="top"  title="Remover"><span class="glyphicon glyphicon-trash"></span></a>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
              <table class="table table-user-information">
                <tbody>
                  <tr>
                    <td>Criação:</td>
                    <td><?= $obra->anoCriacao ?> (<?= $obra->age() ?> anos)</td>
                  </tr>
                  <tr>
                    <td>Periodo:</td>
                    <td><?= $obra->compositor->periodo->nome ?></td>
                  </tr>
                  <tr>
                    <td>Descrição:</td>
                    <td><?= $obra->descricao ?></td>
                  </tr>
                  <tr>
                    <td>Compositor:</td>
                    <td><?= $obra->compositor->nome ?></td>
                  </tr>
                  <tr>
                    <td>Duração</td>
                    <td> <?= $obra->duracao ?></td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
