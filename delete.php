<?php
    //fichier de connexion à la base de données
    require_once 'db.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        try {
            // Requête préparée pour la suppression (protection injections SQL)
            $dt = $db->prepare("DELETE FROM etudiants WHERE id = ?");
            $dt->execute([$id]);
            // Redirection vers index.php avec un message de succès
            header("Location: index.php?status=success&message=Etudiant+supprime");
            exit();
        } catch (PDOException $e) {
            // En cas d'erreur, redirection avec un message d'erreur
            header("Location: index.php?status=error&message=Erreur+de+suppression");
            exit();
        }
    } else {
        // Si aucun ID n'est fourni, redirection avec un message d'erreur
        header("Location: index.php?status=error&message=ID+invalide");
        exit();
    }
?>