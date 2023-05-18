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
        $Title = $_POST['title'];
        $FirstName = $_POST['firstName'];
        $MiddleName = $_POST['middleName'];
        $LastName = $_POST['lastName'];
        $District = $_POST['districts'];
        $Contact = $_POST['contact'];
        
        $sql = "UPDATE customer SET 
            title = '$Title',
            first_name = '$FirstName',
            middle_name = '$MiddleName',
            last_name = '$LastName',
            contact_no = '$Contact',
            district = '$District'
            WHERE id = $cusid";
        
        if ($con->query($sql) === TRUE) {
            echo "<h1>Hello $FName your record created successfully</h1>";
            header("Location: customer.php");
            exit;
          } else {
            echo '<span style="color:red;text-align:center;">Error: Duplicate error </span>'. "<br>" . $con->error;
          }
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
            <div class="col-2 ">
                <!-- First Column -->
            </div>
            <div class="col-8 pt-5 ">
                <!-- Second Column -->
                <div class="row">
                    <div class="col">

                          
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active" aria-current="page">Customers Details Update Section</li>
                    </ol>
                    </nav>
                    
                        <!-- First Section: Form -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-2">                          
                                    <label for="inputEmail4">Title</label>
                                    <select name="title" id="title" class="form-control" value="<?php echo $row['title']; ?>">
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">First Name</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" value="<?php echo $row['first_name']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">Middle Name</label>
                                    <input type="text" class="form-control" name="middleName" id="middleName" placeholder="Middle Name" value="<?php echo $row['middle_name']; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" value="<?php echo $row['last_name']; ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="District">District</label>
                                    <select id="districts" name="districts" class="form-control" >
                                    <?php
													//Get Locations
													$sql = "SELECT id,district FROM district";
												    $result = $con->query($sql);
													if ($result->num_rows > 0) {
														
														
													// output data of each row
													echo '<option value="' . $row2['id'] . '">' . $row2['district'] . '</option>';

													while($row = $result->fetch_assoc()) {
														echo "<option value=".$row["id"].">".$row["district"]."</option>";
													}
													} else {
														echo '<option value="">Makes not found</option>';
													}
												?>	
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputZip">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo isset($row['contact_no']) ? $row['contact_no'] : ''; ?>">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                     
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2 ">
                <!-- First Column -->
         </div>    
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

