<?php
    include('includes/verifica_login.php');
    include_once('includes/conexao.php'); 

    $descricao = "";
    $obs = "";
    $dono = "";
    $imagem = "";

    if (isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "SELECT * FROM itens WHERE id = $id";
        $res = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($res);

        $descricao = $row['descricao'];
        $obs = $row['obs'];
        $dono = $row['usuario_id'];
        $imagem = $row  ['imagem'];

    }

    if (isset($_POST['Salvar']) == 'Salvar'){    
    
        $descricao = $_POST['descricao'];
        $obs = $_POST['obs'];
        $dono = $_POST['dono'];
        $imagem = $_POST['imagem'];


        if (empty($id)){
          $sql = "insert into itens (";
          $sql .= "descricao, obs, usuario_id, imagem) values ";
          $sql .= "('$descricao', '$obs', '$dono', '$imagem')";
        }else{
          $sql = "Update itens set descricao = '$descricao', obs = '$obs' , usuario_id='$dono', imagem='$imagem'
          Where id = '$id'";
          
        }
    

  	  mysqli_query($conexao, $sql) or die('Erro ao tentar cadastrar o item');
      mysqli_close($conexao);

      if (isset($_POST['Salvar']) == 'Salvar'){    
          echo "<script>
              alert('Item cadastrado com sucesso!');
          </script>";
        }else{
            echo "<script>
               alert('Item alterado com sucesso!');
            </script>";
        }
        header( "refresh:0;url=rel_itens.php" );
    }    

    include("includes/topo.php");

?>


        <header>
          <div id="logo"><img src="img/logob.png"></div><h2>Cadastro de Itens</h2>
          </header>
          
          <section>
            <nav style="height: 495px">
              <?php
                include("includes/menu.php");
              ?> 
            </nav>
            
            <article>
                    <form action="" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/><br/><br/>
                      <label for="descricao">Descrição</label>
                      <input type="text" id="descricao" name="descricao" value="<?php echo $descricao;?>" placeholder="Descrição.." required><br/><br/>
                  
                      <label for="foto">Imagem</label><br/>
                      <input type="file" id="imagem" name="imagem" value="<?php echo $imagem;?>" accept="image/*"><br/><br/>

                  
                      <label for="obs">Observação</label>
                      <textarea class="obs" id="obs" name="obs"><?php echo $obs;?>
                      </textarea>  
                      <label for="dono">Dono do Item</label>
                      <select id="dono" name="dono">
                        <?php
                          $sql = "Select * from usuarios";
                          $resultado = mysqli_query($conexao, $sql);

                          while ($row_resultado = mysqli_fetch_assoc($resultado))
                          { ?>
                            <option value="<?php echo $row_resultado['id'];?>"<?php if ($row_resultado['id']==$dono){echo "selected";}?>><?php echo $row_resultado['nome'];?></option><?php
                          }
                             
                        ?>
                      </select>
                    
                      <input type="submit" name="Salvar" value="Salvar"/>
                    </form>
  
            </article>
          </section>
          
          <?php
    include("includes/rodape.php");
?>