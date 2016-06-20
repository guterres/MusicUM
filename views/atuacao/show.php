<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title"><?= $atuacao->id ?> : Atuacao de <?= $atuacao->audicao->titulo ?></h3>
      <?php if($atuacao->audicao->notHappened()){ ?>
      <div class="pull-right" style=" margin-top: -25px; margin-right: -15px;">
        <a href="?controller=atuacao&action=edit&id=<?= $atuacao->id ?>&au=<?= $atuacao->audicao->id ?>" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
        <a href="?controller=atuacao&action=destroy&id=<?= $atuacao->id ?>&au=<?= $atuacao->audicao->id ?>" class="btn btn-danger btn-circle" data-toggle="tooltip" id="confirm-delete" data-placement="top"  title="Remover"><span class="glyphicon glyphicon-trash"></span></a>
      </div>
      <?php } ?>
    </div>
    <div class="panel-body">
      <div class="row">
          <table class="table table-user-information">
            <tbody>
              <tr>
                <td>Grupo:</td>
                <td><?= $atuacao->grupo->nome ?></td>
              </tr>
              <tr>
                <td>Alunos:</td>
                <td>
                  <ul>
                    <?php
                        foreach ($atuacao->alunos as $a) {
                          echo "<li><a href='?controller=aluno&action=show&id={$a->id}'>{$a->nome}</a></li>";
                        }
                    ?>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>Maestros:</td>
                <td>
                  <ul>
                    <?php
                        foreach ($atuacao->maestros as $a) {
                          echo "<li><a href='?controller=professor&action=show&id={$a->id}'>{$a->nome}</a></li>";
                        }
                    ?>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>Obras:</td>
                <td>
                  <ul>
                    <?php
                        foreach ($atuacao->obras as $a) {
                          echo "<li><a href='?controller=obra&action=show&id={$a->id}'>{$a->nome}</a></li>";
                        }
                    ?>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
