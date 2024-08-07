$(document).ready(function(){
    
    // Go to signup form
    $("#signup").on("click", function(){
        $(".signup").removeClass("d-none");
        $(".signin").addClass("d-none");
    })
    
    //sigup
    $("#signupaction").on("click",function(){
        
    var username = $("#username").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var age = $("#age").val();
    var gender = $("#gender").val();
    $.post('includes/signup.php' , {username:username , email:email , password:password , age:age , gender:gender} , function(data){
        if(data === "success"){
            window.location.href = 'index.php';
        }else{
            $(".error").removeClass("d-none");
            $(".error").html(data);
        }
        });
})

 // Login

     $("#login").on("click",function(){
    var username = $("#usernamel").val();
    var password = $("#passwordl").val();
    $.post('includes/login.php' , {username:username  , password:password } , function(data){
    if(data === "success"){
        window.location.href = 'index.php';
    }else{
        $(".error").removeClass("d-none");
        $(".error").html(data);

    }
    });
});

    // Search
$("#search").on("keyup",function(e){
    if(e.which == 8 && $("#search").val() == ""){
        $(".data_search").addClass("d-none");
    }
})


$("#search").on("keypress",function(){
    var search = $("#search").val();
    $(".data_search").removeClass("d-none");
    $.post('includes/search_result.php',{search:search} , function(data){
        $(".data_search").html(data);
    });
})

$(".send_message").on("click",function() {
    $(".message").removeClass('d-none');
    var friend_id = $(this).attr("userid");
    $("#send_message_btn").attr('userid', friend_id);
    $.post('includes/message.php' , {friend_id : friend_id} , function(data){
        $(".content").html(data);
    })
})

$("#send_message_btn").on("click", function(){
    if ($("#message_content").val() !== "") {
        var content = $("#message_content").val();
        var friend_id = $(this).attr("userid");
        $.post('includes/send_message.php' , {friend_id:friend_id , content:content} , function(data){
            $.post('includes/message.php' , {friend_id : friend_id} , function(data){
                $(".content").html(data);
            })
            $("#message_content").val('');
        })
    }
    })

    


})