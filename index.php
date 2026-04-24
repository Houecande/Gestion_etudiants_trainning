<?php
    //fichier de connexion à la base de données
    require_once 'db.php';     
?>
<link rel="stylesheet" href="assets/css/style.css"/>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Gestion des étudiants</h1>
            <form method='POST' action='traitement.php' class="form">
                <label>Nom :</label><br/>
                <div class="form-group">
                <input type="text" placeholder="nom" name='nom'/><br/>
                <label>Prénom :</label><br/>
                <input type="text" placeholder="prénom" name='prenom'/><br/>
                <label>Filière :</label><br/>
                <select name='filiere_id' placeholder="choisir" class="form-control">
                    <option value="">-- choisissez une filière --</option>
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
        <div class="table-container">
            <h1>Liste des étudiants</h1>
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
                                echo '<td><a href="update.php?id='.$dt[$i]['id'].'" class="btn-edit">Modifier</a> | <a href="delete.php?id='.$dt[$i]['id'].'" class="btn-delete">Supprimer</a></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">Aucun étudiant trouvé.</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="assets/js/script.js"></script>
</body>