<?php
   $articles=true;
    include_once __DIR__ . "/main.php";
    // Vérifiez si l'ID existe dans l'URL
    if (!empty($_GET["idarticle"])) {
    // Récupérez l'ID de l'URL du client à supprimer
        $idarticle = $_GET["idarticle"];
        var_dump($idarticle);
    // Supprimer les clients 
        echo "L'ID récupéré de l'URL est : " . $idarticle;
    // Préparer la requête SQL pour supprimer le client
        $requete =$pdo->prepare("DELETE FROM article WHERE idarticle = :idarticle ");
    // Binder les valeurs des paramètres
        $requete->bindParam(":idarticle", $idarticle, PDO::PARAM_INT);
    // Exécuter la requête
        try {
            $requete->execute();
            echo "L'articlea été supprimé avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de l'article : " . $e->getMessage();
        }
    // Redirection
        header('Location:articles.php');
        exit;
    } else {
        // Si l'ID n'est pas présent dans l'URL
        echo "Aucun ID trouvé dans l'URL.";
    }
?>
