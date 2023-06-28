<?php
  /**
   * @param string $field
   * @param string $value
   * @return mixed
   */
  function getUser(string $field, string $value): mixed
  {

    if (!in_array($field, getColumns('user'))) {
      return false;
    }

    $connect = connect();

    // 2. QUERY
    $request = $connect->prepare("SELECT * FROM user WHERE $field = ?");

    $params = [
      trim($value),
    ];

    // 3. EXECUTE
    $request->execute($params);

    // 4. FETCH
    return $request->fetchObject();
  }


  /**
   * @param string $field
   * @param string $value
   * @return bool
   */
  function userExists(string $field, string $value): bool
  {
    if (is_object(getUser($field, $value))) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * @return void
   */
  function logout(): void
  {
    $errorMessage = 'Au revoir !';


    session_unset();
    session_destroy();
    session_write_close();


    session_start();
    $_SESSION['alert'] = $errorMessage;


    header('Location: index.php');
    die;
  }


  function SudoCtrl($userId, $username, $email, $admin)
  {
    if (empty($userId) || !is_numeric($userId)) {
      return 'L\'identifiant de l\'utilisateur est invalide.';
    }
    if (empty($username)) {
      return 'Le nom d\'utilisateur est requis.';
    }
    $user = getUser('username', $username);
    if ($user && $user->id != $userId) {
      return 'Le nom d\'utilisateur est déjà utilisé par un autre utilisateur.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return 'L\'adresse email est invalide.';
    }
    $user = getUser('email', $email);
    if ($user && $user->id != $userId) {
      return 'L\'adresse email est déjà utilisée par un autre utilisateur.';
    }
    if ($admin !== '0' && $admin !== '1') {
      return 'La valeur d\'administrateur est invalide.';
    }
    return '';
  }

