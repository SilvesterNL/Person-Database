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
           
           
            $totalprice = 0;
            if (!empty($lawids)) {
                foreach($lawids as $lawid) {
                    $law = $con->query("SELECT * FROM laws WHERE id = ".$con->real_escape_string($lawid));
                    $selectedlaw = $law->fetch_assoc();
                    $totalprice = $totalprice + $selectedlaw["fine"];
                }
            }

            $con->query("INSERT INTO bills (citizenid,type,amount) VALUES ('".$con->real_escape_string($_POST["citizenid"])."','police','".$con->real_escape_string($totalprice)."')");

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

    function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }
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

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="assets/css/main.css" rel="stylesheet">
        <link href="assets/css/profiles.css" rel="stylesheet">
        <link href="assets/css/laws.css" rel="stylesheet">

		 <!-- Froala text-editor scripts -->
        <link href="./_files/codemirror.min.css" rel="stylesheet">
        <script src="./_files/codemirror.min.js"></script>
        <script src="./_files/xml.min.js"></script>
        <link href="./_files/font-awesome.min.css" rel="stylesheet">
        <script src="./_files/froala_editor.pkgd.min.js"></script>
        <link href="./_files/froala_editor.pkgd.min.css" rel="stylesheet">
        <link href="./_files/froala_editor.min.css" rel="stylesheet">
        <script src="./_files/nl.js"></script>

		<!-- Froala Style Rules -->
        <style>
            .fr-box.fr-basic .fr-element.fr-view, 
            .fr-wrapper.show-placeholder .fr-element.fr-view {
                font-family: 'Roboto Mono', monospace!important;
            }

            .fr-toolbar {
                border-radius: .25rem .25rem 0vh 0vh !important;
                border: 1px solid #ced4da;
            }

            .second-toolbar {
                border-radius: 0vh 0vh .25rem .25rem !important;
                border: 1px solid #ced4da;
            }

            .fr-active{
                fill: #004682 !important;
            }

            .fr-floating-btn {
                border-radius:.25em !important;
            }

            .none {
                display:none;
            }
            
            .fr-wrapper::before{
                font-family: 'Roboto Mono', monospace!important;
                text-align: left;
                content: "Unlicensed copy of the Froala Editor. Use it legally by purchasing a license.";
                position:absolute;
                width:100%;
                z-index:10000;
                height:fit-content;

                padding: 12.5px 25px;
                color:#FFF;
                text-decoration:none;
                background-color:white;
                /* background:rgba(58, 122, 176); */
                display:block;
                font-size:14px;
                font-family:sans-serif;
            }

            .fr-quick-insert {
                display: none !important;
            }
        </style>


    </head>
    <body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom bg-custom">
        <a class="nav-label" href="#">
            <img src="assets/images/icon.png" width="22" height="22" alt="">
            <span class="title">
                               Welkom <?php echo $_SESSION["rank"] . " " . $firstname . " " . substr($lastname, 0, 1); ?>.
                            </span>
        </a>
        <a class="nav-button" href="logout">
            <button class="btn btn-outline-light btn-logout my-2 my-sm-0" type="button">LOG UIT</button>
        </a>

        <div class="navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
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
                            <textarea name="report" id="froala-editor" class="form-control" value="" placeholder="reportage.." required="" style="display: none;"><?php echo $report; ?></textarea>
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
            <?php } ?>
        </main><!-- /.container -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/main.js"></script>

		<!-- Froala Text-Editor (THIS CODE IS NOT IN SEPERATE FILE BECAUSE OF TESTING) -->
        <script>
            let name = <?php echo json_encode($firstname." ".$lastname); ?>;
            let rank = <?php echo json_encode($_SESSION["rank"]); ?>;
            let date = curday('-');
            let templates = [
                `<p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><img src="./assets/images/pv_logo.png" style="width: 205px; padding-top: 50px;" class="fr-fic fr-dii"></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14px;"><strong>EENHEID QUACKCITY</strong></span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span style="font-size: 14px; ">DISTRICT LS-ZUID</span></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span style="font-size: 14px; ">BASISTEAM MISSION ROW</span></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><br></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14px; ">Proces-verbaalnummer: (pv nummer)</span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;">
                    <br>
                </p>
                <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style="vertical-align: baseline;"><strong>M I N I - P R O C E S - V E R B A A L</strong></span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style="background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"><strong>beschikking</strong></span></p>
                <p >
                    <br>Ik, verbalisant, ${name}, ${rank} van Politie Eenheid QUACKCITY, verklaar het volgende.</p>
                <p >Op ${date}, omstreeks <span style="color: rgb(235, 107, 86);">TIJD</span> uur, bevond ik mij in uniform gekleed en met algemene politietaak belast op de openbare weg,&nbsp;</p>
                <p style="line-height: 1.2;">BEVINDINGEN</p>
                <p >Locatie:
                    <br>Gepleegde overtreding:
                    <br>Feitcode:
                    <br>Boetebedrag:
                    <br>Verklaring:&nbsp;</p>
                <p>
                    <br>
                    <br>
                </p>
                <p><em><span style="font-size: 10px;">Indien Snelheidsovertreding</span></em>
                    <br>Gemeten snelheid:
                    <br>Toegestane snelheid:
                    <br>Correctie: - 10%
                    <br>Uiteindelijke snelheid:&nbsp;</p>

                `
                ,
                `<p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><img src="./assets/images/pv_logo.png" style="width: 205px; padding-top: 50px;" class="fr-fic fr-dii"></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14px; "><strong>EENHEID QUACKCITY</strong></span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span style="font-size: 14px; ">DISTRICT LS-ZUID</span></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span style="font-size: 14px; ">BASISTEAM MISSION ROW</span></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;">
                    <br>
                </p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14px; ">Proces-verbaalnummer: (pv nummer)</span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;">
                    <br>
                </p>
                <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style=" vertical-align: baseline;"><strong>I N B E S L A G N A M E</strong></span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style=" background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"><strong>voertuig</strong></span></p>
                <p>
                    <br>
                </p>
                <p>
                    <br>
                </p>
                <p >Ik, verbalisant, ${name}, ${rank} van Politie Eenheid QuackCity, verklaar het volgende. Op ${date}, omstreeks <span style="color: rgb(235, 107, 86);">TIJD</span> uur, heb ik een of meerdere goederen van de heer/mevrouw <span style="color: rgb(235, 107, 86);">NAAM</span> in beslag genomen. </p>
                <p >
                    <br>
                </p>
                <p style=" line-height: 1.2;">BEVINDINGEN</p>
                <p >
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">Voertuigsoort:&nbsp;Personenauto/Motorfiets/Bromfiets
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">Merk/Type:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">Kleur:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">Kenteken:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">Reden:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">Ophaal-datum:&nbsp;</p>
                <p >
                    <br>
                </p>`
                /* `<p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><img src="./assets/images/pv_logo.png" style="width: 205px;" class="fr-fic fr-dii"></p>
                 <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span><strong>EENHEID LOS SANTOS</strong></span></p>
                 <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span>DISTRICT LS-ZUID</span></strong></p>
                 <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span>BASISTEAM MISSION ROW</span></strong></p>
                 <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;">
                     <br>
                 </p>
                 <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span>Proces-verbaalnummer: (pv nummer)</span></p>
                 <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;">
                     <br>
                 </p>
                 <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style="vertical-align: baseline;"><strong>P R O C E S - V E R B A A L</strong></span></p>
                 <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style="background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"><strong>bewijsmateriaal</strong></span></p>
                 <p>
                     <br>
                 </p>
                 <p>
                     <br>
                 </p>
                 <p>Ik, verbalisant, ${name}, ${rank} van Politie Eenheid Los Santos, verklaar het volgende.</p>
                 <p>
                     <br>
                 </p>
                 <p style="line-height: 1.2;">BEVINDINGEN</p>
                 <p >
                     <br style="box-sizing: border-box; color: rgb(65, 65, 65);">Adres Bedrijf/Winkel:&nbsp;
                     <br style="box-sizing: border-box; color: rgb(65, 65, 65);">Datum/tijd:&nbsp;
                     <br style="box-sizing: border-box; color: rgb(65, 65, 65);">Bewijs:&nbsp;</p>

                 <p>
                     <br>
                 </p> */
                ,
                `<p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><img src="./assets/images/pv_logo.png" style="width: 205px; padding-top: 50px;" class="fr-fic fr-dii"></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14px; "><strong>EENHEID QUACKCITY</strong></span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span style="font-size: 14px; ">DISTRICT LS-ZUID</span></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span style="font-size: 14px; ">BASISTEAM MISSION ROW</span></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><br></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14px; ">Proces-verbaalnummer: (pv nummer)</span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;">
                    <br>
                </p>
                <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style=" vertical-align: baseline;"><strong>P R O C E S - V E R B A A L</strong></span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style="background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"><strong>aangifte</strong></span></p>
                <p >Feit:
                    <br>Plaatsdelict:
                    <br>Pleegdatum/tijd:&nbsp;</p>
                <p >
                    <br>
                </p>
                <p >Ik, verbalisant, ${name}, ${rank} van Politie Eenheid QuackCity, verklaar het volgende.</p>
                <p >Op ${date}, <span style="color: rgb(235, 107, 86);">TIJD</span> uur, verscheen voor mij, in het politiebureau, Mission Row, Sinner Street, QuackCity, een persoon, de aangever die mij opgaf te zijn:&nbsp;</p>
                <p >Achternaam:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65);">Voornamen:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65);">Geboren:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65);">Geboorteplaats:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65);">Geslacht:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65);">Nationaliteit:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65);">Adres:&nbsp;</p>

                <p >Hij/Zij deed aangifte en verklaarde het volgende over het in de aanhef vermelde incident, dat plaatsvond op de locatie genoemd bij plaats delict, op de genoemde pleegdatum/tijd.</p>
                <p style=" line-height: 1.2;">
                    <br>
                </p>
                <p style=" line-height: 1.2;">BEVINDINGEN:</p>
                <p >
                    <br>
                </p>
                <p >Aan niemand werd het recht of de toestemming geven tot het plegen van dit feit.</p>
                <p >De verbalisant,</p>
                <p >${name}</p>
                <p >
                    <br>
                </p>
                <p >Ik, <span style="color: rgb(235, 107, 86);">NAAM AANGEVER</span>, verklaar dat ik dit proces-verbaal heb gelezen. Ik verklaar dat ik de waarheid heb verteld. Ik verklaar dat mijn verhaal goed is weergegeven in het proces-verbaal. Ik weet dat het doen van een valse aangifte strafbaar is.</p>
                <p >De aangever,</p>
                <p style=" line-height: 1.2; color: rgb(235, 107, 86);">NAAM AANGEVER</p>
                <p style=" line-height: 1.2; color: rgb(235, 107, 86);">
                    <br>
                </p>
                <p style=" line-height: 1.2; color: rgb(235, 107, 86);">
                    <br>
                </p>
                <p style=" line-height: 1.2;"><strong>Eventuele opmerkingen verbalisant</strong></p>
                <p style=" line-height: 1.2;">
                    <br>
                </p>
                <p >Waarvan door mij is opgemaakt dit proces-verbaal, dat ik sloot en ondertekende te QuackCity op ${date}/<span style='color: rgb(235, 107, 86); font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;'>TIJD</span>&nbsp;</p>
                <p >${name}</p>`
                ,
                `<p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><img src="./assets/images/pv_logo.png" style="width: 205px; padding-top: 50px;" class="fr-fic fr-dii"></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14px; "><strong>EENHEID QUACKCITY</strong></span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span style="font-size: 14px; ">DISTRICT LS-ZUID</span></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span style="font-size: 14px; ">BASISTEAM MISSION ROW</span></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><br></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14px; ">Proces-verbaalnummer: (pv nummer)</span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;">
                    <br>
                </p>
                <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style=" vertical-align: baseline;"><strong>P R O C E S - V E R B A A L</strong></span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style=" background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"><strong>aanhouding</strong></span></p>
                <p >
                    <br>Ik, verbalisant, ${name}, ${rank} van Politie Eenheid QuackCity, verklaar het volgende.</p>
                <p >Op ${date}, omstreeks <span style="color: rgb(235, 107, 86);">TIJD</span> uur, bevond ik mij in uniform gekleed en met algemene politietaak belast op de openbare weg,</p>
                <p >Daar heb ik aangehouden:
                    <br>Een verdachte die op basis van nader identiteitsonderzoek, bleek te zijn:&nbsp;</p>
                <p >Achternaam:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">Voornamen:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">Geboren:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">Geslacht:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">Nationaliteit:&nbsp;
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-family: ;">BSN:&nbsp;
                </p>
                <p ><b>Identiteitsfouillering:</b>
                    <br>Ja/Nee</p>
                <p ><b>Veiligheidsfouillering:</b>
                    <br>Ja/Nee</p>
                <p ><b>Inbeslagneming:</b>
                    <br>Ja/Nee, zo ja wat?</p>
                <p ><b>Gebruik transportboeien:</b>
                    <br>Ja/Nee</p>
                <p ><b>Gebruik geweld:</b>
                    <br>Ja/Nee</p>
                <p ><b>Rechtsbijstand:</b>
                    <br>Ja/Nee</p>
                <p >
                    <br>
                </p>

                <p ><b>Reden van aanhouding:</b>
                    <br>De verdachte werd aangehouden als verdachte van overtreding van artikel(en).</p>
                <p >
                    <br>
                </p>
                <p style=" line-height: 1.2;"><b>Bevindingen:</b></p>
                <p style=" line-height: 1.2;">
                    <br>
                </p>
                <br>
                <p ><b>Ik heb de verdachte tijdens de aanhouding verteld dat hij/zij zich mag beroepen op zijn zwijgrecht.</b>
                <br>Ja/Nee</p>
                <p >
                    <br>
                </p>
                <p ><b>Voorgeleiding:</b>
                    <br>Op genoemd bureau werd de verdachte ten spoedigste voorgeleid voor de hulpofficier van justitie. Deze gaf op te <span style="color: rgb(235, 107, 86);">TIJD</span> uur het bevel de verdachte op te houden voor onderzoek.</p>
                <p >
                    <br>
                </p>
                <p >Waarvan door mij, ${name}, op ambtseed is opgemaakt, dit proces-verbaal te QuackCity op ${date}/<span style="color: rgb(235, 107, 86);">TIJD</span>.</p>
                <p >
                    <br>
                </p>
                <p ><b>Strafeis:</b>
                    <br><b>Gekregen straf:</b></p>`
                ,
                `<p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><img src="./assets/images/pv_logo.png" style="width: 205px;" class="fr-fic fr-dii"></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14px; "><strong>EENHEID QUACKCITY</strong></span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span style="font-size: 14px; ">DISTRICT LS-ZUID</span></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><strong><span style="font-size: 14px; ">BASISTEAM MISSION ROW</span></strong></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;">
                    <br>
                </p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14px; ">Proces-verbaalnummer: (pv nummer)</span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: left; margin-top: 0pt; margin-bottom: 0pt;">
                    <br>
                </p>
                <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style=" vertical-align: baseline;"><strong>P R O C E S - V E R B A A L</strong></span></p>
                <p dir="ltr" style="line-height: 1.38; text-align: center; margin-top: 0pt; margin-bottom: 0pt;"><span style=" background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"><strong>bewijsmateriaal</strong></span></p>
                    <br>
                </p>
                <p >Ik, verbalisant, ${name}, ${rank} van Politie Eenheid QuackCity, verklaar het volgende.</p>
                <p >
                    <br>
                </p>
                <p style=" line-height: 1.2;">BEVINDINGEN</p>
                <p style=" line-height: 1.2;">
                    <br>
                </p>
                <p ><span style='color: rgb(65, 65, 65); font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;'>Adres Bedrijf/Winkel:&nbsp;</span>
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;"><span style='color: rgb(65, 65, 65); font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;'>Datum/tijd:&nbsp;</span>
                    <br style="box-sizing: border-box; color: rgb(65, 65, 65); font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;"><span style='color: rgb(65, 65, 65); font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;'>Bewijs</span>:&nbsp;</p>
                <p >
                    <br>
                </p>`
            ];


            FroalaEditor.DefineIcon('sjablonen', {NAME: 'cog', SVG_KEY: 'add'});
            FroalaEditor.RegisterCommand('sjablonen', {
                title: 'Sjablonen',
                type: 'dropdown',
                focus: false,
                undo: true,
                refreshAfterCallback: true,
                options: {
                    '0': 'Mini Proces Verbaal',
                    '1': 'Voertuig Inbeslagname',
                    '2': 'Proces Verbaal Aangifte',
                    '3': 'Proces Verbaal Aanhouding',
                    '4': 'Proces Verbaal Bewijsmateriaal'
                },
                callback: function (cmd, val) {
                    this.html.insert(templates[val]);
                },
                // Callback on refresh.
                refresh: function ($btn) {
                },
                // Callback on dropdown show.
                refreshOnShow: function ($btn, $dropdown) {
                },
            });

            new FroalaEditor('textarea', {
                width: '100%',
                attribution: false,
                imageUpload: false,
                useClasses: false,
                language: 'nl',
                placeholderText: "Rapportage opstellen...",
                toolbarButtons: 	{
                    'moreText': {
                        'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontSize', 'textColor', 'backgroundColor', 'clearFormatting']
                    },
                    'moreParagraph': {
                        'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'lineHeight', 'outdent', 'indent'],
                        'buttonsVisible': 3
                    },
                    'moreRich': {
                        'buttons': [ 'sjablonen', 'insertLink', 'insertImage', 'insertTable', 'fontAwesome', 'specialCharacters', 'insertHR'],
                        'buttonsVisible': 3
                    },
                    'moreMisc': {
                        'buttons': ['undo', 'redo', 'fullscreen', 'spellChecker', 'selectAll', 'help'],
                        'align': 'right',
                        'buttonsVisible': 2
                    }
                },
                imageDefaultDisplay: 'block',
                imageInsertButtons: ['imageByURL'],
                imageEditButtons: ['imageReplace', 'imageAlign', 'imageSize', 'linkOpen', 'linkEdit', 'linkRemove', 'imageDisplay', 'imageAlt', 'imageRemove']
            });

            function curday(sp){
                today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //As January is 0.
                var yyyy = today.getFullYear();

                if(dd<10) dd='0'+dd;
                if(mm<10) mm='0'+mm;
                return (dd+sp+mm+sp+yyyy);
            };

            setTimeout(() => {
                $("#logo").html("");
            }, 100);
        </script>
        <script>

        </script>
    </body>
</html>
