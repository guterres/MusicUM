$(document).ready(function(){
  $('#table_gestao').DataTable( {
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

  $('[data-toggle="tooltip"]').tooltip();

  $('#datepicker')
   .datepicker({
       format: 'yyyy-mm-dd'
   })
   .on('changeDate', function(e) {
       $('#eventForm').formValidation('revalidateField', 'date');
   });

   $('#timepicker').timepicker({
     minuteStep: 1,
     showSeconds: true,
     showMeridian: false,
     defaultTime: '00:00:01',
     showInputs: false,
     disableFocus: true
   });

   $('#readonly').keydown(function(){
     return false;
   });

   $('#selectpicker').selectpicker({
    size: 5
  });

  $(document).on("click", "#confirm-delete", function(e) {
        var link = $(this).attr("href");
        e.preventDefault();
        bootbox.confirm("Tem a certeza que deseja eliminar?", function(result) {
            if (result) {
                document.location.href = link;
            }
        });
    });

    $(document).on("click", "#import", function(e) {
        var link = $(this).attr("href");
        e.preventDefault();
        bootbox.dialog({
          title: "Carregar ficheiro de XML",
          message: "<form action='"+link+"' method='post' style='margin-bottom:50px;' enctype='multipart/form-data'>"+
                    "<div class='form-group'>"+
                    "<input type='file' accept='text/xml' onchange='return isXml(this)' name='xml' required>"+
                    "</div>"+
                    "<div class='form-group'>"+
                    "<input class='btn btn-success pull-right' type='submit' name='enviar' value='Carregar'>"+
                    "</div>"+
                    "</form>"
        });
    });

  
});
