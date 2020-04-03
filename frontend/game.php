<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/js/main.js">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Jouer</title>
</head>
<body>
  <header>
      <div id="logo">
          <a href="index.php"><img src="assets/img/logo.png" alt="Accueil"></a>
          <a id="user" href="user.php"><img src="https://img.icons8.com/ios-glyphs/64/000000/user--v1.png"></a>
      </div>
      <nav id="main-menu">
          <ul class="nav-bar">
              <li class="nav-button-game"><a href="index.php">ACCUEIL</a></li>
              <li class="nav-button-game"><a href="game.php">JOUER</a></li>
              <li class="nav-button-biblio"><a href="biblio.php">BIBLIOTHEQUE</a></li>
              <li class="nav-button-shop"><a href="shop.php">BOUTIQUE</a></li>
              <li class="nav-button-user"><a href="user.php">ESPACE UTILISATEUR</a></li>
          </ul>
      </nav>
  </header>
  <main>
  <div id="param">
        <div id="form">
            <form action='#.php' method='POST'>
                <label class="txt" for="nom">Nom de la partie</label> : <br>
                <input name='nom' id="nom" type='text' placeholder="Nom"> <br>
                Partie Privée
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
                Partie Publique <br>
                <label for="scenar">Choisissez un scénario :</label>
                <select id="cars" name="cars">
                    <option value="volvo">Scénar 1</option>
                    <option value="saab">Scénar 2</option>
                    <option value="fiat">Scénar 3</option>
                </select> <br>
                Votre lien d'invitation : sdfgrts5445rtg5rt84gregz<br>
                <button type="submit" class="button" id="form-submit">Lancer la partie</button>
            </form>
        </div>
    </div>
  </main>
  <footer>

  </footer>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>
