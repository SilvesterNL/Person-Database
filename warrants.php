<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
        header('Cache-Control: no cache');
    }
    $response = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['type'] == "show") {
            $query = $con->query("SELECT * FROM warrants WHERE id = ".$con->real_escape_string($_POST['warrantid']));
            $selectedwarrant = $query->fetch_assoc();
            $profile = $con->query("SELECT * FROM profiles WHERE citizenid = '".$con->real_escape_string($selectedwarrant["citizenid"])."'");
            $profiledata = $profile->fetch_assoc();
            header('Cache-Control: no cache');
        } elseif ($_POST['type'] == "delete") {
            $sql = "DELETE FROM warrants WHERE id = ".$con->real_escape_string($_SESSION["warrantid"]);
            if ($con->query($sql)) {
                $response = true;
                header('Cache-Control: no cache');
            } else {
                echo "Error deleting record: " . mysqli_error($con);
                header('Cache-Control: no cache');
                exit();
            }
        }
    }
    $result = $con->query("SELECT * FROM warrants ORDER BY created DESC");
    header('Cache-Control: no cache');
    $warrant_array = [];
    while ($data = $result->fetch_assoc()) { 
      header('Cache-Control: no cache');
        $profile = $con->query("SELECT * FROM profiles WHERE citizenid = '".$con->real_escape_string($data["citizenid"])."'");
        $profiledata = $profile->fetch_assoc();
        $data["fullname"] = $profiledata["fullname"];
        $warrant_array[] = $data;
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
        <div style="top: 177.5px!important;" class="active-tab"></div>
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
          <a href="warrants" class="active" data-active="3">
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
                <h3>Arrestatiebevelen</h3>
                <p class="lead">Hier vind je alle arrestatiebevelen die zijn ingedeeld.<br/>Je kunt ook nieuwe arrestatiebevelen maken, deze mag je alleen aanmaken als je toestemming heb gekregen van de korpsleiding.<br /><strong>Deze kan je dan maken op het profiel van de persoon waar je het bevel wilt plaatsen.</strong></p>
            </div>
            <div class="warrants-container">
                <div class="warrants-list">
                    <h5 class="panel-container-title">Gezochte personen</h5>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["type"] == "delete" && $response) { ?>
                        <p style='color: #13ba2c;'>Bevel verwijderd!</p>
                    <?php } ?>
                    <?php if (empty($warrant_array)) { ?>
                        <p>Geen arrestatiebevelen..</p>
                    <?php } else { ?>
                        <?php foreach($warrant_array as $warrant) {?>
                            <form method="post">
                                <input type="hidden" name="type" value="show">
                                <input type="hidden" name="warrantid" value="<?php echo $warrant["id"]; ?>">
                                <button type="submit" class="btn warrant-item">
                                    <h5 class="warrant-title"><?php echo $warrant["title"]; ?> - <?php echo $warrant["fullname"]; ?></h5>
                                    <p class="warrant-author">door: <?php echo $warrant["author"]; ?></p>
                                    <?php $_SESSION["author"] = $warrant["author"]; ?>
                                    <?php 
                                        $datetime = new DateTime($warrant["created"]);
                                        echo '<p class="warrant-author">Aangemaakt: '.$datetime->format('d/m/y H:i').'</p>';
                                    ?>
                                </button>
                            </form>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="warrant-report">
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["type"] == "show") { ?>
                        <div class="report-show">
                          <div class="warrant">
                            <?php $_SESSION["warrantid"] = $selectedwarrant["id"] ?>
                            <img class="cjib" src="assets/images/cjib_logo.jpg" alt="cjib logo">
                            <strong style="font-size:13px">Afzender</strong><br>
                            <p>
                            Openbaar Ministerie
                            <br>
                            Coordinatie politie
                            <br>
                            Postbus 5116
                            <br>
                            5467 KA Fortis
                          </p>

                          <p class="warrantleft">
                            ARRESTATIEBEVEL
                            <br>
                            <?php echo $selectedwarrant["naam"] ?>
                            <br>
                            Burger service nummer 
                            <br>
                            <?php echo $selectedwarrant["citizenid"] ?>
                          </p>
                          <br>
                        <p>
                          De officier van justitie stelt dat de gestelde op verzoek van het lokaal OM gearresteerd dient te worden naar aanleidng van het overtreden van een of meerdere strafbare feiten.
                        </p>
                        <br />
                        <p>
                          Verbalisant
                          <br>
                          Naam:
                          <br>
                          Voornaam:
                          <br>
                          Bewijs:
                          <br>
                          Omschrijving:
                        </p>
                        <p class="warrantleft1"> 
                          <?php echo $selectedwarrant["author"] ?>
                          <br>
                          <?php echo $selectedwarrant["naam"] ?>
                          <br>
<?php $authorname = explode(" ", $selectedwarrant["naam"]);
    $authorfirst = $authorname[0]; ?>
                          <?php echo $authorfirst ?>
                          <br>
                          <?php echo $selectedwarrant["bewijs"] ?>
                          <br>
                          <?php echo $selectedwarrant["description"] ?>
                        </p>
                        <p> 
                          <br>
                          <br>
                          De officier gelast de dienaar van de openbare mach aan wie zulks wordt opgedragen en aan wie dit bevel ter hand wordt gesteld de veroordeelde onmiddelijk gevangen te nemen en over te brengen naar een poltiebureau waar hij/zij zal worden ingesloten om zijn/haar straf te ondergaan danwel tijdelijk zal worden ingesloten in afwachting van plaatsing in een penitentaire inrichting.
                          <br>
                          <br>

                          Fortis, <?php 
                                        $datetime = new DateTime($warrant["created"]);
                                        echo ''.$datetime->format('d/m/y H:i').'</p>';
                                    ?>
                          <br>
                          De officier van justitie
                        </p>
                          </div>
                        </div>
                       
                        <form method="post">
                            <input type="hidden" name="type" value="delete">
                            <input type="hidden" name="warrantid" value="<?php echo $warrant["id"]; ?>">
                            <div class="form-group">
                                <button type="submit" style="margin-top: 1vh; float: right;" name="create" class="btn btn-danger">VERWIJDER</button>
                            </div>
                        </form> 
                    <?php } ?>
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
