<?= $this->extend('layout/app.layout.php') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Renew Package <small>(<?= $mySubscription['subscription_name']; ?>)</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Suspend</a></li>
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

                    <div class="col-12 col-md-6 mx-auto">
                        <?php $validation = \Config\Services::validation(); ?>

                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <section class="bg-light rounded p-2 mt-1">
                            <table class="table table-bordered table-dark">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Personal Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td><?= $mySubscription['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?= $mySubscription['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?= $mySubscription['phone']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>

                        <section class="bg-light rounded p-2 mt-1">
                            <table class="table table-bordered table-dark">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Billing Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Street</td>
                                        <td><?= $mySubscription['billing_street']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td><?= $mySubscription['billing_city']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td><?= $mySubscription['billing_state']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Postal Code</td>
                                        <td><?= $mySubscription['billing_postal_code']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><?= $mySubscription['billing_country']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>

                        <section class="bg-light rounded p-2 mt-1">
                            <table class="table table-bordered table-dark">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Subscription Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Id</td>
                                        <td><?= $mySubscription['subscription_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Subscription</td>
                                        <td><?= $mySubscription['subscription_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Duration</td>
                                        <td><?= $mySubscription['subscription_duration']; ?> Months</td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>LKR <?= $mySubscription['subscription_price']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Next Billing</td>
                                        <td><?= $mySubscription['valid_to']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>

                        <section class="bg-light rounded p-2 mt-1">
                            <table class="table table-bordered table-dark">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Payment Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Payment Method</td>
                                        <td><?= $mySubscription['payment_method_name']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>


                        <section class="bg-light rounded p-2 mt-1 mb-1">
                            <h5 class="text-bold">Do you wish to renew this package ?</h5>
                            <hr>
                            <form action="<?= url_to('customer.subscription.submit_renew', $mySubscription['id']); ?>" method="post">
                                <?= csrf_field() ?>

                                <input type="hidden" value="<?= $mySubscription['subscription_id']; ?>" name="subscription_id">

                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="">Renew For <span class="text-danger">*</span></label>
                                        <select name="renew_for" id="" class="form-control">
                                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                                <option <?= set_value('renew_for') == $i ? 'selected' : null; ?> value="<?= $i ?>"><?= $i . ($i == 1 ? " Month" : " Months"); ?></option>
                                            <?php endfor; ?>
                                        </select>

                                        <?php if ($validation->hasError('renew_for')) : ?>
                                            <br>
                                            <div class="text-danger mt-1"><?= $validation->getError('renew_for'); ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group col-12 col-md-6">
                                        <label for="">Payment Method <span class="text-danger">*</span></label>
                                        <select name="payment_method" id="" class="form-control">
                                            <option value="">Select</option>
                                            <?php foreach ($paymentMethods as $method) : ?>
                                                <option <?= $method['id'] == set_value('payment_method') ? 'selected' : null; ?> value="<?= $method['id'] ?>"><?= $method['method'] ?></option>
                                            <?php endforeach ?>
                                        </select>

                                        <?php if ($validation->hasError('payment_method')) : ?>
                                            <br>
                                            <div class="text-danger mt-1"><?= $validation->getError('payment_method'); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" name="terms_and_conditions" id="" class="mr-2">I agree to the terms and conditions
                                    <?php if ($validation->hasError('terms_and_conditions')) : ?>
                                        <br>
                                        <div class="text-danger mt-1"><?= $validation->getError('terms_and_conditions'); ?></div>
                                    <?php endif; ?>
                                </div>


                                <button class="btn btn-primary btn-sm">
                                    <i class="fa fa-paper-plane"></i>
                                    SUBMIT</button>
                            </form>
                        </section>


                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<?php \App\Helpers\Messages::Success(); ?>
<?php \App\Helpers\Messages::Error(); ?>
<?= $this->endSection() ?>