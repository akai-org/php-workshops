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


if (empty($_POST['sex'])) {
  echo '<p>Wybierz płeć!</p>';
} else {
  $sex = $_POST['sex'];

  if ($sex == 'male') {
    echo '<p>Dzień dobry panu!</p>';
  } else if ($sex == 'female') {
    echo '<p>Dzień dobry pani!</p>';
  } else {
    /*
    Poprawność pól trzeba sprawdzać nawet wtedy, gdy formularz umożliwia wybranie
    wartości spośród podanych (pola typu radio, checkbox, select).
    Bardzo łatwo jest podmienić rodzaj pola w przeglądarce i wysłać złośliwe dane.
    */
    echo '<p>Pole płeć ma niedozwoloną wartość!</p>';
  }
}


if (empty($_POST['birth_year'])) {
  echo '<p>Podaj swój rok urodzenia!</p>';
} else {
  $birth_year = $_POST['birth_year'];

  // intval zamienia ciąg znaków na wartość całkowitoliczbową, a jeśli się to nie uda, zwraca 0.
  $birth_year_num = intval($birth_year);

  if (!$birth_year_num) {
    echo '<p>Rok urodzenia musi być liczbą</p>';
  } else {
    /*
    date zwraca aktualną datę zapisaną według podanego formatu.
    Y to symbol roku czterocyfrowego.
    Zwracana wartość jest typu string, więc dobrze jest ją zamienić na liczbę,
    jeśli chcemy wykonywać na niej obliczenia (chociaż zadziałałoby to i bez tego).
    */
    $year = intval(date('Y'));
    $age = $year - $birth_year_num;
    echo "<p>Obliczony wiek: $age.</p>";
  }
}


if (empty($_POST['password']) || empty($_POST['password2'])) {
  echo '<p>Wpisz hasło do obu pól</p>';
} else {
  $password = $_POST['password'];
  $password2 = $_POST['password2'];

  if ($password == $password2) {
    echo '<p>Hasła są zgodne.</p>';

    // strlen podaje długość napisu
    if (strlen($password) < 8) {
      echo '<p>Hasło jest za krótkie!</p>';
    }
  } else {
    echo '<p>Hasła nie pasują!</p>';
  }
}

/*
is_array sprawdza, czy podana wartość jest tablicą.
Zaznaczone pola typu checkbox przekazywane są do skryptu właśnie w postaci tablicy.
Trzeba tylko pamiętać, żeby nazwa pola miała na końcu parę nawiasów kwadratowych - [].
*/
if (is_array($_POST['interests'])) {
  $interests = $_POST['interests'];
  $messages = [
    'Na pewno spodoba Ci się ta płyta.',
    'Co ostatnio przeczytałeś?',
    'Nie przegap jutrzejszego meczu!',
    'Jaki polecasz przepis na makaron?',
    'Ile pali Twoje auto?',
    'Co sądzisz o nowym MacBooku Pro?',
    'Znalazłem tanie loty do Norwegii.'
  ];

  foreach ($interests as $chosen) {
    // isset sprawdza, czy zmienna jest ustawiona
    if (isset($messages[$chosen])) {
      echo "<p>{$messages[$chosen]}</p>";
    }
  }
} else {
  echo '<p>Nie wybrano żadnych zainteresowań.</p>';
}
