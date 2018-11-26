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

<!-- '<p>' . $donnees['last_name'].', '.$donnees['first_name'].', '.$donnees['email'].', '.$donnees['gender'].', '.$donnees['ip_address'].', '.$donnees['birth_date'].', '.$donnees['avatar_url'].', '.$donnees['avatar_url'].'</p>'; -->

    <?php
        include('mdp.php');
        $bdd = new PDO('mysql:host=https://promo-24.codeur.online;dbname=test', 'lucasv', $mdp);

    ?>

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
                echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'] . '</p>';
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
            $reponse = $bdd->query('SELECT DISTINCT country_code FROM table1 WHERE country_code LIKE "N%" ORDER BY country_code');
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
            5) Répartition par Etat et le nombre d’enregistrement par état (décroissant).
        </blockquote><br>
        <?php

        $reponse = $bdd->query("SELECT COUNT(*) AS nbr_doublon, country_code from table1 GROUP BY country_code HAVING COUNT(*) >= 1 ORDER BY nbr_doublon DESC");
        while ($donnees = $reponse->fetch()){

        echo '<p>Il y a ' . $donnees['nbr_doublon'] . ' habitants dans le pays ' . $donnees['country_code'] .'</p>';
        }
        ?>
            <div style="height: 1px; width: 80%; background-color: blue;"></div>
    </div>
    <div style="height: 1px; width: 100%; background-color: black;"></div>
    <h2>Exercice 6</h2>
    <button id="btnexo6">Afficher</button>
    <div id="exo6">
        <blockquote>
            6) Insérer un utilisateur, lui mettre à jour son adresse mail puis supprimer l’utilisateur.
        </blockquote><br>
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
    </div>

    <div style="height: 1px; width: 100%; background-color: black;"></div>
    <h2>Exercice 7</h2>
    <!-- 7) Nombre de femme et d’homme. -->
    <?php
    $reponse = $bdd->query('SELECT gender, COUNT(*) AS nombre FROM table1 GROUP BY gender');

    while ($donnees = $reponse->fetch()){
        echo "<p> Il y a ". $donnees['nombre'] . " " . $donnees['gender'] . " dans l'entreprise.";
    }
       
    ?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>


    <h2>Exercice 8</h2>
    <button id="btnexo8">Afficher</button>
    <div id="exo8">
        <blockquote>
            8) Afficher l'âge de chaque personne, puis la moyenne d’âge générale, celle des femmes puis celle des hommes.
        </blockquote><br>
    <?php
    // $reponse = $bdd->query('SELECT first_name, last_name, birth_date, gender FROM table1 WHERE 1');

    // $age = array();

    // while ($donnees = $reponse->fetch()){
    //     array_push($age, $donnees['birth_date']);
    //     $today = date_format(date_create('today'), "d/m/Y");
    //     $datetoday = date_create_from_format("d/m/Y", $today);
    //     $birth = date_create_from_format("d/m/Y", $donnees['birth_date']);
    //     echo '<p>' . $donnees['last_name'].', '.$donnees['first_name'] . ', '. date_diff($birth, $datetoday)->y . '</p>';

        // }
        $reponse = $bdd->query("SELECT ROUND(AVG(TIMESTAMPDIFF(year, STR_TO_DATE(birth_date, '%d/%m/%Y'), NOW())), 1) AS average FROM table1");
        while ($donnees = $reponse->fetch()){
        echo "<p> La moyenne d'âge des employés est de " . $donnees['average'] . " ans.</p>";
        }

        $reponse = $bdd->query("SELECT gender, ROUND(AVG(TIMESTAMPDIFF(year, STR_TO_DATE(birth_date, '%d/%m/%Y'), NOW())), 1) AS average FROM table1 GROUP BY gender");
        while ($donnees = $reponse->fetch()){
        echo "<p> La moyenne d'âge des " . $donnees['gender'] ." est de " . $donnees['average'] . " ans.</p>";
        }

        $reponse = $bdd->query('SELECT last_name, first_name, TIMESTAMPDIFF(year, STR_TO_DATE(birth_date, "%d/%m/%Y"), NOW()) AS age FROM table1');
        while ($donnees = $reponse->fetch()){
            echo '<p>' . $donnees['first_name'] . ', ' . $donnees['age'] . '</p>';
        }

    ?>
    </div>
    <div style="height: 1px; width: 100%; background-color: black;"></div>

    <h2>Exercice 9</h2>
    <button id="btnexo9">Afficher</button>
    <div id="exo9">
        <blockquote>
            9) Créer deux nouvelles tables, une qui contient l’ensemble des membres de l’ACS, l’autre qui contient les département avec numéros et nom écrit. Afficher le nom de chaque apprenant avec son département de résidence.
        </blockquote><br>
    <?php

        $drop = $bdd->prepare("DROP TABLE Departements, Persons");
        $drop->execute();

        $createPersons = $bdd->prepare('CREATE TABLE Persons(
            PersonID int,
            nom varchar(255),
            prenom varchar(255))'); 
        // A terme un input à la place de Persons
        $createPersons->execute();

        $createPersons = $bdd->prepare('CREATE TABLE Departements(
            PersonID int,
            nom varchar(255),
            prenom varchar(255))'); 
        // A terme un input à la place de Persons
        $createPersons->execute();

    ?>

    <div style="height: 1px; width: 100%; background-color: black;"></div>

<script src="assets/js/script.js"></script>

</body>

</html>