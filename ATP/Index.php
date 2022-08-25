<?php
  session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PUC Lends - Login</title>
        <meta charset="utf-8"/>
        <link href="css/estilo.css" rel="stylesheet" />
    </head>

    <body id="login">
        <div id="login" class="login-page">
            <div id=login class="form">
              <form class="login-form" action="login.php" method="POST">

                <input type="email" name="email" placeholder="E-Mail" required autofocus/>
                <input type="password" name="senha" placeholder="Senha" required/>
                <input type="submit" name="Entrar" Value="Entrar " style=background-color:#76b852>

              </form>
              <?php
                    if(isset($_SESSION['nao_autenticado'])):
                    ?>
                    <div>
                      <p id="erro" class="form">ERRO: Usuário ou senha inválidos!</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
              ?> 
            </div>
          </div>
    </body>
</html>

