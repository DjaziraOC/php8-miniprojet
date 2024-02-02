<?php
   $articles=true;
    include_once __DIR__ . "/main.php";
// Table ligne_commande 
    // Vérifiez si l'ID existe dans l'URL
if (!empty($_GET["idcommande"])) {
    // Récupérez l'ID de l'URL du client à supprimer
        $idcommande = $_GET["idcommande"];
        var_dump( $idcommande);
    // Supprimer les commandes
        echo "L'ID récupéré de l'URL est : " .  $idcommande;
    // Préparer la requête SQL pour supprimer la commande séléctionné
        $requete =$pdo->prepare("DELETE FROM ligne_commande WHERE idcommande = :idcommande ");
    // Binder les valeurs des paramètres
        $requete->bindParam(":idcommande",  $idcommande, PDO::PARAM_INT);
    // Exécuter la requête
        $requete->execute();
            
// table commande 
    // Préparer la requête SQL pour supprimer la commande séléctionné
        $requete2 =$pdo->prepare("DELETE FROM commande WHERE idcommande = :idcommande ");
    // Binder les valeurs des paramètres
        $requete2->bindParam(":idcommande",  $idcommande, PDO::PARAM_INT);
    // Exécuter la requête
        try {
            $requete2->execute();
            echo "La commande a été supprimé avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la commande : " . $e->getMessage();
        }
    // Redirection
        header('Location:commandes.php');
        exit;
} else {
    // Si l'ID n'est pas présent dans l'URL
    echo "Aucun ID trouvé dans l'URL.";
}

//Table Commande  
    // Vérifiez si l'ID existe dans l'URL
    if (!empty($_GET["idcommande"])) {
    // Récupérez l'ID de l'URL du client à supprimer
        $idcommande = $_GET["idcommande"];
        var_dump( $idcommande);
    // Supprimer les commandes
        echo "L'ID récupéré de l'URL est : " .  $idcommande;
    // Préparer la requête SQL pour supprimer la commande séléctionné
        $requete =$pdo->prepare("DELETE FROM commande WHERE idcommande = :idcommande ");
    // Binder les valeurs des paramètres
        $requete->bindParam(":idcommande",  $idcommande, PDO::PARAM_INT);
    // Exécuter la requête
        try {
            $requete->execute();
            echo "La commande a été supprimé avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la commande : " . $e->getMessage();
        }
    // Redirection
        header('Location:commandes.php');
        exit;
    } else {
        // Si l'ID n'est pas présent dans l'URL
        echo "Aucun ID trouvé dans l'URL.";
    }
?>
