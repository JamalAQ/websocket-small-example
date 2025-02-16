<?php
include("classes/connection.php");

// تحميل مكتبة Ratchet عبر Composer
require __DIR__ . '/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class ChatServer implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";

        // in case of one message demande for frontend
        // // جلب جميع الرسائل من قاعدة البيانات
        // $messages = $this->getAllUsersNames();

        // // إرسال جميع الرسائل لجميع العملاء
        // foreach ($this->clients as $client) {
        //     $client->send(json_encode($messages));
        // }

                // in our case here we use more than one message for the front end 
                
                // جلب جميع الرسائل من قاعدة البيانات
                $messages = $this->getAllUsersNames();
                $firstUser = $this->get1stuser();
        
                // إرسال جميع الأسماء واسم أول مستخدم للعميل الجديد
                $data = json_encode(['users' => $messages, 'firstUser' => $firstUser]);
        
                // إرسال جميع الرسائل للعميل الجديد
                foreach ($this->clients as $client) {
                    $client->send($data);
                }

    }


    // 1- the server will take the situation it RUN on it 
    // 2- if the 2 line to get the information exist in onopen , it will bring the information on open 
    // 3- if the 2 line to get the information is exist in onmessage , it will bring the information on massege 
    // 2+3 if the information dose not exist in a place in the code when the srver run it will not disapear in this exact event 
    // so if u want the information to be in open and on message u shoud but the 2 line to get the information in the on open and in the on message for sure befor RUN the server

    // finally to run the server u go to the terminal in its folder u right ( php theName.php) and wait for a while 

    public function onMessage(ConnectionInterface $from, $msg) {

        $data = json_decode($msg, true);

        if(isset($data["type"])){
            if($data["type"]=="addUser"){

                // اضافة مستخدم جديد
                $this->addUser($data["username"],$data["email"],$data["password"]);

            }else if ($data["type"]=="deleteUser"){

                // حذف اسم المستخدم
                $this->deleteUser($data["content"]);

            }else if ($data["type"]=="ubdateUser"){

                //تحديث البيانات 
                $this->updateUser($data["oldusername"],$data["newusername"],$data["newemail"],$data["newpassword"]);
            }
        }

        // in case of one message demande for frontend
        // // جلب جميع الرسائل من قاعدة البيانات
        // $messages = $this->getAllUsersNames();

        // // إرسال جميع الرسائل لجميع العملاء
        // foreach ($this->clients as $client) {
        //     $client->send(json_encode($messages));
        // }

                // in our case here we use more than one message for the front end 
                // جلب جميع الرسائل من قاعدة البيانات
                $messages = $this->getAllUsersNames();
                $firstUser = $this->get1stuser();
        
                // إرسال جميع الأسماء واسم أول مستخدم للعميل الجديد
                $data = json_encode(['users' => $messages, 'firstUser' => $firstUser]);
        
                // إرسال جميع الرسائل للعميل الجديد
                foreach ($this->clients as $client) {
                    $client->send($data);
                }

    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    private function getAllUsersNames() {
        global $db;
        $stmt = $db->query("SELECT * from users ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function get1stuser() {
        GLOBAL $db;
        $stmt=$db->prepare("SELECT username from users");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC)[0]["username"];
        return $result; 
    }

    private function addUser($username , $email , $password) {
        global $db;
        $stmt = $db->prepare("INSERT INTO users (username,email,password) VALUES (:username,:email,:password)");
        $stmt->bindparam(":username",$username);
        $stmt->bindparam(":email",$email);
        $stmt->bindparam(":password",$password);
        $stmt->execute();
        // $stmt->execute(['content' => $message]); طريقة اخرى غير bindparam ل تعريف المتغيرات

    }

    private function deleteUser($message) {
        global $db;
        $stmt = $db->prepare("DELETE FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(":username", $message);
        $stmt->execute();
    }




    private function updateUser($oldusername ,$newusername , $newemail , $newpassword) {
        global $db;

        $stmt1=$db->prepare("SELECT * from users where username=:oldusername");
        $stmt1->bindParam(":oldusername", $oldusername);
        $stmt1->execute();
        $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($result)){
            $result=$result[0];

            $stmt = $db->prepare("UPDATE users SET username = :newusername, email=:newemail , password = :newpassword where username=:oldusername");
    
            $stmt->bindParam(":oldusername", $oldusername);

            if($newusername!==""){
                $stmt->bindParam(":newusername", $newusername);
            }else{
                $stmt->bindParam(":newusername", $result["username"]);
            }
    
            if($newemail!==""){
                $stmt->bindParam(":newemail", $newemail);
            }else{
                $stmt->bindParam(":newemail", $result["email"]);
            }
    
            if($newpassword!==""){
                $stmt->bindParam(":newpassword", $newpassword);
            }else{
                $stmt->bindParam(":newpassword", $result["password"]);
            }

            $stmt->execute();

        }

    }
    
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatServer()
        )
    ),
    8083
);

$server->run();

