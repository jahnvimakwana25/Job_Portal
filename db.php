<?php
class JobPortal 
{
    public $conn;

    function __construct() 
    {
        $dsn = "mysql:host=localhost;dbname=jobportaldb";
        $username = "root";
        $password = "";

        try 
        {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function registerUser($name, $username, $email, $password, $phone, $gender, $address, $role = 'user') 
    {
        $sql = "INSERT INTO users (name, username, email, password, phone, gender, address, role)
                VALUES (:name, :username, :email, :password, :phone, :gender, :address, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    }

    function isusernameexists($username) 
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->rowCount() > 0; 
    }

    function validateUser($username, $password) 
    {
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }


     function AddCategory($categoryname, $isactive) 
     {
        $sql = "INSERT INTO job_categories (categoryname, isactive) VALUES(:categoryname, :isactive)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':categoryname', $categoryname);
        $stmt->bindParam(':isactive', $isactive);
        return $stmt->execute();
    }    
    
    function CategoryExists($categoryname) {
        $sql = "SELECT COUNT(*) FROM job_categories WHERE categoryname = :categoryname";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':categoryname', $categoryname);
        $stmt->execute();
        
        return $stmt->fetchColumn() > 0; // If count is more than 0, the category exists
    }

    

    public function GetAllCategories() 
    {
        $sql = "SELECT * FROM job_categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }

    function UpdateCategory($categoryid, $categoryname, $isactive) 
    {
        $sql = "UPDATE job_categories SET categoryname = :categoryname, isactive = :isactive WHERE categoryid = :categoryid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':categoryname', $categoryname);
        $stmt->bindParam(':isactive', $isactive);
        $stmt->bindParam(':categoryid', $categoryid);
        $stmt->execute();
    }

    public function GetCategoryDetails($categoryid) 
    {
        $sql = "SELECT * FROM job_categories WHERE categoryid = :categoryid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':categoryid', $categoryid);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    function DeactivateCategory($categoryid) 
    {
        $sql = "UPDATE job_categories SET isactive = 0 WHERE categoryid = :categoryid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':categoryid', $categoryid);
        $stmt->execute();
    }

    public function AddJob($jobtitle, $description, $company, $location, $categoryid, $postedby, $jobtype, $salaryrange) 
    {
        $sql = "INSERT INTO jobs (jobtitle, description, company_name, location, categoryid, postedby, jobtype, salaryrange)
                VALUES (:jobtitle, :description, :company, :location, :categoryid, :postedby, :jobtype, :salaryrange)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':jobtitle', $jobtitle);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':categoryid', $categoryid);
        $stmt->bindParam(':postedby', $postedby);
        $stmt->bindParam(':jobtype', $jobtype);
        $stmt->bindParam(':salaryrange', $salaryrange);
        
        return $stmt->execute();
    }


    public function GetAllCategoriesActive() 
    {
        $sql = "SELECT * FROM job_categories WHERE isactive = 1";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetAllJobs() {
        $sql = "SELECT j.jobid, j.jobtitle, j.description, j.company_name, j.location, 
                       j.isactive, j.postedby, j.jobtype, j.salaryrange, 
                       c.categoryname 
                FROM jobs j
                LEFT JOIN job_categories c ON j.categoryid = c.categoryid";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function DeactivateJob($jobid) 
    {
        $sql = "UPDATE jobs SET isactive = 0 WHERE jobid = :jobid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':jobid', $jobid);
        return $stmt->execute();
    }

    public function GetJobDetails($jobid) 
    {
        $sql = "SELECT * FROM jobs WHERE jobid = :jobid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':jobid', $jobid);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   

    public function UpdateJob($jobid, $jobtitle, $description, $company, $location, $categoryid, $postedby, $jobtype, $salaryrange, $isactive) {
        $sql = "UPDATE jobs 
                SET jobtitle = :jobtitle, description = :description, company_name = :company, location = :location, 
                    categoryid = :categoryid, postedby = :postedby, jobtype = :jobtype, salaryrange = :salaryrange, isactive = :isactive
                WHERE jobid = :jobid";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindParam(':jobid', $jobid);
        $stmt->bindParam(':jobtitle', $jobtitle);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':categoryid', $categoryid);
        $stmt->bindParam(':postedby', $postedby);
        $stmt->bindParam(':jobtype', $jobtype);
        $stmt->bindParam(':salaryrange', $salaryrange);
        $stmt->bindParam(':isactive', $isactive);
        
        return $stmt->execute();
    }
    

    public function GetJobsByCategoryName($categoryname) {
        $stmt = $this->conn->prepare("
            SELECT j.jobid, j.jobtitle, j.company_name, j.location, c.categoryname
            FROM jobs j
            INNER JOIN job_categories c ON j.categoryid = c.categoryid
            WHERE c.categoryname = :categoryName AND j.isactive = 1
        ");
        $stmt->bindParam(':categoryName', $categoryname);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function ApplyForJob($jobid, $applicant_name, $applicant_email) {
        $sql = "INSERT INTO job_applications (jobid, applicant_name, applicant_email) 
                VALUES (:jobid, :applicant_name, :applicant_email)";
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bindParam(':jobid', $jobid);
        $stmt->bindParam(':applicant_name', $applicant_name);
        $stmt->bindParam(':applicant_email', $applicant_email);
    
        return $stmt->execute();
    }
    
    public function getOneJobPerCategory($categoryId) {
        $sql="SELECT * FROM jobs WHERE categoryid = :catid ORDER BY jobid DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':catid', $categoryId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    function isLoggedIn() {
        return isset($_SESSION['username']);
    }
    
    function redirectIfNotLoggedIn() {
        if (!isLoggedIn()) {
            header("Location: ../index.php");
            exit();
        }
    }
    public function getJobsByType($type) {
        $sql = "SELECT j.*
                FROM jobs j
                JOIN (
                    SELECT categoryid, MIN(jobid) as min_jobid
                    FROM jobs
                    WHERE jobtype = :jobtype AND isactive = 1
                    GROUP BY categoryid
                ) filtered
                ON j.jobid = filtered.min_jobid";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':jobtype', $type);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    
}
?>
