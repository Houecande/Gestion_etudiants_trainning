<?php
    //fichier de connexion à la base de données
    require_once 'db.php';
    $message = "";
    $status = "";
    
    if(isset($_POST['btn'])){  
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $filiere_id = $_POST['filiere_id'];
        // Vérification que les champs ne sont pas vides
        if (!empty($nom) && !empty($prenom) && !empty($filiere_id)) {
            try{
                // Requête préparée pour l'insertion (protection injections SQL)
                $dt = $db->prepare("INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (?, ?, ?)");
                    $dt->execute([$nom, $prenom, $filiere_id]);
                // Redirection vers index.php avec un message de succès
                header("Location: index.php?status=success&message=Etudiant+ajoute");
                exit();
            } catch (PDOException $e) {
                $message = "Erreur lors de l'ajout : " . $e->getMessage();
                $status = "error";
            }
        } else {
            $message = "Veuillez remplir tous les champs.";
            $status = "error";
        }
    }

    if(isset($_POST['btn2'])){  
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $filiere_id = $_POST['filiere_id'];
        $id = $_POST['id'];
        // Vérification que les champs ne sont pas vides
        if (!empty($nom) && !empty($prenom) && !empty($filiere_id)) {
            try{
                // Requête préparée pour l'insertion (protection injections SQL)
                $dt = $db->prepare("UPDATE etudiants SET nom = ?, prenom = ?, filiere_id = ? WHERE id = ?");
                    $dt->execute([$nom, $prenom, $filiere_id, $id]);
                // Redirection vers index.php avec un message de succès
                header("Location: index.php?status=success&message=Etudiant+mis+à+jour");
                exit();
            } catch (PDOException $e) {
                $message = "Erreur lors de la modification : " . $e->getMessage();
                $status = "error";
            }
        } else {
            $message = "Veuillez remplir tous les champs.";
            $status = "error";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Traitement</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Cette partie HTML ne s'affiche que si une erreur survient et empêche la redirection -->
    <div class="container">
        <h1>Résultat de l'opération</h1>
        <?php if ($message): ?>
            <div class="alert alert-<?= $status ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <a href="index.php">Retour au formulaire</a>
    </div>
</body>
</html>