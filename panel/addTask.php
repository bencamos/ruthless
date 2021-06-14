
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

  function addTask() {
    global $link;
    $website = $_POST["websites"];
    $productKeyWords = $_POST["productKeyWords"];
    $productLink = $_POST["product"];
    $proxy = $_POST["Proxies"];
    $payment = $_POST["payment"];
    $quantity = $_POST["quantity"];
    $variant = $_POST["variant"];
    $account = $_POST["account"];
    $shipping = $_POST["shipping"];
    $billing = $_POST["billing"];
    $execdate = $_POST["execdate"];
    $exectime = $_POST["exectime"];
    $userId = $_SESSION["id"];

    if (is_null($billing)) {
      $billing = $shipping;
    }

    $date = $execdate . " " . $exectime;
    echo $date;
    date_default_timezone_set("UTC");
    $exectime1 = strtotime($date) * 1000;
    $status = "Waiting...";
    $int0 = 0;
    echo("ID:". $userId ."<br>Website: ". $website ."<br>Product Link: ". $productLink ."<br>Product Key Words: ". $productKeyWords ."<br>Proxy: ". $proxy ."<br>Payment: ". $payment ."<br>Quantity: ". $quantity ."<br>Variant: ". $variant ."<br>Account: ". $account . "<br>Shipping: " . $shipping . "<br>Billing: " . $billing . "<br>Exec Date: ". $execdate ."<br>Exec Time: ". $exectime . "");
    $stmt = $link->prepare("INSERT INTO tasks (id, status, website, productKeyWords, productLink, proxy, payment, quantity, variant, account, shipping, billing, exectime, success, fail) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssssssiii", $userId, $status, $website, $productKeyWords, $productLink, $proxy, $payment, $quantity, $variant, $account, $shipping, $billing, $exectime1, $int0, $int0);
    $stmt->execute();
    mysqli_stmt_close($stmt);
  }

  if (getRank()) {
    if (getTasksLimit()) {
      addTask();
    } else {
      echo "You have reached your limit";
      die();
    }
  } else {
    echo "You have no plan or it has expired.";
    die();
  }
}
die();
?>