<?php 
    require 'vendor/autoload.php';

    use Jeffry\EmilianiFestivosColombia\Emiliani;

    $festivos = Emiliani::getFestivos(2024);
    //$isFestivo = Emiliani::isFestivo('2024-01-01');
    //$habiles = Emiliani::habiles('2022-12-04', '2022-12-10');
print_r($festivos);
    