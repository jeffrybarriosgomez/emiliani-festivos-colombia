<?php

namespace Jeffry\EmilianiFestivosColombia;

class Emiliani
{
    private static array $festivos = [
        ['date' => '01-01', 'isMonday' => false, 'description' => 'Año Nuevo'],
        ['date' => '01-06', 'isMonday' => true, 'description' => 'Día de los Reyes Magos'],
        ['date' => '03-19', 'isMonday' => true, 'description' => 'Día de San José'],
        ['oDate' => -3, 'isMonday' => false, 'description' => 'Jueves Santo'],
        ['oDate' => -2, 'isMonday' => false, 'description' => 'Viernes Santo'],
        ['date' => '05-01', 'isMonday' => false, 'description' => 'Día del Trabajador'],
        ['oDate' => 40, 'isMonday' => true, 'description' => 'Ascensión del Señor'],
        ['oDate' => 60, 'isMonday' => true, 'description' => 'Corpus Christi'],
        ['oDate' => 71, 'isMonday' => true, 'description' => 'Sagrado Corazón de Jesús'],
        ['date' => '06-29', 'isMonday' => true, 'description' => 'San Pedro y San Pablo'],
        ['date' => '07-20', 'isMonday' => false, 'description' => 'Día de la Independencia'],
        ['date' => '08-07', 'isMonday' => false, 'description' => 'Batalla de Boyacá'],
        ['date' => '08-15', 'isMonday' => true, 'description' => 'La Asunción de la Virgen'],
        ['date' => '10-12', 'isMonday' => true, 'description' => 'Día de la Raza'],
        ['date' => '11-01', 'isMonday' => true, 'description' => 'Todos los Santos'],
        ['date' => '11-11', 'isMonday' => true, 'description' => 'Independencia de Cartagena'],
        ['date' => '12-08', 'isMonday' => false, 'description' => 'Día de la Inmaculada Concepción'],
        ['date' => '12-25', 'isMonday' => false, 'description' => 'Día de Navidad'],
    ];

    public static function getFestivos(int $year): array
    {
        $festivosData = [];
        $pascua = self::getPascua($year);

        foreach (self::$festivos as $festivo) {
            $date = $festivo['date'] ?? null;
            $oDate = $festivo['oDate'] ?? null;

            if ($date) {
                $date = self::formatDate("$year-$date");
            } elseif ($oDate !== null) {
                $date = self::sumDays($pascua, $oDate);
            }

            if ($festivo['isMonday']) {
                $date = self::nextMonday($date);
            }

            $festivosData[] = $date;
        }

        return $festivosData;
    }

    public static function isFestivo(string $date): bool
    {
        $formattedDate = self::formatDate($date);
        $year = (int)date('Y', strtotime($formattedDate));
        return in_array($formattedDate, self::getFestivos($year), true);
    }

    public static function habiles(string $fechaIni, string $fechaFin, array $festivos = [], array $descanso = [6, 0]): void
    {
        $inicio = strtotime($fechaIni);
        $fin = strtotime($fechaFin);
        $incremento = 86400; // 24 * 60 * 60

        for ($dia = $inicio; $dia <= $fin; $dia += $incremento) {
            if (!in_array(date('w', $dia), $descanso)) {
                echo "\n" . date('Y-m-d', $dia);
            }
        }
    }

    private static function formatDate(string $date): string
    {
        return date('Y-m-d', strtotime($date));
    }

    private static function sumDays(string $date, int $days): string
    {
        return date('Y-m-d', strtotime("$date $days days"));
    }

    private static function nextMonday(string $date): string
    {
        while (date('w', strtotime($date)) != 1) {
            $date = date('Y-m-d', strtotime("$date +1 day"));
        }
        return $date;
    }

    private static function getPascua(int $year): string
    {
        $a = $year % 19;
        $b = $year % 4;
        $c = $year % 7;
        $d = (19 * $a + 24) % 30;
        $e = (2 * $b + 4 * $c + 6 * $d + 5) % 7;
        $day = 22 + $d + $e;

        return $day <= 31 
            ? date("Y-m-d", strtotime("$year-03-" . self::formatTwoNumber($day))) 
            : date("Y-m-d", strtotime("$year-04-" . self::formatTwoNumber($day - 31)));
    }

    private static function formatTwoNumber(int $num): string
    {
        return str_pad((string)$num, 2, '0', STR_PAD_LEFT);
    }
}