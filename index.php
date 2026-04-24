<?php
    //fichier de connexion à la base de données
    require_once 'db.php';     
?>
<link rel="stylesheet" href="assets/css/style.css"/>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Gestion des étudiants</h1>
            <form method='$_POST' action='traitement.php' class="form">
                <label>Nom :</label><br/>
                <div class="form-group">
                <input type="text" placeholder="nom" name='name'/><br/>
                <label>Prénom :</label><br/>
                <input type="text" placeholder="prénom" name='prenom'/><br/>
                <label>Filière :</label><br/>
                <select name='filiere' placeholder="choisir" class="form-control">
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
                <input type="submit" value="Ajouter l'étudiant"/>
            </form>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>