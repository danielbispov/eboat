<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img class="logo" src="<?=base_url()?>/assets/img/logo.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
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
            </ul>
        </div>
    </div>
</nav>