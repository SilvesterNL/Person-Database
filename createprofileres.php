<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
    }
    $respone = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['type'] == "create") {
            $note = nl2br($_POST["note"]);
            $insert = $con->query("INSERT INTO profiles (citizenid,fullname,avatar,fingerprint,dnacode,punten,note,lastsearch) VALUES('".$con->real_escape_string($_POST['citizenid'])."','".$con->real_escape_string($_POST['fullname'])."','".$con->real_escape_string($_POST['avatar'])."','".$con->real_escape_string($_POST['fingerprint'])."','".$con->real_escape_string($_POST['dnacode'])."','".$con->real_escape_string($_POST['punten'])."','".$con->real_escape_string($note)."',".time().")");
            if ($insert) {
                $last_id = $con->insert_id;
                $_SESSION["personid"] = $last_id;
                $respone = true;
                header('Location: profiles');
            }
        } elseif ($_POST['type'] == "edit") {
            $query = $con->query("SELECT * FROM profiles WHERE id = ".$con->real_escape_string($_POST['profileid']));
            $selectedprofile = $query->fetch_assoc();
        } elseif ($_POST['type'] == "realedit") {
            $note = nl2br($_POST["note"]);
            $update = $con->query("UPDATE profiles SET citizenid = '".$con->real_escape_string($_POST['citizenid'])."', fullname = '".$con->real_escape_string($_POST['fullname'])."', avatar = '".$con->real_escape_string($_POST['avatar'])."', fingerprint = '".$con->real_escape_string($_POST['fingerprint'])."', dnacode = '".$con->real_escape_string($_POST['dnacode'])."', punten = '".$con->real_escape_string($_POST['punten'])."', note = '".$con->real_escape_string($note)."' WHERE id = ".$_POST['profileid']);
            if ($update) {
                $_SESSION["personid"] = $_POST['profileid'];
                $respone = true;
                header('Location: profiles');
            } else {
                $response = false;
            }
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
        <div style="top: 58.5px!important;" class="active-tab"></div>
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
          <a href="profiles" class="active" data-active="1">
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
                <h3>Profiel Maken</h3>
                <p class="lead">Hier maak je een profiel aan als een nieuwe crimineel in wordt gebracht.<br />Zorg ervoor dat alle gegevens kloppen en dat er een juiste foto is geplaatst!</p>
            </div>
            <div class="createprofile-container">
            <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "edit" && !empty($selectedprofile)) { ?>
                <form method="post">
                    <input type="hidden" name="type" value="realedit">
                    <input type="hidden" name="profileid" value="<?php echo $selectedprofile["id"]; ?>">
                    <div class="input-group mb-3">
                        <input type="text" name="citizenid" class="form-control login-user" value="<?php echo $selectedprofile["citizenid"]; ?>" placeholder="bsn" required>
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" name="fullname" class="form-control login-pass" value="<?php echo $selectedprofile["fullname"]; ?>" placeholder="volledige naam" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="avatar" class="form-control login-user" value="<?php echo $selectedprofile["avatar"]; ?>" placeholder="profiel foto (imgur URL vb. https://i.imgur.com/zKDjdhe.png)" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="fingerprint" class="form-control login-user" value="<?php echo $selectedprofile["fingerprint"]; ?>" placeholder="vinger patroon">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="dnacode" class="form-control login-user" value="<?php echo $selectedprofile["dnacode"]; ?>" placeholder="dna code">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="punten" class="form-control login-user" value="<?php echo $selectedprofile["punten"]; ?>" placeholder="Punten">
                    </div>
                    <?php $notes = str_replace( "<br />", '', $selectedprofile["note"]); ?>
                    <div class="input-group mb-2">
                        <textarea name="note" class="form-control" value="<?php echo $notes; ?>" placeholder="notitie" required><?php echo $notes; ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="create" class="btn btn-primary btn-police">Pas Aan</button>
                    </div>
                </form>
            <?php } else { ?>
                <form method="post">
                    <input type="hidden" name="type" value="create">
                    <div class="input-group mb-3">
                        <input type="text" name="citizenid" class="form-control login-user" value="" placeholder="bsn" required>
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" name="fullname" class="form-control login-pass" value="" placeholder="volledige naam" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="avatar" class="form-control login-user" value="" placeholder="profiel foto (imgur URL vb. https://i.imgur.com/zKDjdhe.png)">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="fingerprint" class="form-control login-user" value="" placeholder="vinger patroon">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="dnacode" class="form-control login-user" value="" placeholder="dna code">
                    </div>
                    <div class="input-group mb-2">
                        <textarea name="note" class="form-control" value="" placeholder="notitie"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="create" class="btn btn-primary btn-police">Voeg toe</button>
                    </div>
                </form>
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