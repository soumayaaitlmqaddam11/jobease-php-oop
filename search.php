<?php
include_once 'job.php';
include 'connect.php';

if (isset($_GET) or isset($_POST)) {
    $title = isset($_POST['title']) ? $_POST['title'] : NULL;
    $jobs = new Job($conn);

    $result = $jobs->search($title);

    foreach ($result as $job) :
?>
        <div class="card">
            <div class="card-header">
                <?= $job['title'] ?>
            </div>
            <div class="card-body">
                <p class="card-text"> <?= $job['description'] ?></p>
                <a onclick="findjob(<?= $job['id'] ?>)" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
<?php

    endforeach;
}