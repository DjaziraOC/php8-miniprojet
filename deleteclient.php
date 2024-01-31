<?php
    $clients=true;
    include_once __DIR__ . "/main.php";
    // Vérifiez si l'ID existe dans l'URL
    if (!empty($_GET['id'])) {
    // Récupérez l'ID de l'URL du client à supprimer
        $id = $_GET['id'];
        var_dump($id);
    // Supprimer les clients 
        echo "L'ID récupéré de l'URL est : " . $id;
    // Préparer la requête SQL pour supprimer le client
        $requete =$pdo->prepare("DELETE FROM client WHERE idclient = :id ");
    // Binder les valeurs des paramètres
        $requete->bindParam(":id", $id, PDO::PARAM_INT);
    // Exécuter la requête
        try {
            $requete->execute();
            echo "Le client a été supprimé avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du client : " . $e->getMessage();
        }
    // Redirection
        header('Location:clients.php');
        exit;
    } else {
        // Si l'ID n'est pas présent dans l'URL
        echo "Aucun ID trouvé dans l'URL.";
    }
?>
