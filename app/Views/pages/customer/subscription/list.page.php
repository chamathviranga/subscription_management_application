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
                            <a href="<?= url_to('subscription.create') ?>" class="btn btn-success">
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
                                        <td>
                                            <a class="btn btn-info btn-sm" href=""><i class="fa fa-edit"></i>Edit</a>
                                            <a class="btn btn-danger btn-sm" href=""><i class="fa fa-trash"></i>Remove</a>
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