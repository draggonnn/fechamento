<?php 

	@session_start();
	if(!isset($_SESSION['logado'])){
		header("Location: login.html");
		exit();
	}


	if(!isset($_GET['token'])){
		header("Location: buy.php");
		exit();
	}

	$token = $_GET['token'];

    require_once 'back/conn.php';

    $conn = new DB();
    $pdo = $conn->pdo();

    $raspadinha = false;

    $query = $pdo->prepare("SELECT * FROM `raspadinha` WHERE token = :token AND status= :status ");
	$query->bindValue(':token', $token);
	$query->bindValue(':status', 0);

    if($query->execute()){

       $row = $query->fetchAll(PDO::FETCH_OBJ);

        if(count($row)>0){
            $raspadinha = $row[0];
        }
    }

	if(!$raspadinha){
		header("Location: buy.php");
		exit();
	}


    $query = $pdo->prepare("SELECT * FROM `pacotes` WHERE id = :package LIMIT 1");
    $query->bindValue(':package', $raspadinha->package);
    $package = false;

    if($query->execute()){

        $row = $query->fetchAll(PDO::FETCH_OBJ);
        if(count($row)>0){
            $package = $row[0];
        }
    }    

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
    <script src="notify/notify.js"></script>
	<title>Raspar</title>
</head>
<body>
<div class="scratch-card">
  <h2>Raspadinha</h2>
  <h3>Ganhe até <?php if($package){ echo 'R$ '.$conn->convertMoney(2, $package->max); }else{ echo '********'; } ?></h3>
  <p>Raspe na parte cinza</p>
  <input type="hidden" id="confetti" value="0">
  <input type="hidden" id="token" value="<?= $token; ?>" >
  <div id="scratch-container" class="scratch-container">
    <canvas class="scratch-canvas" id="scratch-canvas" width="300" height="60"></canvas>
    <p id="code" class="code">
	R$ <?= $conn->convertMoney(2, $raspadinha->reward); ?>   
    </p>
  </div>
  <p style="font-weight: 100;padding: 0;margin: 6px;display:none;" id="ganhou" >Você ganhou seu prêmio</p>
  <button style="cursor:pointer;" type="button" onclick="location.href='buy.php';" >Voltar</button>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.1/dist/confetti.browser.min.js"></script>
  <script src="js/js.js"></script> 
</div>
</body>
</html>