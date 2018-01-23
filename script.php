<?php
  session_start();
  require_once 'config.php';
  $username = $_SESSION['username'];
  $nomMaquina = $_POST['maquina'];
  $memoria = $_POST['memoria'];
  // echo shell_exec('ls ../../../home/carles/');
  if($_POST['accio'] == "desplegar"){
    shell_exec("echo ./getClone.sh " . $nomMaquina . " " . $username . " " . $memoria . " > ./scripts/exec.txt");
    //Canvi estat BBDD
    $query = "UPDATE Maquines SET estat = '2', ram = '$memoria' WHERE ownerUsername = '$username' AND nom = '$nomMaquina'";
    if ($result = $link->query($query)) {
      echo "Màquina desplegada";
    }
    else{
      echo "Error BD";
    }
  }
  else if($_POST['accio'] == "iniciar"){
    shell_exec("echo ./startVM.sh " . $_POST['maquina'] . " " . $_POST['usuari'] . " > ./scripts/exec.txt");
    sleep(2);
    shell_exec("'' > ./scripts/exec.txt");

    $query = "SELECT ip FROM Maquines WHERE ownerUsername = '$username' AND nom = '$nomMaquina'";

    while (shell_exec("ls -l IPs | grep " . $_POST['maquina'] . "_" . $_POST['usuari'] . ".txt") == "") {
      shell_exec("echo ./getIP.sh " . $_POST['maquina'] . " " . $_POST['usuari'] . " > ./scripts/exec.txt");
    }

    // echo shell_exec("cat IPs/" . $_POST['maquina'] . "_" . $_POST['usuari'] . ".txt");

    $ipMaquina = shell_exec("cat IPs/" . $_POST['maquina'] . "_" . $_POST['usuari'] . ".txt");

    //Canvi estat BBDD

    $query = "UPDATE Maquines SET estat = '3' WHERE ownerUsername = '$username' AND nom = '$nomMaquina'";
    if ($result = $link->query($query)) {
      $query = "UPDATE Maquines SET ip = '$ipMaquina' WHERE ownerUsername = '$username' AND nom = '$nomMaquina'";
      if ($result = $link->query($query)) {
          echo $ipMaquina;
      }
      else{
        echo "Error BD";
      }
    }
    else{
      echo "Error BD";
    }
  }
  else if($_POST['accio'] == "parar"){
    echo "Màquina parada";
    shell_exec("echo ./stopVM.sh " . $_POST['maquina'] . " " . $_POST['usuari'] . " > ./scripts/exec.txt");
    //Canvi estat BBDD
    $query = "UPDATE Maquines SET estat = '2' WHERE ownerUsername = '$username' AND nom = '$nomMaquina'";
    if ($result = $link->query($query)) {
      // echo "Màquina desplegada->parada";
      $query = "UPDATE Maquines SET ip = '' WHERE ownerUsername = '$username' AND nom = '$nomMaquina'";
      if ($result = $link->query($query)) {
          echo $ipMaquina;
      }
      else{
        echo "Error BD";
      }
    }
    else{
      echo "Error BD";
    }
  }
  else if($_POST['accio'] == "eliminar"){
    // echo "Màquina eliminada";
    shell_exec("echo ./removeVM.sh " . $_POST['maquina'] . " " . $_POST['usuari'] . " > ./scripts/exec.txt");
    //Canvi estat BBDD
    $query = "UPDATE Maquines SET estat = '1' WHERE ownerUsername = '$username' AND nom = '$nomMaquina'";
    if ($result = $link->query($query)) {
      // echo "Màquina no desplegada";
    }
    else{
      echo "Error BD";
    }
  }
  sleep(2);
  shell_exec("'' > ./scripts/exec.txt");
 ?>
