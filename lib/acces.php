<?php

  /**
   * @return void
   */
  function checkUrl(): void
  {
    if (!str_contains($_SERVER['REQUEST_URI'], 'index.php?')) {
      header('Location: index.php?');
      die;
    }
  }

  function exportJSON(object $user): void
  {
    $filename = $user->id . '_' . time() . '.json';
    header('Content-type: application/json');
    header('Content-disposition: attachment; filename="' . $filename . '"');
    echo json_encode($user);
  }
