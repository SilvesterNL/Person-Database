<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
        header('Cache-Control: no cache');
    }
    $respone = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['type'] == "search") {
            $result = $con->query("SELECT * FROM reportsres WHERE concat(' ', title, ' ') LIKE '%".$con->real_escape_string($_POST['search'])."%' OR concat(' ', report, ' ') LIKE '%".$con->real_escape_string($_POST['search'])."%' ORDER BY created DESC");
            $search_array = [];
            while ($data = $result->fetch_assoc()) { 
                $search_array[] = $data;
                header('Cache-Control: no cache');
            }
        }
        if ($_POST['type'] == "show" || isset($_SESSION["reportid"]) && $_SESSION["reportid"] != NULL) {
            if (isset($_SESSION["reportid"]) && $_SESSION["reportid"] != NULL) {
                $reportId = $_SESSION["reportid"];
                header('Cache-Control: no cache');
            } else {
                $reportId = $_POST['reportid'];
                header('Cache-Control: no cache');
            }
            $query = $con->query("SELECT * FROM reportsres WHERE id = ".$con->real_escape_string($reportId));
            $selectedreport = $query->fetch_assoc();
            $lawids = json_decode($selectedreport["laws"], true);
            $profile = $con->query("SELECT * FROM profiles WHERE id = ".$con->real_escape_string($selectedreport["profileid"]));
            $profiledata = $profile->fetch_assoc();
            header('Cache-Control: no cache');
            $lawdata = [];
            if (!empty($lawids)) {
                foreach($lawids as $lawid) {
                    $result = $con->query("SELECT * FROM laws WHERE id = ".$con->real_escape_string($lawid));
                    $lawdata[] = $result->fetch_assoc();
                }
            }
            $_SESSION["reportid"] = NULL;
        }
    }
    header('Cache-Control: no cache');
    $name = explode(" ", $_SESSION["name"]);
    $firstname = $name[0];
    $last_word_start = strrpos($_SESSION["name"], ' ') + 1;
    $lastname = substr($_SESSION["name"], $last_word_start);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="https://www.politie.nl/politie2018/assets/images/icons/favicon.ico" type="image/x-icon" />
        <link rel="icon" type="image/png" sizes="16x16" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-32.png">
        <link rel="icon" type="image/png" sizes="64x64" href="https://www.politie.nl/politie2018/assets/images/icons/favicon-64.png">

        <title>Politie Databank</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="assets/css/main.css" rel="stylesheet">
        <link href="assets/css/profiles.css" rel="stylesheet">
        <link href="assets/css/laws.css" rel="stylesheet">
        <link href="assets/css/navbar.css" rel="stylesheet">
    </head>
    <body>
    <nav>
    <div class="sidebar-top">
      <span class="shrink-btn">
        <i class='bx bx-chevron-left'></i>
      </span>
      <img src="./assets/images/icon.png" class="logo" alt="">
      <h3 class="hide">Politie Fomato</h3>
    </div>

    

    <div class="search"></div>


    <div class="sidebar-links">
      <ul>
        <div style="top: 117.5px!important;" class="active-tab"></div>
        <li class="tooltip-element" data-tooltip="0">
          <a href="dashboard"  data-active="0">
            <div class="icon">
              <i class='bx bx-home'></i>
              <i class='bx bx-home'></i>
            </div>
            <span class="link hide">Dashboard</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="profiles"  data-active="1">
            <div class="icon">
              <i class='bx bx-male'></i>
              <i class='bx bx-male'></i>
            </div>
            <span class="link hide">Personen</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="reports" class="active" data-active="2">
            <div class="icon">
              <i class='bx bx-message-square-detail'></i>
              <i class='bx bxs-message-square-detail'></i>
            </div>
            <span class="link hide">Rapportages</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="3">
          <a href="warrants" data-active="3">
            <div class="icon">
              <i class='bx bx-target-lock'></i>
              <i class='bx bx-target-lock'></i>
            </div>
            <span class="link hide">Arrestatiebevelen</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="4">
          <a href="archiefvieuwer" data-active="3">
            <div class="icon">
              <i class='bx bx-archive'></i>
              <i class='bx bx-archive'></i>
            </div>
            <span class="link hide">Archief</span>
          </a>
        </li>
        <div class="tooltip">
          <span class="show">Dashboard</span>
          <span>Personen</span>
          <span>Rapportages</span>
          <span>Arrestatiebevelen</span>
          <span>Archief</span>
        </div>
      </ul>
      
      
      
      <?php if ($_SESSION["role"] == "admin") { ?>
      <h4 class="hide">Leiding</h4>
      <ul>
        <li class="tooltip-element" data-tooltip="0">
          <a href="users" data-active="4">
            <div class="icon">
              <i class='bx bx-male'></i>
              <i class='bx bx-male'></i>
            </div>
            <span class="link hide">Gebruikers</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="laws" data-active="5">
            <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bx-folder'></i>
            </div>
            <span class="link hide">Straffen</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="settings" data-active="6">
            <div class="icon">
              <i class='bx bx-cog'></i>
              <i class='bx bxs-cog'></i>
            </div>
            <span class="link hide">Settings</span>
          </a>
        </li>
        <div class="tooltip">
          <span class="show">Gebruikers</span>
          <span>Straffen</span>
          <span>Settings</span>
        </div>
      </ul>
    </div>
    <?php } ?>




    <div class="sidebar-footer">
      <a href="#" class="account tooltip-element" data-tooltip="0">
        <i class='bx bx-user'></i>
      </a>
      <div class="admin-user tooltip-element" data-tooltip="1">
        <div class="admin-profile hide">
          <img src="<?php echo $_SESSION["profilepic"]; ?>" alt="">
          <div class="admin-info">
            <h3><?php echo $firstname . " " . substr($lastname, 0, 1); ?>.</h3>
            <h5><?php echo $_SESSION["rank"]; ?></h5>
          </div>
        </div>
        <a href="./logout" class="log-out">
          <i class='bx bx-log-out'></i>
        </a>
      </div>
      <div class="tooltip">
        <span class="show"><?php echo $firstname . " " . substr($lastname, 0, 1); ?>.</span>
        <span>Logout</span>
      </div>
    </div>
  </nav>

        <main role="main" class="container">
            <div class="content-introduction">
                <h3>Reports</h3>
                <p class="lead">Hier kun je rapportages opzoeken, lezen en bijwerken. <br/> Gelieve niet een report bij te werken van iemand anders mits je toestemming heb gekregen!</p>
            </div>
            <div class="profile-container">
                <div class="profile-search">
                    <?php if ($_SERVER['REQUEST_METHOD'] != "POST" || $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] != "show") { ?>
                        <a href="createreport" class="btn btn-pol btn-md my-0 ml-sm-2">MAAK NIEUW rapportage</a>
                    <?php } else { ?>
                        <form method="post" action="createreportres">
                            <input type="hidden" name="type" value="edit">
                            <input type="hidden" name="reportid" value="<?php echo $selectedreport['id']; ?>">
                            <button type="submit" name="issabutn" class="btn btn-pol btn-md my-0 ml-sm-2">PAS REPORT AAN</button>
                        </form>
                    <?php } ?>
                    <br /><br />
                    <form method="post" class="form-inline ml-auto">
                        <input type="hidden" name="type" value="search">
                        <div class="md-form my-0">
                            <input class="form-control" name="search" type="text" placeholder="Zoek een report.." aria-label="Search">
                        </div>
                        <button type="submit" name="issabutn" class="btn btn-pol btn-md my-0 ml-sm-2">ZOEK</button>
                    </form>
                </div>
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "search") { ?>
                    <div class="search-panel">
                        <h5 class="panel-container-title">Gevonden reports..</h5>
                        <div class="panel-list">
                            <?php if (empty($search_array)) { ?>
                                <p>Geen rapportages gevonden..</p>
                            <?php } else { ?>
                                <?php foreach($search_array as $report) {?>
                                    <form method="post">
                                        <input type="hidden" name="type" value="show">
                                        <input type="hidden" name="reportid" value="<?php echo $report['id']; ?>">
                                        <button type="submit" class="btn btn-panel panel-item">
                                            <h5 class="panel-title">#<?php echo $report['id']; ?> <?php echo $report['title']; ?></h5>
                                            <p class="panel-author">door: <?php echo $report['author']; ?></p>
                                        </button>
                                    </form>
                                <?php }?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "show" && !empty($selectedreport)) { ?>
                    <div class="report-show">
                        <h4 class="report-title"><?php echo $selectedreport["title"]; ?></h4>
                        <?php if ($profiledata != NULL) {?>
                            <p>Betfreft: <?php echo $profiledata["fullname"]; ?> (<?php echo $profiledata["citizenid"]; ?>)
                        <?php } ?>
                        <hr>
                        <strong>rapportage:</strong>
                        <p class="report-description"><?php echo $selectedreport["report"]; ?></p>
                        <p class="report-author"><i>Geschreven door: <?php echo $selectedreport["author"]; ?></i></p>
                    </div>
                            
                       
                    </div>
                <?php } ?>
            </div>
        </main><!-- /.container -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/app.js"></script>
    </body>
</html>
