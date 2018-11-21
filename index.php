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
    <!-- 6) Insérer un utilisateur, lui mettre à jour son adresse mail puis supprimer l’utilisateur. -->
    <h1>Exercice 6</h1>
    <div class="formcontainer">
        <form action="#backToUser" class="myform" id="backToUser" method="post">
            <input id="formemail" type="email" placeholder="email" name="email">
            <input id="formfn" type="text" placeholder="Frist Name" name="first">
            <input id="formln" type="text" placeholder="Last Name" name="last">
            <input id="formcc" type="text" placeholder="Country Code" name="countrycode">
            <input id="formdob" type="date" placeholder="Date of Birth" name="dateofbirth">
            <input type="submit" value="Confirmer" name="send" id="envoyer"><label for="envoyer"></label>
        </form>
    </div>

    <?php

        $reponse = $bdd->prepare("INSERT INTO table1 (first_name, last_name, email, country_code, birth_date) VALUES (? , ?, ?, ?, ?)");
        
        
        
        if(!isset($POST['first']) || !isset($_POST['last']) || !isset($_POST['email']) || !isset($_POST['countrycode']) || !isset($_POST['dateofbirth'])){
            echo "Veuillez remplir les tous les champs.";
        }
        else {
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
    <h1>Exercice 7</h1>
    <!-- 8) Afficher l'âge de chaque personne, puis la moyenne d’âge générale, celle des femmes puis celle des hommes. -->
    
    <?php
    $reponse = $bdd->query('SELECT first_name, last_name, birth_date FROM table1 WHERE 1');

    $age = array();

    while ($donnees = $reponse->fetch()){
        array_push($gender, $donnees['birth_date']);
        echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'] . ', '. date_diff(date_create($donnees['birth_date']), date_format(date_create('today')))->y . '</p>';
    }

    

        // echo "<h3>Il y a " . $im . " hommes et " . $if . " femmes dans l'entreprise.</h3>";
       
        // while ($donnees = $reponse->fetch()) {
        //     echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['country_code'].'</p>';
        // }
    ?>
    <div style="height: 1px; width: 100%; background-color: black;"></div>
</body>

</html>