
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
            <div class="panel panel-info">
              <div class="panel-heading">
                <h3 class="panel-title"><?= $aluno->id ?> : <?= $aluno->nome ?></h3>
                <div class="pull-right" style=" margin-top: -25px; margin-right: -15px;">
                  <a href="?controller=aluno&action=edit&id=<?= $aluno->id ?>" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></a>
                  <a href="?controller=aluno&action=destroy&id=<?= $aluno->id ?>" class="btn btn-danger btn-circle" data-toggle="tooltip" id="confirm-delete" data-placement="top"  title="Remover"><span class="glyphicon glyphicon-trash"></span></a>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                    <table class="table table-user-information">
                      <tbody>
                        <tr>
                          <td>Data Nascimento:</td>
                          <td><?= $aluno->dataNasc ?> (<?= $aluno->age() ?> anos)</td>
                        </tr>
                        <tr>
                          <td>Ano:</td>
                          <td><?= $aluno->anoCurso ?></td>
                        </tr>
                        <tr>
                          <td>Curso:</td>
                          <td><?= $aluno->curso->nome ?></td>
                        </tr>
                        <tr>
                          <td>Professores do curso;</td>
                          <td>
                            <ul>
                              <?php
                                  foreach ($aluno->findProfCurso() as $p) {
                                    echo "<li><a href='?controller=professor&action=show&id={$p->id}'>{$p->nome}</a></li>";
                                  }
                              ?>
                            </ul>
                          </td>
                        </tr>
                        <tr>
                          <td>Instrumento:</td>
                          <td><?= $aluno->curso->instrumento->nome ?></td>
                        </tr>
                        <tr>
                          <td>Atuações:</td>
                          <td>
                              <?php
                                if($aluno->findAtuacoes()){
                                  echo "<ul>";
                                  foreach($aluno->findAtuacoes() as $a){
                                    echo "<li><a href='?controller=atuacao&action=show&id={$a->id}'>Atuação: {$a->id}</a></li>";
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
