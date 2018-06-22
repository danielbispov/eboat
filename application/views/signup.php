<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('commons/header');?>
<script>
    $(document).ready(function () {
        $('#signup_form').validate({
            errorClass: 'alert alert-warning',
            rules: {
                name: {
                    required: true
                },
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
                email: "Please, insert an email.",
                password: "Please, put a 6 characters minimum password."
                name: "Please, insert your name";
            }
        });
    });
</script>
<body>
<?php $this->load->view('commons/menu'); ?>
<div class="container">
    <div class="container">
        <form action="<?=base_url();?>Eboat/register_user" method="post" id="signup_form" class="form-signin">
            <?php
            if (isset($this->session->userdata['registered']) and $this->session->userdata['registered'] == false) {
                $result='<div class="alert alert-danger alert-dismissible fade show">Something went wrong, maybe you already have an account</div>';
                echo $result;
            }
            ?>
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="name" class="sr-only">name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Full name" autofocus required>

            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address"  required>

            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" name="password" pattern=".{6,}" class="form-control" placeholder="Password" required>

            <div>
                <input type="checkbox" id="permission" name="permission">
                <label for="permission">I wish to provide trips</label>
            </div>

            <button class="btn btn-primary btn-block btn-dark" type="submit">Sign un</button>
        </form>
    </div>
</div>

</body>
</html>