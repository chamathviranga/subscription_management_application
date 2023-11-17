<?= $this->extend('layout/app.layout.php') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Available Subscriptions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">List</a></li>
                        <li class="breadcrumb-item active">Subscription</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <div class="row">

                    <div class="col-12">
                        <div class="mt-1 mb-1 justify-content-end d-flex">
                            <a href="<?= url_to('customer.subscription.create') ?>" class="btn btn-success">
                                <i class="fa fa-plus"></i>
                                Add New
                            </a>
                        </div>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Street</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Postal Code</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Subscription</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Valid From</th>
                                    <th scope="col">Valid To</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mySubscriptions as $key => $subscription) : ?>
                                    <tr>
                                        <th scope="row"><?= ++$key; ?></th>
                                        <td><?= $subscription['name'] ?></td>
                                        <td><?= $subscription['email'] ?></td>
                                        <td><?= $subscription['phone'] ?></td>
                                        <td><?= $subscription['billing_street'] ?></td>
                                        <td><?= $subscription['billing_city'] ?></td>
                                        <td><?= $subscription['billing_state'] ?></td>
                                        <td><?= $subscription['billing_postal_code'] ?></td>
                                        <td><?= $subscription['billing_country'] ?></td>
                                        <td><?= $subscription['subscription_name'] ?></td>
                                        <td><?= $subscription['payment_method_name'] ?></td>
                                        <td><?= $subscription['valid_from'] ?></td>
                                        <td><?= $subscription['valid_to'] ?></td>
                                        <td>
                                            <?php
                                            if ($subscription['status'] == 'active') {
                                                echo '<span class="badge badge-success">Active</span>';
                                            }

                                            if ($subscription['status'] == 'cancelled') {
                                                echo '<span class="badge badge-danger">Cancelled</span>';
                                            }

                                            if ($subscription['status'] == 'suspended') {
                                                echo '<span class="badge badge-warning">Suspended</span>';
                                            }

                                            ?>

                                        </td>
                                        <td class="text-center">
                                            <a class="btn mt-1 btn-info btn-sm" href="<?= url_to("customer.subscription.edit", $subscription['id']) ?>"><i class="fa fa-edit"></i>Edit</a>
                                            <a class="btn mt-1 btn-warning btn-sm" href="<?= url_to("customer.subscription.suspend", $subscription['id']) ?>"><i class="fas fa-ban"></i>Suspend</a>
                                            <a class="btn mt-1 btn-danger btn-sm" href="<?= url_to("customer.subscription.cancel", $subscription['id']) ?>"><i class="fas fa-times"></i>Cancel</a>
                                            <a class="btn mt-1 btn-dark btn-sm" href="<?= url_to("customer.billing_dispute", $subscription['id']) ?>"><i class="fa fa-cash-register"></i>Billing Dispute</a>
                                            <a class="btn mt-1 btn-primary btn-sm" href="<?= url_to("customer.subscription.renew", $subscription['id']) ?>"><i class="fas fa-money-bill-wave-alt"></i>Renew</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>


                    </div>


                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <!-- <nav aria-label="Contacts Page Navigation">
                    <ul class="pagination justify-content-center m-0">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                        <li class="page-item"><a class="page-link" href="#">8</a></li>
                    </ul>
                </nav> -->
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>


<?= $this->endSection() ?>