<?php
    require "config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['type'] == "create") {
            $insert = $con->query("INSERT INTO aangifte (datum,agent,gestolengoed,naamslacht,locatie,gebeurtenis,bewijs,verdachtesign,created) VALUES('".$con->real_escape_string($_POST['datum'])."','".$con->real_escape_string($_SESSION['name'])."','".$con->real_escape_string($_POST['gestolengoed'])."','".$con->real_escape_string($_POST['naamslacht'])."','".$con->real_escape_string($_POST['locatie'])."','".$con->real_escape_string($_POST['gebeurtenis'])."','".$con->real_escape_string($_POST['bewijs'])."', '".$con->real_escape_string($_POST['verdachtesign'])."',".time().")");
            Header("Location: aangifteinzameling");
        }}


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
        <link href="../assets/css/main.css" rel="stylesheet">
        <link href="../assets/css/navbar.css" rel="stylesheet">
    </head>
    <body>
    <nav>
    <div class="sidebar-top">
      <span class="shrink-btn">
        <i class='bx bx-chevron-left'></i>
      </span>
      <img src="../assets/images/icon.png" class="logo" alt="">
      <h3 class="hide">Politie Fomato</h3>
    </div>

    <div class="search">
    </div>



    <div class="sidebar-links">
      <ul>
        <div style="top:233px;" class="active-tab"></div>
        <li class="tooltip-element" data-tooltip="0">
          <a href="../dashboard"  data-active="0">
            <div class="icon">
              <i class='bx bx-home'></i>
              <i class='bx bx-home'></i>
            </div>
            <span class="link hide">Dashboard</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="../profiles" data-active="1">
            <div class="icon">
              <i class='bx bx-male'></i>
              <i class='bx bx-male'></i>
            </div>
            <span class="link hide">Personen</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="../reports" data-active="2">
            <div class="icon">
              <i class='bx bx-message-square-detail'></i>
              <i class='bx bxs-message-square-detail'></i>
            </div>
            <span class="link hide">Rapportages</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="3">
          <a href="../warrants" data-active="3">
            <div class="icon">
              <i class='bx bx-target-lock'></i>
              <i class='bx bx-target-lock'></i>
            </div>
            <span class="link hide">Arrestatiebevelen</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="3">
          <a href="../archiefvieuwer" class="active" data-active="3">
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
        </div>
      </ul>
      
      
      
      <?php if ($_SESSION["role"] == "admin") { ?>
      <h4 class="hide">Leiding</h4>
      <ul>
        <li class="tooltip-element" data-tooltip="0">
          <a href="../users" data-active="4">
            <div class="icon">
              <i class='bx bx-male'></i>
              <i class='bx bx-male'></i>
            </div>
            <span class="link hide">Gebruikers</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="../laws" data-active="5">
            <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bx-folder'></i>
            </div>
            <span class="link hide">Straffen</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="../settings" data-active="6">
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
        <a href="../logout" class="log-out">
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
                <h3>Archief</h3>
                <p class="lead">Welkom in het grote politie archief!<br />Hier kan je alle informatie vinden die je nodig hebt tijdens of voor je dienst. 
                <br />
                <br />
                </p>
            </div>
            <div class="dashboard-container">
            <form method="post">
                        <input type="hidden" name="type" value="create">
                        <input type="hidden" name="author" class="form-control login-pass" value="<?php echo $_SESSION["name"]; ?>" placeholder="" required>
                        <div class="input-group mb-3">
                            <input  type="text" name="datum" class="form-control login-user"  value="(Titel Aangifte) | <?php echo date("d/m/Y") ?>, <?php echo date("H:i") ?>" placeholder="Datum en tijd incident" required>
                        </div>
                            <div class="input-group mb-3">
                                <input type="text" name="gestolengoed" class="form-control login-user" value="" placeholder="(Optioneel) Gestolen Goederen">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="naamslacht" class="form-control login-user" value="" required placeholder="Naam van het slachtoffer">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="locatie" class="form-control login-user" value="" required placeholder="Locatie">
                            </div>
                            <div class="input-group mb-3">
                                <textarea type="text" name="gebeurtenis" class="form-long login-user" value="" required placeholder="Wat is er gebeurd?"></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="bewijs" class="form-control login-user" value=""  placeholder="Bewijs">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="verdachtesign" class="form-control login-user" value="" required placeholder="Signalement Verdachte">
                            </div>				
                        <div class="form-group">
                            <button type="submit" name="create" class="btn btn-primary btn-police">Maak Aangifte</button>
                        </div>
                    </form>
                <?php  ?>
                </div>
            </div>

        </main><!-- /.container -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/app.js"></script>
    </body>
</html>
