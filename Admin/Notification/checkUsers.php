<?php
//Load the Notification calss from 'notification.php'
include('notification.php');
$notification = new Notification;
$users = getUsersToSend($notification);
var_dump($users);
$tokens = getUserTokens($users);
var_dump($tokens);
$notification->sendNotification($notification->getAllTokens(false), "Answer some questions", "Don't forget to check out the new questionnaire today");
sendNotificationToUsers($tokens, $notification);


//Takes in an array of user tokens and sends a notification to those tokens.
function sendNotificationToUsers($userTokens, $notification){
    $notification->sendNotification($userTokens, "Answer some questions", "Don't forget to check out the new questionnaire today");
}

//Gets all the users that need to be notified.
function getUsersToSend($notification){
    $users = array();
    $allTokens = $notification->getAllTokens(true);

    $conn = mysqli_connect("localhost:3306", "experjt1_program", "?qbdD_w__~hQ", "experjt1_itechdigi_sussexuni2017");

    $sql = "SELECT * FROM questionnaire_user";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
            $notification->updateNotified($row['id']);
            if($row["notified"] == 'not sent'){
                if(!in_array($row['user_id'], $users)){
                    array_push($users, $row["user_id"]);
                }
            }
        }
    }
    mysqli_close($conn);
    var_dump($users);
    return $users;
}

//Get all the tokens for for each user
function getUserTokens($users){
    $tokens = array();
    $conn = mysqli_connect("localhost:3306", "experjt1_program", "?qbdD_w__~hQ", "experjt1_itechdigi_sussexuni2017");

    $sql = "SELECT * FROM token";
    $result = mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
            for($x = 0; $x < sizeof($users); $x++){
                if($users[$x] == $row['user_fk']){
                    array_push($tokens, $row['token']);
                }
            }
            
        }
    }
    mysqli_close($conn);
    return $tokens;
}
?>