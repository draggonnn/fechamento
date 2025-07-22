<?php 

	@session_start();
	if(!isset($_SESSION['logado'])){
		header("Location: login.html");
		exit();
	}


    require_once 'back/conn.php';

    $conn = new DB();
    $pdo = $conn->pdo();

    
    $query = $pdo->prepare("SELECT * FROM `pacotes` ORDER BY id ASC");
    $bilhetes = array();

    if($query->execute()){

       $row = $query->fetchAll(PDO::FETCH_OBJ);

        if(count($row)>0){
            $bilhetes = $row;
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

    $query = $pdo->prepare("SELECT * FROM `raspadinha` WHERE user_id = :user_id AND status= :status ORDER BY id ASC");
    $query->bindValue(':user_id', $_SESSION['logado']);
    $query->bindValue(':status', 0);
    $raspadinhas = array();

    if($query->execute()){

       $row = $query->fetchAll(PDO::FETCH_OBJ);

        if(count($row)>0){
            $raspadinhas = $row;
        }
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
                <button class="btn btn-outline-info" onclick="location.href='history.php';" > <i class="fa fa-clock"></i> Histórico</button>
                <button class="btn btn-outline-success" onclick="$('#modalDeposit').modal('show');" > <i class="fa-solid fa-money-bill-transfer"></i> Depositar</button>
                <button class="btn btn-outline-danger" onclick="location.href='back/sair.php';" ><i class="fa fa-power-off"></i>  Sair</button>
            </div>

               <div class="col-md-12 mt-5">
                 <h5 class="text-white" >Comprar raspadinha:</h5>
               </div>
               
            
                <div class="col-md-12">
                    <div class="row">
                            <?php if(count($bilhetes)> 0){ foreach($bilhetes as $k => $b){ ?>


                              <div class="ticketContainer">
                                    <div class="ticket">
                                        <div class="ticketTitle"><?= $b->nome; ?></div>
                                        <hr>
                                        <div class="ticketDetail">
                                        <div>Minimo:&ensp; R$ <?= $conn->convertMoney(2, $b->min); ?></div>
                                        <div>Máximo:&nbsp; R$ <?= $conn->convertMoney(2, $b->max); ?></div>
                                        <div>Custo:&emsp; R$  <?= $b->valor; ?></div>
                                        </div>
                                        <div class="ticketRip">
                                        <div class="circleLeft"></div>
                                        <div class="ripLine"></div>
                                        <div class="circleRight"></div>
                                        </div>
                                        <div class="ticketSubDetail">
                                        <div class="code">Compre agora: </div>
                                        <div class="date">
                                           <button onclick="buyB('<?= $b->id; ?>');" class="btn btn-sm btn-success" >R$ <?= $b->valor; ?></button>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="ticketShadow"></div>
                             </div>

                            <?php } } ?>
                    </div>  
                </div>

                <hr>

                <div class="col-md-12">
                <h5 class="text-white" >Minhas Raspadinhas:</h5>
               </div>
               
                <div class="col-md-12">
                    <div class="row">

                  
                            <?php if(count($raspadinhas)> 0){ foreach($raspadinhas as $k => $r){
                                
                                $query = $pdo->prepare("SELECT * FROM `pacotes` WHERE id = :package LIMIT 1");
                                $query->bindValue(':package', $r->package);
                                $package = false;
                            
                                if($query->execute()){
                            
                                   $row = $query->fetchAll(PDO::FETCH_OBJ);
                                    if(count($row)>0){
                                        $package = $row[0];
                                    }
                                }    
                                
                            ?>                            
                            
                            
                                <div style="cursor:pointer;" onclick="location.href='raspar.php?token=<?= $r->token; ?>'; " class="ticketContainer">
                                    <div style="background: #e2ff00;" class="ticket">
                                        <div class="ticketTitle">Raspadinha #<?= $r->id; ?></div>
                                        <hr>
                                        <div class="ticketDetail">
                                        <div>Compra:&ensp; <?= date('d/m/Y H:i', strtotime($r->created)); ?></div>
                                        <div>Ganhe: &ensp; <?= $package->nome; ?></div>
                                        </div>
                                        <div class="ticketRip">
                                        <div class="circleLeft"></div>
                                        <div class="ripLine"></div>
                                        <div class="circleRight"></div>
                                        </div>
                                        <div class="ticketSubDetail">
                                        <div class="code">Raspe e ganhe</div>
                                        <div class="date">
                                           <button class="btn btn-sm btn-success" >Raspar</button>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="ticketShadow"></div>
                             </div>

                            
                             <?php } } ?>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</body>


    <!-- Modal -->
    <div class="modal fade" id="modalDeposit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Digite quando deseja depositar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="number" min="10" class="form-control" placeholder="0,00" id="vl_deposit">
                    </div>
                </div>
                <div class="col-md-12">
                <nav aria-label="Page navigation example">
                <ul class="pagination mt-3">
                    <li onclick="$('#vl_deposit').val(10);" class="page-item" style="cursor:pointer;margin-right: 5px;padding: 6px;border-radius: 10px;border: 1px solid #100246;">R$ 10,00</li>
                    <li onclick="$('#vl_deposit').val(20);" class="page-item" style="cursor:pointer;margin-right: 5px;padding: 6px;border-radius: 10px;border: 1px solid #100246;" >R$ 20,00</li>
                    <li onclick="$('#vl_deposit').val(50);" class="page-item" style="cursor:pointer;margin-right: 5px;padding: 6px;border-radius: 10px;border: 1px solid #100246;" >R$ 50,00</li>
                    <li onclick="$('#vl_deposit').val(100);" class="page-item" style="cursor:pointer;margin-right: 5px;padding: 6px;border-radius: 10px;border: 1px solid #100246;" >R$ 100,00</li>
                    <li onclick="$('#vl_deposit').val(200);" class="page-item" style="cursor:pointer;margin-right: 5px;padding: 6px;border-radius: 10px;border: 1px solid #100246;" >R$ 200,00</li>
                </ul>
                </nav>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button onclick="initDeposit();$('#modalDeposit').modal('toggle');$('#modalPix').modal('show');" type="button" class="btn btn-success" data-dismiss="modal">Continuar</button>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPix" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pagamento com pix</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <img id="load" src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921" alt="">

          <div class="row" id="dix-pix" style="display:none;" >
            <div class="col-md-12">
              <img src="" id="img-pix" width="60%" alt="">
            </div>
            <div class="col-md-12">
              <textarea name="code-pix" class="form-control" id="code-pix" rows="3" cols="80"></textarea>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button onclick="$('#modalPix').modal('toggle');" type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>

<script>

    
    function getStatus(reference){
       var intervalS = setInterval(function(){
         $.post('back/status.php', {reference}, function(data){
           var obj = JSON.parse(data);
           if(obj.status == "approved"){
             $("#img-pix").attr('src', 'https://i.pinimg.com/originals/32/b6/f2/32b6f2aeeb2d21c5a29382721cdc67f7.gif');
             $("#code-pix").hide();
             clearInterval(intervalS);
             setTimeout(function(){
               location.href="";
             }, 3000);
           }
         });
       }, 2000);
     }

    function initDeposit(){
        let vl = $("#vl_deposit").val();
        $.post('back/deposit.php', {vl}, function(res){
            var obj = JSON.parse(res);
            if(obj.erro){
                alert(obj.message);
                return false;
            }else{
                var base64    = obj.datapix.transaction_data.qr_code_base64;
                var codePix   = obj.datapix.transaction_data.qr_code;
                var reference = obj.reference;

                getStatus(reference);

                $("#load").hide();
                $("#img-pix").attr('src', 'data:image/jpeg;base64,'+base64);
                $("#code-pix").val(codePix);
                $("#dix-pix").show();
            }
        });
    }

    function buyB(id){
        $.post('back/buyB.php', {id}, function(res){
            var obj = JSON.parse(res);
            if(obj.erro){
                alert(obj.message);
                return false;
            }else{
                location.href="raspar.php?token="+obj.token;
            }
        });
    }
</script>
</html>