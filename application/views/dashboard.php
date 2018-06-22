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
                        <a role="button" class="btn btn-danger" href="<?=base_url('Eboat/logout');?>">
                            Logout
                        </a>
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
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-trips-tab" data-toggle="tab" href="#nav-trips" role="tab" aria-controls="nav-trips" aria-selected="true">Available Trips</a>
                        <a class="nav-item nav-link" id="nav-manage-tab" data-toggle="tab" href="#nav-manage" role="tab" aria-controls="nav-manage" aria-selected="false">Manage trips</a>
                        <a class="nav-item nav-link" id="nav-mytrips-tab" data-toggle="tab" href="#nav-mytrips" role="tab" aria-controls="nav-mytrips" aria-selected="false">Bought trips</a>
                    </div>
                </nav>
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="nav-trips" aria-labelledby="nav-trips-tab" role="tabpanel">
                        <table class="table mt-3">
                            <thead>
                            <tr>
                                <th scope="col">Provider</th>
                                <th scope="col">Origin</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Departure</th>
                                <th scope="col">Cost</th>
                                <th scope="col"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($trips as $trip_data): ?>
                                <tr>
                                    <td><?php echo $trip_data['provider_name']; ?></td>
                                    <td><?php echo $trip_data['origin']; ?></td>
                                    <td><?php echo $trip_data['destination']; ?></td>
                                    <td><?php echo $trip_data['departure']; ?></td>
                                    <td>R$ <?php echo $trip_data['cost']; ?></td>
                                    <td>
                                    <?php if($this->session->userdata['id'] != $trip_data['provider_id']):?>
                                        <a role="button" class="btn btn-primary"
                                                href="<?=base_url('Eboat/new_schedule/'.$this->session->userdata['id']."/".$trip_data['trip_id']);?>">
                                            Buy
                                        </a>
                                    <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="nav-manage" role="tabpanel" aria-labelledby="nav-manage-tab">

                        <?php if($this->session->userdata['permission'] == 't'): ?>

                        <div class="card mt-3">

                            <form action="<?=base_url('Eboat/register_trip');?>" method="post" name="login" class="form-trip">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="origin">Origin</label>
                                        <input type="text" class="form-control" id="origin" name="origin" placeholder="Origin" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="destination">Destination</label>
                                        <input type="text" class="form-control" id="destination" name="destination" placeholder="Destination" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="departure">Departure</label>
                                        <input type="text" class="form-control" id="departure" name="departure" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="cost">Price</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">R$</span>
                                            </div>
                                            <input type="number" class="form-control" id="cost" name="cost" placeholder="Price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="boat">Boat name</label>
                                    <input type="text" class="form-control" id="boat" name="boat" placeholder="eg. Maria II" required>
                                </div>

                                <button class="btn btn-primary btn-block" type="submit">Create trip</button>
                            </form>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Origin</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Departure</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($user_trips != null): ?>
                                    <?php foreach ($user_trips as $user_trip): ?>
                                    <tr>
                                        <td><?php echo $user_trip['origin']; ?></td>
                                        <td><?php echo $user_trip['destination']; ?></td>
                                        <td><?php echo $user_trip['departure']; ?></td>
                                        <td>R$ <?php echo $user_trip['cost']; ?></td>
                                        <td>
                                            <div class="container">
                                                <a role="button" class="btn btn-danger" href="<?=base_url('Eboat/remove_trip/'.$user_trip['trip_id']);?>">
                                                    Delete
                                                </a>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_update">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </div>

                        <?php else: ?>

                            <div class="card border-warning mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">You're not pro</h5>
                                </div>
                                <div class="card-body text-warning">
                                    <p class="card-text">You have registered as a passenger only.</p>
                                </div>
                            </div>

                        <?php endif;?>
                    </div>


                    <div class="tab-pane fade" id="nav-mytrips" role="tabpanel" aria-labelledby="nav-mytrips-tab">

                            <?php if($b_trips != null): ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Provider</th>
                                    <th scope="col">Origin</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Departure</th>
                                    <th scope="col">Cost</th>

                                </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($b_trips as $btrip_data): ?>
                                    <tr>
                                        <td><?php echo $btrip_data['provider_name']; ?></td>
                                        <td><?php echo $btrip_data['origin']; ?></td>
                                        <td><?php echo $btrip_data['destination']; ?></td>
                                        <td><?php echo $btrip_data['departure']; ?></td>
                                        <td>R$ <?php echo $btrip_data['cost']; ?></td>
                                        <td>
                                            <button role="button"
                                               class="btn btn-danger" data-toggle="modal" data-target="#modal_cancel">
                                                Cancel
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>

                                <div class="card border-warning mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Nothing here!</h5>
                                    </div>
                                    <div class="card-body text-warning">
                                        <p class="card-text">You haven't bought any trips yet :(</p>
                                    </div>
                                </div>

                            <?php endif; ?>

                    </div>

                </div>

            </div>
        </div>

        <?php if(isset($user_trip) and isset($trip_data)): ?>
        <!-- Update modal -->
        <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title">Update trip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?=base_url('Eboat/update_trip/'.$trip_data['trip_id']);?>" method="post" name="login" class="form-trip">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="origin">Origin</label>
                                    <input type="text" class="form-control" id="upd_origin" name="upd_origin" value="<?php echo $user_trip['origin'];?>" placeholder="Origin">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="destination">Destination</label>
                                    <input type="text" class="form-control" id="upd_destination" name="upd_destination" value="<?php echo $user_trip['destination'];?>" placeholder="Destination">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="departure">Departure</label>
                                    <input type="text" class="form-control" id="upd_departure" name="upd_departure" value="<?php echo $user_trip['departure'];?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cost">Price</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">R$</span>
                                        </div>
                                        <input type="number" class="form-control" id="upd_cost" name="upd_cost" value="<?php echo $user_trip['cost'];?>" placeholder="Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="boat">Boat name</label>
                                    <input type="text" class="form-control" id="upd_boat" name="upd_boat" placeholder="eg. Maria II">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a role="button" class="btn btn-primary" href="<?=base_url('Eboat/update_trip/'.$user_trip['trip_id']);?>">Update</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <?php endif; ?>

        <!-- Cancel trip modal -->
        <div class="modal fade" id="modal_cancel" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm cancellation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to cancel this trip?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, stop!</button>
                        <a role="button"
                           href="<?=base_url('Eboat/delete_schedule/'.$this->session->userdata['id']."/".$btrip_data['trip_id']);?>"
                           class="btn btn-primary">Yes, cancel</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </body>
</html>