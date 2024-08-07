<?php include 'includes/nav.php';in(0);?>

<div class="container mt-5">
    <div class="p-3 col-lg-4 col-sm text-center m-auto signin">
        <img src="assets/img/logo.png" width="100">
        <div class="bg-danger p-3 m-2 radius-20 error d-none"></div>
        <input type="text" id="usernamel" class="form-control radius-20 border-0 p-2" placeholder="Username">
        <input type="text" id="passwordl" class="form-control radius-20 border-0 mt-2 p-2" placeholder="Password">
        <button id="login" class="btn btn-primary radius-20 mt-2 w-100 mb-3 p-2">LOGIN</button>
        <span id="signup" style="cursor:pointer" class="text-white">Create A Account</span>
    </div>
</div>


<?php include 'signup.php'; ?>
<?php include 'includes/footer.php'; ?>