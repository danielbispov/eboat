<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('commons/header');?>

<body>
<div class="container">
    <?php $this->load->view('commons/menu'); ?>

    <div class="container">
        <form class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
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