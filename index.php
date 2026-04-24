<?php
    //fichier de connexion à la base de données
    require_once 'db.php';     
?>
<link rel="stylesheet" href="assets/css/style.css"/>
<body>
    <h1>Gestion des étudiants</h1>
    <div class="main-container">
        
        <div class="form-container">
            <h2>Ajout d'un étudiant</h2>
            
            <form method='POST' action='traitement.php' class="form">
                <label>Nom :</label><br/>
                <div class="form-group">
                <input type="text" placeholder="Nom de l'étudiant" name='nom' required/><br/>
                <label>Prénom :</label><br/>
                <input type="text" placeholder="Prénom de l'étudiant" name='prenom' required/><br/>
                <label>Filière :</label><br/>
                <select name='filiere_id' class="form-control">
                    <option value="">-- Choisissez une filière --</option>
                    <?php
                        //Récupération de toutes les filières de la base de données
                        $req = $db->query('SELECT * FROM filieres');
                        if($req->rowCount() != 0){
                            $dt=$req->fetchAll();
                            for($i=0; $i<sizeof($dt); $i++){
                                echo '<option value="'.$dt[$i]['id'].'">'.$dt[$i]['nom'].'</option>';
                            }
                        }
                    ?>
                </select><br/>
                <input type="submit" value="Ajouter l'étudiant" name = "btn"/>
            </form>
        </div>     
    </div>
        <div class="table-container">
            <h2>Liste des étudiants</h1>
            <?php if (isset($_GET['message'])): ?>
                <div class="alert alert-<?= htmlspecialchars($_GET['status'] ?? 'success') ?>">
                    <?= htmlspecialchars($_GET['message']) ?>
                </div>
            <?php endif; ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Filière</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //Récupération de tous les étudiants avec leur filière
                        $req = $db->query('SELECT e.id, e.nom, e.prenom, f.nom AS filiere FROM etudiants e JOIN filieres f ON e.filiere_id = f.id');
                        if($req->rowCount() != 0){
                            $dt=$req->fetchAll();
                            for($i=0; $i<sizeof($dt); $i++){
                                echo '<tr>';
                                echo '<td>'.$dt[$i]['nom'].'</td>';
                                echo '<td>'.$dt[$i]['prenom'].'</td>';
                                echo '<td>'.$dt[$i]['filiere'].'</td>';
                                echo '<td><a href="update.php?id='.$dt[$i]['id'].'" class="btn-edit">Modifier</a>  <a href="delete.php?id='.$dt[$i]['id'].'" class="btn-delete" onclick="return confirm(\'Êtes-vous sûr ?\')">Supprimer</a></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">Aucun étudiant trouvé.</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    <script src="assets/js/script.js"></script>
</body>