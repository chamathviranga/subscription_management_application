<?= $this->extend('layout/app.layout.php') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $mySubscription['subscription_name']; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Edit</a></li>
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

                        <form action="<?= url_to('customer.subscription.update', $mySubscription['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="put">
                            <section class="bg-light rounded p-2 mt-1">
                                <h4>Personal Details</h4>
                                <hr>

                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Ex: John Doe" value="<?= set_value('name') ? set_value('name') : $mySubscription['name']; ?>">

                                    <?php if ($validation->hasError('name')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('name'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Email <span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control" placeholder="Ex: john@gmail.com" value="<?= set_value('email') ? set_value('email') : $mySubscription['email']; ?>">

                                    <?php if ($validation->hasError('email')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('email'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control" placeholder="Ex: 0711000000" value="<?= set_value('phone') ? set_value('phone') : $mySubscription['phone']; ?>">

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
                                    <input type="text" name="billing_street" class="form-control" placeholder="Ex: 1 Street" value="<?= set_value('billing_street') ? set_value('billing_street') : $mySubscription['billing_street']; ?>">

                                    <?php if ($validation->hasError('billing_street')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('billing_street'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Billing City <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_city" class="form-control" placeholder="Ex: Colombo" value="<?= set_value('billing_city') ? set_value('billing_city') : $mySubscription['billing_city']; ?>">

                                    <?php if ($validation->hasError('billing_city')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('billing_city'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Billing State <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_state" class="form-control" placeholder="Ex: Western Province" value="<?= set_value('billing_state') ? set_value('billing_state') : $mySubscription['billing_state']; ?>">

                                    <?php if ($validation->hasError('billing_state')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('billing_state'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Billing Postal Code <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_postal_code" class="form-control" placeholder="Ex: 10500" value="<?= set_value('billing_postal_code') ? set_value('billing_postal_code') : $mySubscription['billing_postal_code']; ?>">

                                    <?php if ($validation->hasError('billing_postal_code')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('billing_postal_code'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Billing Country <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_country" class="form-control" placeholder="Ex: Sri Lanka" value="<?= set_value('billing_country') ? set_value('billing_country') : $mySubscription['billing_country']; ?>">

                                    <?php if ($validation->hasError('billing_country')) : ?>
                                        <div class="text-danger mt-1"><?= $validation->getError('billing_country'); ?></div>
                                    <?php endif; ?>

                                </div>
                            </section>

                            <section class="bg-light rounded p-2 mt-1">

                                <h4>Subscription Details</h4>
                                <hr>

                                <div class="form-group">
                                    <label for="">Current Subscription</label>
                                    <input type="text" name="" id="" value="<?= $mySubscription['subscription_name']; ?>" disabled class="form-control">
                                    <input type="hidden" name="subscription" value="<?= $mySubscription['subscription_id']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Downgrade Subscription</label>
                                    <select name="subscription_downgrade" id="" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach ($subscriptions as $subscription) :
                                            if ($subscription['duration'] < $mySubscription['subscription_duration']) :
                                        ?>
                                                <option <?= $subscription['id'] == set_value('subscription_downgrade') ? 'selected' : null; ?> value="<?= $subscription['id'] ?>"><?= $subscription['name'] ?></option>
                                        <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </select>

                                    <?php if ($validation->hasError('subscription_downgrade')) : ?>
                                        <br>
                                        <div class="text-danger mt-1"><?= $validation->getError('subscription_downgrade'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Upgrade Subscription</label>
                                    <select name="subscription_upgrade" id="" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach ($subscriptions as $subscription) :
                                            if ($subscription['duration'] > $mySubscription['subscription_duration']) :
                                        ?>
                                                <option <?= $subscription['id'] == set_value('subscription_upgrade') ? 'selected' : null; ?> value="<?= $subscription['id'] ?>"><?= $subscription['name'] ?></option>
                                        <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </select>

                                    <?php if ($validation->hasError('subscription_upgrade')) : ?>
                                        <br>
                                        <div class="text-danger mt-1"><?= $validation->getError('subscription_upgrade'); ?></div>
                                    <?php endif; ?>

                                </div>

                                <div class="form-group">
                                    <label for="">Additional Comments</label>
                                    <textarea name="additional_comments" class="form-control" id="" cols="30" rows="5" placeholder="Any other information ..."><?= set_value('additional_comments') ?></textarea>

                                    <?php if ($validation->hasError('additional_comments')) : ?>
                                        <br>
                                        <div class="text-danger mt-1"><?= $validation->getError('additional_comments'); ?></div>
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
                                            <option <?= ($method['id'] == set_value('payment_method')) || empty(set_value('payment_method')) && ($method['id'] == $mySubscription['payment_method']) ? 'selected' : null; ?> value="<?= $method['id'] ?>"><?= $method['method'] ?></option>
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