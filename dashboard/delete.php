<?php
include_once('../database/connexion.php');
require_once('job.php');

// Vérifier si l'ID de l'article à supprimer est passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $job_id = $_GET['id'];

    // Créer une instance de la classe Job
    $job = new Job($conn);

    // Appeler la méthode pour supprimer l'article
    $result = $job->deleteArticle($job_id);

    if ($result === true) {
        // Rediriger vers la page des articles après la suppression
        header('Location: article.php');
    } else {
        // Gérer les erreurs de suppression ici
        echo "Error: " . $result;
    }
} else {
    // Rediriger vers la page des articles si l'ID n'est pas valide
    header('Location: article.php');
}
?>
