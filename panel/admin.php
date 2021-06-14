<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
require_once "../config.php";
?>

<?php
$stmt = $link->prepare("SELECT * FROM userPlans WHERE id = ?");
$stmt->bind_param("i", $_SESSION["id"]);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_NUM);

if ($data) {
    foreach ($data as $row) {
      $usersRank = $row[2];
    }
} else {
    die();
}
mysqli_stmt_close($stmt);
$stmt = $link->prepare("SELECT * FROM planTypes WHERE name = ?");
$stmt->bind_param("i", $usersRank);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_NUM);

if ($data) {
    foreach ($data as $row) {
      if ($usersRank == "admin") {
        
      } else {
        die();
      }
    }
} else {
    die();
}
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ruthless Dash</title>
  <link rel="stylesheet" href="css/dashboard.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
      <img src="images/ruthless.png" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">RUTHLESS</span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-close">
            <a href="./index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            <li class="nav-item menu-close">
              <a href="./tasks.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Tasks
                </p>
              </a>
          </li>
          <li class="nav-item menu-close">
            <a href="./profiles.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Profiles
              </p>
            </a>
        </li>
        <hr>
        <?php
        $stmt = $link->prepare("SELECT * FROM userPlans WHERE id = ?");
        $stmt->bind_param("i", $_SESSION["id"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_NUM);

        if ($data) {
            foreach ($data as $row) {
              $usersRank = $row[2];
            }
        } else {
            die();
        }
        mysqli_stmt_close($stmt);
        $stmt = $link->prepare("SELECT * FROM planTypes WHERE name = ?");
        $stmt->bind_param("i", $usersRank);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_NUM);

        if ($data) {
            foreach ($data as $row) {
              if ($usersRank == "admin") {
                echo '<li class="nav-item menu-open">';
                  echo '<a href="./admin.php" class="nav-link">';
                    echo '<i class="nav-icon fas fa-tachometer-alt"></i>';
                    echo '<p>';
                      echo 'Admin';
                    echo '</p>';
                  echo '</a>';
              echo '</li>';
              } else {
                die();
              }
            }
        } else {
            die();
        }
        mysqli_stmt_close($stmt);
        ?>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <div class="content-header">
    </div>
    <section class="content">

    </section>
  </div>
</div>
</body>
</html>


