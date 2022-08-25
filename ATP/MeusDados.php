<?php
    include('includes/verifica_login.php');
    include_once('includes/conexao.php'); 

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM USUARIOS WHERE id = $id";
    $res = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($res);

    $nome = $row['nome'];
    $cpf = $row['cpf'];
    $fone = $row['fone'];
    $celular = $row['celular'];
    $iswhats = $row['iswhats'];
    if ($iswhats==1){
        $iswhats = "checked";
    }else
        $iswhats = "null";

    $datanasc = $row['datanasc'];
    $genero = $row['genero'];
    $endereco = $row['endereco'];
    $bairro = $row['bairro'];
    $cidade = $row['cidade'];
    $uf = $row['uf'];
    $cep = $row['cep'];
    $email = $row['email'];
    $senha = $row['senha'];
    $senhamd5 = $senha;
    $adm = $row['adm'];    

    if ($adm==1){
        $adm = 'checked="checked"';
    }else
        $adm = "";


    if (isset($_POST['Salvar']) == 'Salvar'){    
    
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $fone = $_POST['fone'];
        $celular = $_POST['celular'];
      
        if(array_key_exists('iswhats', $_POST)){
            $iswhats = 1;
        } else {
            $iswhats = 0;
        }
      
        $datanasc = $_POST['datanasc'];
        $genero = $_POST['genero'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $cep = $_POST['cep'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if ($senha != $senhamd5){
            $senha = md5($_POST['senha']);
        }

        if(array_key_exists('adm', $_POST)){
            $adm = 1;
        } else {
            $adm = 0;
        }

            
        $sql = "Update usuarios set nome = '$nome', cpf = '$cpf', fone='$fone', celular='$celular', 
                iswhats='$iswhats', datanasc='$datanasc', genero='$genero', endereco='$endereco', 
                bairro='$bairro', cidade='$cidade', uf='$uf', cep='$cep', email='$email', senha='$senha', adm='$adm'
                Where id = '$id'";
                  
        mysqli_query($conexao, $sql) or die('Erro ao tentar cadastrar o usuário');
        mysqli_close($conexao);
      
        echo "<script>
                alert('Usuário alterado com sucesso!');
            </script>";
    
    }        
    include("includes/topo.php");
       
      
?>

        <header>
            <div id="logo"><img src="img/logob.png"></div><h2>Meus Dados</h2>
          </header>
          
          <section>
            <nav style="height: 1410px">
                <?php
                   include("includes/menu.php");
                ?> 
            </nav>
            
            <article>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/><br/><br/>
                    Nome Completo: <input type="text" name="nome" value="<?php echo $nome;?>"required/><br/><br/>
                    CPF:  <input type="text" name="cpf" value="<?php echo $cpf;?>"/>
                    Telefone:  <input type="text" name="fone" value="<?php echo $fone;?>"/><br/><br/>
                    Celular:  <input type="text" name="celular"  value="<?php echo $celular;?>" /><br/>
                    É Whatsapp?: <input type="checkbox" name="iswhats" value="on"<?php echo $iswhats;?>/><br/><br/><br/>
                    Data Nascimento: <input type="date" name="datanasc" value="<?php echo $datanasc;?>"/><br/><br/>
                    Genero: <select name="genero">
                        <option value="M"<?php if ($genero == 'M'){echo "selected";}?>>Masculino</option>
                        <option value="F"<?php if ($genero == 'F'){echo "selected";}?>>Feminino</option>
                    </select><br/><br/>
                    Endereço: <input type="text" name="endereco" value="<?php echo $endereco;?>"/><br/><br/>
                    Bairro: <input type="text" name="bairro" value="<?php echo $bairro;?>"/><br/><br/>
                    Cidade: <input type="text" name="cidade" value="<?php echo $cidade;?>"/><br/><br/>
                    UF: <input type="text" name="uf" value="<?php echo $uf;?>"/><br/><br/>
                    CEP: <input type="text" name="cep" value="<?php echo $cep;?>"/><br/><br/>
        
                    <h3>Dados para Login:</h3>
                    E-Mail: <input type="email" name="email" placeholder="Informe o e-mail" value="<?php echo $email;?>"required/><br/><br/>
                    Senha: <input type="password" name="senha" placeholder="Informe a senha" value="<?php echo $senha;?>"required/><br/><br/>

                    <?php if($_SESSION['adm'] == 1)
                    {echo 'Administrador: <input type="checkbox" '.$adm.' name="adm" /><br/><br/>';
                    }else
                    {echo 'Administrador: <input type="checkbox" disabled="disabled" name="adm"/><br/><br/>';}?>

        
                    <input type="submit" name="Salvar" value="Salvar"/>
                </form>
          </article>
          </section>
<?php
    include("includes/rodape.php");
?>