<?php
    require "requires/config.php";
    if (!$_SESSION['loggedin']) {
        Header("Location: login");
    }
    $result = $con->query("SELECT * FROM laws ORDER BY months ASC");
    $laws_array = [];
    while ($data = $result->fetch_assoc()) { 
        $laws_array[] = $data;
    }
    $respone = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['type'] == "createnew") {
            $query = $con->query("SELECT * FROM profiles WHERE id = ".$con->real_escape_string($_POST["profileid"]));
            $selectedprofile = $query->fetch_assoc();
        } elseif ($_POST['type'] == "create") {
            $profileid = NULL;
            $lawids = array_map('intval', explode(',', $_POST["laws"]));
            array_shift($lawids);
            if (isset($_POST["citizenid"]) && $_POST["citizenid"] != "") {
                $query = $con->query("SELECT * FROM profiles WHERE citizenid = '".$con->real_escape_string($_POST["citizenid"])."'");
                $profile = $query->fetch_assoc();
                if ($profile != NULL) {
                    $profileid = $profile["id"];
                }
            }
            $reportnote = nl2br($_POST["report"]);
            $insert = $con->query("INSERT INTO reports (title,author,profileid,report,laws,created) VALUES('".$con->real_escape_string($_POST['title'])."','".$con->real_escape_string($_POST['author'])."','".$con->real_escape_string($profileid)."','".$con->real_escape_string($reportnote)."', '".json_encode($lawids)."',".time().")");
            if ($insert) {
                $last_id = $con->insert_id;
                $_SESSION["reportid"] = $last_id;
                $respone = true;
                header('Location: reports');
            }
        } elseif ($_POST["type"] == "edit") {
            $query = $con->query("SELECT * FROM reports WHERE id = ".$con->real_escape_string($_POST['reportid']));
            $selectedreport = $query->fetch_assoc();
            $laws = json_decode($selectedreport["laws"], true);
            $lawsedit_array = [];
            $totalprice = 0;
            $totalmonths = 0;
            if (!empty($laws)) {
                foreach($laws as $lawid) {
                    $law = $con->query("SELECT * FROM laws WHERE id = ".$con->real_escape_string($lawid));
                    $selectedlaw = $law->fetch_assoc();
                    $totalmonths = $totalmonths + $selectedlaw["months"];
                    $totalprice = $totalprice + $selectedlaw["fine"];
                    $lawsedit_array[] = $selectedlaw;
                }
            }
            $profile = $con->query("SELECT * FROM profiles WHERE id = ".$con->real_escape_string($selectedreport['profileid']));
            $profiledata = $profile->fetch_assoc();
        } elseif ($_POST["type"] == "realedit") {
            $report = nl2br($_POST["report"]);
            $profile = $con->query("SELECT * FROM profiles WHERE citizenid = '".$con->real_escape_string($_POST['citizenid'])."'");
            $profileid = 0;
            if ($profile->num_rows > 0) {
                $profiledata = $profile->fetch_assoc();
                $profileid = $profiledata['id'];
            }
            $reportnote = nl2br($_POST["report"]);
            $update = $con->query("UPDATE reports SET title = '".$con->real_escape_string($_POST['title'])."', author = '".$con->real_escape_string($_POST['author'])."', profileid = ".$con->real_escape_string($profileid).", report = '".$con->real_escape_string($reportnote)."', created = ".time()." WHERE id = ".$_POST['reportid']);
            if ($update) {
                $_SESSION["reportid"] = $_POST['reportid'];
                $respone = true;
                header('Location: reports');
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

		<!-- Text editor CSS -->
		<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />

        <title>Politie Databank</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="assets/css/main.css" rel="stylesheet">
        <link href="assets/css/profiles.css" rel="stylesheet">
        <link href="assets/css/laws.css" rel="stylesheet">


    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-custom bg-custom">
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">

                <!-- Left menu -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-label" href="#">
                            <img src="assets/images/icon.png" width="22" height="22" alt="">
                            <span class="title">
                                Welkom <?php echo $_SESSION["rank"] . " " . $firstname . " " . substr($lastname, 0, 1); ?>.
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-button" href="logout">
                            <button class="btn btn-outline-light btn-logout my-2 my-sm-0" type="button">LOG UIT</button>
                        </a>
                    </li>
                </ul>

                <!-- Right menu -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard">DASHBOARD</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            OPZOEKEN
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profiles">PERSONEN</a>
                            <a class="dropdown-item" href="reports">REPORTS</a>
                            <!-- <a class="dropdown-item" href="#">VOERTUIGEN</a> -->
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="warrants">ARRESTATIEBEVELEN</a>
                    </li>
                    <?php if ($_SESSION["role"] == "admin") { ?>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ADMIN
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="laws">STRAFFEN</a>
                            <a class="dropdown-item" href="users">GEBRUIKERS</a>
                        </div>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link-report" href="createreport">NIEUW RAPPORT</a>
                    </li>
                </ul>
            </div>
        </nav>


        <main role="main" class="container">
            <div class="content-introduction">
                <h3>Report Maken</h3>
                <p class="lead">Hier kun je een nieuw reportage aanmaken.<br />Je kunt een BSN koppelen aan een reportage (Hiervoor MOET er een profiel bestaan) of je kan het leeg laten en later toevoegen.<br />Je kunt ook straffen toevoegen (wanneer nodig) onderaan de pagina.</br>Om een straf weg te halen kun je klikken op dezelfde straf bij "Geselecteerde Straffen"</p>
            </div>
            <div class="createreport-container">
                <div class="createreport-left">
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "edit" && !empty($selectedreport)) { ?>
                    <form method="post">
                        <input type="hidden" name="type" value="realedit">
                        <input type="hidden" name="author" class="form-control login-pass" value="<?php echo $_SESSION["name"]; ?>" placeholder="" required>
                        <input type="hidden" name="reportid" class="form-control login-pass" value="<?php echo $selectedreport["id"]; ?>" placeholder="" required>
                        <div class="input-group mb-3">
                            <input type="text" name="title" class="form-control login-user" value="<?php echo $selectedreport["title"]; ?>" placeholder="titel" required>
                        </div>
                        <?php if (!empty($profiledata)) { ?>
                            <div class="input-group mb-3">
                                <input type="text" name="citizenid" class="form-control login-user" value="<?php echo $profiledata["citizenid"]; ?>" placeholder="koppel bsn (mag leeg)">
                            </div>
                        <?php } else {?>
                            <div class="input-group mb-3">
                                <input type="text" name="citizenid" class="form-control login-user" value="" placeholder="koppel bsn (mag leeg)">
                            </div>
                        <?php } ?>
                        <?php $report = str_replace( "<br />", '', $selectedreport["report"]); ?>
                        <div class="input-group mb-2">
                            <textarea name="report" class="form-control" id="textVanRapport" value="" placeholder="reportage.." required><?php echo $report; ?></textarea>
                        </div>
						<script>
						document.getElementById("textVanRapport").style.width = "500px";
						</script>
                        <div class="form-group">
                            <button type="submit" name="create" class="btn btn-primary btn-police">Bewerk reportage</button>
                        </div>
                    </form>
                <?php } else { ?>
                    <form method="post">
                        <input type="hidden" name="type" value="create">
                        <input type="hidden" name="laws" class="report-law-punishments" value="">
                        <input type="hidden" name="author" class="form-control login-pass" value="<?php echo $_SESSION["name"]; ?>" placeholder="" required>
                        <div class="input-group mb-3">
                            <input type="text" name="title" class="form-control login-user" value="" placeholder="titel" required>
                        </div>
                        <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "createnew") { ?>
                            <div class="input-group mb-3">
                                <input type="text" name="citizenid" class="form-control login-user" value="<?php echo $selectedprofile["citizenid"]; ?>" placeholder="koppel bsn (mag leeg)">
                            </div>
                        <?php } else {?>
                            <div class="input-group mb-3">
                                <input type="text" name="citizenid" class="form-control login-user" value="" placeholder="koppel bsn (mag leeg)">
                            </div>
                        <?php } ?>
                        <div class="">
                            <textarea name="report" class="form-control" value="" placeholder="reportage.." required></textarea>
                        </div>				
                        <div class="form-group">
                            <button type="submit" name="create" class="btn btn-primary btn-police">Maak reportage</button>
                        </div>
                    </form>
                <?php } ?>
                </div>
                <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] == "edit" && !empty($selectedreport)) { ?>
                    <div class="createreport-right">
                        <h5>Geselecteerde Straffen</h5>
                        <p class="total-punishment">Totaal: €<?php echo $totalprice; ?> - <?php echo $totalmonths; ?> maanden</p>
                        <div class="added-laws">
                        <?php if (!empty($lawsedit_array)) { ?>
                            <?php foreach($lawsedit_array as $issalaw) { ?>
                                <div class="report-law-item" data-toggle="tooltip" data-html="true" title="<?php echo $issalaw["description"]; ?>">
                                    <h5 class="lawlist-title"><?php echo $issalaw["name"]; ?></h5>
                                    <p class="lawlist-fine">Boete: €<span class="fine-amount"><?php echo $issalaw["fine"]; ?></span></p>
                                    <p class="lawlist-months">Cel: <span class="months-amount"><?php echo $issalaw["months"]; ?></span> maanden</p>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="createreport-right">
                        <h5>Geselecteerde Straffen</h5>
                        <p class="total-punishment">Totaal: €0 - 0 maanden</p>
                        <div class="added-laws">
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if ($_SERVER['REQUEST_METHOD'] != "POST" || $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['type'] != "edit") { ?>
                <button type="button" class="btn btn-primary btn-police" id="togglelaws" style="margin-bottom:2vh!important;">TOGGLE STRAFFEN</button>
                <div class="laws">
                    <div class="lawlist-search">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Zoeken</span>
                            </div>
                            <input type="text" class="lawsearch form-control" aria-label="Zoeken" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <?php foreach($laws_array as $law){?>
                        <div class="report-law-item-tab" data-toggle="tooltip" data-html="true" title="<?php echo $law['description']; ?>">
                            <input type="hidden" class="lawlist-id" value="<?php echo $law['id']; ?>">
                            <h5 class="lawlist-title"><?php echo $law['name']; ?></h5>
                            <p class="lawlist-fine">Boete: €<span class="fine-amount"><?php echo $law['fine']; ?></span></p>
                            <p class="lawlist-months">Cel: <span class="months-amount"><?php echo $law['months']; ?></span> maanden</p>
                        </div>
                    <?php }?>
                    </div>
                </div>
				<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
				<script>
					new FroalaEditor('textarea');
				</script>
            <?php } ?>
        </main><!-- /.container -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
