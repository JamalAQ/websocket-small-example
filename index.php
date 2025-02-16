<?php
error_reporting(E_ALL); // سطر ضروري 
ini_set('display_errors',1);// سطر ضروري 

include("includes/templates/header.php");
require("classes/connection.php");
require("classes/functions.php");
?>

<div class="bg-warning container my-3 py-3 text-center" id="firstuserhere">
    <!-- يبدل الى ويب سوكيت من جافا سكريبت  -->
    <?php 
    // echo get1stuser();
    ?>

</div>
<br><br>
<div class="container py-3">
    
<div class="row justify-content-center" id="informationTable">
    <div class="col-4 text-center">Username</div>
    <div class="col-4 text-center">Email</div>
    <div class="col-4 text-center">Password</div>
    <!-- any add here is from js  -->
</div>

</div>
<br><br>
<!-- <div id="usersNames" class="container" > -->
    <!-- // fulled by js from websocket  -->
<!-- </div> -->
<!-- <br><br> -->
<div action="" method="post" class="container">
    <div>
        <p style="display:inline-block; width:80px;">username :</p>
        <input type="text" name="username" class="p-2 m-2" id="addUserName">
    </div>
    <div>
        <p style="display:inline-block; width:80px;">email :</p>
        <input type="text" name="email" class="p-2 m-2" id="addEmail">
    </div>
    <div>
        <p style="display:inline-block; width:80px;">password :</p>
        <input type="text" name="password" class="p-2 m-2" id="addPassword">
    </div>
    <div>
        <button onclick=addUser() style="border:none;" class="bg-success p-2 my-2">Add</button>
    </div>
</div>

<br><br>

<!-- #########################delete by form ################################## -->

<!-- <form action="" method="post" class="container">
    <div>
        <p style="display:inline-block">Write the username to delete the user :</p>
        <input type="text" name="deleteuser" class="p-2 m-2">
    </div>
    <div>
        <input type="submit" value="Delete" style="border:none;" class="bg-danger p-2 my-2">
    </div>
</form> -->

<!-- ################################ delete by ajax now websocket the ajax beacom a comment ################################# -->

<div class="container">
    <p style="display:inline-block">Write the username to delete the user :</p>
    <input  type="text" name="deleteuser" class="p-2 m-2" id="theNameWhichWillBeDeleted">
</div>
<div>
    <div class="container">
        <div onclick=deleteUser() id="deleteUser" style="width:fit-content;" class="bg-danger p-2 my-2 deleteUser">Delete</div>
    </div>
</div>
<br><br>

<!-- ############################# ubdate user by ajax now websocket the ajax becom a comment ############################ -->

<div class="container">
    <div>
        <p style="display:inline-block; width:120px;">Old username :</p>
        <input type="text" id="oldusername" class="p-2 m-2">
    </div>
    <div>
        <p style="display:inline-block; width:120px;">New username :</p>
        <input type="text" id="newusername" class="p-2 m-2">
    </div>
    <div>
        <p style="display:inline-block; width:120px;">New email :</p>
        <input type="text" id="newemail" class="p-2 m-2">
    </div>
    <div>
        <p style="display:inline-block; width:120px;">New password :</p>
        <input type="text" id="newpassword" class="p-2 m-2">
    </div>
</div>
<div>
    <div class="container">
        <div onclick=ubdateUser() id="updateUser" style="width:fit-content;" class="bg-warning p-2 my-2 deleteUser">Update</div>
    </div>
</div>




<?php include("includes/templates/footer.php") ?>