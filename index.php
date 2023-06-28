<?php

  session_name('PP' . date('Ymd'));
  session_start();

  require_once 'config.php';
  require_once 'lib/pdo.php';
  require_once 'lib/acces.php';
  require_once 'lib/output.php';
  require_once 'lib/user.php';


  $connect = connect();


?>
    <div class="alert-container">
      <?php
        // alert message
        if (!empty($_SESSION['alert'])) {
          if (!empty($_SESSION['alert-color']) && in_array($_SESSION['alert-color'], ['danger', 'info', 'success', 'warning'])) {
            $alertColor = $_SESSION['alert-color'];
            unset($_SESSION['alert-color']);
          } else {
            $alertColor = 'danger';
          }
          echo '<div class="alert alert-' . $alertColor . '">';
          echo '<span class="close-button">&times;</span>';
          echo $_SESSION['alert'];
          echo '</div>';
          // only once
          unset($_SESSION['alert']);
        }
      ?>
    </div>
    </div>
<?php

  include 'page/header.php';
  include 'page/menu.php';


  // Vérifie la présence d'un paramètre 'page' dans l'URL
  if (!empty($_GET['page'])) {
    getContent($_GET['page']);
  }


  include_once 'page/footer.html';