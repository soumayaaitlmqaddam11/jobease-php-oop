<?php

class Job
{
    public $conn;
    private $id;
    private $title;
    private $description;
    private $company;
    private $location;
    private $status;
    private $date_created;
    private $image_path;
    private $image_name;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getCompany(){
        return $this->company;
    }
    public function getLocation(){
        return $this->location;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getDateCreated(){
        return $this->date_created;
    }
    public function getImagePath(){
        return $this->image_path;
    }
    public function setTitle($title){
        $this->title=$title;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function setCompany($company){
        $this->company=$company;
    }
    public function setLocation($location){
        $this->location=$location;
    }
    public function setStatus($status){
        $this->status=$status;
    }
    public function setDateCreated($date_created){
        $this->date_created=$date_created;
    }
    public function setImagePath($image_path){
        $this->image_path=$image_path;
    }
    public function deleteArticle($job_id)
    {
        $job_id = $this->conn->real_escape_string($job_id);

        $sql = "DELETE FROM jobs WHERE job_id = $job_id";

        if ($this->conn->query($sql) === TRUE) {
            return true; 
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    

    public function getArticleDetails($job_id)
    {
        $job_id = $this->conn->real_escape_string($job_id);

        $sql = "SELECT * FROM jobs WHERE job_id = $job_id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $articlesDetails=$result->fetch_assoc();
            return $articlesDetails;
        } else {
            return null;
        }
    }

    public function getAllRows()
    {
        $sql = "SELECT * FROM jobs";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return array();
        }
    }

    public function addArticle($title, $company, $description, $location, $status, $dateCreated, $imagePath)
    {
        // var_dump($imagePath);
        $folder = __DIR__."uploads/";
        $uploadFileName = uniqid() . basename($imagePath['name']);
        $target='C:/xampp/htdocs/OffreEmploi/uploads/';
        $uploadFile = $target . $uploadFileName;
        move_uploaded_file($imagePath['tmp_name'], $uploadFile);

        $imagePathInDatabase = $uploadFileName;
        // Échappez les variables pour prévenir les attaques par injection SQL
        $title = $this->conn->real_escape_string($title);
        $company = $this->conn->real_escape_string($company);
        $description = $this->conn->real_escape_string($description);
        $location = $this->conn->real_escape_string($location);
        $status = $this->conn->real_escape_string($status);
        $dateCreated = $this->conn->real_escape_string($dateCreated);
        // $imagePath = $this->conn->real_escape_string($imagePath);
        
        $string = str_replace(' ','',$imagePathInDatabase); 

        // Requête SQL pour ajouter un nouvel article
        $sql = "INSERT INTO jobs (title, company, description, location, status, date_created, image_path)
                VALUES ('$title', '$company', '$description', '$location', '$status', '$dateCreated', '$imagePathInDatabase')";

        // Exécutez la requête
        if ($this->conn->query($sql) === TRUE) {
            return true; // Succès
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    public function articleExists($job_id)
    {
        $job_id = $this->conn->real_escape_string($job_id);

        $sql = "SELECT COUNT(*) AS count FROM jobs WHERE job_id = '$job_id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }

    public function updateArticle($job_id, $title, $company, $description, $location, $status, $dateCreated, $imagePath)
    {
        // Vérifier d'abord si l'ID existe
        if (!$this->articleExists($job_id)) {
            return "L'article avec l'ID $job_id n'existe pas.";
        }

        // Échapper les valeurs pour éviter les injections SQL
        $job_id = $this->conn->real_escape_string($job_id);
        $title = $this->conn->real_escape_string($title);
        $company = $this->conn->real_escape_string($company);
        $description = $this->conn->real_escape_string($description);
        $location = $this->conn->real_escape_string($location);
        $status = $this->conn->real_escape_string($status);
        $dateCreated = $this->conn->real_escape_string($dateCreated);
        $imagePath = $this->conn->real_escape_string($imagePath);

        // Requête SQL pour mettre à jour l'article
        $sql = "UPDATE jobs SET 
                title = '$title',
                company = '$company',
                description = '$description',
                location = '$location',
                status = '$status',
                date_created = '$dateCreated',
                image_path = '$imagePath'
                WHERE job_id = '$job_id'";

        // Exécuter la requête
        if ($this->conn->query($sql) === TRUE) {
            return true; // Succès
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    
    }


    

    public function closeConnection()
    {
        $this->conn->close();
    }
    public function getAllRowsOpen()
{
    $sql = "SELECT * FROM jobs";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } else {
        return array();
    }
}
public function getAllJob()
{
    $stmt = "SELECT * FROM job";
    $result = $this->conn->query($stmt);
    $allJob = [];
    while ($row = $result->fetch_assoc()) {
        $allJob[] = $row;
    }
    return $allJob;
}
public function search($alph)
{
    $stmt = "SELECT * FROM job where title like '%$alph%'";
    $result = $this->conn->query($stmt);
    $getalph = [];
    while ($row = $result->fetch_assoc()) {
        $getalph[] = $row;
    }
    return $getalph;
}

public function getJobId($id)
{
    $stmt = "SELECT * FROM job where id=$id";
    $result = $this->conn->query($stmt);
    $getalph = [];
    while ($row = $result->fetch_assoc()) {
        $getalph[] = $row;
    }
    return $getalph;
}
}


?>

