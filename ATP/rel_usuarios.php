<?php
    include('verifica_login.php');
    // Conectando ao banco de dados: 
    include_once("conexao.php");
    // Criando tabela e cabeçalho de dados:
    include("includes/topo.php");


?>
        <header>
            <div id="logo"><img src="img/logob.png"></div><h2>Usuários</h2>
        </header>
          
        <section>
            <nav>
                 <?php
                  include("includes/menu.php");
                ?> 
            </nav>
            <article>
                <a href="cadUsuarios.php"><button class="buttonCad" style="vertical-align:middle"><span>Cadastrar Novo</span></button></a></br></br>
                <table border=1>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Celular</th>
                        <th>Data Nascimento</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>...</th>
                        <th>x</th>            
                        
                    </tr>

                    <?php
                        $sql = "SELECT * FROM usuarios";
                        $resultado = mysqli_query($conexao,$sql) or die("Erro ao retornar dados");
                        // Obtendo os dados por meio de um loop while
                        while ($registro = mysqli_fetch_array($resultado))
                        {
                         
                            $id = $registro['id'];
                            $nome = $registro['nome'];
                            $cpf = $registro['cpf'];
                            $fone = $registro['fone'];
                            $celular = $registro['celular'];
                            $datanasc = implode("/",array_reverse(explode("-",$registro['datanasc'])));
                            $cidade = $registro['cidade'];
                            $uf = $registro['uf'];

                            echo "<tr>";
                            echo "<td>".$nome."</td>";
                            echo "<td>".$cpf."</td>";
                            echo "<td>".$fone."</td>";
                            echo "<td>".$celular."</td>";
                            echo "<td style='text-align:center'>".$datanasc."</td>";
                            echo "<td>".$cidade."</td>";
                            echo "<td>".$uf."</td>";
                            echo "<td>
                                    <a href='cadusuarios.php?id=".$id."'><button class='buttonEdit' style='vertical-align:middle'><span>Editar</span></button></a>
                                </td>";
                            echo "<td><a href='del_usuarios.php?id=".$id."' onclick=\"return confirm('Deseja realmente excluir este usuário?');\"><button class='buttonDel' style='vertical-align:middle'><span>Excluir</span></button></a></td>";
                            echo "</tr>";
                        }
                        mysqli_close($conexao);
                    ?>
                </table>
            </article>
        </section>
          
        <footer>
            <p>Todos os direitos reservados.</p>
        </footer>
    </body>
 </html>





