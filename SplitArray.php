<?php

/**
 * Klasa dzieląca tablicę elementów na X kolumn, 
 * nie rozbijając podgrup elmenetów,
 * zachowując kolejność elementów,
 * uwzględniająca separator między podgrupami w jednej kolumnie
 */
class SplitArray
{

    /**
     * Funkcja grupująca kategorie na X kolumn
     * 
     * @param array $array        Tablica elementów do podzielenia
     * @param int $columns        Liczba kolumn na jaką zoswtanie podzielona tablica
     * @param int $separationSize Rozmiar separatora rozdzielającego grupy
     * @return array              Posortowana tablica elmenetów podzielona na kolumny
     */
    public static function div(array $array, int $columns, int $separationSize): array {

        $arrayPartition = self::arrayPartition($array, $columns);
        $arrayCounts = self::arrayCounts($arrayPartition, $separationSize);

        return self::arraySort($arrayPartition, $separationSize, $arrayCounts);
    }

    /**
     * Podzielenie równomietnie tablicy na X kolumn
     * 
     * @param array $array         Tablica elementów do podzielenia
     * @param int $numberOfColumns Liczba kolumn na jaką zoswtanie podzielona tablica
     * @return array               Wynik w postaci dwuwymiarowej tablicy z podzieloną tablicą
     */
    private static function arrayPartition(array $array, int $numberOfColumns): array {

        $arrayLength = count($array);
        $partLength = floor($arrayLength / $numberOfColumns);
        $partRemainder = $arrayLength % $numberOfColumns;
        $partition = array();
        $mark = 0;
        for ($x = 0; $x < $numberOfColumns; $x++) {
            $increment = ($x < $partRemainder ) ? $partLength + 1 : $partLength;
            $partition[$x] = array_slice($array, $mark, $increment, true);
            $mark += $increment;
        }
        return $partition;
    }

    /**
     * Informacja o ilości elmentów w poszczególnych kolumnach / grupach
     * 
     * @param array $array        Tablica elementów 
     * @param int $separationSize Rozmiar separatora rozdzielającego grupy
     * @return array              Tablica z informacją o ilości elementów w grupach
     */
    private static function arrayCounts(array $array, int $separationSize): array {

        $groups = [];
        $columns = [];

        for ($x = 0; $x < count($array); $x++) {
            $groups[$x] = array_map('count', $array[$x]);
            $columns[$x] = array_sum($groups[$x]) + count($groups[$x]) - $separationSize;
        }

        return ['all' => array_sum($columns), 'columns' => $columns, 'groups' => $groups];
    }

    /**
     * Sortowanie group elementów między kolumnami w celu otrzymania najoptymalniejszego wyniku
     * 
     * @param array $array        Tablica elementów do posortowania
     * @param int $separationSize Rozmiar separatora rozdzielającego grupy
     * @param array $counts       Ilość elementów w podgrupach tablicy
     * @return array              Posortowana tablica elementów
     */
    private static function arraySort(array $array, int $separationSize, array $counts): array {

        for ($i = 0; $i < $counts['all']; $i++) {

            $change = 0;

            for ($x = 0; $x < (count($array) - 1); $x++) {

                $left = $x;
                $right = $x + 1;

                if ($counts['columns'][$left] < $counts['columns'][$right]) {
                    $change = self::moveGroup($array, $counts, $right, $left, reset($counts['groups'][$right]), $separationSize, 'down');
                } else if ($counts['columns'][$left] > $counts['columns'][$right]) {
                    $change = self::moveGroup($array, $counts, $left, $right, end($counts['groups'][$left]), $separationSize, 'up');
                }
            }

            if ($change === false) {
                break;
            }
        }

        return $array;
    }

    /**
     * Funkcja przenosząca grupę między kolumnami
     * 
     * @param array $array           Tablica elementów
     * @param array $counts          Ilość elementów w podgrupach tablicy
     * @param int $from              Klucz kolumny z której prznieś grupę
     * @param int $to                Klucz kolumny do której prznieś grupę
     * @param int $element           Element do przeniesienia
     * @param string $separationSize Rozmiar separatora rozdzielającego grupy
     * @param string $side           up/down - przenieś na początek/koniec tablicy
     * @return bool                  Czy została przeniesiona grupa
     */
    private static function moveGroup(array &$array, array &$counts, int $from, int $to, int $element, string $separationSize, string $side): bool {


        if (($counts['columns'][$to] + $element + $separationSize) <= $counts['columns'][$from]) {
            $key = key($counts['groups'][$from]);

            self::moveElemet($array, $from, $to, $key, $side);
            self::moveElemet($counts['groups'], $from, $to, $key, $side);

            $counts['columns'][$to] += $element + $separationSize;
            $counts['columns'][$from] -= $element + $separationSize;

            return true;
        }

        return false;
    }

    /**
     * Funkcja przenosząca elmenet tablicy z jednej kolumny do drugiej
     * 
     * @param array $array   Tablica elementów
     * @param int $oldColumn Obecna kolumna z elementem
     * @param int $newColumn Nowa kolumna z elementem
     * @param string $key    Klucz tablicy do przeniesienia
     * @param string $side   up/down - przenieś na początek/koniec tablicy
     */
    private static function moveElemet(array &$array, int $oldColumn, int $newColumn, string $key, string $side) {

        if ($side == 'up') {
            $array[$newColumn] = [$key => $array[$oldColumn][$key]] + $array[$newColumn];
        } else if ($side == 'down') {
            $array[$newColumn] = $array[$newColumn] + [$key => $array[$oldColumn][$key]];
        }

        unset($array[$oldColumn][$key]);
    }

}
