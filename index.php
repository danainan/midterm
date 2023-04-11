<?php
    require "connect_db.php";
    require "userModel.php";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = "";
    if(isset($_GET["search"])){
    $name = $_GET["search"];
}

    $account = new userModel();
    $account->set_connection($conn);
    $result = $account->search($name);

    if(isset($_GET["email"])){
        $email = $_GET["email"];
        $result = $account->delete($email);
    }
     
    $result = $account->search($name);
    
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <br>
    <div class="container-fluid">
        <div class ="row">
            <div class ="col-md-4">
              <form method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="ค้นหาด้วยอีเมล" value="<?php echo $name; ?>">
                        <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="submit">Search</button>
                              <a href="register.php" class="btn btn-outline-secondary" type="button">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <hr>
    <div>
        จำนวนข้อมูล <?php echo $result->num_rows; ?> รายการ
        <table class="table table-striped table-bordered table-hove">
            <thead class="bg-success fw-bolder">
            <tr>
                <td>Email</td>
                <td>Password</td>
                <td>repeatPassword</td>
                
            </tr>
            </thead>
            <tbody>
            <?php
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "
                                    <tr>
                                        <td>".$row["email"]."</td>
                                        <td>".$row["password"]."</td>
                                        <td>".$row["repeatPassword"]."</td>
                                        <td><a href='index.php?email=".$row["email"]."' onclick='return confirm(\"Are you sure?\")' class='btn btn-danger'>Delete</a></td>
                                    </tr>
                                ";
                            }
                        } else 
                        {
                            echo "0 results";
                        }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<script>

$(document).ready(function () {
    $('#accoutsData').DataTable();

});
</script>

<?php
    // disconnect
    $conn->close();
?>