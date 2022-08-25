<?php
    include('includes/verifica_login.php');
    // Conectando ao banco de dados: 
    include_once("includes/conexao.php");
    // Criando tabela e cabeçalho de dados:
    include("includes/topo.php");

?>
 
        <header>
            <div id="logo"><img src="img/logob.png"></div><h2>Itens</h2>
        </header>
          
        <section>
            <nav>
                <?php
                  include("includes/menu.php");
                ?> 
            </nav>
            <article>
                <a href="cadItens.php"><button class="buttonCad" style="vertical-align:middle"><span>Cadastrar Novo</span></button></a></br></br>
                <table border=1>
                    <tr>
                        <th>Descrição do Item</th>
                        <th>Observação</th>
                        <th>Dono do Item</th>
                        <th>Imagem do Item</th>
                        <th>...</th>
                        <th>x</th>            
                    </tr>

                    <?php
                        $sql = "SELECT * FROM itens";
                        $resultado = mysqli_query($conexao,$sql) or die("Erro ao retornar dados");
                        // Obtendo os dados por meio de um loop while
                        while ($registro = mysqli_fetch_assoc($resultado)) 
                        {
                            $id = $registro['id'];
                            $desc = $registro['descricao'];
                            $obs = $registro['obs'];
                            $dono = $registro['usuario_id'];
                            $imagem = $registro['imagem'];

                            $resdono = mysqli_query($conexao,"select nome from usuarios where id=".$dono) or die("Erro ao retornar dados");
                            while ($regdono = mysqli_fetch_assoc($resdono))
                            {
                                $nomedono = $regdono['nome'];
                            }

                            echo "<tr>";
                            echo "<td>".$desc."</td>";
                            echo "<td>".$obs."</td>";
                            echo "<td>".$nomedono."</td>";
                            echo "<td style='text-align: center'><img src='img/".$imagem."' style='width:100px; height: 100px' /></td>";                            
                            echo "<td>
                                    <a href='caditens.php?id=".$id."'><button class='buttonEdit' style='vertical-align:middle'><span>Editar</span></button></a>
                                </td>";
                            echo "<td>
                                    <a href='del_itens.php?id=".$id."' onclick=\"return confirm('Deseja realmente excluir este item?');\"><button class='buttonDel' style='vertical-align:middle'><span>Excluir</span></button></a>
                                </td>";
                            echo "</tr>";
                            echo "</tr>";
                        }
                        mysqli_close($conexao);
                    ?>
                </table>
            </article>
        </section>
          
<?php
    include("includes/rodape.php");
?>