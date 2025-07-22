<?php 

	@session_start();
	if(!isset($_SESSION['logado'])){
		header("Location: login.html");
		exit();
	}


    require_once 'back/conn.php';

    $conn = new DB();
    $pdo = $conn->pdo();

    
    $query = $pdo->prepare("SELECT * FROM `raspadinha` WHERE user_id='".$_SESSION['logado']."' AND status = '1' ORDER BY id DESC LIMIT 20");
    $historico = array();

    if($query->execute()){
       $row = $query->fetchAll(PDO::FETCH_OBJ);
        if(count($row)>0){
            $historico = $row;
        }
    }


    $query = $pdo->prepare("SELECT * FROM `user` WHERE id = :id");
    $query->bindValue(':id', $_SESSION['logado']);

    if($query->execute()){

       $row = $query->fetchAll(PDO::FETCH_OBJ);

        if(count($row)>0){
            $user = $row[0];
        }else{
            session_destroy();
            header("Location: login.html");
	    	exit();
        }
    }else{
        session_destroy();
        header("Location: login.html");
        exit();
    }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="css/style-buy.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="notify/notify.js"></script>
    <title>Minha conta</title>
    <style>
        li{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container  pt-3">
        <div style="margin-top:50px;" class="row pt-3" >

            <div class="col-md-6">
                <h1 class="text-white" >Meu saldo: <span style="background: #198754;border-radius: 20px;padding: 5px;" >R$ <?= $user->balance; ?></span></h1>
            </div>
            <div class="col-md-6 text-rigth">
                <button class="btn btn-outline-primary" onclick="location.href='buy.php';" > <i class="fa fa-home"></i> Inicio</button>
                <button class="btn btn-outline-success" onclick="location.href='buy.php?deposit';" > <i class="fa-solid fa-money-bill-transfer"></i> Depositar</button>
                <button class="btn btn-outline-danger" onclick="location.href='back/sair.php';" ><i class="fa fa-power-off"></i>  Sair</button>
            </div>

               <div class="col-md-12 mt-5">
                 <h5 class="text-white" >Meu histórico</h5>
               </div>
               
            
                <div class="col-md-12">
                    <div class="row">

                    <div class="card">
                        <div class="card-body">
                            
                            <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Raspadinha</th>
                                        <th scope="col">Custo</th>
                                        <th scope="col">Ganhei</th>
                                        <th scope="col">Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($historico)> 0){ foreach($historico as $k => $b){
                                        
                                        $query = $pdo->prepare("SELECT * FROM `pacotes` WHERE id = :package LIMIT 1");
                                        $query->bindValue(':package', $b->package);
                                        $package = false;
                                    
                                        if($query->execute()){
                                    
                                        $row = $query->fetchAll(PDO::FETCH_OBJ);
                                            if(count($row)>0){
                                                $package = $row[0];
                                            }
                                        }        
                                        
                                    ?>
                                        <tr>
                                            <th scope="row">#<?= $b->id; ?></th>
                                            <td><?php if($package){ ?> <b class="text-danger" >- R$ <?= $package->valor; ?></b> <?php }else{ echo '*******'; } ?></td>
                                            <td> <b class="text-success">+ R$ <?= $conn->convertMoney(2, $b->reward); ?></b> </td>
                                            <td><?= date('d/m/Y H:i', strtotime($b->created)); ?></td>
                                        </tr>
                                        <?php } } ?>

                                    </tbody>
                                </table>

                        </div>
                    </div>

                    </div>  
                </div>


        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 

</html>