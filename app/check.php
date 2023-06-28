<?php

  if (function_exists('checkUrl')) {
    checkUrl();
  } else {
    header('Location: ../index.php');
    die;
  }
