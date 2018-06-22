<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img class="logo" alt="Logo image" src="<?=base_url()?>/assets/img/logo.png">
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="menu-items">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('index'); ?>">Home</a>
                </li>
                <?php
                    if(!isset($this->session->userdata['name'])) {
                        echo "<li class=\"nav-item\">" .
                            "<a class=\"nav-link\" href=\"" . base_url('login') . "\">Sign In</a>" .
                            "</li>";
                    }?>
                <li class="nav-item">
                    <a class="nav-link" title="6 characters minimum" href="<?=base_url('signup'); ?>">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>