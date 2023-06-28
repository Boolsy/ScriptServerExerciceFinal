<?php
  if (function_exists('checkUrl') && function_exists('logout')) {
    checkUrl();
    $_SESSION['alert'] = 'Au revoir !';
    logout();
  } else {
    header('Location: index.php?');
    die;
  }

