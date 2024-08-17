# Festivos Colombia (Emiliani)

Esta librería PHP proporciona una implementación completa de las festividades en Colombia, basada en la Ley Emiliani. La Ley Emiliani (Ley 51 de 1983) establece que algunas festividades nacionales deben ser trasladadas al siguiente lunes para fomentar el turismo y el descanso de los trabajadores. Esta librería permite calcular de manera precisa los días festivos según la Ley Emiliani para cualquier año dado, verificar si una fecha específica es festiva, y calcular días hábiles entre dos fechas.

## Ejemplo de Uso
### 1. Obtener los festivos para un año específico
Puedes obtener todos los días festivos de un año específico utilizando el método getFestivos.
``` php
<?php

require 'vendor/autoload.php';

use Jeffry\EmilianiFestivosColombia\Emiliani;

$festivos = Emiliani::getFestivos(2024);
print_r($festivos);
```
Salida esperada:
``` php
Array
(
    [0] => 2024-01-01
    [1] => 2024-01-08
    [2] => 2024-03-25
    [3] => 2024-03-28
    [4] => 2024-03-29
    [5] => 2024-05-01
    ...
)
```
### 2. Verificar si una fecha específica es festiva
Puedes verificar si una fecha dada es un día festivo utilizando el método isFestivo.

``` php
<?php

require 'vendor/autoload.php';

use Jeffry\EmilianiFestivosColombia\Emiliani;

$isFestivo = Emiliani::isFestivo('2024-01-01');
echo $isFestivo ? 'Es festivo' : 'No es festivo';
``` 
Salida esperada:

``` php
Es festivo
```

### 3. Calcular los días hábiles entre dos fechas
Puedes calcular los días hábiles (excluyendo fines de semana y festivos) entre dos fechas con el método habiles.

``` php
require 'vendor/autoload.php';

use Jeffry\EmilianiFestivosColombia\Emiliani;

$fechaInicio = '2024-01-01';
$fechaFin = '2024-01-10';

Emiliani::habiles($fechaInicio, $fechaFin);
```

Salida esperada:

``` php
2024-01-02
2024-01-03
2024-01-04
2024-01-05
2024-01-08
2024-01-09
2024-01-10
```

Estos ejemplos muestran cómo utilizar las principales funcionalidades de la librería.
