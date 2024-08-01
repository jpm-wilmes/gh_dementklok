<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("dbase.php");

// haal regels op. Er is 1 record met 3 regels
$sql="SELECT * FROM berichten";
$berichten=getData($sql);
// bouw de pagina op
?>
<DOCTYPE html>
<head>
    
    <meta http-equiv="refresh" content="60">
</head>
<body>
    <div class="vl"></div>
    <div class="hl"></div>
    <div class="pagina" id="alles">
        <div class="top">
            <div class="kop links" id="links">
                    12:00
            </div>  
            <div class="kop rechts">
                <div id="dagdeel">
                    voormiddag
                </div><br>
                <div id="weekdag">
                    woensdag
                </div><br>
                <div id="datum">
                    24 juni
                </div>
            </div>  
        </div>
        <div class="tekstregels">
            <div id="regel1">
                dummy
            </div><br>
            <div id="regel2">
                dummy
            </div><br>
            <div id="regel3">
                dummy
            </div><br>
        </div>
    </div>
</body>
<style>
    body {
        background-color: black;
        color: white;

    }
    .pagina {
        width: 100%;
        height: 100%;
        margin: 15px;
        font-family:'Arial';
        font-weight: bold;
    }
    .kop {
        height: 40vh;
        width: 50%;
        position: fixed;
        z-index: 1;
        background-color: light-green;
        top: 0;
        overflow-x: hidden;

    }
    .links {
        text-align:center;
        left: 0;
        align: center;

        font-size: 30VH;
    }
    .rechts {
        right: 0;
        text-align: left;
        margin-top: 15px;
        margin-left: 25px;
        font-size: 48px;
    }
    .tekstregels {
        font-size: 48px;
        line-height:1;
        z-index: 2;
        padding-top:45vh
    }
    .vl {
        border-left: 6px solid white;
        height: 40vh;
        position: absolute;
        left: 49%;
        margin-left: -3px;
        top: 0;
    }
    .hl {
        position: absolute;
        border-bottom: 6px solid white;       
        height: 38vh;
        width: 100%;   
        margin-left: -3px;    
    }
</style>
<!-- Hieronder staat de JS functionaliteit -->
<script>
    // Request full-screen mode

    const d = new Date(); 
    // de methode slice wordt gebruikt om de leading 0 toe te passen bij de tijd
    hours = "0" + d.getHours().toString(); minutes = + "0" + d.getMinutes().toString();
    var time = hours.slice(-2) + ":" + minutes.slice(-2);
    // Maandgetal naar maand
    const maandtekst=['Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December'];
    var datum= d.getDate() + " - " + maandtekst[d.getMonth()];
    // Weekdaggetal naar dag
    const weekdag=["Zondag","Maandag","Dinsdag","Woensdag","Donderdag","Vrijdag","Zaterdag"];
    // Vul de locaties op het scherm
    document.getElementById("links").innerHTML = time;
    document.getElementById("datum").innerHTML = datum;
    if (d.getHours() <12) {
        tekst = "Goede Ochtend";
        document.getElementById("dagdeel").innerHTML = tekst;
    } 
    if (d.getHours()>=12 && d.getHours()<18){
        tekst = "Goede Middag";
        document.getElementById("dagdeel").innerHTML = tekst;
    }
    if (d.getHours()>=18) {
        tekst = "Goede Avond";
        document.getElementById("dagdeel").innerHTML = tekst;
    }
    document.getElementById("weekdag").innerHTML = weekdag[d.getDay()];
    // haal informatie van de server om de teksten in de onderste helft op te halen
    document.getElementById("regel1").innerHTML = "<?php echo $berichten[0]['bericht1'];?>";
    document.getElementById("regel2").innerHTML = "<?php echo $berichten[0]['bericht2'];?>";
    document.getElementById("regel3").innerHTML = "<?php echo $berichten[0]['bericht3'];?>";




</script>
