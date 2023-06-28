<?php
  function connect()
  {
    // variable globale. Si le script appelant la fonction connect() possède une variable nommée $connect, alors son contenu sera récupéré ici
    global $connect;

    // Il est inutile de créer une nouvelle connexion à la DB si elle existe déjà
    if (is_a($connect, 'PDO')) {
      return $connect;
    } else {
      // try / catch : gestion d'erreur. Si le code dans la partie "try" échoue, alors la partie "catch" s'exécute.
      try {
        // La connexion PDO utilise les constantes présentes dans le script config.php
        $connect = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASSWORD);
        // On spécifie le mode d'erreur de PDO via la méthode setAttribute et les constantes de PDO
        // Avant PHP 8.0 il est nécessaire de le préciser, car ce n'est pas le mode par défaut
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $exception) {
        // On affiche l'erreur
        die ('Erreur: ' . $exception->getMessage());
      }
      return $connect;
    }
  }


  /**
   * @param string $table
   * @return array
   */
  function getColumns(string $table): array
  {
    $connect = connect();
    $columns = [];
    $cols = $connect->query("DESCRIBE " . $table, PDO::FETCH_OBJ);
    foreach ($cols as $col) {
      $columns[] = $col->Field;
    }
    return $columns;
  }