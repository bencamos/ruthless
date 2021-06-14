<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
include "../config.php";
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
            <li class="nav-item menu-open">
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
                echo '<li class="nav-item menu-close">';
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
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <div class="content-header">
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">All Tasks</h3>
                <button style="float: right;" id="myBtn">Add Task</button>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <script>
                    setInterval(function () {
                      $( "#oplist" ).load(window.location.href + " #oplist" );
                      console.log("Refreshing...");
                    }, 1000);
                  </script>
                  <table id="oplist" class="table m-0">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Status</th>
                      <th>Website</th>
                      <th>Product Key Words</th>
                      <th>Product Link</th>
                      <th>Proxy</th>
                      <th>Payment Method</th>
                      <th>Quantity</th>
                      <th>Variant</th>
                      <th>Account</th>
                      <th>Succeded</th>
                      <th>Failed</th>
                      <th>Success Rate</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $stmt = $link->prepare("SELECT * FROM tasks WHERE id = ? ORDER BY exectime");
                      $stmt->bind_param("i", $_SESSION["id"]);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $data = $result->fetch_all(MYSQLI_NUM);

                      if ($data) {
                          foreach ($data as $row) {
                            echo $opid;
                            echo "<tr>";
                            echo "<td>" . $row[0] . "</td>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . "</td>";
                            echo "<td>" . $row[4] . "</td>";
                            echo "<td>" . $row[5] . "</td>";
                            echo "<td>" . $row[6] . "</td>";
                            echo "<td>" . $row[7] . "</td>";
                            echo "<td>" . $row[8] . "</td>";
                            echo "<td>" . $row[9] . "</td>";
                            echo "<td>" . $row[10] . "</td>";
                            if ($row[9] == 0 OR $row[10] == 0)  {
                              $successrate = "0";
                            } else {
                              $successrate = ($row[9] / ($row[10] + $row[9])) * 100;
                            }
                            echo "<td>" . $success . "</td>";
                            echo "<td>" . $fail . "</td>";
                            echo "<td>" . $successrate . "%</td>";
                            echo "</tr>";
                          }
                      } else {
                          echo "Empty";
                      }
                      mysqli_stmt_close($stmt);
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <?php
            $stmt = $link->prepare("SELECT * FROM tasks WHERE id = ? ORDER BY exectime");
            $stmt->bind_param("i", $_SESSION["id"]);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_NUM);

            if ($data) {
                foreach ($data as $row) {
                  $count = $count + 1;
                  $fail = $fail + $fail;
                  $success = $success + $success;
                }
            echo '<div class="info-box mb-3 bg-warning">';
              echo '<div class="info-box-content">';
                echo '<span class="info-box-text">Total Tasks</span>';
                echo '<span class="info-box-number">' . $count . '</span>';
              echo '</div>';
            echo '</div>';
            echo '<div class="info-box mb-3 bg-success">';
              echo '<div class="info-box-content">';
                echo '<span class="info-box-text">Succesful Purchases</span>';
                echo '<span class="info-box-number">' . $success . '</span>';
              echo '</div>';
            echo '</div>';
            echo '<div class="info-box mb-3 bg-danger">';
              echo '<div class="info-box-content">';
                echo '<span class="info-box-text">Failed Purchases</span>';
                echo '<span class="info-box-number">' . $fail . '</span>';
              echo '</div>';
            echo '</div>';
            echo '</div>';
              } else {
                echo "Empty";
              }
              mysqli_stmt_close($stmt);
            ?>
          </div>
          <div id="myModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <form action="/panel/addTask.php" method="POST">
                <label for="websites">Website:</label>
                <select id="websites" name="websites">
                  <option id="temp" value="nike">Nike.com</option>
                  <option id="temp" value="bestbuy">Best Buy</option>
                  <option id="temp"value="shopify">Shopify</option>
                </select>
                &nbsp
                <label for="product">Product Link:</label>
                <input type="text" id="product" name="product">
                &nbsp
                <label for="productKeyWords">Product Key Words:</label>
                <input type="text" id="productKeyWords" name="productKeyWords">
                &nbsp
                <label for="Proxies">Proxies:</label>
                <select id="Proxies" name="Proxies">
                  <option id="temp" value="temp">User submitted proxie "groups"</option>
                </select>
                &nbsp<hr>
                <label for="payment">Checkout Payment:</label>
                <select id="payment" name="payment">
                  <option id="temp" value="temp">User submitted payments</option>
                </select>
                &nbsp
                <label for="shippingTitle">Shipping:</label>
                <select id="payment" name="shipping">
                  <option id="temp" value="temp">User submitted shipping</option>
                </select>
                &nbsp
                <label id="billingSeperateTitle" for="billingSeperateTitle">Billing:</label>
                <select id="billing" name="billing">
                  <option id="temp" value="temp">User submitted billing</option>
                </select>
                <br>
                <br>
                <label for="quantity">Purchase Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" max="50">
                &nbsp
                <label for="variant">Purchase Variant:</label>
                <input type="text" id="variant" name="variant" >
                <hr>
                <label id="websiteLoginTitle" for="websiteLoginTitle">Website Login:</label>
                <select id="account" name="account">
                  <option id="temp" value="temp">User submitted accounts</option>
                </select>
                <hr>
                <label id="execTitle" for="exectime">Run at:</label>
                <input type="date" id="execdate" name="execdate">
                <input type="time" id="exectime" name="exectime">
                <hr>
                <input type="checkbox" id="scheduleCheck" name="scheduleCheck" value="Schedule" onclick="enableScheduler()" checked>
                <label for="scheduleCheck">Schedule Task</label>
                &nbsp
                <input type="checkbox" id="websiteLoginCheck" name="websiteLoginCheck" value="websiteLogin" onclick="websiteLogin()" checked>
                <label for="websiteLogin">Login Required</label>
                &nbsp
                <input type="checkbox" id="billingSeperateCheck" name="billingSeperateCheck" value="billingSeperate" onclick="billingSeperate()" checked>
                <label for="websiteLogin">Use different billing from shipping</label>
                <br>
                <input type="submit" value="Add Task">
              </form>
            </div>
          </div>
        </div>
        <script>
          var modal = document.getElementById("myModal");
          var btn = document.getElementById("myBtn");
          var span = document.getElementsByClassName("close")[0];
          btn.onclick = function() {
            modal.style.display = "block";
          }
          span.onclick = function() {
            modal.style.display = "none";
          }
          window.onclick = function(event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
          }
          function enableScheduler() {
            var checkBox = document.getElementById("scheduleCheck");
            var title = document.getElementById("execTitle");
            var date = document.getElementById("execdate");
            var time = document.getElementById("exectime");
            if (checkBox.checked == true){
              date.style.display = "block";
              time.style.display = "block";
              title.style.display = "block";
            } else {
              date.style.display = "none";
              time.style.display = "none";
              title.style.display = "none";
            }
          }
          function websiteLogin() {
            var checkBox = document.getElementById("websiteLoginCheck");
            var title = document.getElementById("websiteLoginTitle");
            var account = document.getElementById("account");
            if (checkBox.checked == true){
              account.style.display = "block";
              title.style.display = "block";
            } else {
              account.style.display = "none";
              title.style.display = "none";
            }
          }
          function billingSeperate() {
            var checkBox = document.getElementById("billingSeperateCheck");
            var title = document.getElementById("billingSeperateTitle");
            var billing = document.getElementById("billing");
            if (checkBox.checked == true){
              billing.style.display = "block";
              title.style.display = "block";
            } else {
              billing.style.display = "none";
              title.style.display = "none";
            }
          }
        </script>
      </div>
    </section>
  </div>
</div>
<script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>