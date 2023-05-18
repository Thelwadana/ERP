<!DOCTYPE html>
<html>
<?php 
$con = mysqli_connect('localhost', 'root', '', 'myerp');
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ItemCode = $_POST['itemCode'];
    $ItemCategory= $_POST['itemCategory'];
    $ItemSubcategory = $_POST['itemSubcategory'];
    $ItemName = $_POST['itemName'];
    $Quantity = $_POST['quantity'];
    $UnitPrice = $_POST['unitPrice'];
    
    $sql = "INSERT INTO item (item_code,item_category,item_subcategory,item_name,quantity,unit_price) 
        VALUES ('$ItemCode', '$ItemCategory', '$ItemSubcategory', '$ItemName', '$Quantity', '$UnitPrice')";
    
    if ($con->query($sql) === TRUE) {
        echo "<h1>Hello $FName your record created successfully</h1>";
        header("Location: item.php");
        exit;
      } else {
        echo '<span style="color:red;text-align:center;">Error: Duplicate error </span>'. "<br>" . $con->error;
      }
      
     
    
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
                        <form action="itemInsert.php" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4">Item Code</label>
                                    <input type="text" class="form-control" name="itemCode" id="itemCode" placeholder="Item Code"  required>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="District">Item Category</label>
                                    <select id="itemCategory" name="itemCategory" class="form-control" required>
                                    <?php
													//Get Locations
													$sql = "SELECT id,category FROM item_category";
												    $result = $con->query($sql);
													if ($result->num_rows > 0) {
														
														
													// output data of each row
													echo '<option value="0">Category</option>';
													while($row = $result->fetch_assoc()) {
														echo "<option value=".$row["id"].">".$row["category"]."</option>";
													}
													} else {
														echo '<option value="">Makes not found</option>';
													}
												?>	
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="District">Item Subcategory</label>
                                    <select id="itemSubcategory" name="itemSubcategory" class="form-control" required>
                                    <?php
													//Get Locations
													$sql = "SELECT id,sub_category FROM item_subcategory";
												    $result = $con->query($sql);
													if ($result->num_rows > 0) {
														
														
													// output data of each row
													echo '<option value="0">Item Subcategory</option>';
													while($row = $result->fetch_assoc()) {
														echo "<option value=".$row["id"].">".$row["sub_category"]."</option>";
													}
													} else {
														echo '<option value="">Makes not found</option>';
													}
												?>	
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Item Name</label>
                                    <input type="text" class="form-control" name="itemName" id="itemName" placeholder="Item Name" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Quantity</label>
                                    <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity" pattern="[0-9]+" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputZip">Unit Price</label>
                                    <input type="text" class="form-control" id="unitPrice" name="unitPrice" pattern="[0-9]+" required >

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

