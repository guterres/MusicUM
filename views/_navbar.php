<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" style="margin-top: -5px;" href="/audicoes"><img src="views/assets/img/logo3.png" /></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li>
         <form action="?controller=audicao&action=search" method="post" class="navbar-form navbar-left" role="search">
           <div class="input-group">
             <input type="text" class="form-control" placeholder="Pesquisar Audição" name="q">
             <div class="input-group-btn">
               <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
             </div>
           </div>
         </form>
        </li>
        <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestão<b class="caret"></b></a>
          <ul class="dropdown-menu multi-level">
            <li><a href="?controller=aluno&action=index">Alunos</a></li>
            <li><a href="?controller=professor&action=index">Professores</a></li>
            <li><a href="?controller=obra&action=index">Obras</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="?controller=audicao&action=index">Explorar</a></li>
      </ul>
    </div>
  </div>
</nav>
