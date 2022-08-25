<?php


//$nome_completo = $_POST['nome_completo'];
//$ano_nascimento = $_POST['ano_nascimento'];

$nome_completo = "Marcos Alarcon";
$ano_nascimento = 1978;
$anoatual = date("Y");
$idade = $anoatual - $ano_nascimento;

echo ($nome_completo."<br><br>");

if ($idade > 18) {
    echo "O $nome_completo tem $idade anos de idade - Ele é maior de idade";
}else{
    echo "O $nome_completo tem $idade anos de idade - Ele é menor de idade";

}

//o valor da variável dentro de uma função permanece------------------------------------------

function teste() {
  static $v = 10; 
  $v++; 
  echo $v . "<br>";
} 

echo ("<br>");
echo ("<br>");

teste(); 
teste(); 
teste();

//o valor da variavel de fora não muda, envia uma copia------------------------------------
echo ("<br>");
echo ("<br>");

function quadrado($valor) {
    $val_orig = $valor; 
    $valor *= $val_orig; 
    echo "Quadrado de $val_orig é: " . $valor;
} 
$valor = 12; 
quadrado($valor); 
echo "<br>$valor";

//já assim o valor da variavel de fora  muda, envia uma copia------------------------------------
echo ("<br>");
echo ("<br>");


function quadrado2(& $valor) {
    $val_orig = $valor; 
    $valor *= $val_orig; 
    echo "Quadrado de $val_orig é: " . $valor;
} 

$valor = 12; 
echo "Valor original: $valor <br>"; 
quadrado2($valor); 
echo "<br>Valor atual: $valor";
    

?>
