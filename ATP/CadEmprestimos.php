<?php
    include('includes/verifica_login.php');
    include_once('includes/conexao.php'); 

    $item = "";
    $data_emp = Date("Y-m-d");
    $usuario = "";
    $obs = "";
    $data_previsao = Date("Y-m-d");;
  
    if (isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "SELECT * FROM emprestimos WHERE id = $id";
        $res = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($res);

        $item = $row['item_id'];
        $data_emp = $row['data_emprestimo'];
        $obs = $row['obs'];
        $usuario = $row['usuario_id'];
        $data_previsao = $row['data_previsao'];

    }

    if (isset($_POST['Salvar']) == 'Salvar'){    
    
        $item = $_POST['item_id'];
        $data_emp = $_POST['data_emprestimo'];
        $usuario = $_POST['usuario_id'];
        $obs = $_POST['obs'];

        $data_previsao = $_POST['data_previsao'];

        if (empty($id)){
          $sql = "insert into emprestimos (";
          $sql .= "item_id, data_emprestimo, usuario_id, obs, data_previsao, devolvido) values ";
          $sql .= "('$item', '$data_emp', '$usuario', '$obs', '$data_previsao', 0)";
        }else{
          $sql = "Update emprestimos set item_id = '$item', data_emprestimo = '$data_emp', usuario_id='$usuario', obs = '$obs',  data_previsao='$data_previsao'
          Where id = '$id'";
           
        }


  	    mysqli_query($conexao, $sql) or die('Erro ao tentar efetuar o empréstimo');
        mysqli_close($conexao);


        if (isset($_GET['id'])){
          echo "<script>
              alert('Empréstimo alterado com sucesso!');
              </script>";
        }else{
            echo "<script>
                 alert('Empréstimo realizado com sucesso!');
              </script>";
        }
        header( "refresh:0;url=rel_emprestimos.php" );
        
    }
    include("includes/topo.php");
?>

<header>
  <div id="logo"><img src="img/logob.png"></div><h2>Cadastro de Empréstimos</h2>
</header>
          
<section>
  <nav style="height: 710px">
    <?php
      include("includes/menu.php");
    ?> 
  </nav>         
  <article>
    <form action="" method="post">

      Item: <select id="item" name="item_id">
            <option>Selecione</option>
              <?php
                $sql = "Select * from itens";
                $resultado = mysqli_query($conexao, $sql);
                while ($row_resultado = mysqli_fetch_assoc($resultado)){  ?>
                  <option value="<?php echo $row_resultado['id'];?>"<?php if ($row_resultado['id']==$item){echo "selected";}?>><?php echo $row_resultado['descricao'];
              ?>
            </option>
            <?php
            }?>
            </select><br/><br/>

      Data do Empréstimo: <input type="date" name="data_emprestimo" value="<?php echo $data_emp;?>" required/><br/><br/>
                        
      Quem está emprestando: <select name="usuario_id">
                  <option>Selecione</option>
                    <?php
                      $sql = "Select * from usuarios";
                      $resultado = mysqli_query($conexao, $sql);
                      while ($row_resultado = mysqli_fetch_assoc($resultado)){  ?>
                        <option value="<?php echo $row_resultado['id'];?>"<?php if ($row_resultado['id']==$usuario){echo "selected";}?>><?php echo $row_resultado['nome'];?>
                  </option><?php
                  }?>
                  </select>  
      Observação:  <textarea class="obs" name="obs"><?php echo $obs;?></textarea><br/><br/>
      Previsão de Devolução: <input type="date" name="data_previsao" value="<?php echo $data_previsao;?>"/><br/><br/>
        
          <input type="submit" name="Salvar" value="Salvar"/>
    </form>
  </article>
</section>
<?php
    include("includes/rodape.php");
?>