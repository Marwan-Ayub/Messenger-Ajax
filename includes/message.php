<?php
include 'config.php';
if(isset($_POST['friend_id'])){
     $friend_id = x($_POST['friend_id']);
?>
<script>
    var friend_id = <?php echo json_encode($friend_id);?>;
    setTimeout(function(){
        $.post('includes/message.php' , {friend_id : friend_id} , function(data){
            $(".content").html(data);
        })
    }, 1000);
</script>
<?php


    m("m JOIN `user` u ON (u.id = m.send) WHERE (m.send = $friend_id AND m.receive = $userid) OR (m.send = $userid AND m.receive = $friend_id) ORDER BY m.date_of_send ASC");
}
function m($condition){
    global $db;
    global $userid;
    $query = mysqli_query($db,"SELECT * FROM `message` $condition");
    if(mysqli_num_rows($query) > 0){
    while($row = mysqli_fetch_assoc($query)){
        $user = x($row['send']);

        $g = x($row['gender']);
        if($g == 1){
            $gender = "man";
        }else{
            $gender = "woman";

        }
        ?>
            <div class="media <?php if( $user !== $userid){
                echo 'bg-white';
            }else{
                echo 'bg-info';
            }  
            ?> p-3 mt-2 radius-20 shadow">
                <div class="d-inline-flex">
                    <img src="assets/img/<?php echo $gender; ?>.png" width="30" class="mr-3">
                    <h5 class="m-1"><?php echo x($row['username']); ?></h5>
                </div>
                <div class="media-body">
                   <?php echo x($row['message_content']); ?>

                </div>
            </div>
            <!-- <div class="mt-3 media bg-white p-3 radius-20 shadow"  >
                
                <div class="media-body ">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur
                        adipisicing elit.</p>
                    </div>
            </div> -->

<?php } }else{
    echo '<p class="text-info text-center">Send Message :)</p>';
}}?>