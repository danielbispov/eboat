<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('commons/header');?>

<body>
<?php $this->load->view('commons/menu'); ?>
<div class="container">
    <div class="container">
        <form action="<?=base_url();?>Eboat/register_user" method="post" class="form-signin">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="name" class="sr-only">name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Full name" autofocus required>

            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email address" autofocus required>

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