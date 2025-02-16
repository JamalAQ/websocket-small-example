<?php
require("connection.php");

function get1stuser() {
    GLOBAL $db;
    $stmt=$db->prepare("SELECT username from users");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC)[0]["username"];
    return $result; 
}


// تم الاستبدال ب ويب سوكيت 
// function addnewuser() {
//     GLOBAL $db;
//     if(
//     ISSET($_POST["username"])&&
//     isset($_POST["email"])&&
//     isset($_POST["password"])&&
//     $_POST["username"]!==null&&
//     $_POST["email"]!==null&&
//     $_POST["password"]!==null)
//     {
//         $username=$_POST["username"];
//         $email=$_POST["email"];
//         $password=($_POST["password"]);
//         $stmt=$db->prepare("INSERT INTO users (username,email,password) VALUES (:username,:email,:password)");
//         $stmt->bindparam(":username",$username);
//         $stmt->bindparam(":email",$email);
//         $stmt->bindparam(":password",$password);
//         $stmt->execute();
//         header("location:http://localhost/return");
//         exit();
//     }
// }
// addnewuser();



// تم الاستبدال ب ويب سوكيت 
// function getusers() {
//     GLOBAL $db;
//     $stmt=$db->prepare("SELECT username from users");
//     $stmt->execute();
//     $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
//     foreach($result as $user){
//         $usernames[] = $user["username"];
//     }
//     $usernamesAsString=implode("<br>",$usernames);
//     return $usernamesAsString; 
// }


// تم الاستبدال ب ويب سوكيت 
// function deleteUser() {
//     GLOBAL $db;
//     if(
//         isset($_POST["deleteuser"])&&
//         !empty($_POST["deleteuser"])
//     ){
//         $deleteuser=$_POST["deleteuser"];
//         $stmt = $db->prepare("DELETE FROM users WHERE username = :username LIMIT 1");
//         $stmt->bindParam(":username", $deleteuser);
//         $stmt->execute();
//     }
// }
// deleteUser();


// تم الاستبدال ب ويب سوكيت
// function deleteUserGet() {
//     GLOBAL $db;
//     if(
//         isset($_GET["deleteuser"])&&
//         !empty($_GET["deleteuser"])
//     ){
//         $deleteuser=$_GET["deleteuser"];
//         $stmt = $db->prepare("DELETE FROM users WHERE username = :username LIMIT 1");
//         $stmt->bindParam(":username", $deleteuser);
//         $stmt->execute();
//     }
// }
// deleteUserGet();



// تم استبدالها ب الويب سوكيت 
// function updateUserGet() {
//     GLOBAL $db;
//     if(
//         isset($_GET["oldusername"])&&
//         !empty($_GET["oldusername"])
//     ){
//         $oldusername=$_GET["oldusername"];

//         if(!empty($_GET["newusername"])){
//             $newusername=$_GET["newusername"];
//         }
//         if(!empty($_GET["newemail"])){
//             $newemail=$_GET["newemail"];
//         }
//         if(!empty($_GET["newpassword"])){
//             $newpassword=$_GET["newpassword"];
//         }
        
//         $stmt1=$db->prepare("SELECT * from users where username=:oldusername");
//         $stmt1->bindParam(":oldusername", $oldusername);
//         $stmt1->execute();
//         $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
//         if(!empty($result)){
//             // سجل في ملاحظاتك في دفترك لا يمكن استخدام فيتش اول 
//             // featch all
//             //  لاكثر من مرة لانها تفرغ بعد ااستخدام الاول 
//             //  وللذلك كما في المثال توضع في متغير ثم تتعامل مع المتغير
//             $result=$result[0];
            
            

    
//             $stmt = $db->prepare("UPDATE users SET username = :newusername, email=:newemail , password = :newpassword where username=:oldusername");
    
//             $stmt->bindParam(":oldusername", $oldusername);
            
//             if(isset($newusername)){
//                 $stmt->bindParam(":newusername", $newusername);
//             }else{
//                 $stmt->bindParam(":newusername", $result["username"]);
//             }
    
//             if(isset($newemail)){
//                 $stmt->bindParam(":newemail", $newemail);
//             }else{
//                 $stmt->bindParam(":newemail", $result["email"]);
//             }
    
//             if(isset($newpassword)){
//                 $stmt->bindParam(":newpassword", $newpassword);
//             }else{
//                 $stmt->bindParam(":newpassword", $result["password"]);
//             }
    
//             $stmt->execute();
//             echo 333;
//         } else { echo 999;}
        
//     }
// }
// updateUserGet();



