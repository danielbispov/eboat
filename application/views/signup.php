<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('commons/header');?>

<body>
<div class="container">
    <?php $this->load->view('commons/menu'); ?>

    <div class="container">
        <form class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="signup_name" class="sr-only">name</label>
            <input type="text" id="signup_name" class="form-control" placeholder="Full name" autofocus>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="signup_password" class="form-control" placeholder="Password" >

            <div>
                <input type="checkbox" id="signup_type" class="" value="provider">
                <label for="signup_type" class="">I wish to provide trips</label>
            </div>

            <div class="sign-up">
                <label>
                    <a href="#">Don't have an account? Sign up</a>
                </label>
            </div>
            <button class="btn btn-primary btn-block btn-dark" type="submit">Sign in</button>
        </form>
    </div>
</div>

</body>
</html>