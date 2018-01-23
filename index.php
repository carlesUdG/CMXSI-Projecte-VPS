<link rel="stylesheet" href="./css/bootstrap.css">
<link rel="stylesheet" href="./css/estils.css">
<link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css" />

<script src="./js/jquery.min.js"></script>
<script src="./js/jquery-ui.min.js"></script>
<script src="./js/bootstrap.min.js"></script>

<html>
  <head>
    <title>Gestor de màquines</title>
    <meta charset="UTF-8">
  </head>
  <body style="background-color: aliceblue;">
    <div class="content">
      <div class="row" style="display: table; margin: 0 auto;">
        <div class="title">
          <span style="font-size: 30px;">Identificació</span>
        </div>
        <div class="box">
          <span style="float:left; margin-bottom: 5px">Entra el teu usuari i contrasenya</span>
          <br />
          <form action="" method="post" class="login">
            <input id="username" name="username" type="text" style="margin-bottom: 20px; width: 100%; padding-left: 5px" placeholder="Usuari"/>
            <br />
            <input id="password" name="password" type="password" style="margin-bottom: 20px; width: 100%; padding-left: 5px" placeholder="Contrasenya"/>
            <br />
            <input name="login" type="submit" class="btn btn-primary" style="height: 40px; width: 100%" value="Entar">
          </form>
          <?php
            require_once 'config.php';

            $username = $password = "";
            $username_err = $password_err = "";

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(empty(trim($_POST["username"]))){
                    $username_err = "Has d'entrar un usuari.";
                } else{
                    $username = trim($_POST["username"]);
                }
                if(empty(trim($_POST['password']))){
                    $password_err = "Has d'entrar una contrasenya.";
                } else{
                    $password = trim($_POST['password']);
                }

                // Validem credencials
                if(empty($username_err) && empty($password_err)){
                    // Preparem la consulta
                    $sql = "SELECT username, password FROM users WHERE username = ?";

                    if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_store_result($stmt);
                            if(mysqli_stmt_num_rows($stmt) == 1){
                                mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                                if(mysqli_stmt_fetch($stmt)){
                                    if(password_verify($password, $hashed_password)){
                                        session_start();
                                        $_SESSION['username'] = $username;

                                        //Creem un directori a l'usuari per les seves màquines
                                        shell_exec('echo mkdir ../users/' . $username . ' > ./scripts/exec.txt');
                                        sleep(2);
                                        shell_exec("'' > ./scripts/exec.txt");
                                        header("location: maquines.php");
                                    }
                                }
                            }
                            echo "Login invalid";

                        } else{
                            echo "Error, torna a provar més tard";
                        }
                    }
                    mysqli_stmt_close($stmt);
                }
                mysqli_close($link);
            }
            ?>
        </div>
      </div>
    </div>
  </body>
</html>
