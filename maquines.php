<?php
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}
$ipXUbuntu = "";
$ipUbuntu = "";
?>

<link rel="stylesheet" href="./css/bootstrap.css">
<link rel="stylesheet" href="./css/estils.css">
<link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css" />

<!-- jQuery library -->
<script src="./js/jquery.min.js"></script>
<script src="./js/jquery-ui.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="./js/bootstrap.min.js"></script>

<!DOCTYPE html>
  <head>
    <title>Gestor de màquines</title>
    <meta charset="UTF-8">
  </head>
  <body>
    <div class="content">
      <div class="row">
        <div class="col-xs-6">
          <h1>Benvingut <?php echo $_SESSION['username'];?>!</h1>
        </div>
        <div class="col-xs-6">
          <a href="logout.php" class="btn btn-danger" style="float: right">Surt</a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 columna">
          <div class="row card">
            <div class="col-xs-12">
              <img src="./img/xubuntu.png" style="margin-bottom: 5px; height: 52;"/>
              <br />
              <br />
              <span id="nom" style="display:none">XUbuntu</span>
              <ul>
                <li>
                  <span id="versio">Versió: 12.04.5 LTS</span>
                </li>
                <li>
                  <span id="ram">Memòria RAM: </span>
                  <select id="ramSelector1" class="RAMselector">
                    <option value="1024">1GB</option>
                    <option value="2048">2GB</option>
                  </select>
                </li>
                <li>
                  <span id="disc">Memòria disc: 10GB</span>
                </li>
                <li>
                  <span id="cpu">#CPUs: 1</span>
                </li>
              </ul>
              <br />
              <?php
                require_once 'config.php';
                $username = $_SESSION['username'];
                $query = "SELECT * FROM Maquines WHERE ownerUsername = '$username' AND nom = 'XUbuntu'";
                if ($result = $link->query($query)) {
                  /* fetch associative array */
                  while ($row = $result->fetch_assoc()) {
                    // printf ("%s (%s)\n", $row["nom"], $row["ownerUsername"]);
                    if($row["estat"] == 1){
                      ?>
                      <button id="button" name="desplegar" type="button" class="btn btn-primary">Desplegar</button>
                      <button id="deleteButton" name="eliminar" type="button" class="btn btn-danger" style="display:none;"><i class="fa fa-trash" style="font-size:20px" aria-hidden="true"></i></button>

                      <script>
                        $("#ramSelector1").attr('disabled', false);
                      </script>
                      <?php
                    }
                    else{
                      if($row["estat"] == 2){
                        ?>
                        <button id="button" name="iniciar" type="button" class="btn btn-success"><i class="fa fa-play" style="font-size:20px" aria-hidden="true"></i></button>
                        <button id="deleteButton" name="eliminar" type="button" class="btn btn-danger"><i class="fa fa-trash" style="font-size:20px" aria-hidden="true"></i></button>
                        <?php
                      }else if($row["estat"] == 3){
                        ?>
                        <button id="button" name="parar" type="button" class="btn btn-warning"><i class="fa fa-stop" style="font-size:20px" aria-hidden="true"></i></button>
                        <button id="deleteButton" name="eliminar" type="button" class="btn btn-danger" style="display:none;"><i class="fa fa-trash" style="font-size:20px" aria-hidden="true"></i></button>
                        <br />
                        <?php
                        $ipXUbuntu = $row["ip"];
                      }
                      ?>
                      <script>
                        $("#ramSelector1").attr('disabled', true);
                      </script>
                      <?php
                    }
                  }
                }
              ?>

            </div>
            <div class="col-xs-12">
              <span class="ip">
                <?php
                  echo $ipXUbuntu;
                ?>
              </span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 columna">
          <div class="row card">
            <div class="col-xs-12">
              <img src="./img/ubuntu.png" style="margin-bottom: 5px; height: 33;"/>
              <br />
              <br />
              <br />
              <span id="nom" style="display:none">Ubuntu</span>
              <ul>
                <li>
                  <span id="versio">Versió: 16.04 LTS</span>
                </li>
                <li>
                  <span id="ram">Memòria RAM: </span>
                  <select id="ramSelector2" class="RAMselector">
                    <option value="1024">1GB</option>
                    <option value="2048">2GB</option>
                  </select>
                </li>
                <li>
                  <span id="disc">Memòria disc: 10GB</span>
                </li>
                <li>
                  <span id="cpu">#CPUs: 1</span>
                </li>
              </ul>
              <br />
              <?php
                require_once 'config.php';
                $username = $_SESSION['username'];
                $query = "SELECT * FROM Maquines WHERE ownerUsername = '$username' AND nom = 'Ubuntu'";
                if ($result = $link->query($query)) {
                  /* fetch associative array */
                  while ($row = $result->fetch_assoc()) {
                    // printf ("%s (%s)\n", $row["nom"], $row["ownerUsername"]);
                    if($row["estat"] == 1){
                      ?>
                      <button id="button" name="desplegar" type="button" class="btn btn-primary">Desplegar</button>
                      <button id="deleteButton" name="eliminar" type="button" class="btn btn-danger" style="display:none;"><i class="fa fa-trash" style="font-size:20px" aria-hidden="true"></i></button>

                      <script>
                        $("#ramSelector2").attr('disabled', false);
                      </script>
                      <?php
                    }
                    else{
                      if($row["estat"] == 2){
                        ?>
                        <button id="button" name="iniciar" type="button" class="btn btn-success"><i class="fa fa-play" style="font-size:20px" aria-hidden="true"></i></button>
                        <button id="deleteButton" name="eliminar" type="button" class="btn btn-danger"><i class="fa fa-trash" style="font-size:20px" aria-hidden="true"></i></button>
                        <?php
                      }else if($row["estat"] == 3){
                        ?>
                        <button id="button" name="parar" type="button" class="btn btn-warning"><i class="fa fa-stop" style="font-size:20px" aria-hidden="true"></i></button>
                        <button id="deleteButton" name="eliminar" type="button" class="btn btn-danger" style="display:none;"><i class="fa fa-trash" style="font-size:20px" aria-hidden="true"></i></button>
                        <br />
                        <?php
                        $ipUbuntu = $row["ip"];
                      }
                      ?>
                      <script>
                      <?php
                        if($row["ram"] == "1024"){
                          ?>
                          $("#ramSelector2").val("1024");
                          <?php
                        }
                        else{
                          ?>
                          $("#ramSelector2").val("2048");
                          <?php
                        }
                        ?>
                        $("#ramSelector2").attr('disabled', true);
                      </script>
                      <?php
                    }
                  }
                }
              ?>

            </div>
            <div class="col-xs-12">
              <span class="ip">
                <?php
                  echo $ipUbuntu;
                ?>
              </span>
            </div>
          </div>
        </div>
        <div class="col-lg-4 columna">
        </div>
      </div>
    </div>
  </body>
</html>

<script>
  $(document).ready(function() {
    $(".btn").on('click', function(){
      spinner(this, true);
      $(this).addClass('disabled');
      var that = this;
      $.ajax({
        type: 'POST',
        url: 'script.php',
        data:{
          maquina: $(that).parent().find("#nom").text(),
          memoria: $(that).parent().find(".RAMselector").val(),
          accio: $(that).attr('name'),
          usuari: "<?php echo $_SESSION['username'];?>"
        },
        success: function(data) {
          console.log(data);
          $(that).parent().parent().find(".ip").text(data)
          // $("test").text(data);
          spinner(that, false);
          $(that).removeClass('disabled');

          //Desplegar
          if($(that).hasClass("btn-primary")){
            $(that).removeClass('btn-primary');
            $(that).addClass('btn-success');
            $(that).html('<i class="fa fa-play" style="font-size:20px" aria-hidden="true"></i>');
            $(that).attr('name', "iniciar");
            $(that).parent().find("#deleteButton").show();
            $(that).parent().find(".RAMselector").attr('disabled', true);

          }//Iniciar
          else if ($(that).hasClass("btn-success")) {
            $(that).removeClass('btn-success');
            $(that).addClass('btn-warning');
            $(that).html('<i class="fa fa-stop" style="font-size:20px" aria-hidden="true"></i>');
            $(that).attr('name', "parar");
            $(that).parent().find("#deleteButton").hide();
          }//Parar
          else if ($(that).hasClass("btn-warning")) {
            $(that).removeClass('btn-warning');
            $(that).addClass('btn-success');
            $(that).html('<i class="fa fa-play" style="font-size:20px" aria-hidden="true"></i>');
            $(that).attr('name', "iniciar");
            $(that).parent().find("#deleteButton").show();
          }//Eliminar
          else if ($(that).hasClass("btn-danger")) {
            $(that).parent().find(".btn").first().removeClass('btn-success');
            $(that).parent().find(".btn").first().removeClass('btn-warning');
            $(that).parent().find(".btn").first().addClass('btn-primary');
            $(that).parent().find(".btn").first().text('Desplegar');
            $(that).parent().find(".btn").first().attr('name', "desplegar");
            $(that).parent().find(".RAMselector").attr('disabled', false);
            $(that).hide();
          }
        }
      })
    });
  });

  function spinner(that, show){
    if(show){
      $(that).append('&nbsp;&nbsp;<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
    }
    else{
      $(".fa-spinner").remove();
    }
  }
</script>
