<?php
    include('includes/verifica_login.php');
    include_once("includes/conexao.php");
    include("includes/topo.php");

?>
 
        <header>
            <div id="logo"><img src="img/logob.png"></div><h2>Empréstimos</h2>
        </header>
          
        <section>
            <nav>
               <?php
                    include("includes/menu.php");
                ?> 
            </nav>
            <article>
                <a href="cademprestimos.php"><button class="buttonCad" style="vertical-align:middle"><span>Cadastrar Novo</span></button></a>
                <table>
                    <tr>
                        <td style="background-color:#ff9999; width:20px; border: 1px solid #000000"></td>
                        <td style="padding-right: 20px">Data de previsão de devolução ultrapassada</td></br>
                       <td style="background-color:#fdff94; width:20px; border: 1px solid #000000"></td>
                        <td>Sem data prevista de devolução</td></br>

                    </tr>
                </table>              
                </br>
                <table border=1>
                    <tr>
                        <th>Item</th>
                        <th>Data do Empréstimo</th>
                        <th>Quem emprestou</th>
                        <th>Observação</th>
                        <th>Previsão de Devolução</th>
                        <th>...</th>
                        <th>x</th>            
                        <th>?</th>   
                        <th>+</th>   
                    </tr>

                    <?php
                        $sql = "SELECT * FROM emprestimos where devolvido = 0";
                        $resultado = mysqli_query($conexao,$sql) or die("Erro ao retornar dados");
                        // Obtendo os dados por meio de um loop while
                        while ($registro = mysqli_fetch_assoc($resultado))
                        {
                            $id = $registro['id'];
                            $item = $registro['item_id'];
                            $res_item = mysqli_query($conexao,"select descricao from itens where id=".$item) or die("Erro ao retornar dados");
                           
                            while ($reg_item = mysqli_fetch_assoc($res_item))
                            {
                                $desc_item = $reg_item['descricao'];
                            }
                            
                            $data_emp = implode("/",array_reverse(explode("-",$registro['data_emprestimo'])));
                            $data_previsao = implode("/",array_reverse(explode("-",$registro['data_previsao'])));

                            $usuario = $registro['usuario_id'];
                            $res_usuario = mysqli_query($conexao,"select nome from usuarios where id=".$usuario) or die("Erro ao retornar dados");
                            while ($reg_usuario = mysqli_fetch_assoc($res_usuario))
                            {
                                $nome_usuario = $reg_usuario['nome'];
                            }


                            $obs = $registro['obs'];
                            $devolvido = $registro['devolvido'];
                            $data_dev = implode("/",array_reverse(explode("-",$registro['data_devolucao'])));

                           $hoje = Date("d/m/Y"); 
                            
                            if($data_previsao < $hoje){
                                $corlinha = "#ff9999";
                            }else{
                                $corlinha = "#ffffff";
                            }

                            if($data_previsao == null){
                                $corlinha = "#fdff94";}

                            echo "<tr>";
                            echo "<td bgcolor=$corlinha>".$desc_item."</td>";
                            echo "<td style='text-align:center' bgcolor=$corlinha>".$data_emp."</td>";
                            echo "<td bgcolor=$corlinha>".$nome_usuario."</td>";
                            echo "<td bgcolor=$corlinha>".$obs."</td>";
                            echo "<td style='text-align:center' bgcolor=$corlinha>".$data_previsao."</td>";
                            echo "<td bgcolor=$corlinha>
                                    <a href='cademprestimos.php?id=".$id."'><button class='buttonEdit' style='vertical-align:middle'><span>Editar</span></button></a>
                                </td>";
                            echo "<td bgcolor=$corlinha>
                                    <a href='del_emprestimos.php?id=".$id."' onclick=\"return confirm('Deseja realmente excluir este empréstimo?');\"><button class='buttonDel' style='vertical-align:middle'><span>Excluir</span></button></a>
                                </td>";
                            echo "<td bgcolor=$corlinha>
                                <a href='cadUsuarios.php?id=".$usuario."'><button class='buttonCt' style='vertical-align:middle'><span>Contato</span></button></a>
                            </td>";
                            echo "<td bgcolor=$corlinha>
                                <a href='cadDevolucao.php?id=".$id."'><button class='buttonDev' style='vertical-align:middle'><span>Devolver</span></button></a>
                            </td>";
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