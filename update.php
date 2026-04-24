<?php
    //fichier de connexion à la base de données
    require_once 'db.php';
    $etudiant = null;
    // Vérification de la présence de l'ID dans l'URL (ex: update.php?id=12)
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        try {
            // 1. Récupération des informations actuelles de l'étudiant pour pré-remplir le formulaire
            $dt = $db->prepare("SELECT * FROM etudiants WHERE id = ?");
            $dt->execute([$id]);
            $etudiant = $dt->fetch(); // On récupère une seule ligne
        } catch (PDOException $e) {
            $error = "Erreur : " . $e->getMessage();
        }
    }
    // Si l'étudiant n'existe pas dans la base, on redirige vers l'accueil avec un message d'erreur
    if (!$etudiant) {
        header("Location: index.php?status=error&message=Etudiant+introuvable");
        exit();
    }
?>
<link rel="stylesheet" href="assets/css/style.css"/>
<body>
    <div class="main-container">
        
        <div class="form-container">
            <h2>Modifier l'étudiant</h2>
            
            <form method='POST' action='traitement.php' class="form">
                <label>Nom :</label><br/>
                <div class="form-group">
                <input type="hidden" name='id' value="<?php echo $etudiant['id']; ?>"/>
                <input type="text" name='nom' value="<?php echo $etudiant['nom']; ?>" required/><br/>
                <label>Prénom :</label><br/>
                <input type="text" placeholder="Prénom de l'étudiant" name='prenom' value="<?php echo $etudiant['prenom']; ?>" required/><br/>
                <label>Filière :</label><br/>
                <select name='filiere_id' class="form-control">
                    <?php
                        //Récupération de toutes les filières de la base de données
                        $req = $db->query('SELECT * FROM filieres');
                        if($req->rowCount() != 0){
                            $dt=$req->fetchAll();
                            for($i=0; $i<sizeof($dt); $i++){
                                // On vérifie si l'ID de la filière en cours correspond à celle de l'étudiant
                                $selected = ($dt[$i]['id'] == $etudiant['filiere_id']) ? "selected" : "";
                                echo "<option value='".$dt[$i]['id']."' $selected>".$dt[$i]['nom']."</option>";
                            }
                        }
                    ?>
                </select><br/>
                <input type="submit" value="Modifier l'étudiant" name = "btn2"/>
                <a href="index.php" class="btn-secondary">Annuler et retourner à la liste</a>
            </form>
        </div>     
    </div>
    <script src="assets/js/script.js"></script>
</body>