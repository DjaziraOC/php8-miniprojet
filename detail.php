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

?>
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
                <button type="submit" name="submit" class="btn btn-primary">Fermer</button>
            </div>
        </form>
    </div>
</main>  
<?php   
        // endwhile;
        // endwhile;
        // $PDOStatement->closeCursor();
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
    
    // $PDOstatment->closeCursor();  
?>
<?php
  include_once ("footer.php");
?>

  


 

