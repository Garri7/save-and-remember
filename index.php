<?php 
session_start();


if (isset($_SESSION['usuario'])) {
 

}else{
    header('Location: login.php');
}

?>
<!doctype html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/lightbox.css">
    <link rel="stylesheet" href="css/estilos.css">

    

    <title>Inventario de Preferencias</title>
</head>
<!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(["setCookieDomain", "*.tools.garri.nom.es"]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//panel.garri.nom.es/statistics/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '9']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
<body>
    
    <div class="container fondo">
        <div class="row  justify-content-center">
            <div class="col-sm-12">

            

        <h1 class="text-center"><i class="bi bi-link"></i> Ordena tus Preferencia de productos.<i class="bi bi-link"></i></h1>
        <p class="fw-light text-center"> Sitio web para ordenar cualquier cosa. </p>
   
           
                <div class="text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-lg fs-5" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
                        <i class="bi bi-plus-circle-fill"></i> Crear
                    </button>
                </div>
            
  
        <br />
        <br />
      
        <div class="table-responsive col-sm-12 col-xs-12">
            <table id="datos_util" class="display table table-bordered table-hover nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Artículo</th>
                        <th>Ubicación</th>
                        <th>Imagen</th>
                        <th>Fecha Creación</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
            </table>
        </div>
        
            <div class="text-center">
                
                <a href="cerrar.php" type="button"   class="btn btn-dark btn-lg fs-5 mt-3" >
                    <i class="bi bi-door-closed-fill"></i> Salir
                </a>
            </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Util</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" id="formulario" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-body">
                            <label for="articulo">Ingrese el Artículo</label>
                            <input type="text" name="articulo" id="articulo" class="form-control">
                            <br />

                            <label for="ubicacion">Ingrese la Ubicación</label>
                            <input type="text" name="ubicacion" id="ubicacion" class="form-control">
                            <br />
                            
                            <label for="imagen">Seleccione una imagen</label>
                            <input type="file" name="imagen_usuario" id="imagen_usuario" class="form-control">
                            <span id="imagen_subida"></span>
                            <br />
                        </div>

                        <div class="modal-footer">
                            <input type="hidden" name="id_usuario" id="id_usuario">
                            <input type="hidden" name="operacion" id="operacion">
                            <input type="submit" name="action" id="action" class="btn btn-success fs-5" value="Crear">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
  

    <script type="text/javascript">
        $(document).ready(function() {
            $("#botonCrear").click(function() {
                $("#formulario")[0].reset();
                $(".modal-title").text("Crear Util");
                $("#action").val("Crear");
                $("#operacion").val("Crear");
                $("#imagen_subida").html("");
            });

            var dataTable = $('#datos_util').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "responsive": true,
                "ajax": {
                    url: "obtener_registros.php",
                    type: "POST"
                },
                "columnsDefs": [{
                    "orderable": false,
                    "targets": [0, 3, 4],
                    //"targets": [0, 1, 2, 3, 4, 5, 6],
                    "order": [[ 1, 'desc' ]],
                    "searchable": false
                }, ],
                "language": {
                    "decimal": "",
                    "emptyTable": "No hay registros",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
            //Aquí código inserción
            $(document).on('submit', '#formulario', function(event) {
                event.preventDefault();
                var articulo = $('#articulo').val();
                var ubicacion = $('#ubicacion').val();
                var extension = $('#imagen_usuario').val().split('.').pop().toLowerCase();
                if (extension != '') {
                    if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        alert("Fomato de imagen inválido");
                        $('#imagen_usuario').val('');
                        return false;
                    }
                }
                if (articulo != '' && ubicacion != '') {
                    $.ajax({
                        url: "crear.php",
                        method: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            alert(data);
                            $('#formulario')[0].reset();
                            $('#modalUsuario').modal('hide');
                            dataTable.ajax.reload();
                        }
                    });
                } else {
                    alert("Algunos campos son obligatorios");
                }
            });

            //Funcionalidad de editar
            $(document).on('click', '.editar', function() {
                var id_usuario = $(this).attr("id");
                $.ajax({
                    url: "obtener_registro.php",
                    method: "POST",
                    data: {
                        id_usuario: id_usuario
                    },
                    dataType: "json",
                    success: function(data) {
                        //console.log(data);				
                        $('#modalUsuario').modal('show');
                        $('#articulo').val(data.articulo);
                        $('#ubicacion').val(data.ubicacion);
                        $('.modal-title').text("Editar Util");
                        $('#id_usuario').val(id_usuario);
                        $('#imagen_subida').html(data.imagen_usuario);
                        $('#action').val("Editar");
                        $('#operacion').val("Editar");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                })
            });

            //Funcionalida de borrar
            $(document).on('click', '.borrar', function() {
                var id_usuario = $(this).attr("id");
                if (confirm("Esta seguro de borrar este registro:" + id_usuario)) {
                    $.ajax({
                        url: "borrar.php",
                        method: "POST",
                        data: {
                            id_usuario: id_usuario
                        },
                        success: function(data) {
                            alert(data);
                            dataTable.ajax.reload();
                        }
                    });
                } else {
                    return false;
                }
            });

        });
    </script>
    
    <script src="./js/lightbox.js"></script>
    <script>
        console.log("%c Sitio desarrollado por: Alberto Garrido ","background: #eee; color: #CB0A0A; font-weight:bold; font-size:16px;")
    </script>
</div>
</div>
</div>
</body>

</html>
