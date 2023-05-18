<!DOCTYPE html>
<html>
<?php 
session_start();
$con = mysqli_connect('localhost', 'root', '', 'myerp');
// Check connection
 if ($con->connect_error) {
     die("Connection failed: " . $con->connect_error);
 }

 if(isset($_GET['id']) && $_GET['id']!=0){
    $_SESSION["sesid"] = $_GET['id'];
 }

 if(isset($_SESSION["sesid"]) && $_SESSION["sesid"]!=0){
  
    $cusid= $_SESSION["sesid"];
    $sql = "SELECT * FROM customer WHERE id = $cusid";
    $result = $con->query($sql);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        
        $sql = "DELETE FROM customer WHERE id = '$cusid'";
        
        if ($con->query($sql) === TRUE) {
            echo "<h1>Customer information deleted successfully</h1>";
            header("Location: customer.php");
            exit;
        } else {
            echo '<span style="color:red;text-align:center;">Error: Failed to delete customer information</span>'. "<br>" . $con->error;
        }
        
        $con->close();
    }

    
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $districtId = $row['district'];
        
        $sql2 = "SELECT * FROM district WHERE id = $districtId";
        $result2 = $con->query($sql2);
        
        if ($result2->num_rows > 0) {
            $row2 = mysqli_fetch_assoc($result2);
        } else {
            // Handle district not found
            $row2 = array();
        }
    } else {
        header('Location: 404.html');
        exit;
    }
 } 
 
 $con->close();
  
	
?>                                        
<head>
    <title>Bootstrap Grid Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <!-- First Column -->
            </div>
            <div class="col-8 pt-5 ">
                <!-- Second Column -->
                <div class="row">
                    <div class="col"> 
                              
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active" aria-current="page">Customers Details Delete Section</li>
                    </ol>
                    </nav>
                    
                        <!-- First Section: Form -->
                        <div class="alert alert-success" role="alert">
                          <h4 class="alert-heading">Notice!</h4>
                          <p>This action will permanently delete the customer's information from the system. Please note that this cannot be undone.</p>
                          <hr>
                          <p class="mb-0">Proceeding with this deletion will result in the complete removal of all data associated with the customer, including their name, contact details, and district information. Take caution before executing this operation as it is irreversible.</p>
                        </div>

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Name:</strong> <?php echo $row['first_name']; ?> <?php echo $row['middle_name']; ?> <?php echo $row['last_name']; ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group col-md-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>District:</strong> <?php echo $row['district']; ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group col-md-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Contact:</strong> <?php echo isset($row['contact_no']) ? $row['contact_no'] : ''; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>



                           

                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                     
                    </div>
                </div>
            </div>
            <div class="col-2 ">
                <!-- First Column -->
            </div>
        </div>
        
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

