<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projet BDD</title>
</head>
<body>

    <?php

    // '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['avatar_url'].'</p>';

    $bdd = new PDO('mysql:host=localhost;dbname=test', 'phpmyadmin', 'test');?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <?php
        echo "<h2>Exercice 1</h2>";

        $reponse = $bdd->query('SELECT * FROM table1 WHERE last_name = "Palmer"');
        while ($donnees = $reponse->fetch()) {
            echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['country_code'].'</p>';
        }
    ?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>
    <?php
        echo "<h2>Exercice 2</h2>";

        $reponse = $bdd->query('SELECT * FROM table1 WHERE gender = "female"');
        while ($donnees = $reponse->fetch()) {
            echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['country_code'].'</p>';
        }
    ?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <?php
        echo "<h2>Exercice 3</h2>";

        $reponse = $bdd->query('SELECT * FROM table1 WHERE country_code LIKE "N%"');
        while ($donnees = $reponse->fetch()) {
            echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['country_code'].'</p>';
        }
    ?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <?php
        echo "<h2>Exercice 4</h2>";

        $reponse = $bdd->query('SELECT * FROM table1 WHERE email LIKE "%google%"');
        while ($donnees = $reponse->fetch()) {
            echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['country_code'].'</p>';
        }
    ?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <?php
        echo "<h2>Exercice 5</h2>";

        $reponse = $bdd->query('SELECT DISTINCT country_code FROM table1 ORDER BY country_code');

        $ccd = array();

        while ($donnees = $reponse->fetch()){
            array_push($ccd, $donnees['country_code']);
        }
$i=0;
        foreach ($ccd as $value) {
            $getpop = $bdd->query("SELECT * FROM table1 WHERE country_code ='$value'");
            
            while ($popinner = $getpop->fetch()){
                $i=$i+1;
                echo '<p>' . $popinner['last_name'].', '.$popinner['first_name'].', '.$popinner['email'].', '.$popinner['gender'].', '.$popinner['ip_address'].', '.$popinner['birth_date'].', '.$popinner['avatar_url'].'</p>';
            }
            echo "<h3>Il y a " . $i . " habitants dans le pays " . $value . "</h3>";
            $i=0;?>
            <div style="height: 1px; width: 80%; background-color: blue;"></div>
            <?php
        }
    ?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>

<?php
    echo "<h2>Exercice 4</h2>";

    // $reponse = $bdd->query('INSERT INTO `table1`(first_name, last_name, email, gender, birth_date, avatar_url, country_code) VALUES ("",'Jean','Valjean','jean.valjean@hotmail.fr','male',NULL,NULL,NULL,NULL,NULL,NULL);');
    // while ($donnees = $reponse->fetch()) {
    //     echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['country_code'].'</p>';
    // }
?>

<div style="height: 1px; width: 100%; background-color: black;"></div>

</body>

</html>