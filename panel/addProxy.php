
<?php
if ( empty(session_id()) ) session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
include "../config.php";
include './planChecker.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST)) {
  echo "Running";

  function run() {
    global $link;
    $proxyGroups = $_POST["proxyGroups"];
    $proxyProtocol = $_POST["proxyProtocol"];
    $proxyList = $_POST["proxyList"];
    $userId = $_SESSION["id"];

    $int0 = 0;
    $stmt = $link->prepare("INSERT INTO proxies (id, group1, type, proxies, online, offline) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssii", $userId, $proxyGroups, $proxyProtocol, $proxyList, $int0, $int0);
    $stmt->execute();
    mysqli_stmt_close($stmt);
  }

  if (getRank()) {
    echo "Running";
    run();
  } else {
    echo "You have no plan or it has expired.";
    die();
  }
} else {
  echo "No.";
}
die();
?>