<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('commons/header');?>

<body>
<?php $this->load->view('commons/menu'); ?>
<div class="container">
    <div class="container">
        <form action="<?=base_url('Eboat/process_login')?>" method="post" name="login" class="form-signin">
            <?php
            if (isset($this->session->userdata['registered']) and $this->session->userdata['registered'] == true) {
                $result='<div class="alert alert-success alert-dismissible fade show">Registered successfully, you can now log in</div>';
                echo $result;
            }
            ?>
            <h2 class="form-signin-heading">Please sign in</h2>

            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" autofocus required>

            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

            <div class="sign-up">
                <label>
                    <a href="<?=base_url('signup');?>">Don't have an account? Sign up</a>
                </label>
            </div>
            <button class="btn btn-primary btn-block btn-dark" type="submit">Sign in</button>
        </form>
    </div>
</div>

</body>
</html>