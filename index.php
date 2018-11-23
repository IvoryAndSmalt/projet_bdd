<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projet BDD</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php

    // '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['avatar_url'].'</p>';

    $bdd = new PDO('mysql:host=localhost;dbname=test', 'phpmyadmin', 'test');?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <h2>Exercice 1</h2>
    <button id="btnexo1">Afficher</button>

    <div id="exo1">
        <blockquote>
            1) Afficher tous les gens dont le nom est palmer.
        </blockquote><br>
        <?php
            $reponse = $bdd->query('SELECT * FROM table1 WHERE last_name = "Palmer"');
            while ($donnees = $reponse->fetch()) {
                echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['country_code'].'</p>';
            }
        ?>
    </div>

    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <h2>Exercice 2</h2>
    <button id="btnexo2">Afficher</button>
    <div id="exo2">
        <blockquote>
            2) Afficher toutes les femmes.
        </blockquote><br>
        <?php
            $reponse = $bdd->query('SELECT * FROM table1 WHERE gender = "female"');
            while ($donnees = $reponse->fetch()) {
                echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['country_code'].'</p>';
            }
        ?>
    </div>
    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <h2>Exercice 3</h2>
    <button id="btnexo3">Afficher</button>
    <div id="exo3">
        <blockquote>
            3) Tous les états dont la lettre commence par N.
        </blockquote><br>
        <?php
            $reponse = $bdd->query('SELECT DISTINCT * FROM table1 WHERE country_code LIKE "N%"');
            while ($donnees = $reponse->fetch()) {
                echo '<p>' .$donnees['country_code'].'</p>';
            }
        ?>
    </div>
    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <h2>Exercice 4</h2>
    <button id="btnexo4">Afficher</button>
    <div id="exo4">
        <blockquote>
            4) Tous les emails qui contiennent google.
        </blockquote><br>
        <?php
        $reponse = $bdd->query('SELECT * FROM table1 WHERE email LIKE "%google%"');
        while ($donnees = $reponse->fetch()) {
            echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].'</p>';
        }
        ?>
    </div>
    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <h2>Exercice 5</h2>
    <button id="btnexo5">Afficher</button>
    <div id="exo5">
        <blockquote>
            5) Répartition par Etat et le nombre d’enregistrement par état (croissant).
        </blockquote><br>
        <?php
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
            if ($i>0){
                echo "<h3>Il y a " . $i . " habitants dans le pays " . $value . "</h3>";
            }
            $i=0;?>
            <div style="height: 1px; width: 80%; background-color: blue;"></div>
            <?php
        }
    ?>
    </div>
    <div style="height: 1px; width: 100%; background-color: black;"></div>
    <!-- 6) Insérer un utilisateur, lui mettre à jour son adresse mail puis supprimer l’utilisateur. -->
    <h1>Exercice 6</h1>
    <div class="formcontainer">
        <form action="#backToUser" class="myform" id="backToUser" method="post">
            <input id="formemail" type="email" placeholder="email" name="email">
            <input id="formfn" type="text" placeholder="Frist Name" name="first">
            <input id="formln" type="text" placeholder="Last Name" name="last">
            <input id="formcc" type="text" placeholder="Country Code" name="countrycode">
            <input id="formdob" type="date" name="dateofbirth">
            <input type="submit" value="Confirmer" name="send" id="envoyer"><label for="envoyer"></label>
        </form>
    </div>

    <?php

        $reponse = $bdd->prepare("INSERT INTO table1 (first_name, last_name, email, country_code, birth_date) VALUES (? , ?, ?, ?, ?)");
        
        
        
        if(!isset($_POST['first']) || !isset($_POST['last']) || !isset($_POST['email']) || !isset($_POST['countrycode']) || !isset($_POST['dateofbirth'])){
            echo "Veuillez remplir les tous les champs.";
        }
        else{
            echo "la requête a été envoyée";
            $reponse->execute(array($_POST['first'], $_POST['last'], $_POST['email'], $_POST['countrycode'], $_POST['dateofbirth']));
        }
    ?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>
    <h1>Exercice 7</h1>
    <!-- 7) Nombre de femme et d’homme. -->
    <?php
    $reponse = $bdd->query('SELECT gender FROM table1 WHERE 1');

    $gender = array();

    while ($donnees = $reponse->fetch()){
        array_push($gender, $donnees['gender']);
    }
    $im=0;
    $if=0;
    foreach ($gender as $value) {
        if($value === "Male"){
            $im=$im+1;
        }
        else if($value === "Female"){
            $if=$if+1;
        }     
    }
        echo "<h3>Il y a " . $im . " hommes et " . $if . " femmes dans l'entreprise.</h3>";
       
    ?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>
    <h1>Exercice 8</h1>

    <!-- 8) Afficher l'âge de chaque personne, puis la moyenne d’âge générale, celle des femmes puis celle des hommes. -->
    
    <?php
    $reponse = $bdd->query('SELECT first_name, last_name, birth_date FROM table1 WHERE 1');

    $age = array();

    while ($donnees = $reponse->fetch()){
        array_push($age, $donnees['birth_date']);
        $today = date_format(date_create('today'), "d/m/Y");
        $datetoday = date_create_from_format("d/m/Y", $today);
        $birth = date_create_from_format("d/m/Y", $donnees['birth_date']);
        echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'] . ', '. date_diff($birth, $datetoday)->y . '</p>';
    }

    ?>
    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <h2>Exercice 9</h2>
    <!-- 9) Créer deux nouvelles tables, une qui contient l’ensemble des membres de l’ACS, l’autre qui contient les département avec numéros et nom écrit. Afficher le nom de chaque apprenant avec son département de résidence. -->

    <?php
        $reponse = $bdd->query('SELECT * FROM table1 WHERE email LIKE "%google%"');

        while ($donnees = $reponse->fetch()) {
            echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['country_code'].'</p>';
        }
    ?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>

<script src="assets/js/script.js"></script>

</body>

</html>