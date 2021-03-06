<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('commons/header');?>
<script>
    $(document).ready(function () {
        $('#login_form').validate({
            errorClass: "alert alert-danger",
            errorElement: "label",
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: "Please, insert your registered email.",
                password: "Please, insert your password."
            },
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            }
        });
    });
</script>

<body>
<?php $this->load->view('commons/menu'); ?>
<div class="container">
    <div class="container">
        <form action="<?=base_url('Eboat/process_login')?>" method="post" id="login_form" name="login" class="form-signin">
            <?php
            if (isset($this->session->userdata['registered']) and $this->session->userdata['registered'] == true) {
                $this->session->unset_userdata['registered'];
                $result='<div class="alert alert-success alert-dismissible fade show">Registered successfully, you can now log in</div>';
                echo $result;
            }
            ?>
            <h2 class="form-signin-heading">Please sign in</h2>

            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" autofocus>

            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">

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