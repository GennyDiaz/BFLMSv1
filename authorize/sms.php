<?php
include '../database/db.php';
require_once ('../Twilio/autoload.php');
use Twilio\Rest\Client;

$sid    = "ACd21259f5ad5ac55647a44eb3a7649caf";
$token  = "ecfbfd9d0ee6dfb6dc81ca27c1e8b42f";
$service = "MG9ee62c75b4681f1f430a6065e7835b5f";
$twilio = new Client($sid, $token); 

if(isset($_POST['send'])){
    $text = $_POST['text'];
    $getdata = $_POST['send'];
    $sql = mysqli_query($conn,"SELECT contact FROM resident where street_id = '".$getdata."'");

    if (mysqli_num_rows($sql) > 0) {
        while($row = mysqli_fetch_assoc($sql)){
            $contact = $row['contact'];

            // Send the Twilio message
        $message = $twilio->messages
        ->create('+63'.$contact, // to
          array(    
                    "messagingServiceSid" => $service,
                    "body" => $text
          ));
          print($message->sid);
        }
    }else{
        echo "No contacts found";
    }
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

?>