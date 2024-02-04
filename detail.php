<?php
    $index=true;
    include_once __DIR__ ."/header.php";  
    include_once __DIR__ ."/main.php";

    if(!empty($_GET["id"])){
       $listidclient= [];

//Récupérer et afficher les informations  
        $query = "SELECT * FROM commande
        INNER JOIN ligne_commande ON commande.idcommande = ligne_commande.idcommande
        INNER JOIN client ON commande.idclient = client.idclient
        WHERE commande.idcommande = :idcommande";
                
        $PDOStatement2= $pdo->prepare($query);
        // Binder les valeurs des paramètres
        $PDOStatement2->bindParam(":idcommande",$_GET["id"],PDO::PARAM_INT);
        // Exécuter la requête
        $PDOStatement2->execute();
        // Récupérer tous les résultats sous forme de tableau associatif
        $ligne= $PDOStatement2->fetch(PDO::FETCH_ASSOC);
        // var_dump($ligne);
// Les liste (idclients/idarticles)
    // La liste déroulante des idarticles (Table article)
        // Préparer et exécuter une requête SELECT pour récupérer tous les idarticle de la table article
        $query = "SELECT idarticle FROM article";
        $PDOStatement= $pdo->prepare($query);
        // Exécuter la requête
        $PDOStatement->execute();
        // Récupérer tous les résultats sous forme de tableau associatif
        $tabidarticles=$PDOStatement->fetchAll(PDO::FETCH_NUM); 
        // var_dump($tabidarticles) ;
    // La liste déroulante des idclients (Table client)
        // Préparer et exécuter une requête SELECT pour récupérer tous les idclient de la table client
        $query = "SELECT idclient FROM client";
        $PDOStatement= $pdo->prepare($query);
        // Exécuter la requête
        $PDOStatement->execute();
        // Récupérer tous les résultats sous forme de tableau associatif
        $tabidclients=$PDOStatement->fetchAll(PDO::FETCH_NUM);   
        // var_dump( $tabidclients)

// stocker le nombre de vues & Mettre à jour le compteur de vues chaque fois qu'on séléctionne la commande .
        // Nom de la page // $pageName = basename($_SERVER['PHP_SELF']);
        // Utiliser l'URL complète comme clé // $pageKey = $_SERVER['REQUEST_URI']; 
        // Utiliser l'id (url) comme clé 
        $pageKey = $_GET['id']; 
        // var_dump($pageKey); 
    
        // Vérifier si la page est déjà enregistrée dans la table
        $query = "SELECT vues FROM commande WHERE idcommande = :idcommande";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':idcommande', $pageKey, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);  
        // var_dump($result);
    if (!$result) {
        // Si la page n'est pas dans la table, l'ajouter
        $query = "INSERT INTO commande (idcommande,vues) VALUES (:idcommande,1)";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':idcommande', $pageKey, PDO::PARAM_INT);
        $statement->execute();
    } else {
        // Sinon, mettre à jour le compteur de vues
        $query = "UPDATE commande SET vues = vues + 1 WHERE idcommande = :idcommande";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':idcommande', $pageKey, PDO::PARAM_INT);
        $statement->execute();
    }
?> 
        <?php foreach($result as $value){
            $viewnumber = $value;
        ?>
        <button class="btn btn-primary" style="float:right;margin-bottom:20px;"> 
                <?php echo  $viewnumber ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
        </button>
        <?php }?>
        <h2  class="mt-5">Détail de la commande </h2>
        <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <input type="hidden" name="myidcommande" value="<?php echo $ligne['idcommande']?>">
            <div class="col-md-6">             
                <label for="idclientliste"  class="form-label">ID client:</label>
                <select class="form-control" name="idclientliste" disabled>
                    <?php
                    //la liste déroulante idclient-modifier la commande
                        foreach($tabidclients as $tabidclient){
                            foreach($tabidclient as $idclientvalue){
                                //séléctionner la commande à modifier en affichant son idclient sur la liste déroulante
                                $selected=($commande['idclient']==$idclientvalue)?"selected":"";
                                echo "<option value=".$idclientvalue." ".$selected.">".$idclientvalue."</option>";
                            }
                        }                  
                    ?>
                </select>          
            </div>
            <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom"  value="<?php echo $ligne['nom']?>" disabled>
        </div>
        <div class="col-md-6">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville"  value="<?php echo $ligne['ville']?>" disabled>
        </div>
        <div class="col-md-6">
            <label for="telephone" class="form-label">Télephone</label>
            <input type="text" class="form-control" id="telephone" name="telephone"  value="<?php echo $ligne['telephone']?>" disabled >
        </div>
            <div class="col-md-6">
                <label for="date_commande" class="form-label">Date :</label>
                <input type="date"  class="form-control" id="date_commande" name="date_commande" value="<?php echo $ligne["date_commande"]?>" disabled>
            </div>
            <div class="col-md-6">
                <label for="idarticle" class="form-label">ID article</label>
                <select class="form-control" name="idarticleliste" disabled>
                    <?php
                    //la liste déroulante idclient-modifier la commande
                        foreach($tabidarticles as $tabidarticle){
                            foreach($tabidarticle as $idarticlevalue){
                                //séléctionner la commande à modifier en affichant son idclient sur la liste déroulante
                                // $selectedarticle=($ligne_commande["idarticle"]==$idarticlevalue)?"selected":"";
                                echo "<option value=".$idarticlevalue." ".$selectedarticle.">".$idarticlevalue."</option>";
                            }
                        }                  
                    ?>
                </select>  
            </div>
            <div class="col-md-6">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="text" class="form-control" id="quantite" name="quantite" value="<?php echo $ligne["quantite"]?>" disabled>
            </div>
            <div class="col-md-12"> 
                <a href="index.php" type="submit" name="submit" class="btn btn-primary">Fermer</a>
            </div>
        </form>
    </div>
</main>  
<?php   
        $PDOStatement2->closeCursor();
        try{
            if(!empty($_POST)){
              // header("location:index.php");  
            }
           
        }catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }else{
        echo "ID du coommande non spécifié.";
    }   
?>
<?php
  include_once ("footer.php");
?>

  


 

