<?php
$commandes=true;
include_once __DIR__ . "/header.php";
include_once __DIR__ . "/main.php";

// La liste déroulante des idclients (commande)
    // Préparer et exécuter une requête SELECT pour récupérer tous les idclient de la table client
    $query = "SELECT idclient FROM client";
    $PDOStatement= $pdo->prepare($query);
    // Exécuter la requête
    $PDOStatement->execute();
    // Récupérer tous les résultats sous forme de tableau associatif
    $tabidclients=$PDOStatement->fetchAll(PDO::FETCH_NUM);   
    // var_dump( $tabidclients);
// La liste déroulante des idarticle (ligne_commande)
    // Préparer et exécuter une requête SELECT pour récupérer tous les idarticle de la table article
    $query2 = "SELECT idarticle FROM article ";
    $PDOStatement2= $pdo->prepare($query2);
    // Exécuter la requête
    $PDOStatement2->execute();
    // Récupérer tous les résultats sous forme de tableau associatif
    $tabidarticles=$PDOStatement2->fetchAll(PDO::FETCH_NUM);   
    // var_dump($tabidarticles);
//---s'assurer qu'aucun champ de formulaire est vide 
if(!empty($_POST["quantite"])&&!empty($_POST["date_commande"])){
    try{
    // L'interface commande
        $query = "INSERT INTO  commande (idclient,date_commande) VALUES (:idclient,:date_commande)";
        $pdoStmt= $pdo->prepare($query);
        // Liaison des paramètres
        $pdoStmt->bindParam(':idclient', $_POST["idclientliste"],PDO::PARAM_INT);
        $pdoStmt->bindParam(':date_commande', $_POST["date_commande"]);
        //l'excution de la requête 
        $pdoStmt->execute();
        //Récupération de l'ID de la dernière ligne insérée 
        $idcommandes=$pdo->lastInsertId();
      
    // L'interface ligne_commande
        // Préparation de la requête
        $query3 = "INSERT INTO  ligne_commande (idcommande,idarticle,quantite) VALUES (:idcommande,:idarticle,:quantite)";
        $pdoStmt3= $pdo->prepare($query3);
        // Liaison des paramètres
        $pdoStmt3->bindParam(':idcommande',$idcommandes);
        $pdoStmt3->bindParam(':idarticle',$_POST["idarticlelist"]);
        $pdoStmt3->bindParam(':quantite',$_POST["quantite"]);
        //l'excution de la requête 
        if ($message=$pdoStmt3->execute()){
            // echo "les données de formulaire sont sauvegarder dans la BD avec succée.";
            $messageS ['messages']="les données de formulaire sont sauvegarder dans la BD avec succée.";
        } else {
            echo "Erreur d'execution SQL statement: " . $pdoStmt3->errorInfo()[2];
        }

    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    } finally {
        // Fermeture du curseur pour libérer les ressources du curseur.
            $pdoStmt->closeCursor();
        // header(header:"/Location:clients.php");
    }
}
?>
    <h1 class="mt-5">Ajouter une commande</h1>
    <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="col-md-6">
            <label for="idclientlist" class="form-label">ID client</label>
            <select class="form-control" name="idclientliste">
                <?php
                    foreach($tabidclients as $tabidclient){
                        foreach($tabidclient as $tabidclientvalue){
                            for ($i =0; $i < count($tabidclient); $i++) {
                                echo '<option value="' .$tabidclient[$i] . '">' . $tabidclient[$i] . '</option>';
                            }
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="date_commande" class="form-label">Date</label>
            <input type="date" class="form-control" id="date_commande" name="date_commande" required>
        </div>
        <div class="col-md-6">
            <label for="idarticlelist" class="form-label">ID article</label>
            <select class="form-control" name="idarticlelist">
                <?php
                    foreach($tabidarticles as $tabidarticle){
                        foreach($tabidarticle as $tabidarticlevalue){
                            echo "<option value=".$tabidarticlevalue.">".$tabidarticlevalue."</option>";
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="text" class="form-control" id="quantite" name="quantite" required>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit" name="submit">Ajouter</button>
        </div>
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
            <div><?= isset($message)? '<div class="mt-5">'.$messageS ['messages'] .'</div>':''?> </div>
        </div>
    </form>
</div>
</main>
<?php 
  include_once ("footer.php");
?>
