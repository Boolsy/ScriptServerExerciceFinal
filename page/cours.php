<?php

  $connect = connect();

  if (is_a($connect, 'PDO')) {
    $sql = 'SELECT * FROM course';
    $query = $connect->prepare($sql);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);


    if ($result) { //tips: du 22/06
      $output = '<div class="table-container">';
      $output .= '<table class="table table-striped">';
      $output .= '<tr>';
      $output .= '<th>Nom du cours</th>';
      $output .= '<th>Code</th>';
      $output .= '</tr>';

      foreach ($result as $row) {
        $output .= '<tr>';
        $output .= '<td>' . $row['name'] . '</td>';
        $output .= '<td>' . $row['code'] . '</td>';
        $output .= '</tr>';
      }

      $output .= '</table>';
      $output .= '</div>';

      echo $output;
    } else {
      echo 'Aucun cours trouvé';
    }
  }
