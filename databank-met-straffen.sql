-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 okt 2020 om 09:49
-- Serverversie: 10.4.13-MariaDB
-- PHP-versie: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databank1`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `laws`
--

CREATE TABLE `laws` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fine` int(11) NOT NULL DEFAULT 0,
  `months` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `laws`
--

INSERT INTO `laws` (`id`, `name`, `description`, `fine`, `months`) VALUES
(9, 'R602 - Niet stoppen voor het rode licht', 'Voor rood lichtnegatie bekeuren omdat verbalisant zelf groen heeft is onvoldoende; nagaan of verkeerslicht dat betrokkene passeerde goed werkte; of er daadwerkelijk sprake is van rood licht bij groen voor verbalisant.', 240, 0),
(10, 'R601 - Niet door rijden bij groen licht', 'Niet door rijden bij groen licht', 140, 0),
(11, 'R628b - Niet opvolgen stopteken politie', 'Stopt niet bij een stopteken ', 415, 0),
(12, 'R326 - Rechts inhalen', 'Rechts inhalen', 240, 0),
(13, 'D505 - Baldadigheid', 'Op de openbare weg of op een voor publiek toegankelijke plaats tegen goederen of personen baldadigheid plegen\r\nstraatschenderij; waaruit bleek dit; feitelijke baldadigheid beschrijven.', 415, 0),
(14, 'D510 - Openbare dronkenschap', 'In het openbaar in staat van dronkenschap het verkeer belemmeren, de orde verstoren of een anders veiligheid bedreigen waaruit bleek dit; welke symptomen waargenomen.', 415, 0),
(15, 'D517 - Identiteitsbewijs', 'Niet voldoen aan de verplichting om een identiteitsbewijs ter inzage aan te bieden feiten en omstandigheden vermelden waarom vordering redelijkerwijze noodzakelijk werd geacht.', 95, 0),
(16, 'D515 - Valse gegevens', 'Een valse naam, voornaam, geboortedatum, -plaats, BRP-adres of woon of verblijfplaats opgeven door welk bevoegd gezag gevraagd; verificatie; wat was onjuist; wiens gegevens gebruikt en wat was de reden.', 300, 0),
(17, 'D537 - Verboden toegang', 'Bevind zich in een gebied waar de persoon niet mag komen ', 95, 0),
(18, 'F116a - Inbrekerswerktuig', 'Het is verboden op een openbare plaats inbrekerswerktuigen te vervoeren of bij zich te hebben. \r\n2. Het is verboden op de weg of in de nabijheid van winkels te vervoeren of bij zich te hebben een voorwerp dat er kennelijk toe is uitgerust om het plegen van (winkel)diefstal te vergemakkelijken', 415, 0),
(19, 'F120a - Klimmen en klauteren', 'Klimmen of zich bevinden op een beeld, monument, overkapping, constructie, openbare toiletgelegenheid, voertuig, hek, heining of andere afsluiting, verkeersmeubilair of daarvoor niet bestemd straatmeubilair waarop?', 95, 0),
(20, 'F120b - Overlast veroorzaken', 'Zich zodanig ophouden dat voor andere gebruikers of bewoners van nabij die plaats gelegen woningen onnodige overlast of hinder wordt veroorzaakt waaruit bleek dit?', 140, 0),
(22, 'F125a - onnodig ophouden', 'Zonder redelijk doel zich in een portiek/poort ophouden, op/tegen een raamkozijn/drempel van een gebouw zitten/liggen waar.', 95, 0),
(24, 'R486 - Voorrangsvoertuig niet voor laten gaan', 'Voorrangsvoertuig niet voor laten gaan werden optische en geluidssignalen gevoerd; mate van hinder.', 240, 0),
(25, 'R397 - Foutief parkeren', 'Als bestuurder een voertuig parkeren op een andere plaats dan daarvoor bestemd is. ', 95, 0),
(26, 'R395 - Gevaar of hinder veroorzaken met stilstaand voertuig', 'Een voertuig op een zodanige wijze laten staan waardoor op de weg gevaar wordt/kan worden veroorzaakt, dan wel het verkeer wordt/kan worden gehinderd gevaar; situatie omschrijven; cat. 4 uitsluitend gehandicaptenvoertuig\r\nmet motor.', 140, 0),
(33, 'R536a - Geen helm dragen op een bromfiets', 'Geen goedgekeurde en goed passende/deugdelijk bevestigde helm dragen. Als bestuurder, passagier bromfiets of brommobiel zonder gesloten carrosserie kinband; soort; geen helm.', 95, 0),
(34, 'Geen helm dragen op een motorfiets', 'Geen goedgekeurde en goed passende/deugdelijk bevestigde helm dragen. Als bestuurder, passagier motorfiets dan wel driewielig motorvoertuig zonder gesloten carrosserie.', 140, 0),
(35, 'Administratiekosten', 'Administratiekosten die wettelijk zijn berekend.', 9, 0),
(36, 'R551a - Eenrichtingsweg overige wegen', 'Handelen in strijd met geslotenverklaring, als bestuurder van een motorvoertuig, bromfiets of snorfiets op autoweg of autosnelweg (spookrijden)', 140, 0),
(37, 'Artikel 5 - Wegenverkeerswet', 'Het is een ieder verboden zich zodanig te gedragen dat gevaar op de weg wordt veroorzaakt of kan worden veroorzaakt of dat het verkeer op de weg wordt gehinderd of kan worden gehinderd. 3 maanden voorwaardelijk', 1500, 3),
(42, 'Afsleepkosten ', 'Als je een auto moet laten wegslepen', 1499, 0),
(43, 'Artikel 327 - Bedrog', 'Artikel 3261.Hij die, met het oogmerk om zich of een ander wederrechtelijk te bevoordelen, hetzij door het aannemen van een valse naam of van een valse hoedanigheid, hetzij door listige kunstgrepen, hetzij door een samenweefsel van verdichtsels, iemand beweegt tot de afgifte van enig goed, tot het verlenen van een dienst, tot het ter beschikking stellen van gegevens, tot het aangaan van een schuld of tot het teniet doen van een inschuld, wordt, als schuldig aan oplichting, gestraft met gevangenisstraf van ten hoogste vier jaren of geldboete van de vijfde categorie.2.Indien het feit wordt gepleegd met het oogmerk om een terroristisch misdrijf voor te bereiden of gemakkelijk te maken, wordt de op het feit gestelde gevangenisstraf met een derde verhoogd.\r\n', 21450, 0),
(44, 'Artikel 435a - Overtreding openbare orde ', 'Hij die in het openbaar kledingstukken of opzichtige onderscheidingstekens draagt of voert, welke uitdrukking zijn van een bepaald staatkundig streven, wordt gestraft met hechtenis van ten hoogste twaalf dagen of geldboete van de tweede categorie.', 4350, 0),
(45, 'Artikel 447e - Wet identificatieplicht', 'Hij die niet voldoet aan de verplichting om een identiteitsbewijs ter inzage aan te bieden of medewerking te verlenen aan het nemen van een of meer vingerafdrukken, hem opgelegd krachtens de Wet op de identificatieplicht.', 2350, 1),
(46, 'ARtikel 461 - Verboden toegang', 'Zonder daartoe gerechtigd te zijn zich bevinden op eens anders grond, waarvan de toegang op blijkbare wijze was\r\nverboden op welke blijkbare wijze was de toegang verboden; waar bevond verdachte zich; niet op kenteken.\r\n', 415, 1),
(47, 'Artikel 367 - Helpen bij ontsnapping', 'De ambtenaar die, belast met de bewaking van iemand die op openbaar gezag of krachtens rechterlijke uitspraak of beschikking van de vrijheid is beroofd, hem opzettelijk laat ontsnappen of bevrijdt of bij zijn bevrijding of zelfbevrijding behulpzaam is, wordt gestraft met gevangenisstraf van ten hoogste drie jaren of geldboete van de vierde categorie. Indien de ontsnapping, bevrijding of zelfbevrijding aan zijn schuld te wijten is, wordt hij gestraft met hechtenis van ten hoogste twee maanden of geldboete van de tweede categorie.', 4350, 36),
(48, 'f310 - Zedelijkheid', 'Zich op of aan de weg of op een vanaf die weg waarneembare plaats bevinden in een houding, toestand of kleding, die uit het oogpunt van openbare zedelijkheid kennelijk kwetsend is of redelijkerwijs kan worden geacht.', 4150, 3),
(49, 'Artikel 184 - Niet voldoen aan een bevel of vordering', 'Hij die opzettelijk niet voldoet aan een bevel of een vordering, krachtens wettelijk voorschrift gedaan door een ambtenaar met de uitoefening van enig toezicht belast of door een ambtenaar belast met of bevoegd verklaard tot het opsporen of onderzoeken van strafbare feiten, alsmede hij die opzettelijk enige handeling, door een van die ambtenaren ondernomen ter uitvoering van enig wettelijk voorschrift, belet, belemmert of verijdelt.', 2350, 3),
(51, 'Artikel 267 - Beleding ambt.', 'Belediging van een ambtenaar gedurende of ter zake van de rechtmatige uitoefening van zijn bediening.', 415, 4),
(52, 'Artikel 180 - Wederspanningheid', 'Hij die zich met geweld of bedreiging met geweld verzet tegen een ambtenaar werkzaam in de rechtmatige uitoefening van zijn bediening, of tegen personen die hem daarbij krachtens wettelijke verplichting of op zijn verzoek bijstand verlenen, wordt als schuldig aan wederspannigheid gestraft met gevangenisstraf van ten hoogste een jaar of geldboete van de derde categorie.', 8350, 6),
(53, 'Artikel 9 - Wegenverkeerswet', 'Het is degene die weet of redelijkerwijs moet weten dat hem bij rechterlijke uitspraak of strafbeschikking de bevoegdheid tot het besturen van motorrijtuigen is ontzegd, verboden gedurende de tijd dat hem die bevoegdheid is ontzegd, op de weg een motorrijtuig te besturen of als bestuurder te doen besturen. word gestraft met een bekeuring van de 1ste cat.', 0, 6),
(54, 'Artikel 25 - WWM CAT. II', '(Cat. II: Vuurwapens: pistolen, revolvers, heavy pistol) \r\n\r\nHet is verboden een wapen of munitie van de categorieen II voorhanden te hebben.', 8350, 50),
(55, 'Artikel 188 - Valse aangifte', 'Hij die aangifte of klacht doet dat een strafbaar feit gepleegd is, wetende dat het niet gepleegd is, wordt gestraft met gevangenisstraf van ten hoogste een jaar of geldboete van de derde categorie. ', 8350, 12),
(56, 'Artikel 27 - WWM CAT IV', '(Cat. IV: Grote geweren, automatisch geweren: AK, Carbine rifle, Compact rifle) \r\nHet is verboden een wapen van de categorieen IV te dragen.', 15350, 70),
(57, 'Artikel 138 - Huisvredebreuk', 'Hij die in de woning of het besloten lokaal of erf, bij een ander in gebruik, wederrechtelijk binnendringt of, wederrechtelijk aldaar vertoevende, zich niet op de vordering van of vanwege de rechthebbende aanstonds verwijdert.\r\n\r\nHij die zich de toegang heeft verschaft door middel van braak of inklimming, van valse sleutels, van een valse order of een vals kostuum, of die, zonder voorkennis van de rechthebbende en anders dan ten gevolge van vergissing binnengekomen, aldaar wordt aangetroffen in de voor de nachtrust bestemde tijd, wordt geacht te zijn binnengedrongen.', 3050, 30),
(58, 'Artikel 196 - Onrechtmatig voordoen als politie ambt.', 'Hij die in het openbaar kledingstukken of opzichtige onderscheidingstekens draagt of voert, welke uitdrukking zijn van een bepaald staatkundig streven, wordt gestraft met hechtenis van ten hoogste twaalf dagen of geldboete van de tweede categorie.', 435, 12),
(59, 'Artikel 261 Smaad & Laster', '1.Hij die opzettelijk iemands eer of goede naam aanrandt, door telastlegging van een bepaald feit, met het kennelijke doel om daaraan ruchtbaarheid te geven, wordt, als schuldig aan smaad, gestraft met gevangenisstraf van ten hoogste zes maanden of geldboete van de derde categorie.2.Indien dit geschiedt door middel van geschriften of afbeeldingen, verspreid, openlijk tentoongesteld of aangeslagen, of door geschriften waarvan de inhoud openlijk ten gehore wordt gebracht, wordt de dader, als schuldig aan smaadschrift, gestraft met gevangenisstraf van ten hoogste een jaar of geldboete van de derde categorie.3.Noch smaad, noch smaadschrift bestaat voor zover de dader heeft gehandeld tot noodzakelijke verdediging, of te goeder trouw heeft kunnen aannemen dat het te last gelegde waar was en dat het algemeen belang de telastlegging eiste.\r\n', 4750, 12),
(61, 'F173a - Handelen in verdovende middelen', 'Zich op een openbare plaats ophouden met het kennelijke doel om middelen als bedoeld in artikel 2 en 3 van de Opiumwet of daarop gelijkende waar, al dan niet tegen betaling af te leveren, aan te bieden of te verwerven, daarbij behulpzaam te zijn of daarin te bemiddelen waaruit kon worden aangenomen dat werd gehandeld.', 4150, 24),
(62, 'Artikel 307 - Dood door schuld', '1.Hij aan wiens schuld de dood van een ander te wijten is, wordt gestraft met gevangenisstraf van ten hoogste twee jaren of geldboete van de vierde categorie.\r\n\r\n2.Indien de schuld bestaat in roekeloosheid, wordt hij gestraft met gevangenisstraf van ten hoogste vier jaren of geldboete van de vierde categorie. ', 8350, 24),
(63, 'Artikel 350 - Vernieling', '1\r\nHij die opzettelijk en wederrechtelijk enig goed dat geheel of ten dele aan een ander toebehoort, vernielt, beschadigt, onbruikbaar maakt of wegmaakt, wordt gestraft met gevangenisstraf van ten hoogste twee jaren of geldboete van de vierde categorie.\r\n2\r\nGelijke straf wordt toegepast op hem die opzettelijk en wederrechtelijk een dier dat geheel of ten dele aan een ander toebehoort, doodt, beschadigt, onbruikbaar maakt of wegmaakt. ', 4350, 36),
(64, 'Artikel 285 - Bedreiging ', 'Bedreiging met openlijk in vereniging geweld plegen tegen personen of goederen, met geweld tegen een internationaal beschermd persoon of diens beschermde goederen, met enig misdrijf waardoor gevaar voor de algemene veiligheid van personen of goederen of gemeen gevaar voor de verlening van diensten ontstaat, met verkrachting, met feitelijke aanranding van de eerbaarheid, met enig misdrijf tegen het leven gericht, met gijzeling, met zware mishandeling of met brandstichting. Indien deze bedreiging schriftelijk en onder een bepaalde voorwaarde geschiedt. Bedreiging met een terroristisch misdrijf wordt gestraft met gevangenisstraf van ten hoogste zes jaren of geldboete van de vijfde categorie. Indien het feit, omschreven in het eerste, tweede of derde lid, wordt gepleegd met het oogmerk om een terroristisch misdrijf voor te bereiden of gemakkelijk te maken, wordt de op het feit gestelde gevangenisstraf met een derde verhoogd.', 2500, 24),
(65, 'Artikel 300 - Mishandeling', 'Met mishandeling wordt gelijkgesteld opzettelijke benadeling van de gezondheid.', 4350, 36),
(66, 'Artikel 310 - Eenvoudige diefstal', 'Hij die enig goed dat geheel of ten dele aan een ander toebehoort wegneemt, met het oogmerk om het zich wederrechtelijk toe te eigenen, wordt, als schuldig aan diefstal.', 3500, 36),
(68, 'Artikel 141 - Openlijke geweldpleging', 'Zij die openlijk in vereniging geweld plegen tegen personen of goederen.', 4350, 6),
(70, 'Artikel 216 - Heling', 'Hij die een goed verwerft, voorhanden heeft of overdraagt, dan wel een persoonlijk recht op of een zakelijk recht ten aanzien van een goed vestigt of overdraagt, terwijl hij ten tijde van de verwerving of het voorhanden krijgen van het goed dan wel het vestigen van het recht wist dat het een door misdrijf verkregen goed betrof.', 0, 48),
(71, 'Artikel 326 - Oplichting', 'Hij die, met het oogmerk om zich of een ander wederrechtelijk te bevoordelen, hetzij door het aannemen van een valse naam of van een valse hoedanigheid, hetzij door listige kunstgrepen, hetzij door een samenweefsel van verdichtsels, iemand beweegt tot de afgifte van enig goed, tot het verlenen van een dienst, tot het ter beschikking stellen van gegevens, tot het aangaan van een schuld of tot het teniet doen van een inschuld, wordt, als schuldig aan oplichting, gestraft met gevangenisstraf van ten hoogste vier jaren of geldboete van de vijfde categorie.', 0, 48),
(72, 'Artikel 317 - Afpersing en afdreiging', 'Hij die, met het oogmerk om zich of een ander wederrechtelijk te bevoordelen, door geweld of bedreiging met geweld iemand dwingt hetzij tot de afgifte van enig goed dat geheel of ten dele aan deze of aan een derde toebehoort, hetzij tot het aangaan van een schuld of het teniet doen van een inschuld, hetzij tot het ter beschikking stellen van gegevens, wordt, als schuldig aan afpersing.', 25000, 54),
(74, 'Artikel 177 - Omkoping', 'Hij die een ambtenaar een gift of belofte doet dan wel een dienst verleent of aanbiedt met het oogmerk om hem te bewegen in zijn bediening, in strijd met zijn plicht, iets te doen of na te laten;\r\n2hij die een ambtenaar een gift of belofte doet dan wel een dienst verleent of aanbiedt ten gevolge of naar aanleiding van hetgeen door deze in zijn huidige of vroegere bediening, in strijd met zijn plicht, is gedaan of nagelaten.', 0, 60),
(75, 'Artikel 420 - Witwassen', 'Hij die van een voorwerp de werkelijke aard, de herkomst, de vindplaats, de vervreemding of de verplaatsing verbergt of verhult, dan wel verbergt of verhult wie de rechthebbende op een voorwerp is of het voorhanden heeft, terwijl hij weet dat het voorwerp onmiddellijk of middellijk afkomstig is uit enig misdrijf.', 0, 72),
(76, 'Artikel 225 - Bewijsschrift vervalsen', 'Hij die een geschrift dat bestemd is om tot bewijs van enig feit te dienen, valselijk opmaakt of vervalst, met het oogmerk om het als echt en onvervalst te gebruiken of door anderen te doen gebruiken, wordt als schuldig aan valsheid in geschrift gestraft, met gevangenisstraf van ten hoogste zes jaren of geldboete van de vijfde categorie.', 0, 84),
(80, 'Artikel 13 - WWM cat I', '(Cat. I: Stiletto’s, valmessen, vlindermessen en alle andere steek of slag wapens)\r\n\r\nHet is verboden een wapen van categorie I te vervaardigen, te transformeren, voor derden te herstellen, over te dragen, voorhanden te hebben, te dragen, te vervoeren, te doen binnenkomen of te doen uitgaan.', 1835, 0),
(81, 'Artikel 45 - Poging en voorbereiding', 'Wanneer deze straf wordt voorgelegd, wordt er van de maximale straf 1/3 af gehaald. Deze straf wordt in combinatie met een ander feit voorgelegd.\r\nPoging tot misdrijf is strafbaar, wanneer het voornemen van de dader zich door een begin van uitvoering heeft geopenbaard. Het maximum van de hoofdstraffen op het misdrijf gesteld wordt bij poging met een derde verminderd. Geldt het een misdrijf waarop levenslange gevangenisstraf is gesteld, dan wordt gevangenisstraf opgelegd van ten hoogste twintig jaren. De bijkomende straffen zijn voor poging dezelfde als voor het voltooide misdrijf.', 0, 0),
(82, 'K030 - Kenteken niet behoorlijk zichtbaar op/aan motorrijtuig', 'Kenteken niet goed zichtbaar', 140, 0),
(83, 'N420d - Lichhtdoorlatendheid ruiten minder dan 55%', 'De lichtdoorlatendheid van de voorruit en/of de naast de bestuurderszitplaats aanwezige zijruiten minder dan 55% bedraagt (Lightsmoke mag, alles daarboven niet!)', 240, 0),
(84, 'K006A - Rijbewijs ingevorderd', 'LET OP! BIJ DERDE KEER VOERTUIG IN BESLAG NEMEN.\r\nMet een motorrijtuig rijden terwijl krachtens de Wet Mulder het rijbewijs is ingevorderd\r\n(datum vordering door CJIB vermelden) (zie CRR)', 4150, 0),
(87, 'Artikel 10 - WVW', 'Het is verboden op de weg een wedstrijd met voertuigen te houden of daaraan deel te nemen. Onder wedstrijd wordt voor de toepassing van dit artikel verstaan elk rijden met voertuigen ter vaststelling of vergelijking van prestaties hetzij van de deelnemers, hetzij van de voertuigen, hetzij van onderdelen daarvan, hetzij van bedrijfsstoffen. Als deelnemer wordt beschouwd de bestuurder van een voertuig waarmee aan een wedstrijd wordt deelgenomen, en de eigenaar of houder van een voertuig, die daarmee aan een wedstrijd doet of laat deelnemen.', 3800, 0),
(88, 'Artikel 48 - Medeplichtigheid', 'Zij die opzettelijk behulpzaam zijn bij het plegen van het misdrijf. zij die opzettelijk gelegenheid, middelen of inlichtingen verschaffen tot het plegen van het misdrijf. Wanneer deze straf wordt voorgelegd, wordt er van de maximale straf 1/3 af gehaald.', 0, 0),
(89, 'Artikel 4 - Gezichtsbedekking', 'Verbod op het dragen van gezichtsbedekkende kleding in het openbaar vervoer en overheids-, onderwijs- en zorginstellingen.', 350, 0),
(90, 'Artikel 231b - Identificerende persoonsgegevens ', 'Hij die opzettelijk en wederrechtelijk identificerende persoonsgegevens, niet zijnde biometrische persoonsgegevens, van een ander gebruikt met het oogmerk om zijn identiteit te verhelen of de identiteit van de ander te verhelen of misbruiken, waardoor uit dat gebruik enig nadeel kan ontstaan, wordt gestraft met een gevangenisstraf van ten hoogste vijf jaren of geldboete van de vijfde categorie. ', 8300, 60),
(91, 'R549a - Niet stoppen bij stopbord', 'Niet stoppen bij stopbord', 140, 0),
(92, 'R421a - Geen dim- of grootlicht voeren bij nacht', 'Geen licht aan als het donker is ', 95, 0),
(93, 'K150c - Niet op eerste vordering behoorlijk het rijbewijs ter inzage afgeven', 'Niet op eerste vordering behoorlijk het rijbewijs ter inzage afgeven', 630, 0),
(101, 'Artikel 8 - Wegenverkeerswet', 'Rijden onder invloed - \r\nHet is een ieder verboden een voertuig te besturen of als bestuurder te doen besturen, terwijl hij verkeert onder zodanige invloed van een stof, waarvan hij weet of redelijkerwijs moet weten, dat het gebruik daarvan - al dan niet in combinatie met het gebruik van een andere stof - de rijvaardigheid kan verminderen, dat hij niet tot behoorlijk besturen in staat moet worden geacht.', 435, 0),
(102, 'Artikel v266 - Eenvoudige belediging', 'Belediging van Ambtenaar in Functie', 535, 0),
(103, 'R617b - Overschrijden doorgetrokken streep (beide richtingen)', 'Als bestuurder de zich niet langs de rand van de rijbaanverharding\r\nbevindende doorgetrokken streep overschrijden met verkeer in beide richtingen (bijvoorbeeld inhalen via de andere rijrichting)', 140, 0),
(104, 'R545 - Gebruik van mobiele telefoon tijden het rijden', 'Als bestuurder van een voertuig tijdens het rijden een mobiel elektronisch\r\napparaat dat gebruikt kan worden voor communicatie of\r\ninformatieverwerking vasthouden', 240, 0),
(105, 'K170 - Gevaar of hinder veroorzaken', 'Een voertuig op een zodanige wijze laten staan waardoor op de weg gevaar wordt/kan worden veroorzaakt, dan wel het verkeer wordt/kan worden gehinderd gevaar; situatie omschrijven; cat. 4 uitsluitend gehandicaptenvoertuig\r\nmet motor.', 435, 0),
(106, 'R315b - Niet de rijbaan gebruiken', 'Als bestuurder van een motorvoertuig niet de rijbaan gebruiken wat werd gebruikt, - door stil te staan op het trottoir, het voetpad, het fietspad, het fiets/ bromfietspad of het ruiterpad.', 95, 0),
(107, 'Artikel 142 - Misbruik noodnummer', 'Hij die opzettelijk, zonder dat daartoe de noodzaak aanwezig is, gebruik maakt van een alarmnummer voor publieke diensten wordt gestraft met gevangenisstraf van ten hoogste drie maanden of geldboete van de derde categorie.\r\n', 15000, 12),
(109, 'Artikel 302 - Zware mishandeling', 'Hij die aan een ander opzettelijk zwaar lichamelijk letsel toebrengt, wordt, als schuldig aan zware mishandeling, gestraft met gevangenisstraf van ten hoogste acht jaren of geldboete van de vijfde categorie.\r\n2\r\nIndien het feit de dood ten gevolge heeft, wordt de schuldige gestraft met gevangenisstraf van ten hoogste tien jaren of geldboete van de vijfde categorie. ', 6000, 96),
(110, 'Artikel 312 - Diefstal met geweld', 'Voorafgegaan, vergezeld of gevolgd van geweld of bedreiging met geweld tegen personen, gepleegd met het oogmerk om die diefstal voor te bereiden of gemakkelijk te maken, of om, bij betrapping op heter daad, aan zichzelf of andere deelnemers aan het misdrijf hetzij de vlucht mogelijk te maken, hetzij het bezit van het gestolen te verzekeren. Indien het feit wordt gepleegd hetzij gedurende de voor de nachtrust bestemde tijd in een woning of op een besloten erf waarop een woning staat.', 6000, 96),
(112, 'Artikel 255 - Verlating van hulpbehoevenden', 'Hij die opzettelijk iemand tot wiens onderhoud, verpleging of verzorging hij krachtens wet of overeenkomst verplicht is, in een hulpeloze toestand brengt of laat, wordt gestraft met gevangenisstraf van ten hoogste twee jaren of geldboete van de vierde categorie.', 0, 120),
(113, 'Artikel 287 - Doodslag', 'Hij die opzettelijk een ander van het leven berooft, wordt, als schuldig aan doodslag, gestraft met gevangenisstraf van ten hoogste vijftien jaren of geldboete van de vijfde categorie. ', 20000, 180),
(114, 'Artikel 289 - Moord voorbedachten rade', 'Hij die opzettelijk en met voorbedachten rade een ander van het leven berooft, wordt, als schuldig aan moord, gestraft met levenslange gevangenisstraf of tijdelijke van ten hoogste dertig jaren of geldboete van de vijfde categorie. ', 30000, 360),
(115, 'VA 005 - Snelheidsoverschrijding 5 km/h', 'Overschrijding van maximum snelheid', 54, 0),
(116, 'VA 010 - Snelheidsoverschrijding 10 km/h', 'Overschrijding van maximum snelheid', 107, 0),
(117, 'VA 015 - Snelheidsoverschrijding 15 km/h', 'Overschrijding van maximum snelheid', 185, 0),
(118, 'VA 020 - Snelheidsoverschrijding 20 km/h', 'Overschrijding van maximum snelheid', 257, 0),
(119, 'VA 025 - Snelheidsoverschrijding 25 km/h', 'Overschrijding van maximum snelheid', 337, 0),
(120, 'VA 030 - Snelheidsoverschrijding 30 km/h', 'Overschrijding van maximum snelheid', 430, 0),
(121, 'VA 040 - Snelheidsoverschrijding 40 km/h', 'Overschrijding van maximum snelheid', 525, 0),
(122, 'VA 050 - Snelheidsoverschrijding 50 km/h', 'Overschrijding van maximum snelheid', 700, 0),
(123, 'VA 060 - Snelheidsoverschrijding 60 km/h', 'Overschrijding van maximum snelheid', 840, 0),
(124, 'VA 070 - Snelheidsoverschrijding 70 km/h', 'Overschrijding van maximum snelheid', 980, 0),
(125, 'VA 080 - Snelheidsoverschrijding 80 km/h', 'Overschrijding van maximum snelheid', 1220, 0),
(126, 'VA 090 - Snelheidsoverschrijding 90 km/h', 'Overschrijding van maximum snelheid', 1460, 0),
(127, 'VA 100 - Snelheidsoverschrijding 100 km/h', 'Overschrijding van maximum snelheid', 1780, 0),
(128, 'Artikel 288 - Poging tot moord', 'Iemand vermoorden maar niet uitgevoerd', 15000, 180),
(129, 'Artikel 48 - Medeplichtigen Moord', 'Hij die mede opzettelijk en met voorbedachten rade een ander van het leven berooft, wordt, als schuldig aan moord.', 10000, 90),
(130, 'Artikel 48 - wederrechtelijk van de vrijheid berooft', 'Hij die mede opzettelijk iemand wederrechtelijk van de vrijheid berooft of beroofd houdt.', 4000, 48),
(131, 'Artikel 48 - Medeplichtigen mishandeling', 'Met mishandeling wordt gelijkgesteld opzettelijke benadeling van de gezondheid.', 2200, 18),
(132, 'Artikel 48 - Medeplichtigen Zware mishandeling', 'Hij die meedoet aan een ander opzettelijk zwaar lichamelijk letsel toebrengt, wordt, als schuldig aan zware mishandeling.', 3000, 48),
(133, 'Artikel 48 - Medeplichtigen Afpersing en afdreiging', 'Hij die mee doet aan, met het oogmerk om zich of een ander wederrechtelijk te bevoordelen, door geweld of bedreiging met geweld iemand dwingt hetzij tot de afgifte van enig goed dat geheel of ten dele aan deze of aan een derde toebehoort, hetzij tot het aangaan van een schuld of het teniet doen van een inschuld, hetzij tot het ter beschikking stellen van gegevens, wordt, als schuldig aan afpersing.', 12500, 27),
(134, 'Artikel 191 - Bevrijding van gevangene', 'Hij die opzettelijk iemand, op openbaar gezag of krachtens rechterlijke uitspraak of beschikking van de vrijheid beroofd, bevrijdt of bij zijn zelfbevrijding behulpzaam is, wordt gestraft met gevangenisstraf van ten hoogste vier jaren of geldboete van de vierde categorie. ', 10000, 48),
(135, 'Artikel 207- Meineed', 'Indien de valse verklaring is afgelegd in een strafzaak ten nadele van de beklaagde of verdachte, wordt de schuldige gestraft met gevangenisstraf van ten hoogste negen jaren of geldboete van de vijfde categorie. ', 8350, 72),
(136, 'Artikel 306 - Deelneming aan aanval of vechterij', 'Zij die opzettelijk deelnemen aan een aanval of vechterij waarin onderscheiden personen zijn gewikkeld, worden, behoudens ieders verantwoordelijkheid voor de bijzondere door hem bedreven feiten, gestraft', 4350, 24),
(137, 'Artikel 426ter - Belemmeren hulpverlener', 'Hij die wederrechtelijk een hulpverlener gedurende de uitoefening van zijn beroep in zijn vrijheid van beweging belemmert of met een of meer anderen zich aan hem tegen zijn uitdrukkelijk verklaarde wil blijft opdringen of hem op hinderlijke wijze blijft volgen wordt gestraft met hechtenis van ten hoogste drie maanden of geldboete van de derde categorie.', 2500, 10),
(138, 'Artikel 131- Opruiing', 'Hij die in het openbaar, mondeling of bij geschrift of afbeelding, tot enig strafbaar feit of tot gewelddadig optreden tegen het openbaar gezag opruit, ', 4350, 48),
(139, 'Artikel 142a - Valse bom', 'Hij die een voorwerp verzendt of op een al dan niet voor het publiek toegankelijke plaats achterlaat of plaatst, met het oogmerk een ander ten onrechte te doen geloven dat daardoor een ontploffing kan worden teweeggebracht, wordt gestraft met gevangenisstraf van ten hoogste vier jaren of geldboete van de vierde categorie. ', 15000, 48),
(140, 'Artikel 11 Opw - SOFT DRUGS (Vanaf 5 tot 10)', 'Op zak hebben van hard drugs zoals (Joint)', 2000, 20),
(143, 'K055 - Rijden zonder geldig rijbewijs', 'artikel 107, lid 1 en feitcode K055\r\nRijden zonder rijbewijs. Wanneer men een motorvoertuig bestuurt zonder rijbewijs is men in overtreding\r\n', 3000, 0),
(144, 'F125-b - Hinderlijk gedrag ', 'zonder redelijk doel zich anders dan als bewoner of gebruiker in een\r\ngemeenschappelijke ruimte van een flat-, appartementsgebouw of publiek\r\ntoegankelijk gebouw bevinden', 95, 5),
(145, 'Artikel 315 - Stroperij', '1.Met gevangenisstraf van ten hoogste drie jaren of geldboete van de vierde categorie wordt gestraft:\r\n1°. stroperij gepleegd met behulp van vaartuigen, wagens, trek- of lastdieren;\r\n2°. stroperij gepleegd onder een of meer der in artikel 311, eerste lid, onder 2°-5°, vermelde omstandigheden.\r\n\r\n2.Ontzetting van de in artikel 28, eerste lid, onder 1°, 2° en 4°, vermelde rechten kan worden uitgesproken. ', 15000, 36),
(146, 'Artikel 189 - Opzettelijk hinderen van onderzoek/aanhouding', 'Met gevangenisstraf van ten hoogste zes maanden of geldboete van de derde categorie wordt gestraft:\r\n1\r\nhij die opzettelijk iemand die schuldig is aan of verdachte is van enig misdrijf, verbergt of hem behulpzaam is in het ontkomen aan de nasporing van of aanhouding door de ambtenaren van de justitie of politie;\r\n2\r\nhij die nadat enig misdrijf is gepleegd, met het oogmerk om het te bedekken of de nasporing of vervolging te beletten of te bemoeilijken, voorwerpen waarop of waarmede het misdrijf gepleegd is of andere sporen van het misdrijf vernietigt, wegmaakt, verbergt of aan het onderzoek van de ambtenaren van de justitie of politie onttrekt;\r\n3\r\nhij die opzettelijk voorwerpen die kunnen dienen om de waarheid aan de dag te brengen of om wederrechtelijk verkregen voordeel als bedoeld in artikel 36e aan te tonen, met het oogmerk om de inbeslagneming daarvan te beletten, te belemmeren of te verijdelen, verbergt, vernietigt, wegmaakt of aan het onderzoek van de ambtenaren van de justitie of politie onttrekt, dan wel door het opzettelijk verstrekken van gegevens of inlichtingen aan derden die inbeslagneming belet, belemmert of verijdelt.\r\n', 8350, 6),
(147, 'Artikel 294 - Aanzetten tot zelfdoding ', '1\r\nHij die opzettelijk een ander tot zelfdoding aanzet, wordt, indien de zelfdoding volgt, gestraft met een gevangenisstraf van ten hoogste drie jaren of geldboete van de vierde categorie.\r\n2\r\nHij die opzettelijk een ander bij zelfdoding behulpzaam is of hem de middelen daartoe verschaft, wordt, indien de zelfdoding volgt, gestraft met een gevangenisstraf van ten hoogste drie jaren of geldboete van de vierde categorie. Artikel 293, tweede lid, is van overeenkomstige toepassing. ', 15000, 36),
(148, '321- Verduistering', 'Hij die opzettelijk enig goed dat geheel of ten dele aan een ander toebehoort en dat hij anders dan door misdrijf onder zich heeft, wederrechtelijk zich toe-eigent, wordt, als schuldig aan verduistering, gestraft met gevangenisstraf van ten hoogste 3 jaren of geldboete van vijfde categorie. ', 0, 36),
(149, 'Artikel 461: Overtreding Verboden toegang', 'Iedereen die een omheind terrein bezit of beheert mag een verboden toegang bord ophangen. Elk privéterrein valt onder artikelnummer 461 van het Wetboek van Strafrecht.  Zonder toestemming betreden van een terrein is inbreuk op het eigendomsrecht van de grondbezitter en is strafbaar. Bij overtredingen kan de politie ingeschakeld worden en riskeert de overtreder een geldboete van maximaal 225 euro. Artikel 138 Huisvredebreuk is een ernstiger feit en geldt als een misdrijf. “Hij die, zonder daartoe gerechtigd te zijn, zich op eens anders grond waarvan de toegang op een voor hem blijkbare wijze door de rechthebbende is verboden, bevindt of daar vee laat lopen, wordt gestraft met een geldboete van de eerste categorie.”', 225, 0),
(150, 'Artikel 10 Opw -HARD DRUGS (Vanaf 2 tot 10)', 'Op zak hebben van hard drugs zoals (Oxycodon, Coke bricks, Meth)', 3000, 30),
(152, 'Artikel 10 Opw - HARD DRUGS (Vanaf 11 tot 20)', 'Op zak hebben van hard drugs zoals (Oxycodon, Coke bricks, Meth)', 6000, 40),
(153, 'Artikel 10 Opw - Hard drugs (Vanaf 20+)', 'Op zak hebben van hard drugs zoals (Oxycodon, Coke bricks, Meth)', 10000, 50),
(154, 'Artikel 11 Opw - SOFT DRUGS (Vanaf 11 tot 20)', 'Op zak hebben van hard drugs zoals (Wiet, Joint)', 4000, 30),
(155, 'Artikel 11 Opw -SOFT DRUGS (Vanaf 20+)', 'Op zak hebben van hard drugs zoals (Wiet, Joint)', 7500, 40),
(156, 'Artikel 11 Opw - WIETBRICK', 'Verhandelen van wietbricks', 1500, 25),
(157, 'F060a - Niet Opvolgen Bevel Politie om zich te verwijderen', 'niet opvolgen bevel politie om zich te verwijderen i.g.v. (dreigende) ongeregeldheden', 390, 0),
(158, 'F114b - de weg als slaapplaats gebruiken', 'de weg als slaapplaats gebruiken', 140, 0),
(159, 'F120a - Klimmen of zich bevinden op daarvoor niet bestemd straatmeubilair', 'op een opebare plaats op een beeld, monument, overkapping, constructie, hek voertuig e.d klimmen of zich bevinden', 95, 0),
(160, 'F120b - Op een openbare plaats overlast of hinder veroorzaken ', '-Zodanig op te houden waardoor voor weggebruikers of omwonenden overlast of hinder wordt veroorzaakt.\r\n-Op een openbare plaats overlast of hinder veroorzaken voor andere gebruikers of bewoners', 140, 0),
(161, 'F185 - Wildplassen', 'binnen de bebouwde kom zijn natuurlijke behoefte doen buiten daarvoor bestemde plaatsen', 140, 0),
(162, 'F125a - Zonder redelijk doel rondhangen', 'zonder redelijk doel in portiek/poort ophouden, op/tegen raamkozijn / drempel v.e. gebouw zitten/liggen', 95, 0),
(163, 'F125b - Zonder redelijk doel rondhangen', 'zich zonder redelijk doel in ge- meenschappelijke ruimte v. flat/publiek toegankelijk gebouw bevinden', 95, 0),
(164, 'D515 - Valse identiteit opgeven', 'opgeven van een valse naam, voornaam, geboortedatum, geboorteplaats, adres of woon- of verblijfplaats', 390, 0),
(165, 'F110b - Zonder toestemming bekladden/ aanplakken', 'zonder toestemming van rechthebbende op openb.pl./onroerende zaak afbeelding /geschrift aanplakken of aanbrengen', 140, 0),
(166, 'F119 - Bedelen', 'op of aan de weg of in een voor het publiek toegankelijk gebouw bedelen om geld of andere zaken', 95, 0),
(167, 'F114a - Wildkamperen ', 'zonder ontheffing buiten kampeerterrein kampeermiddelen plaatsen ten behoeve van reacreatief nachtverblijf', 140, 0),
(168, 'F220 - Zonder toestemming collecteren of daartoe een intekenlijst aanbieden', 'zonder vergunning/ontheffing geld of goederen inzamelen of een intekenlijst aanbieden\r\n', 140, 0),
(169, 'F230 - Zonder toestemming goederen aanbieden', 'zonder vergunning/ontheffing een standplaats innemen', 140, 0),
(170, 'F225a - Zonder toestemming goederen aanbieden', 'venten op door het college of de burgemeester aangewezen(verboden) openbare plaatsen', 140, 0),
(171, 'F225b - Zonder toestemming goederen aanbieden', 'venten op door het college of de burgemeester aangewezen (verboden) dagen of uren', 140, 0),
(172, 'D537b - Op terrein van een ander zich niet houden aan de toegangsvoorwaarden (1)', 'zich niet houden aan de toegangsvoor- waarden van de eigenaar\r\n\r\n(1) eerste maal', 95, 0),
(173, 'D537b - Op terrein van een ander zich niet houden aan de toegangsvoorwaarden (2)', 'zich niet houden aan de toegangsvoor- waarden van de eigenaar\r\n\r\n(2) tweede vergrijp', 190, 3),
(174, 'F121b - Op openbare weg met aangebroken fles/blik alcohol', 'aangebroken flessen, blikjes e.d. met alcoholhoudende drank bij zich hebben op een openbare plaats in aangew. geb.', 95, 0),
(175, 'F121a - Op openbare weg alcohol drinken waar dat verboden is', 'alcoholhoudende drank nuttigen op een openbare plaats binnen een door het college / burgemeester aangewezen gebied', 95, 0),
(176, 'F112 - Orde verstoren in horecabedrijf', 'in een openbare inrichting de orde verstoren', 390, 0),
(177, 'F105a - Als horecahouder bezoekers toelaten na sluitingstijd', 'als houder van een openbare inrichting na sluitingstijd die inrichting voor bezoekers geopend hebben', 280, 0),
(178, 'F105b - Als horecahouder bezoekers toelaten na sluitingstijd', 'als houder van een openbare inrichting na sluitingstijd in die inrichting bezoekers laten verblijven', 280, 0),
(179, 'E211a - Onder de 18 jaar alcoholhoudende drank aanwezig hebben waar dit niet is toegstaan', 'als persoon jonger dan 18 alcohol aan- wezig hebben waar dit niet is toegestaan', 95, 0),
(180, 'F121C - Overlast veroorzaken in de openbare ruimte in combinatie met alcohol gebruik', 'op of aan openbare plaats of op openbaar water of in een publiek gebouw alcohol- houdende drank nuttigen (met overlast)', 180, 0),
(181, 'F171b - Softdrugs gebruiken waar niet toegestaan', 'op een openbare plaats, al dan niet binnen een door college of burgemeester aangewezen gebied, softdrugs gebruiken', 95, 0),
(182, 'F171 - Op een openbare plaats harddrugs gebruiken', 'op/aan openbare weg of plaats harddrugs gebruiken of stoffen/voorwerpen voor dat gebruik voorhanden hebben', 390, 0),
(183, 'H320 - Brand stichten: in openlucht vuur stoken', 'in de openlucht vuur aanleggen, stoken of hebben', 280, 0),
(184, 'H205 - Overlast veroorzaken voor omgeving d.m.v. toestellen of geluidsapparatuur', 'Veroorzaken van geluidhinder voor een omwonende of de omgeving door/met toe- stellen/(geluids)apparaten/handelingen', 140, 0),
(185, 'F250 - Met een voertuig rijden door park / plantsoen', 'zonder ontheffing rijden/bevinden met vo ertuig/paard in publiektoegankelijk park natuurgebied/plantsoen/recreatieterrein', 140, 0),
(186, 'H022 - Rommel op straat gooien', 'straatafval achterlaten in openbare ruimte zonder gebruik te maken van voorgeschreven bakken, manden e.d.', 140, 0),
(187, 'H025 - Afval in de openbare ruimte achterlaten', 'afval buiten een inrichting storten/op of in de bodem brengen/te verbranden', 390, 0),
(188, 'H171 - Vuurwerk Buiten toegestane tijden afsteken -> 31 dec. 18.00 uur t/m 1 jan. 02.00 uur', 'Vuurwerk afsteken buiten de toegestane tijden (31-12 18.00 uur tot 01-01 02.00 uur)', 140, 0),
(189, 'H162a - Vuurwerk voorhanden hebben buiten de daarvoor bestemde dagen', 'Vuurwerk voorhanden hebben buiten de daarvoor bestemde dagen', 200, 0),
(190, 'D511 - Naaktlopen waar niet toegestaan', 'naaktrecreatie buiten daartoe aangewezen plaatsen', 95, 0),
(191, 'H107 - Voertuigwrak op de weg laten staan', 'een voertuigwrak parkeren op de weg', 390, 0),
(192, 'CITES - Koraal 1 t/m 10 stuks ', 'Het in bezit zijn van \"Vochtig\" Koraal is strafbaar en vastgesteld door de instantie CITES. De hoogte van de boete hangt af van de hoeveelheid. Met Vochtig koraal wordt bedoelt koraal dat nog leeft en dus uit zijn leefomgeving is gehaald.', 800, 0),
(193, 'CITES - Koraal 11 t/m 25 stuks ', 'Het in bezit zijn van \"Vochtig\" Koraal is strafbaar en vastgesteld door de instantie CITES. De hoogte van de boete hangt af van de hoeveelheid. Met Vochtig koraal wordt bedoelt koraal dat nog leeft en dus uit zijn leefomgeving is gehaald.', 1400, 0),
(194, 'CITES - Koraal 26 t/m 50 stuks ', 'Het in bezit zijn van \"Vochtig\" Koraal is strafbaar en vastgesteld door de instantie CITES. De hoogte van de boete hangt af van de hoeveelheid. Met Vochtig koraal wordt bedoelt koraal dat nog leeft en dus uit zijn leefomgeving is gehaald.', 2000, 0),
(195, 'CITES - Koraal 51 t/m 75 stuks ', 'Het in bezit zijn van \"Vochtig\" Koraal is strafbaar en vastgesteld door de instantie CITES. De hoogte van de boete hangt af van de hoeveelheid. Met Vochtig koraal wordt bedoelt koraal dat nog leeft en dus uit zijn leefomgeving is gehaald.', 3000, 0),
(196, 'CITES - Koraal 76 t/m 100 stuks ', 'Het in bezit zijn van \"Vochtig\" Koraal is strafbaar en vastgesteld door de instantie CITES. De hoogte van de boete hangt af van de hoeveelheid. Met Vochtig koraal wordt bedoelt koraal dat nog leeft en dus uit zijn leefomgeving is gehaald.', 4500, 0),
(197, 'CITES - Koraal 101 t/m 125 stuks ', 'Het in bezit zijn van \"Vochtig\" Koraal is strafbaar en vastgesteld door de instantie CITES. De hoogte van de boete hangt af van de hoeveelheid. Met Vochtig koraal wordt bedoelt koraal dat nog leeft en dus uit zijn leefomgeving is gehaald.', 6000, 0),
(198, 'CITES - Koraal 125+', 'Het in bezit zijn van \"Vochtig\" Koraal is strafbaar en vastgesteld door de instantie CITES. De hoogte van de boete hangt af van de hoeveelheid. Met Vochtig koraal wordt bedoelt koraal dat nog leeft en dus uit zijn leefomgeving is gehaald.', 8000, 10),
(199, 'E162e - Op of langs de spoorweg lopen', 'op of langs niet toegestaan gedeelte lokale spoorweg bevinden of daarop of langs dieren drijven/laten lopen', 95, 0),
(200, 'E126 - Na sluitingstijd op het station zijn', 'Orde/rust/veiligheid/goede bedrijfsgang verstoren door op gesloten niet toeganke lijk deel van station/hal te bevinden.', 95, 0),
(201, 'E120a - De bedrijfsgang verstoren/ belemmeren in het openbaar vervoer', 'Orde/rust/veiligheid/goede bedrijfsgang verstoren door bediening/gebruik van voorzieningen te verhinderen/belemmeren', 240, 0),
(202, 'Artikel 311 - Gekwalificeerde diefstal - Winkeloverval met geweld', '1.Met gevangenisstraf van ten hoogste zes jaren of geldboete van de vierde categorie wordt gestraft: 1°. diefstal van vee uit de weide; 2°. diefstal bij gelegenheid van brand, ontploffing, watersnood, schipbreuk, stranding, spoorwegongeval, oproer, muiterij of oorlogsnood; ', 2500, 30),
(203, 'Artikel 311 - Gekwalificeerde diefstal - Huisinbraak met geweld', '1.Met gevangenisstraf van ten hoogste zes jaren of geldboete van de vierde categorie wordt gestraft: 1°. diefstal van vee uit de weide; 2°. diefstal bij gelegenheid van brand, ontploffing, watersnood, schipbreuk, stranding, spoorwegongeval, oproer, muiterij of oorlogsnood; 3°. diefstal gedurende de voor de nachtrust bestemde tijd, in een woning of op een besloten erf waarop een woning staat, door iemand die zich aldaar buiten weten of tegen de wil van de rechthebbende bevindt; 4', 4000, 40),
(204, 'Artikel 311 - Gekwalificeerde diefstal - Kleine Bank overval met geweld', 'Deze boete geef je, als een verdachte iemand heeft geslagen of heeft geschoten bij een bankoverval', 6000, 60),
(205, 'Artikel 311 - Gekwalificeerde diefstal - Juwelier met geweld', '1.Met gevangenisstraf van ten hoogste zes jaren of geldboete van de vierde categorie wordt gestraft: 1°. diefstal van vee uit de weide; 2°. diefstal bij gelegenheid van brand, ontploffing, watersnood, schipbreuk, stranding, spoorwegongeval, oproer, muiterij of oorlogsnood; 3°. diefstal gedurende de voor de nachtrust bestemde tijd, in een woning of op een besloten erf waarop een woning staat, door iemand die zich aldaar buiten weten of tegen de wil van de rechthebbende bevindt; ', 7000, 65),
(206, 'Artikel 311 - Gekwalificeerde diefstal - Pacific Bank met geweld ', '1.Met gevangenisstraf van ten hoogste zes jaren of geldboete van de vierde categorie wordt gestraft: 1°. diefstal van vee uit de weide; 2°. diefstal bij gelegenheid van brand, ontploffing, watersnood, schipbreuk, stranding, spoorwegongeval, oproer, muiterij of oorlogsnood; 3°. diefstal gedurende de voor de nachtrust bestemde tijd, in een woning of op een besloten erf waarop een woning staat, door iemand die zich aldaar buiten weten of tegen de wil van de rechthebbende bevindt; ', 10000, 70),
(207, 'Artikel 310 - Eenvoudige diefstal - Huisinbraak', 'Hij die enig goed dat geheel of ten dele aan een ander toebehoort wegneemt, met het oogmerk om het zich wederrechtelijk toe te eigenen, wordt, als schuldig aan diefstal.', 2500, 25),
(208, 'Artikel 310 - Eenvoudige diefstal - Winkeloverval ', 'Hij die enig goed dat geheel of ten dele aan een ander toebehoort wegneemt, met het oogmerk om het zich wederrechtelijk toe te eigenen, wordt, als schuldig aan diefstal.', 1750, 15),
(209, 'Artikel 310 - Eenvoudige diefstal - Kleine Bankoverval', 'Hij die enig goed dat geheel of ten dele aan een ander toebehoort wegneemt, met het oogmerk om het zich wederrechtelijk toe te eigenen, wordt, als schuldig aan diefstal.', 3000, 30),
(210, 'Artikel 312 - Diefstal met geweldpleging - Winkeloverval', 'Indien er tijdens de overval of inbraak een persoon zwaar gewond of dood gemaakt is dan valt het onder deze categorie', 4500, 45),
(211, 'Artikel 312 - Diefstal met geweldpleging - Huisinbraak', 'Indien er tijdens de overval of inbraak een persoon zwaar gewond of dood gemaakt is dan valt het onder deze categorie', 4750, 55),
(212, 'Artikel 312 - Diefstal met geweldpleging - Kleine bank', 'Indien er tijdens de overval of inbraak een persoon zwaar gewond of dood gemaakt is dan valt het onder deze categorie', 7500, 75),
(213, 'Artikel 312 - Diefstal met geweldpleging - Juwelier', 'Indien er tijdens de overval of inbraak een persoon zwaar gewond of dood gemaakt is dan valt het onder deze categorie', 8500, 80),
(214, 'Artikel 312 - Diefstal met geweldpleging - Pacific Bank', 'Indien er tijdens de overval of inbraak een persoon zwaar gewond of dood gemaakt is dan valt het onder deze categorie', 15500, 90),
(216, 'Artikel 48 - Medeplichtig wederrechtelijk van de vrijheid berooft', 'Hij die mede opzettelijk iemand wederrechtelijk van de vrijheid berooft of beroofd houdt.', 1400, 20),
(217, 'Artikel 48 - Poging tot wederrechtelijk van de vrijheid berooft', 'Hij die mede opzettelijk iemand wederrechtelijk van de vrijheid berooft of beroofd houdt.', 2000, 24),
(218, 'Artikel 311 - Medeplichtig Gekwalificeerde diefstal - Kleine Bank overval met wapens', 'Mede plichtig Gekwalificeerde diefstal - Kleine Bank overval met wapens (Wapen getrokken maar niet gebruikt)', 3500, 30),
(219, 'Artikel 312 - Medeplichtig Diefstal met geweldpleging - Kleine bank', 'Medeplichtig Diefstal met geweldpleging - Kleine bank', 3750, 37),
(220, 'Artikel 310 - Medeplichtig Eenvoudige diefstal - Kleine Bankoverval', 'Medeplichtig Eenvoudige diefstal - Kleine Bankoverval', 2250, 15),
(221, 'Artikel 26 - WWM CAT. III', '(Cat. II: Semi automatische wapens: Micro-SMG, Mini-SMG en alle andere soorten SMG) \r\n\r\nHet is verboden een wapen of munitie van de categorieen III voorhanden te hebben.', 10350, 60),
(222, 'Artikel 310 - Eenvoudige diefstal - Autodiefstal', 'Autodiefstal', 1000, 10),
(223, 'Artikel 287 - Poging tot doodslag', 'Hij die opzettelijk een ander van het leven berooft, wordt, als schuldig aan doodslag, gestraft met gevangenisstraf van ten hoogste vijftien jaren of geldboete van de vijfde categorie. ', 10000, 90);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `citizenid` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT 'https://i.imgur.com/tdi3NGa.png',
  `fingerprint` varchar(255) DEFAULT NULL,
  `dnacode` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `lastsearch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `profileid` int(11) DEFAULT NULL,
  `report` text NOT NULL,
  `laws` text DEFAULT NULL,
  `created` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `last_login` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `role`, `rank`, `last_login`) VALUES
(1, 'Admin', '$2y$10$0/IMFb9LohgRbS0i7zAkkOcPSzFbsEs5SzUMWAKomigW5H/e7GpJK', 'Admin Account', 'admin', 'Admin', '2020-10-05');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `warrants`
--

CREATE TABLE `warrants` (
  `id` int(11) NOT NULL,
  `citizenid` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `laws`
--
ALTER TABLE `laws`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexen voor tabel `warrants`
--
ALTER TABLE `warrants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `laws`
--
ALTER TABLE `laws`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT voor een tabel `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT voor een tabel `warrants`
--
ALTER TABLE `warrants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
