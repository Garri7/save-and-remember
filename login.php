<?php 
session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
}


$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = filter_var(strtolower($_POST['usuario']));
    $pass = $_POST['pass'];

    //echo "datos" . $usuario ." - " . $pass;
    try {
        //include("conexion.php");
        $conexion = new PDO('mysql:host=localhost;dbname=NAME_DB', 'USER', 'PASS');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $stado = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario AND pass = :pass');
    $stado->execute(array(':usuario' => $usuario, ':pass' => $pass));
    $resultado = $stado->fetch();

    if ($resultado !== false) {
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
       //echo 'Datos correctos';
    } else{
        $error .= '<i class="bi bi-emoji-frown-fill"></i> Datos Incorrectos';
    }
   // var_dump($resultado);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Iniciar Sesión</title>
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

    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            
            <div class="col-auto border border-2 p-3 ">
                <h2 class="text-center text-light">Entrar</h2>
                <hr class="text-light">
                <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="mb-3 text-light">
                        <label for="exampleInputEmail1" class="form-label"><i class="bi bi-person-circle"></i> Usuario</label>
                        <input type="text" class="form-control" name="usuario">
                    </div>
                    <div class="mb-3 text-light">
                        <label for="exampleInputPassword1" class="form-label"><i class="bi bi-key-fill"></i> Contraseña</label>
                        <input type="password" class="form-control" name="pass" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label text-light" for="exampleCheck1">Recordar</label>
                    </div>
                    <button type="submit" class="btn btn-light">Entrar</button>
                    <?php 
                        if (!empty($error)) : ?>
                            <div class="alert-danger p-3 mt-2">
                                    <?php echo $error; ?>
                            </div>
                        
                   <?php endif; ?>
                </form>
                

            </div>

        </div>

    </div>

    <script>
        console.log("%c Sitio desarrollado por: Alberto Garrido ","background: #eee; color: #CB0A0A; font-weight:bold; font-size:16px;")
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>