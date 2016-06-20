<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Audições</title>
    <link rel="stylesheet" href="views/assets/css/jquery.typeahead.min.css" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="views/assets/css/home.css" type="text/css">
    <script src="views/assets/js/jquery.js"></script>
    <script src="views/assets/js/jquery.typeahead.min.js"></script>
</head>

<body>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand page-scroll" href="#"><img src="views/assets/img/logo2.png"  /></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="btn-default btn" href="?controller=audicao&action=index">Explorar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>CONCERTOS/AUDIÇÕES</h1>
                <br/>
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                  <form action="?controller=audicao&action=search" method="post">
                    <div class="typeahead-container">
                    <div class="input-group input-group-lg">
                      <input id="q" name="q" type="search" autofocus autocomplete="off" class="form-control" placeholder="Pesquisar Audições">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Pesquisar</button>
                      </span>
                    </div>
                  </div>
                  </form>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </header>
    <script>
        var datajson = <?php echo $json; ?>;
        $('#q').typeahead({
          minLength: 1,
          order: "asc",
          dynamic: true,
          maxItemPerGroup: 3,
          delay: 500,
          group: true,
          template:
              '<span>{{titulo}}</span>' +
              '<span>({{id}})</span>',
          href: '?controller=audicao&action=show&id={{id}}',
          source: {
              "<strong style='color:green;'>Ocorridos</strong>": {
                  display: "titulo",
                  data: datajson.ocorr,
              },
              "<strong style='color:red;'>Não Ocorridos</strong>": {
                  display: "titulo",
                  data: datajson.notocorr,
              }
          },
          debug: true
      });
    </script>
</body>
</html>
