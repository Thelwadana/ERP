<!DOCTYPE html>
<html>
<?php 
$con = mysqli_connect('localhost', 'root', '', 'myerp');
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Title = $_POST['title'];
    $FirstName = $_POST['firstName'];
    $MiddleName = $_POST['middleName'];
    $LastName = $_POST['lastName'];
    $District = $_POST['districts'];
    $Contact = $_POST['contact'];
    
    $sql = "INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district) 
            VALUES ('$Title', '$FirstName', '$MiddleName', '$LastName', '$Contact', '$District')";
    
    if ($con->query($sql) === TRUE) {
        echo "<h1>Hello $FName your record created successfully</h1>";
        header("Location: customer.php");
        exit;
      } else {
        echo '<span style="color:red;text-align:center;">Error: Duplicate error </span>'. "<br>" . $con->error;
      }
      
      $con->close();
    
    $con->close();
 } 
?> 


<head>
    <title>Bootstrap Grid Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid h-100 ">
        <div class="row">
            <div class="col-2 ">
                <!-- First Column -->
            </div>
            <div class="col-8 ">
                <!-- Second Column -->
                <div class="row">
                    
                    <div class="col pt-5">
                        
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active" aria-current="page">Customers Details Insert Section</li>
                    </ol>
                    </nav>

                    
                        <!-- First Section: Form -->
                        <form action="customerInsert.php" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-2">                          
                                    <label for="inputEmail4">Title</label>
                                    <select name="title" id="title" class="form-control">
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">First Name</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" pattern="[A-Za-z]+" required>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">Middle Name</label>
                                    <input type="text" class="form-control" name="middleName" id="middleName" placeholder="Middle Name" pattern="[A-Za-z]+" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Last Name</label>
                                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" pattern="[A-Za-z]+" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="District">District</label>
                                    <select id="districts" name="districts" class="form-control" required>
                                    <?php
													//Get Locations
													$sql = "SELECT id,district FROM district";
												    $result = $con->query($sql);
													if ($result->num_rows > 0) {
														
														
													// output data of each row
													echo '<option value="0">District</option>';
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
                                    <input type="text" class="form-control" id="contact" name="contact" pattern="[0-9]{10}" required >

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Insert</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                     
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2 bg-primary">
                <!-- First Column -->
         </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

