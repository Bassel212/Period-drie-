<!DOCTYPE html>
<html lang="en">
<body>
 test
<!--<h1>My first PHP page</h1>-->
<?php
//echo "Hello World!";
//?><!--<br><br><br>-->
<!---->
<!---->
<?php
//function Say_Hallo (){
//    echo "Hello World!";
//}
//Say_Hallo();
//?><!--<br><br>-->
<!---->
<?php
//$x = 5 + 5;
//echo $x;
//?><!--<br><br><br>-->
<!---->
<!--<header>-->
<!--    --><?php
//    $color = "red";
//    echo "GOOD BYE " . $color . "<br>";
//    ?><!--<br><br>-->
<!---->
<!--    --><?php
//    $name = 'Linus';
//
//    function myTest() {
//        global $name; // Maakt gebruik van de globale variabele $name
//        $name = 'Tobias'; // Wijzigt de globale variabele
//    }
//
//    myTest();
//    echo $name; // Uitvoer: Tobias
//    ?><!--<br><br><br>-->
<!---->
<!--    --><?php
//    $name = 'Linus';
//
//    function myTest1() {
//        $GLOBALS['name'] = 'Tobias'; // Wijzigt de globale variabele via $GLOBALS
//    }
//
//    myTest1();
//    echo $name; // Uitvoer: Tobias
//    ?><!--<br><br><br>-->
<!---->
<!--    --><?php //#✍ التفسير:
//    #int → نوع البيانات عدد صحيح (Integer)
//    #(5) → القيمة المخزنة في المتغير
//
//    $num = 5 ;
//    var_dump($num);
//    ?><!--<br><br>-->
<!---->
<!--    --><?php //#مثال آخر مع أنواع مختلفة من البيانات:
//    $a = 5;
//    $b = "Hello";
//    $c = 3.14;
//    $d = true;
//
//    var_dump($a);
//    var_dump($b);
//    var_dump($c);
//    var_dump($d);
//?><!--<br><br>-->
<!---->
<!--    --><?php
//    #حساب طول النص | strlen
//echo strlen("Hello World!");
//?><!--<br><br>-->
<!---->
<!--    --><?php //#تحويل النص الى احرف كبيرة | ucwords
//    echo ucwords("big lettres");
//    ?><!--<br><br>-->
<!---->
<!--    --><?php //#استبدال النص | str_replace
//    echo str_replace("Hallo", "world!","Hallo World!");
//    ?><!--<br><br>-->
<!---->
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];

        // Validatie voor naam
        if (empty($_POST['name']) || strlen($_POST['name']) < 3) {
            $errors[] = "De naam moet minimaal 3 tekens bevatten.";
        }

        // Validatie voor e-mail
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Voer een geldig e-mailadres in.";
        }

        // Validatie voor leeftijd
        if (empty($_POST['age']) || !filter_var($_POST['age'], FILTER_VALIDATE_INT)) {
            $errors[] = "Leeftijd moet een geldig getal zijn.";
        }

        // Validatie voor wachtwoord
        if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
            $errors[] = "Het wachtwoord moet minimaal 6 tekens bevatten.";
        }

        // Toon resultaten
        if (empty($errors)) {
            echo "<h1>Validatie geslaagd</h1>";
            echo "<p>Bedankt voor het invullen van het formulier!</p>";
        } else {
            echo "<h1>Validatie mislukt</h1>";
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
            echo "<a href='javascript:history.back()'>Ga terug naar het formulier</a>";
        }
    }
    ?>
</body>
</html>
