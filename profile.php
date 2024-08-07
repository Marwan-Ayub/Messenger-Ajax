<?php include 'includes/nav.php';in(1);?>

<nav class="container mt-5 navbar navbar-expand-lg navbar-light bg-white radius-20">
<a href="profile.php" class="navbar-brand ms-3">Messenger</a>
<ul class="navbar-nav mr-auto">
<li class="nav-item">
    <a href="?logout" class="nav-link text-danger">LOGOUT</a>
</li>
</ul>
</nav>

<!-- Friends List -->
<div class="row m-5 justify-content-center">
    <div class="col-sm-3 m-2 bg-light radius-20 p-4">
        <input type="text" id="search" class="form-control radius-20 border-0 mt-2 p-2" placeholder="Search username">
       <!-- Search -->
        <div class="bg-info mt-2 radius-20 p-2 data_search d-none"></div>
        
        <div class="dropdown m-3 ">
        <span class=" dropdown-toggle text-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Request Friends
        </span>
        <ul class="dropdown-menu p-2">
            <?php 
            global $result_id_request;
            $query = mysqli_query($db,"SELECT * FROM `send_request` WHERE (`response_id` = '$userid' AND `is_accept` = 0)");
            if(mysqli_num_rows($query)){
            while($row = mysqli_fetch_assoc($query)){
                $result_id_request = x($row['request_id']);
            }
            echo '<div class="dropdown-item " >'.users("WHERE `id` = '$result_id_request'",2).'</div>';
        }else{
            echo 'Empty result';
        }
            ?>
            
        </ul>
        </div>
        
        <hr>
        <h5>Friends</h5>
        <?php users("u JOIN send_request sr ON (sr.request_id = $userid OR sr.response_id = $userid) AND (u.id = sr.response_id OR u.id = sr.request_id) WHERE sr.is_accept = 1 AND u.id <> $userid ",1); ?>
    </div>
    <div class="message col-sm-7 m-2 bg-light radius-20 p-3 d-none">
            <div class="content">
            
            </div>

            <div class="d-flex">
                <input id="message_content" type="text" class="form-control radius-20 border-0 mt-2 p-2" placeholder="Write Message">
                
                <button class="butt" id="send_message_btn">
                <div class="svg-wrapper-1">
                    <div class="svg-wrapper">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                    </svg>
                    </div>
                </div>
                <span>Send</span>
                </button>

                <!-- <span id="send_message_btn" class="btn btn-primary radius-20 mt-1 ms-2 p-8">Send</span> -->
            </div>
        </div>
</div>


<?php include 'includes/footer.php'; ?>