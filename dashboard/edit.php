<?php
include_once('../database/connexion.php');
require_once('job.php');

// Vérifier si l'ID de l'article à éditer est passé en paramètre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_GET['id'];

    // Créer une instance de la classe Job
    $jobModifier = new Job($conn);

    // Récupérer les détails de l'article à éditer
    $articleDetails = $jobModifier->getArticleDetails($job_id);

    if ($articleDetails) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $company = $_POST['company'];
        $location = $_POST['location'];
        $status = $_POST['status'];
        $date_created = $_POST['date_created'];
        $image_path = $_POST['image_path'];

        $jobModifier->setTitle($title);
        $jobModifier->setDescription($description);
        $jobModifier->setCompany($company);
        $jobModifier->setLocation($location);
        $jobModifier->setStatus($status);
        $jobModifier->setDateCreated($date_created);
        $jobModifier->setImagePath($image_path);
        $jobModifier->updateArticle($job_id, $title, $company, $description, $location, $status, $date_created, $image_path);

    }
} else if (isset($_GET['id'])) {
    $job_id = $_GET['id'];

    // Créer une instance de la classe Job
    $jobModifier = new Job($conn);

    // Récupérer les détails de l'article à éditer
    $articleDetails = $jobModifier->getArticleDetails($job_id);



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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container">
        <form id="forms" method="POST">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-4">
                <div class="col">
                    <div class="">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control first_name" name="title"
                            value="<?php echo isset($articleDetails['title']) ? $articleDetails['title'] : ''; ?>">
                    </div>

                </div>
                <div class="col">
                    <div class="">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control email" name="company"
                            value="<?php echo isset($articleDetails['company']) ? $articleDetails['company'] : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Description</label>
                <textarea class="form-control position" rows="4"
                    name="description"><?php echo isset($articleDetails['description']) ? $articleDetails['description'] : ''; ?></textarea>
            </div>


            <div class="mb-4">
                <label class="form-label">Location</label>
                <input type="text" class="form-control title_user" name="location"
                    value="<?php echo isset($articleDetails['location']) ? $articleDetails['location'] : ''; ?>">
            </div>

            <div class=" mb-4">
                <label class="form-label">Status</label>
                <input type="text" class="form-control status" name="status"
                    value="<?php echo isset($articleDetails['status']) ? $articleDetails['status'] : ''; ?>">
            </div>

            <div class=" mb-4">
                <label class="form-label">Date_Created</label>
                <input type="date" class="form-control first_name" name="date_created"
                    value="<?php echo isset($articleDetails['date_created']) ? $articleDetails['date_created'] : ''; ?>">
            </div>
            <div class=" mb-4">
                <label class="form-label">image_path</label>
                <input type="file" class="form-control first_name" name="image_path"
                    value="<?php echo isset($articleDetails['image_path']) ? $articleDetails['image_path'] : ''; ?>">
            </div>

            <div class="d-flex w-100 justify-content-center">
                <p class="error text-danger"></p>
                <button type="submit" class="btn btn-success btn-block mb-4 me-4 save">Save Edit</button>
                <div class="col-sm-3">
                    <div class="d-grid">
                        <a class="btn btn-outline-primary" href="article.php" role="button">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </form>

    </div>
    </div>
</body>

</html>