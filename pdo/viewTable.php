
<?php 

session_start();
if(!isset($_SESSION["id"])){
    header("Location: login2.php");
    exit();
}


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body >
    <h1 style="text-align: center;color:#C3DBD9;padding: 30px;">Your Data </h1>
<div class="col-9" style="margin:auto;">
<button onclick="window.location.href='../logout.php'">Logout</button>
<?php

        $dsn = 'mysql:dbname=iti;host=127.0.0.1;port=3306;'; #port number
        $user = 'root';
        $password = '';

        ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

       $db= new PDO($dsn, $user, $password);
       $select_query = "select * from `student`";
       $stmt = $db->prepare($select_query);
       $res=$stmt->execute();
       $users=$stmt->fetchAll(PDO::FETCH_OBJ);
       echo "<table border='2px' class='table table-striped' >
               <th>id</th>  <th>FirstName</th> <th>LastName</th>  <th>View</th> <th>Edit</th> <th>delete</th>";
       foreach ($users as $r){  # $l --> line ===> is string

           echo "<tr> <td>$r->id</td>  <td>$r->fname</td> <td>$r->lname</td> ";
           echo "<td> <a href='view.php?id={$r->id}'> View</a> </td>
                   <td> <a href='../register?id={$r->id}'> Edit</a> </td>
                   <td> <a href='delete_pdo.php?id={$r->id}'> Delete</a> </td>";
           echo "</tr>";

       }
       echo "</table>";
?>
</div>
       </body>
</html>