<?php
include_once('../database/connexion.php');
require_once('job.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title']) && isset($_POST['description'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $company = $_POST['company'];
        $location = $_POST['location'];
        $status = $_POST['status'];
        $date_created = $_POST['date_created'];
        $image_path = $_POST['image_path'];

        $nouvelUtilisateur = new Job($conn);

        // Configurer les propriétés d'abord
        $nouvelUtilisateur->setTitle($title);
        $nouvelUtilisateur->setDescription($description);
        $nouvelUtilisateur->setCompany($company);
        $nouvelUtilisateur->setLocation($location);
        $nouvelUtilisateur->setStatus($status);
        $nouvelUtilisateur->setDateCreated($date_created);
        $nouvelUtilisateur->setImagePath($image_path);

        // Ensuite, ajouter l'article
        $nouvelUtilisateur->addArticle($title, $company, $description, $location, $status, $date_created, $image_path);
        header('Location: article.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
<body>
    <div class="container">

    <!-- les informations qui j'entre seront sécurisés avec la methode poste -->
     <form id="forms" method="POST" >
                            <!-- 2 column grid layout with text inputs for the first and last names -->
                            <div class="row mb-4">
                              <div class="col">
                                <div class="">
                                  <label class="form-label" >Title</label>
                                  <input type="text" class="form-control first_name" name="title" >
                                </div>
                              </div>
                              <div class="col">
                              <div class="">
                                <label class="form-label" >Company</label>
                              <input type="text" class="form-control email"name="company" >
                            </div>
                              </div>
                            </div>
                          
                            <!-- Text input -->
                            <div class="mb-4">
                                    <label class="form-label" >Description</label>
                                    <textarea class="form-control position"  rows="4" name="description"></textarea>
                                </div>
                           
                          
                            <!-- Text input -->
                            <div class="mb-4">
                                <label class="form-label">Location</label>
                              <input type="text" class="form-control title_user"name="location" >
                            </div>
                          
                            <!-- Number input -->
                            <div class=" mb-4">
                              <label class="form-label">Status</label>
                              <input type="text" class="form-control status" name="status" >
                            </div>
                          
                            <!-- Message input -->
                            <div class=" mb-4">
                              <label class="form-label">Date_Created</label>
                              <input type="text" class="form-control first_name" name="date_created">                          
                            </div>
                            <div class=" mb-4">
                              <label class="form-label">image_path</label>
                              <input type="file" class="form-control first_name" name="image_path">                          
                            </div>                         
                                    <div class="row mb-3">
                                        <div class="offset-sm-3 col-sm-3">
                                            <div class="d-grid">
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <div class="d-grid">
                                                <a class="btn btn-outline-primary" href="article.php" role="button">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
    </form>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="dashboard.js"></script>
        <script src="agents.js"></script>  
</body>
</html>