<!DOCTYPE html>
<html>
<?php 
$sea="";
$con = mysqli_connect('localhost', 'root', '', 'myerp');
// Check connection
if ($con->connect_error) {
     die("Connection failed: " . $con->connect_error);
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sea= $_POST["search"];
    
 } 
?>                                        
<head>
    <title>Bootstrap Grid Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 bg-primary">
                <!-- First Column -->
                <div class="row">
                    <div class="col">
                     
                    
                    
                    <div class="pt-5">
                        <div>
                            <a href="customer.php"> 
                                <button type="" class="btn btn-danger col-md-12">CUSTOMER SECTION</button>
                            </a>    
                        </div>
                        <div class="pt-1">
                            <a href="item.php"> 
                                <button type="" class="btn btn-danger col-md-12">ITEM SECTION</button>
                            </a> 
                        </div>
                        <div class="pt-1">
                            <button type="" class="btn btn-danger col-md-12">INSERT</button>
                        </div>
                    
                    </div>
                    
                    </div>
                </div>
            </div>
            <div class="col-10 pt-5 bg-lightgray">
                <!-- Second Column -->
                
                <div class="row">
                    <div class="col">

                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active" aria-current="page">Customers Details </li>
                    </ol>
                    </nav>
                    <form action="customer.php" method="post">
                            <div class="form-row">
                               
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Search Customer Id</label>
                                    <input type="text" class="form-control" name="search" id="search" placeholder="First Name">
                                    <button type="submit" class="btn btn-danger btn-sm col-md-3 mt-1">SEARCH</button>  
                                </div>
                               
                            </div>
                    </form>

                    <div class="pt-2 pb-2">
                        <div>
                            <a href="customerInsert.php"> 
                                <button type="submit" class="btn btn-danger col-md-3">INSERT CUSTEMER DATA</button>
                            </a>    
                        </div>
                    </div>


                        <!-- Second Section: Table -->
                        <div style="height: 500px; overflow-y: scroll;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Custom ID</th>
                                        <th>Title</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Contact Number</th>
                                        <th>District</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $con = mysqli_connect('localhost', 'root', '', 'myerp');
                                    // Check connection
                                    if ($con->connect_error) {
                                        die("Connection failed: " . $con->connect_error);
                                    }

                                    
								    $sql = "SELECT * FROM customer ORDER BY id DESC";

								    if($sea> 0){
								    
							    
								    	$sql = "SELECT * FROM customer WHERE id = '$sea' ORDER BY id DESC";
								    		
								    	
								    	
								    }
                                    
                                    $result = mysqli_query($con,$sql);

                                    while ($res = $result->fetch_assoc()) {
                                        $districtId = $res['district'];
                                        $sql2 = "SELECT district FROM district WHERE id ='$districtId'";
                                        $result2 = mysqli_query($con, $sql2); // Execute the query
                                        $districtName = mysqli_fetch_assoc($result2);

                                        echo "<tr>";
                                        echo "<td>".$res['id']."</td>";
                                        echo "<td>".$res['title']."</td>";
                                        echo "<td>".$res['first_name']."</td>";
                                        echo "<td>".$res['middle_name']."</td>";
                                        echo "<td>".$res['last_name']."</td>";
                                        echo "<td>".$res['contact_no']."</td>";
                                        echo "<td>".$districtName['district']."</td>";
                                        echo '<td>
                                               <a href="customerUpdate.php?id='.$res["id"].'">
                                               <button type="button" class="btn btn-primary btn-sm">update</button>
                                               </a>

                                               <a href="customerDelete.php?id='.$res["id"].'">
                                               <button type="button" class="btn btn-danger btn-sm">delete</button>
                                               </a>
                                             </td>';
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

