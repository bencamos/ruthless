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
            <li class="nav-item menu-close">
              <a href="./tasks.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Tasks
                </p>
              </a>
          </li>
          <li class="nav-item menu-open">
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
                <h3 class="card-title">Proxy Management</h3>
                <button style="float: right;" id="proxyCheckBtn">Check Proxies</button>
                <button style="float: right;" id="proxyBtn">Add Proxies</button>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table id="oplist" class="table m-0">
                    <thead>
                    <tr>
                      <th>Group</th>
                      <th>Type</th>
                      <th>Amount</th>
                      <th>Online</th>
                      <th>Offline</th>
                      <th>Online Rate</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $stmt = $link->prepare("SELECT * FROM proxies WHERE id = ?");
                      $stmt->bind_param("i", $_SESSION["id"]);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $data = $result->fetch_all(MYSQLI_NUM);

                      if ($data) {
                          foreach ($data as $row) {
                            echo "<tr>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . "</td>";
                            echo "<td>" . $row[4] . "</td>";
                            if ($row[5] == 0 OR $row[6] == 0)  {
                              $successrate = "0";
                            } else {
                              $successrate = ($row[5] / ($row[6] + $row[5])) * 100;
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
          <hr>
          <div class="col-md-10">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Website Accounts</h3>
                <button style="float: right;" id="accountBtn">Add Accounts</button>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table id="oplist" class="table m-0">
                    <thead>
                    <tr>
                      <th>Website</th>
                      <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $stmt = $link->prepare("SELECT * FROM accounts WHERE id = ?");
                      $stmt->bind_param("i", $_SESSION["id"]);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $data = $result->fetch_all(MYSQLI_NUM);

                      if ($data) {
                          foreach ($data as $row) {
                            echo "<tr>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . "</td>";
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
          <div class="col-md-10">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Payments</h3>
                <button style="float: right;" id="paymentBtn">Add Payment Method</button>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table id="oplist" class="table m-0">
                    <thead>
                    <tr>
                      <th>Number</th>
                      <th>Expiry</th>
                      <th>Name</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $stmt = $link->prepare("SELECT * FROM payments WHERE id = ?");
                      $stmt->bind_param("i", $_SESSION["id"]);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $data = $result->fetch_all(MYSQLI_NUM);

                      if ($data) {
                          foreach ($data as $row) {
                            echo "<tr>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . "</td>";
                            echo "<td>" . $row[5] . "</td>";
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
          <div class="col-md-10">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Shipping & Billing</h3>
                <button style="float: right;" id="addressBtn">Add Address</button>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table id="oplist" class="table m-0">
                    <thead>
                    <tr>
                      <th>Street</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Zip Code</th>
                      <th>Mobile</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                      $stmt = $link->prepare("SELECT * FROM address WHERE id = ?");
                      $stmt->bind_param("i", $_SESSION["id"]);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $data = $result->fetch_all(MYSQLI_NUM);

                      if ($data) {
                          foreach ($data as $row) {
                            echo "<tr>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . "</td>";
                            echo "<td>" . $row[4] . "</td>";
                            echo "<td>" . $row[5] . "</td>";
                            echo "<td>" . $row[6] . "</td>";
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
          </div>
          <div id="proxyModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <form action="/panel/addProxy.php" method="POST">
                <label for="addProxies">Proxy Group:</label>
                <select id="proxyGroups" name="proxyGroups">
                  <option id="main" value="main">Main</option>
                </select>
                &nbsp
                <label style="display:none" for="proxyType">Proxy Type:</label>
                <select style="display:none" id="proxyProtocol" name="proxyProtocol">
                  <option id="socks4" value="socks4">Socks 4</option>
                  <option id="socks5" value="socks5">Socks 5</option>
                  <option id="http" value="http">HTTP</option>
                  <option id="https" value="https">HTTPS</option>
                </select>
                &nbsp
                <label for="product">Proxies:</label>
                <input type="text" id="proxyList" name="proxyList">
                &nbsp
                <button style="float: left;" id="proxyGroupNew">Add New Group</button>
                <button style="float: right;" id="proxyGroupBtn">Add Proxy Group</button>
                <br>
                <br>
                <input type="submit" value="Add Proxy">
              </form>
            </div>
          </div>
          <div id="accountModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <form action="/panel/addAccount.php" method="POST">
                <input type="submit" value="Add Account">
              </form>
            </div>
          </div>
          <div id="paymentModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <form action="/panel/addPayment.php" method="POST">
                <input type="submit" value="Add Payment Method">
              </form>
            </div>
          </div>
          <div id="addressModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <form action="/panel/addAddress.php" method="POST">
                <input type="submit" value="Add Address">
              </form>
            </div>
          </div>
          <script>
            var proxyModal = document.getElementById("proxyModal");
            var accountModal = document.getElementById("accountModal");
            var paymentModal = document.getElementById("paymentModal");
            var addressModal = document.getElementById("addressModal");
            var proxyGroupBtn = document.getElementById("proxyGroupBtn");
            var proxyGroupNew = document.getElementById("proxyGroupNew");
            var proxyBtn = document.getElementById("proxyBtn");
            var proxyType = document.getElementById("proxyType");
            var proxyTypeSec = document.getElementById("proxyProtocol");
            var accountBtn = document.getElementById("accountBtn");
            var paymentBtn = document.getElementById("paymentBtn");
            var addressBtn = document.getElementById("addressBtn");

            var span = document.getElementsByClassName("close")[0];
            proxyGroupNew.onclick = function() {
              var x = document.getElementById("proxyGroups");
              var option = document.createElement("option");
              option.text = prompt("Please enter name for new group", "");
              x.add(option);
            }
            proxyCheckBtn.onclick = function() {
              window.location.href = "/panel/proccessing/checkProxies.php";
            }
            proxyGroupBtn.onclick = function() {
              var prompt = prompt("Please enter name for new group:", "");
              var x = document.getElementById("proxyGroups");
              var option = document.createElement("option");
              x.add(option);
              if (!prompt == null || prompt == "") {
                option.text = prompt;
              }
              proxyType.style.display = "none";
              proxySec.style.display = "none";
            }
            proxyBtn.onclick = function() {
              proxyModal.style.display = "block";
            }
            accountBtn.onclick = function() {
              accountModal.style.display = "block";
            }
            paymentBtn.onclick = function() {
              paymentModal.style.display = "block";
            }
            addressBtn.onclick = function() {
              addressModal.style.display = "block";
            }

            span.onclick = function() {
              proxyModal.style.display = "none";
              accountModal.style.display = "none";
              paymentModal.style.display = "none";
              addressModal.style.display = "none";
            }
            window.onclick = function(event) {
              if (event.target == proxyModal) {
                proxyModal.style.display = "none";
              }
              if (event.target == accountModal) {
                accountModal.style.display = "none";
              }
              if (event.target == paymentModal) {
                paymentModal.style.display = "none";
              }
              if (event.target == addressModal) {
                addressModal.style.display = "none";
              }
            }
          </script>
        </div>
      </div>
    </section>
  </div>
</div>
</body>
</html>


