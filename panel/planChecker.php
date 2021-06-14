<?php
if ( empty(session_id()) ) session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
include "../../config.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function timeNow() {
    $mt = explode(' ', microtime());
    return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
}

if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}

echo $link->connect_error;

function getRank() {
  global $link;
  $stmt = $link->prepare("SELECT * FROM userPlans WHERE id = ?");
  $stmt->bind_param("i", $_SESSION["id"]);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_NUM);
  if ($data) {
      foreach ($data as $row) {
        if ($row[3] < timeNow()) {
          mysqli_stmt_close($stmt);
          return 0;
        } else {
          mysqli_stmt_close($stmt);
          return $row[2];
        }
      }
  } else {
    mysqli_stmt_close($stmt);
    return 0;
  }
}

function expiryCheck() {
  global $link;
  $stmt = $link->prepare("SELECT * FROM userPlans WHERE id = ?");
  $stmt->bind_param("i", $_SESSION["id"]);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_NUM);

  if ($data) {
      foreach ($data as $row) {
        if ($row[3] < timeNow()) {
          mysqli_stmt_close($stmt);
          return 0;
        } else {
          $usersRank = $row[2];
          $tasksRunning = $row[4];
        }
      }
  } else {
    mysqli_stmt_close($stmt);
    return 0;
  }
}

function getTasksLimit() {
  global $link;
  $stmt = $link->prepare("SELECT * FROM userPlans WHERE id = ?");
  $stmt->bind_param("i", $_SESSION["id"]);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_NUM);
  if ($data) {
      foreach ($data as $row) {
        if ($row[4] >= taskCheck()) {
          mysqli_stmt_close($stmt);
          return 0;
        } else {
          mysqli_stmt_close($stmt);
          return 1;

        }
      }
  } else {
    mysqli_stmt_close($stmt);
    return 0;
  }
}

function taskCheck() {
  global $link;
  $stmt = $link->prepare("SELECT * FROM planTypes WHERE name = ?");
  $stmt->bind_param("i", getRank());
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_NUM);
  if ($data) {
      foreach ($data as $row) {
        return $row[2];
      }
  } else {
    mysqli_stmt_close($stmt);
    return 0;
  }
}

 ?>