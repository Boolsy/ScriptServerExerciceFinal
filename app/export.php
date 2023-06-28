<?php


  session_name('PP' . date('Ymd'));
  session_start();

  include_once '../config.php';
  include_once '../lib/pdo.php';
  include_once '../lib/user.php';
  include_once '../lib/acces.php';


//Tips du 22/06
  if (!empty($_SESSION['id'])) {
    $user = getUser('id', $_SESSION['id']);

    unset($user->password);
    unset($user->image);

    exportJSON($user);

  }






