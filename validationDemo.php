<?php



    $errors = [];
    $olddata= [];
    if (empty($_POST["fname"]) or $_POST["fname"]==""){
        $errors["fname"]="First Name is required";
    }else{
        $olddata["fname"] = $_POST["fname"];
    }

    if (empty($_POST["lname"]) or $_POST["lname"]==""){
        $errors["lname"]="Last Name is required";
    }else{
        $olddata["lname"] = $_POST["lname"];
    }

    if (empty($_POST["gender"]) or $_POST["gender"]==""){
        $errors["gender"]="Gender is required";
    }else{
        $olddata["gender"] = $_POST["gender"];
    }
    if (empty($_POST["address"]) or $_POST["address"]==""){
        $errors["address"]="address is required";
    }else{
        $olddata["address"] = $_POST["address"];
    }

    if (empty($_POST["username"]) or $_POST["username"]==""){
        $errors["username"]="username is required";
    }else{
        $olddata["username"] = $_POST["username"];
    }

    if (empty($_POST["password"])){
        $errors["password"]="password is required";
    }else{
        $olddata["password"] = $_POST["password"];
    }
    if (empty($_POST["Department"]) or $_POST["Department"]==""){
        $errors["Department"]="Department is required";
    }else{
        $olddata["Department"] = $_POST["Department"];
    }
    if($_FILES['f1']['name']){
        move_uploaded_file($_FILES['f1']['tmp_name'], "image/".$_FILES['f1']['name']);
        $img = "image/".$_FILES['f1']['name'];
    }

    # convert array to string
    if (count($errors)> 0){

        $err=json_encode($errors);

        if(count($olddata) > 0) {
            var_dump($olddata);
            $old = json_encode($olddata);

            header("Location:register.php?errors={$err}&olddata={$old}");
        }else {
            header("Location:register.php?errors={$err}");  # issue url --> get method
        }
    }
    else
    {
        $user = isset($img)?  implode(":",$_POST).":".$img :  implode(":",$_POST);
   
  
        ///edit the file
            if($_GET["id"]!='')
            {
                var_dump($_GET["id"]);
                
                require "pdo/edit_pdo.php"; 
      
                update_user($_GET["id"],$user, isset($img)?$img:"");
                // header("Location:edit.php?id={$_GET["id"]}");
                // exit;
            } 
            else
            {
                

                
      
                    $dsn = 'mysql:dbname=iti;host=127.0.0.1;port=3306;'; #port number
                    $myuser = 'root';
                    $password = '';

                    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

                    try{


                        $db= new PDO($dsn, $myuser, $password);
                        var_dump($db);


                        $insert_query= "insert into student(`fname`, `lname`,`gender`,`address`,`username`,`password`,`department`) values(:fname,:lname,:gender,:address,:username,:password,:department)";
            
                        $inst_stmt = $db->prepare($insert_query);
                        $data = explode(":", $user);
                        // var_dump($data[0]);
                        // exit;
                        $inst_stmt->bindParam(":fname", $data[0], PDO::PARAM_STR);
                        $inst_stmt->bindParam(":lname", $data[1], PDO::PARAM_STR);
                        $inst_stmt->bindParam(":gender", $data[2], PDO::PARAM_STR);
                        $inst_stmt->bindParam(":address", $data[3], PDO::PARAM_STR);
                        $inst_stmt->bindParam(":username", $data[4], PDO::PARAM_STR);
                        $inst_stmt->bindParam(":password", $data[5], PDO::PARAM_STR);
                        $inst_stmt->bindParam(":department", $data[6], PDO::PARAM_STR);
                        


                        $inst_stmt->execute();
                        echo $db->lastInsertId();
                        echo $inst_stmt->rowCount();
                        var_dump( $db->errorInfo());

                    }catch (Exception $e){
                        echo $e->getMessage();
                    }
            }    

 header("Location:pdo/viewTable.php?id={$_GET["id"]}");
    }