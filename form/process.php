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

// funkcja empty zwraca prawdę, jeśli zmienna jest pusta albo w ogóle nieustawiona
if (empty($_POST['name'])) {
  echo '<p>Wpisz swoje imię i nazwisko!</p>';
} else {
  $name = $_POST['name'];

  // funkcja explode dzieli tekst wystąpieniami separatora i zwraca tablicę
  $words = explode(' ', $name);

  // count podaje liczbę elementów w tablicy
  if (count($words) == 2) {
    echo "<p>Imię: {$words[0]}<br>Nazwisko: {$words[1]}</p>";
  }
}
