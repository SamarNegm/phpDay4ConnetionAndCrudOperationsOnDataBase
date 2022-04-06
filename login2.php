<?php
    session_start();
    if(isset($_SESSION["id"])){
        header("Location:pdo/viewTable.php");
        exit();
    }
    if(isset($_POST['sub'])){
        
        $u = $_POST['username'];
        $p = $_POST['password'];
        echo "<pre></pre>";
        echo $u."<br>";
        echo $p."<br>";
        echo "<pre></pre>";
        // echo $u;
        // echo $p;

         // Open the file
        $filename = 'users.txt';
        $file = fopen($filename, 'r'); 

        // Add each line to an array
        if ($file) 
            $array = explode("\n", fread($file, filesize($filename)));

        // echo "hello";

        if (!empty($array)) {
            // echo "hello";
            foreach ($array as $key => $line) {
                // echo "hello";
                if($line != "") {
                    // echo "hello";
                    $data = explode(":", $line);
                    // var_dump($data);
                    if($data[4] == $u && $data[5] == $p){
                        echo "5";
                        session_start();
                        $_SESSION['id']=$key;
                        echo $_SESSION['id'];
                        // exit();
                        header("Location:pdo/viewTable.php");
                        // $localkey = $key;
                        break;
                    }
                }
            }
        } else{
            echo 'username or password does not exist';
        }


    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <form action="login2.php" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="card col-5" style="margin:auto;padding: 90px;margin-top: 60px">
    <h1>Login</h1>
        <div class="mb-3">
          <label  class="form-label">Use rName</label>
          <input class="form-control" name="username" placeholder="Username"> 
 
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1"  name="password" placeholder="Password">
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <input type="submit" name="sub" value="Submit" class="btn btn-primary">
    </div>
    
</form>
</body>
</html>