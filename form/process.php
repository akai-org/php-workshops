<?php
echo '<pre>';
/*
<pre> to znacznik HTMLowy, który sprawia, że przeglądarka przestaje
ignorować białe znaki. Dzięki temu output funkcji print_r będzie czytelniejszy. */

/*
$_POST to superglobalna (dostępna w kaźdym miejscu skryptu) tablica
zawierające dane przesłane do skryptu metodą POST. Dane można też przekazać
metodą GET, czyli jako parametry w pasku adresu przeglądarki.
Funkcja print_r wypisuje całą strukturę tablicy.
*/
print_r($_POST);

echo '</pre>';

