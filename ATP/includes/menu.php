<?php
  $arquivo = $_SERVER['PHP_SELF'];
  
?>
    <ul id="menu">
        <li><a href="rel_emprestimos.php" <?php if ($arquivo == '/atp/rel_emprestimos.php') {echo "class='active'";}?>>Empréstimos</a></li>
        <?php
            if($_SESSION['adm'] == 1){?>
                <li><a href="rel_usuarios.php" <?php if ($arquivo == '/atp/rel_usuarios.php') {echo "class='active'";}?>>Usuários</a></li>
            <?php
            }
        ?>
        
        <li><a href="rel_itens.php" <?php if ($arquivo == "/atp/rel_itens.php") {echo "class='active'";}?>>Itens</a></li>
        <li><a href="MeusDados.php" <?php if ($arquivo == "/atp/MeusDados.php") {echo "class='active'";}?>>Meus Dados</a></li>
        <li><a class="sair" href="logout.php">Sair</a></li>
    </ul>
  
