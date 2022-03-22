<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
    }
    $profiles = $con->query("SELECT * FROM profiles ORDER BY lastsearch DESC LIMIT 6");
    $recentsearch_array = [];
    while ($data = $profiles->fetch_assoc()) { 
        $recentsearch_array[] = $data;
    }
    $reports = $con->query("SELECT * FROM reports ORDER BY created DESC LIMIT 6");
    $recentreports_array = [];
    while ($data = $reports->fetch_assoc()) { 
        $recentreports_array[] = $data;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if ($_POST['type'] == "search") {
        $result = $con->query("SELECT * FROM profiles WHERE concat(' ', fullname, ' ') LIKE '%".$con->real_escape_string($_POST['search'])."%' OR citizenid = '".$con->real_escape_string($_POST['search'])."' OR dnacode = '".$con->real_escape_string($_POST['search'])."' OR fingerprint = '".$con->real_escape_string($_POST['search'])."'");
        $search_array = [];
        while ($data = $result->fetch_assoc()) { 
            $search_array[] = $data;
        }
      }elseif ($_POST['type'] == "show" || isset($_SESSION["personid"]) && $_SESSION["personid"] != NULL) {
          if (isset($_SESSION["personid"]) && $_SESSION["personid"] != NULL) {
              $personId = $_SESSION["personid"];
              $citizenid = $_SESSION["citizenid"];
          } else {
              $personId = $_POST['personid'];
              $citizenid = $_SESSION["citizenid"];
          }
          $query = $con->query("SELECT * FROM profiles WHERE id = ".$con->real_escape_string($personId));
          $selectedprofile = $query->fetch_assoc();
          $result = $con->query("SELECT * FROM reports WHERE profileid = ".$con->real_escape_string($personId)." ORDER BY created DESC");
          $update = $con->query("UPDATE profiles SET lastsearch = ".time()." WHERE id = ".$personId);
          $reports_array = [];
          while ($data = $result->fetch_assoc()) { 
              $reports_array[] = $data;
          }
          $_SESSION["personid"] = NULL;
      }
  }

    $name = explode(" ", $_SESSION["name"]);
    $firstname = $name[0];
    $last_word_start = strrpos($_SESSION["name"], ' ') + 1;
    $lastname = substr($_SESSION["name"], $last_word_start);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=3, shrink-to-fit=yes">
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

    <div class="search">
      <i class='bx bx-search'></i>
      <form method="post">
      <input type="hidden" name="type" value="search">
      <input name="search" type="text" class="hide" placeholder="Zoek Personen">
  </form>
    </div>

    <!-- <form method="post" class="form-inline ml-auto">
                        <input type="hidden" name="type" value="search">
                        <div class="md-form my-0">
                            <input class="form-control" name="search" type="text" placeholder="Zoek een persoon.." aria-label="Search">
                        </div>
                        <button type="submit" name="issabutn" class="btn btn-pol btn-md my-0 ml-sm-2">ZOEK</button>
                    </form> -->


    <div class="sidebar-links">
      <ul>
        <div class="active-tab"></div>
        <li class="tooltip-element" data-tooltip="0">
          <a href="dashboard" class="active" data-active="0">
            <div class="icon">
              <i class='bx bx-home'></i>
              <i class='bx bx-home'></i>
            </div>
            <span class="link hide">Dashboard</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="profiles" data-active="1">
            <div class="icon">
              <i class='bx bx-male'></i>
              <i class='bx bx-male'></i>
            </div>
            <span class="link hide">Personen</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="reports" data-active="2">
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
        <div class="tooltip">
          <span class="show">Dashboard</span>
          <span>Personen</span>
          <span>Rapportages</span>
          <span>Arrestatiebevelen</span>
        </div>
      </ul>
      
      
      
      <?php if ($_SESSION["rank"] == "Leiding") { ?>
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
        <a href="logout" class="log-out">
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
                <h3>Welkom bij de Politie Databank</h3>
                <p class="lead">Zoek personen en andere informatie op die je kunt gebruiken tijdens je dienst. <br />Ook kun je hier alle rapportages lezen, aanmaken, bijwerken en verwijderen. <br /><strong>Zorg ervoor dat alle documentatie goed wordt opgenomen en alle bewijzen erin worden meegenomen.</strong>
                <br />
                <br />
                </p>
            </div>
            <div class="dashboard-container">
                <!-- Left Container -->
                <div class="homesearch">
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "search") { ?>
                    <div class="search-panel">
                    <h5 style="margin-left:16px;" class="panel-container-title">Gevonden Personen</h5>
                        <div class="panel-list">
                        <grid class="dashpers">
                            <?php if (empty($search_array)) { ?>
                                <p>Geen persoon persoon gevonden.. Maak een profiel aan.</p>
                            <?php } else { ?>
                                <?php foreach($search_array as $person) {?>
                                  
                                    <form method="post">
                                        <input type="hidden" name="type" value="show">
                                        <input type="hidden" name="personid" value="<?php echo $person['id']; ?>">
                                        <?php $_SESSION["citizenid"] = $person['citizenid']; ?>
                                        <button style="width:398px; margin-left:17px;" type="submit" class="recpers btn btn-panel panel-item">
                                            <h5 class="panel-title"><?php echo $person['fullname']; ?></h5>
                                            <p class="panel-author">BSN: <?php echo $person['citizenid']; ?></p>
                                        </button>
                                
                                    </form>
                                <?php }?>
                            <?php } ?>
                            </grid>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "show" && !empty($selectedprofile)) { ?>
                    <div class="profile-panel">
                        <div class="profile-avatar">
                            <img src="<?php echo $selectedprofile["avatar"]; ?>" alt="profile-pic" width="150" height="150" />
                        </div>
                        <div class="kruisje">
                                  <a href="dashboard">
                                    <img alt="kruis" src="./assets/images/kruisje.png">
                                  </a>
                                </div>
                        <div class="profile-information">
                        <?php $_SESSION["citizenid"] = $selectedprofile['citizenid']; ?>
                        <?php $warrant = $con->query("SELECT * FROM warrants WHERE citizenid = '".$_SESSION['citizenid']."' ORDER BY id");
                        while ($data1 = $warrant->fetch_assoc()) { 
                            $warrant_array[] = $data1;
                        }
                        ?>
                            <p><strong>Naam:</strong><br /><?php echo $selectedprofile["fullname"]; ?></p>
                            <p><strong>Burger Service Nummer:</strong><br /><?php echo $selectedprofile["citizenid"]; ?></p>
                            <p><strong>Vingerpatroon:</strong><br /><?php echo $selectedprofile["fingerprint"]; ?></p>
                            <p><strong>Dnacode:</strong><br /><?php echo $selectedprofile["dnacode"]; ?></p>
                            <p><strong>Notitie:</strong><br /><?php echo $selectedprofile["note"]; ?></p>
                            <strong>Arrestatiebevelen:</strong>
                            <?php if (empty($warrant_array)) { ?>
                                    <p>Geen arrestatiebevelen gevonden</p>
                                <?php } else { ?>
                                    <?php foreach($warrant_array as $warrant) {?>
                                        
                                        <form method="post" action="warrants">
                                            <input type="hidden" name="type" value="show">
                                            <input type="hidden" name="warrantid" value="<?php echo $warrant['id']; ?>">
                                            <button type="submit" class="arrestatiedanger panel-item">
                                                <h5 class="panel-title"><?php echo $warrant['title']; ?></h5>
                                                <p class="panel-author">door: <?php echo $warrant['author']; ?></p>
                                            </button>
                                        </form>
                                    <?php }?>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="profile-reports-panel">
                        <div class="profile-lastincidents">
                            <form method="post" action="createreport" style="float:right; margin-left: 1vw;">
                                <input type="hidden" name="type" value="createnew">
                                <input type="hidden" name="profileid" value="<?php echo $selectedprofile['id']; ?>">
                                <button type="submit" name="issabutn"  class="btn btn-success btn-md my-0 ml-sm-2 newrapportbtn">NIEUW RAPPORT</button>
                            </form>
                            <form method="post" action="createwarrant" style="float:right;">
                                <input type="hidden" name="type" value="create">
                                <input type="hidden" name="profileid" value="<?php echo $selectedprofile['id']; ?>">
                                <button type="submit" name="issabutn"  class="btn btn-success btn-md my-0 ml-sm-2 newrapportbtn">NIEUW BEVEL</button>
                            </form>
                            <br />
                            <h5 class="panel-container-title">Laatste rapportages</h5>
                            <div class="panel-list">
                                <?php if (empty($reports_array)) { ?>
                                    <p>Geen reportages gevonden bij deze persoon..</p>
                                <?php } else { ?>
                                    <?php foreach($reports_array as $report) {?>
                                        <form method="post" action="reports">
                                            <input type="hidden" name="type" value="show">
                                            <input type="hidden" name="reportid" value="<?php echo $report['id']; ?>">
                                            <button type="submit" class="btn btn-panel panel-item">
                                                <h5 class="panel-title panelprof">#<?php echo $report['id']; ?> <?php echo $report['title']; ?></h5>
                                                <p class="panel-author panelaupro">door: <?php echo $report['author']; ?></p>
                                            </button>
                                        </form>
                                    <?php }?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                                    </div>
                <div class="left-panel-container">
                    <h5 class="panel-container-title">Laatste rapportages</h5>
                    <?php if(!empty($recentreports_array)) { ?>
                        <?php foreach($recentreports_array as $report) {?>
                            <form method="post" action="reports">
                                <input type="hidden" name="type" value="show">
                                <input type="hidden" name="reportid" value="<?php echo $report['id']; ?>">
                                <button type="submit" class="btn btn-panel panel-item" style="text-align:left!important;">
                                    <h5 class="panel-title">#<?php echo $report['id']; ?> <?php echo $report['title']; ?></h5>
                                    <p class="panel-author">door: <?php echo $report['author']; ?></p>
                                </button>
                            </form>
                        <?php }?>
                    <?php } else { ?>
                            <p>Geen personen opgezocht..</p>
                    <?php } ?>
                </div>  
                <!-- Right Container -->
                <div class="right-panel-container">
                    <h5 class="panel-container-title">Laatst opgezocht</h5>
                    <div class="panel-list">
                    <?php if(!empty($recentsearch_array)) { ?>
                        <?php foreach($recentsearch_array as $person) {?>
                            <form method="post" action="profiles">
                                <input type="hidden" name="type" value="show">
                                <input type="hidden" name="personid" value="<?php echo $person['id']; ?>">
                                <input type="hidden" name="citizenid" value="<?php echo $person['citizenid']?>">
                                <?php $_SESSION["citizenid"] = $person['citizenid']; ?>
                                
                                <button type="submit" class="btn btn-panel panel-item" style="text-align:left!important;">
                                    <h5 class="panel-title"><?php echo $person['fullname']; ?></h5>
                                    <p class="panel-author">BSN: <?php echo $person['citizenid']; ?></p>
                                </button>
                            </form>
                        <?php }?>
                    <?php } else { ?>
                            <p>Geen personen opgezocht..</p>
                    <?php } ?>
                    </div>
                    
                </div> 
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
