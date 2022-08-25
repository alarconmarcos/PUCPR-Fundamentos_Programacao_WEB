<?php
    include('includes/verifica_login.php');
    include('includes/conexao.php'); 

    if (isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE from emprestimos where id = $id";

        $res = mysqli_query($conexao, $sql);


        echo "<script>
            alert('Empréstimo excluído com sucesso!');
        </script>";
        header( "refresh:0;url=rel_emprestimos.php" );
   

    }

 

?>