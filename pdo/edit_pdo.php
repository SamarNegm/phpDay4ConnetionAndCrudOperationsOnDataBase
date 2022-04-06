<?php
require "pdoconnect.php";
function update_user($id, $data, $img = "")
{
    try{
        $db=connectToDatabase();
        if($db){
            if(isset($img) && $img != ""){
                $update_query = 'update student set `fname`=:fname,`lname`=:lname,`address`=:address,`gender`=:gender,`username`=:username,`password`=:password,`department`=:department where `id`='.$id;
            } else {
                $update_query = 'update student set `fname`=:fname,`lname`=:lname,`address`=:address,`gender`=:gender,`username`=:username,`password`=:password,`department`=:department where `id`='.$id;
            }
         
            $data = explode(":",$data);
  
            echo "<pre>";
            print_r($data);
            echo "</pre>";
            // exi  t();
            $update_stmt = $db->prepare($update_query);

            $update_stmt->bindParam(":fname",$data[0] );
            $update_stmt->bindParam(":lname",$data[1] );
            $update_stmt->bindParam(":address",$data[3] );
            $update_stmt->bindParam(":gender",$data[2] );
            $update_stmt->bindParam(":username",$data[4] );
            $update_stmt->bindParam(":password",$data[5] );
            $update_stmt->bindParam(":department",$data[6] );


            $res=$update_stmt->execute();
            if ($res){
                return true;
            }
        }
    return false;
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}