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
                      <li class="breadcrumb-item active" aria-current="page">Item Details </li>
                    </ol>
                    </nav>
                    <form action="item.php" method="post">
                            <div class="form-row">
                               
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Search Item Id</label>
                                    <input type="text" class="form-control" name="search" id="search" placeholder="First Name">
                                    <button type="submit" class="btn btn-danger btn-sm col-md-3 mt-1">SEARCH</button>  
                                </div>
                               
                            </div>
                    </form>

                    <div class="pt-2 pb-2">
                        <div>
                            <a href="itemInsert.php"> 
                                <button type="submit" class="btn btn-danger col-md-3">INSERT ITEM DATA</button>
                            </a>    
                        </div>
                    </div>


                        <!-- Second Section: Table -->
                        <div style="height: 500px; overflow-y: scroll;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item Id</th>
                                        <th>Item Code</th>
                                        <th>Item Category</th>
                                        <th>Item Subcategory</th>
                                        <th>Item Name</th>
                                        <th>Item Quantity</th>
                                        <th>Unit Price</th>
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

                                    
								    $sql = "SELECT * FROM item ORDER BY id DESC";

								    if($sea> 0){
								    
							    
								    	$sql = "SELECT * FROM item WHERE id = '$sea' ORDER BY id DESC";
								    		
								    	
								    	
								    }
                                    
                                    $result = mysqli_query($con,$sql);

                                    while ($res = $result->fetch_assoc()) {
                                        $itemCato = $res['item_category'];
                                        $itemSubcato = $res['item_subcategory'];

                                        $sql2 = "SELECT category FROM item_category WHERE id ='$itemCato'";
                                        $result2 = mysqli_query($con, $sql2); // Execute the query
                                        $ItemCatoName = mysqli_fetch_assoc($result2);

                                        $sql3 = "SELECT sub_category FROM item_subcategory WHERE id ='$itemSubcato'";
                                        $result3 = mysqli_query($con, $sql3); // Execute the query
                                        $ItemSubcatoName = mysqli_fetch_assoc($result3);

                                        echo "<tr>";
                                        echo "<td>".$res['id']."</td>";
                                        echo "<td>".$res['item_code']."</td>";
                                        echo "<td>".$ItemCatoName['category']."</td>";
                                        echo "<td>".$ItemSubcatoName['sub_category']."</td>";
                                        echo "<td>".$res['item_name']."</td>";
                                        echo "<td>".$res['quantity']."</td>";
                                        echo "<td>".$res['unit_price']."</td>";
                                        echo '<td>
                                               <a href="itemUpdate.php?id='.$res["id"].'">
                                               <button type="button" class="btn btn-primary btn-sm">update</button>
                                               </a>

                                               <a href="itemDelete.php?id='.$res["id"].'">
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

