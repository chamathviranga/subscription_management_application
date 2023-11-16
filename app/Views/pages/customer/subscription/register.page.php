<?= $this->extend('layout/app.layout.php') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Register For a Subscription</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Create</a></li>
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
                        <?php
                        $validation = \Config\Services::validation();
                        ?>

                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <form action="<?= url_to('customer.subscription.submit') ?>" method="post">
                            <?= csrf_field() ?>

                            <section class="bg-light rounded p-2 mt-1">
                                <h4>Personal Details</h4>
                                <hr>

                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Ex: John Doe" value="<?= set_value('name') ? set_value('name') : auth()->user()->username; ?>">

                                    <?php if ($validation->hasError('name')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('name'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Email <span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control" placeholder="Ex: john@gmail.com" value="<?= set_value('email') ? set_value('email') : auth()->user()->getEmail(); ?>">

                                    <?php if ($validation->hasError('email')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('email'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control" placeholder="Ex: 0711000000" value="<?= set_value('phone') ?>">

                                    <?php if ($validation->hasError('phone')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('phone'); ?></div>
                                    <?php endif; ?>

                                </div>

                            </section>

                            <section class="bg-light rounded p-2 mt-1">

                                <h4>Billing Details</h4>
                                <hr>

                                <div class="form-group">
                                    <label for="">Billing Street <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_street" class="form-control" placeholder="Ex: 1 Street" value="<?= set_value('billing_street') ?>">

                                    <?php if ($validation->hasError('billing_street')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('billing_street'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Billing City <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_city" class="form-control" placeholder="Ex: Colombo" value="<?= set_value('billing_city') ?>">

                                    <?php if ($validation->hasError('billing_city')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('billing_city'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Billing State <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_state" class="form-control" placeholder="Ex: Western Province" value="<?= set_value('billing_state') ?>">

                                    <?php if ($validation->hasError('billing_state')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('billing_state'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Billing Postal Code <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_postal_code" class="form-control" placeholder="Ex: 10500" value="<?= set_value('billing_postal_code') ?>">

                                    <?php if ($validation->hasError('billing_postal_code')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('billing_postal_code'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Billing Country <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_country" class="form-control" placeholder="Ex: Sri Lanka" value="<?= set_value('billing_country') ?>">

                                    <?php if ($validation->hasError('billing_country')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('billing_country'); ?></div>
                                    <?php endif; ?>

                                </div>

                            </section>

                            <section class="bg-light rounded p-2 mt-1">

                                <h4>Subscription Details</h4>
                                <hr>

                                <div class="form-group">
                                    <label for="">Choose Subscription <span class="text-danger">*</span></label>
                                    <select name="subscription" id="" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach ($subscriptions as $subscription) : ?>
                                            <option <?= $subscription['id'] == set_value('subscription') ? 'selected' : null; ?> value="<?= $subscription['id'] ?>"><?= $subscription['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>

                                    <?php if ($validation->hasError('subscription')) : ?>
                                        <br>
                                        <div class="text-danger mt-1"><?= $validation->getError('subscription'); ?></div>
                                    <?php endif; ?>

                                </div>


                            </section>

                            <section class="bg-light rounded p-2 mt-1">
                                <h4>Payment Details</h4>
                                <hr>
                                <div class="form-group">
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

                            </section>

                            <div class="form-group">
                                <input type="checkbox" name="terms_and_conditions" id="" class="mr-2">I agree to the terms and conditions
                                <?php if ($validation->hasError('terms_and_conditions')) : ?>
                                    <br>
                                    <div class="text-danger mt-1"><?= $validation->getError('terms_and_conditions'); ?></div>
                                <?php endif; ?>
                            </div>

                            <button type="reset" class="btn btn-danger">RESET</button>
                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                        </form>

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
<?= $this->endSection() ?>