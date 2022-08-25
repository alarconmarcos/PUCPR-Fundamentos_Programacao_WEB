<?php
    include('includes/verifica_login.php');
    include_once('includes/conexao.php'); 

    if (isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "SELECT * FROM emprestimos WHERE id = $id";
        $res = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($res);

        $obs = $row['obs'];
       
        $data_dev = Date("Y-m-d");

    }

    if (isset($_POST['Salvar']) == 'Salvar'){    
    
        $obs = $_POST['obs'];
        $data_dev= $_POST['data_devolucao'];


        $sql = "Update emprestimos set obs = '$obs', data_devolucao='$data_dev', devolvido=1
                Where id = '$id'";

  	    mysqli_query($conexao, $sql) or die('Erro ao tentar devolver o item');
        mysqli_close($conexao);

        echo "<script>
            alert('Item devolvido com sucesso!');
            </script>";
            header( "refresh:0;url=rel_emprestimos.php" );
    }    

    include("includes/topo.php");

?>


        <header>
          <div id="logo"><img src="img/logob.png"></div><h2>Devolução</h2>
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
                      <label for="data_devolucao">Data da Devolução</label>
                      <input type="date" id="data_devolucao" name="data_devolucao" value="<?php echo $data_dev;?>" required><br/><br/>
                  
               
                      <label for="obs">Observação</label>
                      <textarea class="obs" id="obs" name="obs"><?php echo $obs;?></textarea>  
                    
                      <input type="submit" name="Salvar" value="Devolver"/>
                    </form>
  
            </article>
          </section>
          
          <?php
    include("includes/rodape.php");
?>