<?php
    include_once("dbase.php");
    // controleer of formulier is ingevuld en verwerk dit dan
    if (isset($_POST['ingestuurd'])){ 
        // als er info is ingestuurd van het formulier, zet dit dan in de database
        $sql="UPDATE berichten SET bericht1 = '" . $_POST['nieuwBericht1'] . "', 
                                   bericht2 = '" . $_POST['nieuwBericht2'] . "', 
                                   bericht3 = '" . $_POST['nieuwBericht3'] . "' WHERE id=1"; // er is maar 1 record. id=1
        $result=getData($sql);
    }
    $sql="SELECT * FROM berichten"; // er is maar 1 set dus behoeft geen verdere controle
    $berichten=getData($sql);
?>
<!-- eenvoudig formulier om content te wijzigen uit de database (update). Overdracht met POST
 Gebruik index 0 want er is maar 1 record. -->
<!DOCTYPE html>
    <head>   
    </head>
    <body style="font-family: Arial">
        Wijzig een of meerdere berichten en druk op OK. Compacte teksten gebruiken<BR>
        <form method="post" action="berichtwim.php"> 
            <input type="text" name="nieuwBericht1" size=50 value="<?php echo $berichten[0]['bericht1']?>"><br> 
            <input type="text" name="nieuwBericht2" size=50 value="<?php echo $berichten[0]['bericht2']?>"><br>
            <input type="text" name="nieuwBericht3" size=50 value="<?php echo $berichten[0]['bericht3']?>"><br>
            <button type="submit" name="ingestuurd"> OK </button>
        </form>
    </body>
