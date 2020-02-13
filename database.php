<?php
//plik połączenia z bazą, wszędzie tam gdzie będziemy potrzebowali łączyć się z bazą wytarczy zaimportować ten plik
$config = require_once 'config.php'; //zaimportowanie pliku config.php z tablicą do zmiennej (tablicy) $config

try
{
    $db = new PDO("mysql:host={$config['host']};dbname={$config['database']};charset=utf8", $config['user'], $config['password'], [
        PDO::ATTR_EMULATE_PREPARES => false, // wyłączenie elumowania 'prepare statements' - zapytanie i faktyczne dane zostają wysyłane oddzielnie, zwieksza odpornosć na wstrzykiwanie SQL, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //w razie błędow PDO zwraca wyjątek, i zatrzymuje skrypt
    ]); //nowy obiekt $db klasy PDO, 1 parametr - (mysql(silnik bazy):host=nawa_hosta;dbname=nawa_bazy;charset=kodowanie znakow), 2 prametr - uzytkownik, 3 parametr - hasło użytkownika, 4 parametr (opcjonalny) - tablica z dodatkowymy parametrami połączenia
}
catch (PDOException $error) //'łapanie' wyjątku PDOExxception i zapisanie go do zmiennej $error
{
    echo $error->getMessage();
    exit('Database error');
}