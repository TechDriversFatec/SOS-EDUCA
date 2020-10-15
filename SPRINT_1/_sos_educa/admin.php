<div id="sair">
  <?php 
    session_start();
    if(!isset($_SESSION["login"]) && !isset($_SESSION["senha"])){
      header("location:login_area_restrita.php");
      exit;          
    }else{
      echo "<center><h2 class='alert-success'>Bem Vindo ".($_SESSION['nome_func'])."</h2></center><br><br>";
    }
    ?>
</div>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <?php include('cabecalho.php');?>
    <title>Admin</title>
    <link href="css/estilo_form2.css" rel="stylesheet">

    <script src="js/jquery/jquery-ui.js"></script>
    <link href="js/jquery/jquery-ui.css" rel="stylesheet">
    <script>
      $(function() {
        $( "#tabs" ).tabs();
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
          $('.dica + span')
          .css({display:'none',
                border: '1px solid #336600',
                padding:'2px 4px',
                background:'#999966',
                marginLeft:'10px'   });
          $('.dica').focus(function() {
            $(this).next().fadeIn(1500);    	 	
          })
          .blur(function(){
            $(this).next().fadeOut(1500);
          });
      });
    </script>

    <!-- <script>
    //Aplica o padrão da animação e velocidade para exibição do efeito
      $.fx.speeds._default =1000;
      $($function() {
        $("#dialog" ).dialog({
              autoOpen: false,
              show: "blind",
              hide: "explode"
        });
        $( "#opener" ).click(function() {
                $( "#dialog" ).dialog( "open" );
                return false;
        });
      });
    </script> --> 
    
    <?php include('conexao.php');
      $conexao=mysqli_connect("localhost", "root", "","sos_educa") or die(mysql_error()); 
    ?>
  </head>
  <body>
    <?php include('navbar.php');?>
      <section class="newsletter container bg-black">
            <h2 class="alert-info">Cadastro de Produtos da Loja</h2>
        <form action="cadastrar_produtos.php" class="form-group" method="post" enctype="multipart/form-data" name="upload_insere">
        
          <div class="col-md-12">
            <label class="col-md-12">Selecione o arquivo conteúdo para Upload</label>
              <div class="input-group col-md-6">
                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-paperclip"> </span></span>
                <input type="file" name="arquivo" class="form-control" aria-describedby="sizing-addon2">
              </div>
          </div>

          <div class="col-md-12">
            <label class="col-md-12">Selecione a imagem para Upload</label>
              <div class="input-group col-md-6">
                <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-paperclip"> </span></span>
                <input type="file" name="imagem" class="form-control" aria-describedby="sizing-addon2">
              </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">
              <h4>Selecione a Categoria do Produto</h4>
            </div>
          </div>

          <div class="col-md-12">
            <div class="col-md-6">
                <select name="sel_cat" class="form-control">
                    <?php
                        $resultado=mysqli_query($conexao,"SELECT * FROM categorias");
                      while($linha=mysqli_fetch_assoc($resultado)){
                    ?>
                    <option value="<?php echo $linha['id_cat']; ?>">
                      <?php echo ($linha['nome_cat']);?>
                    </option>
                      <?php }?>
                </select> 
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">
              <input class="input-group form-control" type="text" name="nome_prod" placeholder="nome">
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">
              <input class="input-group form-control" type="text" name="preco" placeholder="preço">
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">
                <textarea name="desc" class="form-control" placeholder="descrição"></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">
                <button class="btn btn-info "> Cadastrar </button>
            </div>
          </div>
        </form>
      </section>
    <div id="tabs-2" class="text-center">
      <h1 class="alert-warning">Controlador de produtos</h1>
      <table class="table table-striped table-bordered table-condensed table-hover" >
          <thead>
            <tr>
              <th>Nome</th>
              <th>Alterar</th> 
              <th>Excluir</th>
            </tr>
          </thead>
      <?php
        $resultado=mysqli_query($conexao,  "SELECT * FROM produtos");
          if($resultado){
            while($row = mysqli_fetch_assoc($resultado)){
      ?>
                <tbody>
                    <tr>
                      <td>
                        <?php echo "<p></p>".($row['nome_prod']);?>
                      </td>
                      <td>
                        <a href="alterar.php?id=<?php echo $row['id_produtos'];?>"><span class="glyphicon glyphicon-pencil"></span></a>
                      </td>
                      <td>
                        <a href="excluir.php?id=<?php echo $row['id_produtos'];?>"><p><span class="glyphicon glyphicon-trash"></span></p></a>
                      </td>
                    </tr>
                </tbody>
        <?php
            }//fim do while
          }//fim do if
            mysqli_close($conexao);//fecha conexão
        ?>
      </table>
    </div>
      <div id="dialog" title="Janela de Dialogo">
        <p align="center">
          <button id="opener" class="bg-white radius""> <a href="logout_area_restrita.php">Sair</a></button>
        </p>
      </div>
      <br>
    <footer class="container-fluid text-center">
      <p>Online Store Copyright</p>  
    </footer>
  </body>
</html>