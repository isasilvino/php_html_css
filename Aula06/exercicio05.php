<?php


 echo "Digite 10 números e calcule a media: ";


 for ($i=1; $i <= 3; $i++) { 
     
<<<<<<< HEAD
     $numeros=readline();
=======
     $numeros[]=readline();
>>>>>>> 06cb5dbada5d7a7098de1d705676acbd51d04331
    }

    function media ($numeros){

<<<<<<< HEAD
        return array_sum($numeros) / 2;
=======
        return array_sum($numeros) / count($numeros);
>>>>>>> 06cb5dbada5d7a7098de1d705676acbd51d04331


    }
echo media($numeros);
    ?>