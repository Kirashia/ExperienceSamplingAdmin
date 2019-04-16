
<?php
class Notification {
    public function sendNotification($tokens, $title, $message){
        for($x = 0; $x < sizeof($tokens); $x++){
            $ch = curl_init("https://fcm.googleapis.com/fcm/send");
            //The device token.
            $token = $tokens[$x]; //token here
            //Title of the Notification.
            $title = $title;
            //Body of the Notification.
            $body = $message;
            //Creating the notification array.
            $notification = array('title' =>$title , 'text' => $body);
            //This array contains, the token and the notification. The 'to' attribute stores the token.
            $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
            //Generating JSON encoded string form the above array.
            $json = json_encode($arrayToSend);
            //Setup headers:
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key= AAAAx5TDtaw:APA91bGucOt83TA1-N2BQ3HjjClcawO4vKH6rSphatGERYe5yKIBf_oBy0Cu2QxWuOsHVG5Q3j16OylOK2oa0uYTcV82PzncBpYNiDxcS1ygRKvnxp0ufL5S8xkXh3fSY-mdMoeNbjr-'; // key here
            //Setup curl, add headers and post parameters.
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);       
            //Send the request
            $response = curl_exec($ch);
            //Close request
            curl_close($ch);
        }
        //return $response;
    }
    //pass true or false to enable or disable the custom index in the array.
    //If enabled the custom index will be the user id
    public function getAllTokens($customIndex){
        $token = array();
        $conn = mysqli_connect("localhost:3306", "experjt1_program", "?qbdD_w__~hQ", "experjt1_itechdigi_sussexuni2017");

        $sql = "SELECT * FROM token";
        $result = mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result) > 0 ){
            while ($row = mysqli_fetch_assoc($result)) {
                if($customIndex == true){
                    $data = array($row['user_fk'] => $row['token']);
                    $tempArray = $token + $data;
                    $token = $tempArray;
                }
                else{
                    array_push($token, $row['token']);
                }
            }
        }
        mysqli_close($conn);
        return $token;
    }
    //This is used to update the database and sent 'notified' to 1 in 'questionnaire_user'
    //so that the auto check script does not resend a notification if the user has already been sent one.
    public function updateNotified($id){
        $conn = mysqli_connect("localhost:3306", "experjt1_program", "?qbdD_w__~hQ", "experjt1_itechdigi_sussexuni2017");
    
        $query = "UPDATE questionnaire_user SET notified='sent' WHERE id=$id;";
                
        mysqli_query($conn, $query);
    
        mysqli_close($conn);
    }
}
?>