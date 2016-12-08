<?php
$evil = !empty($_GET['evil']);
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <title>Formularz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <h1>Rejestracja</h1>
      <?php if ($evil): ?>
        <div class="alert alert-warning">
          <h4>Witaj w trybie złośliwym!</h4>
          <p>Formularz poniżej zawiera te same pola co poprzedni,
          ale możesz do nich wpisać <strong>całkowicie dowolne wartości</strong>
          i przekonać się, czy skrypt obsłuży je poprawnie.</p>
          <p>Aby wrócić do zwyczajnego formularza, <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="alert-link">kliknij tutaj</a>.</p>
        </div>
      <?php endif; ?>
      <form action="/form/process.php" method="post">
        <div class="form-group">
          <label for="name">Imię i nazwisko:</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Adres email:</label>
          <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label>Płeć:</label>
          <?php if ($evil): ?>
          <input type="text" name="sex" id="sex" class="form-control">
          <?php else: ?>
          <div class="radio">
            <label><input type="radio" name="sex" value="male" id="male"> mężczyzna</label>
          </div>
          <div class="radio">
            <label><input type="radio" name="sex" value="female" id="female"> kobieta</label>
          </div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="birth_year">Rok urodzenia:</label>
          <?php if ($evil): ?>
            <input type="text" id="birth_year" name="birth_year" class="form-control">
          <?php else: ?>
            <select class="form-control" id="birth_year" name="birth_year"></select>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="password">Hasło:</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
          <label for="password2">Powtórz hasło:</label>
          <input type="password" name="password2" id="password2" class="form-control">
        </div>
        <div class="form-group">
          <label>Zainteresowania:</label>
          <?php if ($evil): ?>
          <input type="text" name="interests[]" class="form-control interests">
          <p>
            <button type="button" class="btn btn-default" id="add">Dodaj pole</button>
            <button type="button" class="btn btn-default" id="remove">Usuń pole</button>
          </p>
          <?php else: ?>
          <div class="checkbox">
            <label><input type="checkbox" name="interests[]" value="0"> Muzyka</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="interests[]" value="1"> Książki</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="interests[]" value="2"> Sport</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="interests[]" value="3"> Gotowanie</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="interests[]" value="4"> Samochody</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="interests[]" value="5"> Technologia</label>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="interests[]" value="6"> Podróże</label>
          </div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="notes">Uwagi:</label>
          <textarea name="notes" id="notes" class="form-control"></textarea>
        </div>

        <p>
          <button type="submit" class="btn btn-primary">Wyślij</button>
          <button type="button" id="random" class="btn btn-default">Wypełnij losowo</button>
        </p>
      </form>
    </div>

    <script>
// pisane na szybko - to nie jest wzorcowy kod JavaScriptowy :)
function id(a) { return document.getElementById(a) };
var birth_year = id('birth_year');
var y = (new Date).getFullYear();
if (birth_year.tagName == 'SELECT') {
  var z = y-80;
  for (var i=y; i>z; i--) {
    var opt = document.createElement('option');
    opt.innerHTML = i;
    opt.value = i;
    birth_year.appendChild(opt);
  }
}

var add = id('add');
if (add) add.addEventListener('click', function() {
  var field = '<input type="text" name="interests[]" class="form-control interests">';
  this.parentNode.insertAdjacentHTML('beforebegin', field);
  document.querySelector('.interests:last-of-type').focus();
});

var remove = id('remove');
if (remove) remove.addEventListener('click', function() {
  var field = document.querySelector('.interests:last-of-type');
  if (field) field.remove();
});

var names_m = ["Piotr", "Krzysztof", "Andrzej", "Jan", "Stanisław", "Tomasz", "Paweł", "Marcin", "Michał", "Marek", "Grzegorz", "Józef", "Łukasz", "Adam", "Zbigniew"];
var names_f = ["Anna", "Maria", "Katarzyna", "Małgorzata", "Agnieszka", "Barbara", "Krystyna", "Ewa", "Elżbieta", "Zofia", "Teresa", "Magdalena", "Joanna", "Janina", "Monika"];
var last_names = ["Nowak", "Kowalski", "Wiśniewski", "Dąbrowski", "Lewandowski", "Wójcik", "Kamiński", "Kowalczyk", "Zieliński", "Szymański", "Woźniak", "Kozłowski", "Jankowski", "Wojciechowski", "Kwiatkowski", "Kaczmarek", "Mazur", "Krawczyk", "Piotrowski", "Grabowski", "Nowakowski", "Pawłowski", "Michalski", "Nowicki", "Adamczyk", "Dudek", "Zając", "Wieczorek", "Jabłoński", "Król", "Majewski", "Olszewski", "Jaworski", "Wróbel", "Malinowski", "Pawlak", "Witkowski", "Walczak", "Stępień", "Górski", "Rutkowski", "Michalak", "Sikora", "Ostrowski", "Baran", "Duda"];
var servers = ["outlook.com", "gmail.com", "wp.pl", "onet.eu"];

function threeDigits() {
  return Math.floor(100+Math.random()*899);
}
var emails = [
  function(f, l) { return f + "." + l + "@" + pick(servers); },
  function(f, l) { return f[0] + "." + l + "@" + pick(servers); },
  function(f, l) { return f.slice(0, 3) + l.slice(0, 3) + "@" + pick(servers); },
  function(f, l) { return f + threeDigits() + "@" + pick(servers); }
];
function password() {
  var length = 5+Math.floor(Math.random()*8);
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for( var i=0; i < length; i++ )
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}

function pick(array) {
  var index = Math.floor(Math.random()*array.length);
  return array[index];
}
id('random').addEventListener('click', function() {
  var sex = Math.random() > 0.5;
  var radio = id(sex?'male':'female');
  if (radio) {
    radio.checked = true;
  } else {
    id('sex').value = sex?'male':'female';
  }
  var first_name, last_name, name;
  first_name = pick(sex?names_m:names_f);
  last_name = pick(last_names);
  if (last_name.slice(-2) == "ki" && !sex) {
    last_name = last_name.slice(0, -2) + "ka";
  }
  id('name').value = first_name+" "+last_name;
  var email = pick(emails)(first_name.toLowerCase(), last_name.toLowerCase());
  id('email').value = email;
  var age = 15 + Math.floor(Math.random()*40);
  var year = y-age;
  birth_year.value = year;
  id('password').value = id('password2').value = password();
  var interests = document.getElementsByName('interests[]');
  for (var i=0; i<interests.length; i++) {
    interests[i].checked = Math.random() > 0.7;
  }
});
    </script>
  </body>
</html>
