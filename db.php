<?php
    try{
        //Connexion à la base de donnée
        $db=new PDO(mysql:host:127.0.0.1;dbname='gestion_etudiants_trainning','root','' );
    } catch (PDOExecption $e) { 
        //si la connexion échoue, le script s'arrête et affiche l'erreur
        die("Erreur de connexion : " . $e->getMessage());
    }
?>