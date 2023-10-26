<!DOCTYPE html>
<html lang="en">
<?php
set_error_handler(function(int $errno, string $errstr) {
    if ((strpos($errstr, 'Undefined array key') === false) && (strpos($errstr, 'Undefined variable') === false)) {
        return false;
    } else {
        return true;
    }
}, E_WARNING);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php


   $servername = "localhost";
   $username = "root";
   $database = "lil";
   $password = "";
   $conn = mysqli_connect($servername, $username, $password, $database);

?>

<div class="main"><div><p>O MNIE</p>

<div class="omnie">  
    <?php
    $omnie = mysqli_query($conn, "SELECT * FROM `omnie`");
    while($x = mysqli_fetch_array($omnie))
    {
        echo $x["opis"];
    }
    ?>
</div>
<div class="art">
<img src="png/1.png" height="500" class="a"> 
<img src="png/2.png" height="500" class="b"> 
<img src="png/3.png" height="500" class="c"> 
<img src="png/4.png" height="500" class="d"> 
</div>

</div>
<!-- ----------------------------------------- -->
<div><p>PROJEKTY</p>

<div>  
    <?php
    $projekty = mysqli_query($conn, "SELECT * FROM `projekty`");
    while($x = mysqli_fetch_array($projekty))
    {
        echo "<div><p class=\"tt\">" . $x["tytul"] . "</p>";
        echo $x["opis"] . "</div>";
    }
    ?>
</div>

</div>
<!-- ----------------------------------------- -->
<div><p>KONTAKT</p>
Wyślij mi email!<br>
<div>  

<form method="POST" id="b">
    TYTUŁ<br><input type="text" name="title"></input><br>
    TREŚĆ<br><textarea name="kont" form="b" rows="5"></textarea><br>
    <input type="submit" value="POTWIERDŹ" name="konts"></input>
    <?php
        $kontt = mysqli_query($conn, "SELECT * FROM `kontakt`");
        while($x = mysqli_fetch_array($kontt))
        {
            $email = $x["email"];
        }
    $kont = $_POST["kont"];
    $title = $_POST["title"];
    if(isset($_POST["konts"])){
        mail($email, $title, $kont);
    }?>
    </form>
</div>

</div>
<!-- ----------------------------------------- -->
<div><p>UMIEJĘTNOŚCI</p>


<div>  
    <?php
    $um = mysqli_query($conn, "SELECT * FROM `um`");
    while($x = mysqli_fetch_array($um))
    {
        echo "<label for=\"file\">" . $x["nazwa"] . "</label>";
        echo "<progress id=\"file\" value=\"" . $x["procenty"] . "\" max=\"100\"></progress> ";
    }
    ?>
</div>
</div>
<!-- ----------------------------------------- -->

<div>

<p>PANEL</p>
<div class="prawo">O MNIE</div>
<div class="lewo">
<form method="POST" id="a">

    OPIS<br><textarea name="om" form="a" rows="5"><?php     $omnie = mysqli_query($conn, "SELECT * FROM `omnie`");
    while($x = mysqli_fetch_array($omnie))
    {
        echo $x["opis"];
    } ?></textarea><br>
    <input type="submit" value="POTWIERDŹ" name="oms"></input>

    <?php

$om = $_POST["om"];
if(isset($_POST["oms"])){
    $add = mysqli_query($conn, "UPDATE `omnie` SET `opis`='$om' WHERE 1");
}

    ?>

</form>
</div><br>
<div class="prawo">PROJEKTY</div>
<div class="lewo">
<form method="POST">

    TYTUL<br><input type="text" name="tytul"></input><br>
    OPIS<br><input type="text" name="opis"></input><br>
    <input type="submit" value="POTWIERDŹ" name="prs"></input>

    <?php

$tytul = $_POST["tytul"];
$opis = $_POST["opis"];
if(isset($_POST["prs"])){
    $add = mysqli_query($conn, "INSERT INTO `projekty`(`tytul`, `opis`) VALUES ('$tytul','$opis')");
}

    ?>


</form>
</div><br>



<div class="prawo">KONTAKT</div>
<div class="lewo">
<form method="POST">

EMAIL<br><input type="text" name="email"></input><br>
    <input type="submit" value="POTWIERDŹ" name="ems"></input>

    <?php

$email = $_POST["email"];
if(isset($_POST["ems"])){
    $add = mysqli_query($conn, "UPDATE `kontakt` SET `email`='$email' WHERE 1");
}

    ?>

</form>
</div><br>

<div class="prawo">UMIEJĘTNOŚCI</div>
<div class="lewo">
<form method="POST">

TYTUL<br><input type="text" name="tt"></input><br>
    PROCENT<br><input type="number" name="pc"></input><br>
    <input type="submit" value="POTWIERDŹ" name="ums"></input>

    <?php

$tt = $_POST["tt"];
$pc = $_POST["pc"];
if(isset($_POST["ums"])){
    $add = mysqli_query($conn, "INSERT INTO `um`(`procenty`, `nazwa`) VALUES ('$pc','$tt')");
}

    ?>

</form>
</div><br>

</div></div>

</body>


</html>