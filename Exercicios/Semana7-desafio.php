<?php

function periodo($dataInicial, $dataFinal){
    $dataInicio = new DateTime($dataInicial);
    $dataFim = new DateTime($dataFinal);

    while ($dataInicio <= $dataFim) {

       echo $dataInicio->format("d/m/Y") . "<br />";

       $dataInicio->add(new DateInterval('P1D'));

    
}
}
    
    
periodo("2017-12-01", "2017-12-10");

?>