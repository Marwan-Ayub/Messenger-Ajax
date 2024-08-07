<?php 
session_start();
$db = mysqli_connect('localhost','root','','chat');
if(!$db){
    exit(mysqli_error($db));
}

function x($data){
    global  $db;
    return mysqli_real_escape_string($db,htmlspecialchars($data));
}


if(isset($_SESSION['userid'])){
   $userid = $_SESSION['userid'];
   $username =  $_SESSION['username'];
}

if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    unset($userid);
    unset($username);
    header("Location:index.php");
}

function in($return){
    global $userid;
    if($return === 1){
        if(!isset($userid)){
            header("Location:index.php");
        }
    }
    if($return === 0){
        if(isset($userid)){
            header("Location:profile.php");
        }
    }
}


function users($condition,$isAdd){
    global $db;
    global $userid;
    if(isset($_GET['accept'])){
        $request_id = x($_GET['accept']);
        mysqli_query($db,"UPDATE `send_request` SET `is_accept` = 1 WHERE `request_id` = '$request_id' AND `response_id` = '$userid'");
        header("Location:profile.php");
    }

    $query = mysqli_query($db, "SELECT * FROM `user` $condition");
    if(mysqli_num_rows($query) > 0){
    while($row = mysqli_fetch_assoc($query)){
        $g = x($row['gender']);
        if($g == 1){
            $gender = "man";
        }else{
            $gender = "woman";

        }

        $user_result_id = x($row['id']);
        echo ' <div class="row ';
        if($isAdd === 1){
            echo "send_message";
        } 
        echo ' m-2 bg-white p-3 radius-20 shadow" userid=';if($isAdd === 1){echo $user_result_id;} echo '>
        <div class="d-inline-flex" style="position:relative;">
            <img src="assets/img/'.$gender.'.png" width="35">
            <h5 class="m-1 text-dark ">'.x($row['username']).'</h5>';
            if($isAdd === 0){
                $check = mysqli_query($db, "SELECT * FROM `send_request` WHERE (`request_id` = '$user_result_id' AND `request_id` <> '$userid') OR (`response_id` = '$user_result_id' AND `response_id` <> '$userid')");
                if (mysqli_num_rows($check) == 0) {
                echo '<img src="assets/img/add.png" id="send" friend="'.$user_result_id.'" width="30" style="cursor: pointer;position: absolute;right: 0;margin-top: 7px;margin-right: 9px;">';
                }
            }
            // 
            if($isAdd === 2){
                echo '<a href="?accept='.$user_result_id.'"> <img src="assets/img/accept.png" width="30" style="cursor: pointer;position: absolute;right: 0;margin-top: 3px;margin-right: -12px;"></a>';

            }
            echo "</div> </div>";
    
    }
}else{
    echo "<div class='text-center text-danger'>NONE</div>";
}
?>
<script>
$("#send").on('click',function(){
    var friend_id = $(this).attr("friend");
    $(this).addClass("d-none");
    $.post('includes/send_request.php',{friend_id:friend_id},function(data){
    });
})

</script>
<?php


} 
?>