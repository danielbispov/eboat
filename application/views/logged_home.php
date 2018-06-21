<?php
    if(!isset($this->session->userdata['name'])) {
        $this->load->view('home');
    } else {
        $session['name'] = $this->session->userdata['name'];
        $session['email'] = $this->session->userdata['email'];
        $session['balance'] = $this->session->userdata['balance'];
        $session['permission'] = $this->session->userdata['permission'];
        if($session['permission'] == 't')
            $session['permission'] = "Pro";
        else
            $session['permission'] = "Basic";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('commons/header');?>

    <body>
    <?php $this->load->view('commons/menu'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 mt-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Hey, <?php echo $session['name'];?>!</h5>
                        <h6 class="card-subtitle mb-2 text-muted">(<?php echo $session['email'];?>)</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Balance: <span class="text-success">R$ <?php echo $session['balance'];?></span>
                        </li>
                        <li class="list-group-item">
                            Account type: <?php echo $session['permission'];?>
                        </li>
                    </ul>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Terms changes</h5>
                    </div>
                    <div class="card-body">

                        <h6 class="card-subtitle mb-2 text-muted">Our terms have changed</h6>
                        <p class="card-text">Check out our terms clicking in the link bellow. It is very important
                        to clarify our intentions and your rights :)</p>
                        <a href="#" class="card-link">Terms</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h1 class="display-5">Travels available</h1>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Provider</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Departure</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($trips as $trip_data): ?>
                            <tr>
                                <td><?php echo $trip_data['provider_id']; ?></td>
                                <td><?php echo $trip_data['destination']; ?></td>
                                <td><?php echo $trip_data['departure']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    </body>
</html>