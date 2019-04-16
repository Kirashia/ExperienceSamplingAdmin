<?php

//$_POST['Token'] = "test token";
if(isset($_POST['Token'])){
    $canAddNewToken = true;
    $token = $_POST['Token'];
    $user = $_POST['User'];
    $conn = mysqli_connect("localhost:3306", "experjt1_program", "?qbdD_w__~hQ", "experjt1_itechdigi_sussexuni2017");

    $sql = "SELECT token FROM token";
    $result = mysqli_query($conn,$sql);
        
    if(mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['token'] == $token){
                $canAddNewToken = false;
            }
        }
    }
    mysqli_close($conn);
    
    if($canAddNewToken == true){
        $conn = mysqli_connect("localhost:3306", "experjt1_program", "?qbdD_w__~hQ", "experjt1_itechdigi_sussexuni2017");

        $query = "INSERT INTO token(token, user_fk) VALUES ('$token', '$user') ON DUPLICATE KEY UPDATE token = '$token';";
            
        mysqli_query($conn, $query);

        mysqli_close($conn);
    }
}

?>