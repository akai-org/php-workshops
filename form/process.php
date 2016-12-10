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


if (empty($_POST['email'])) {
  echo '<p>Wpisz swój adres email!</p>';
} else {
  $email = $_POST['email'];

  /*
  strpos podaje, na której pozycji w ciągu, licząc od zera, znajduje się podciąg.
  Jeśli go nie znajdzie, zwróci false.
  Żeby wychwycić taką sytuację, musimy zrobić porównanie z uwzględnieniem typu
  (potrójnym znakiem równości). Inaczej warunek byłby spełniony, gdyby znak @
  pojawił się na początku ciągu (na zerowej pozycji).
  */

  if (strpos($email, '@') === false) {
    echo '<p>Adres email nie zawiera znaku @</p>';
  } else {
    echo '<p>Adres email zawiera znak @</p>';
  }

  /*
  filter_var umożliwia przepuszczanie danych przez różne filtry.
  Jeśli filtr coś odrzuci, funkcja zwraca false.
  */
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<p>Adres email jest poprawny.</p>';
  } else {
    echo '<p>Adres email jest nieprawidłowy!</p>';
  }
}
