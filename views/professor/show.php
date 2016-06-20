      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title"><?= $professor->id ?> : <?= $professor->nome ?></h3>
                <div class="pull-right" style=" margin-top: -25px; margin-right: -15px;">
                  <a href="?controller=professor&action=edit&id=<?= $professor->id ?>" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                  <a href="?controller=professor&action=destroy&id=<?= $professor->id ?>" class="btn btn-danger btn-circle" data-toggle="tooltip" id="confirm-delete" data-placement="top"  title="Remover"><span class="glyphicon glyphicon-trash"></span></a>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                    <table class="table table-user-information">
                      <tbody>
                        <tr>
                          <td>Data Nascimento:</td>
                          <td><?= $professor->dataNasc ?> (<?= $professor->age() ?> anos)</td>
                        </tr>
                        <tr>
                          <td>Habilitação:</td>
                          <td><?= $professor->habilitacao ?></td>
                        </tr>
                        <tr>
                          <td>Curso:</td>
                          <td><?= $professor->curso->nome ?></td>
                        </tr>
                        <tr>
                          <td>Maestro:</td>
                          <td>
                              <?php
                                if($professor->findAtuacoes()){
                                  echo "<ul>";
                                  foreach($professor->findAtuacoes() as $p){
                                    echo "<li><a href='?controller=atuacao&action=show&id={$p->id}'>Atuação: {$p->id}</a></li>";
                                  }
                                  echo "</ul>";
                                }else{
                                  echo "n/a";
                                }
                              ?>
                          </td>
                        </tr>
                        <tr>
                          <td>Organizador:</td>
                          <td>
                              <?php
                                if($professor->findAudicoes()){
                                  echo "<ul>";
                                  foreach($professor->findAudicoes() as $a){
                                    echo "<li><a href='?controller=audicao&action=show&id={$a->id}'>Audição: {$a->id}</a></li>";
                                  }
                                  echo "</ul>";
                                }else{
                                  echo "n/a";
                                }
                              ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
