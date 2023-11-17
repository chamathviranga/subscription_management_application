<?= $this->extend('layout/app.layout.php') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Billing Dispute <small>(<?= $mySubscription['subscription_name']; ?>)</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Billing Dispute</a></li>
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
                                        <td><?= $modifiedDateString = date('Y-m-d', strtotime('+' .  $mySubscription['subscription_duration'] . ' months', strtotime($mySubscription['created_at'])));; ?></td>
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
                            <h5 class="text-bold">Do you have any issues with billing?</h5>
                            <hr>
                            <form action="<?= url_to('customer.submit_billing_dispute', $mySubscription['id']); ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="">Explanation of the Issue</label>
                                    <textarea name="issue" id="" cols="30" rows="3" class="form-control"><?= set_value('issue') ?></textarea>

                                    <?php if ($validation->hasError('issue')) : ?>
                                        <br>
                                        <div class="text-danger mt-1"><?= $validation->getError('issue'); ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Relevant Billing Information</label>
                                    <textarea name="additional_info" id="" cols="30" rows="3" class="form-control"><?= set_value('additional_info') ?></textarea>

                                    <?php if ($validation->hasError('additional_info')) : ?>
                                        <br>
                                        <div class="text-danger mt-1"><?= $validation->getError('additional_info'); ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Support Documents</label>
                                    <br>
                                    <input type="file" name="support_document" id="" class="form-control">

                                    <?php if ($validation->hasError('support_document')) : ?>
                                        <br>
                                        <div class="text-danger mt-1"><?= $validation->getError('support_document'); ?></div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Preferred Resolution</label>
                                    <select name="preferred_resolution" id="" class="form-control">
                                        <option <?= set_value('preferred_resolution') == 'refund' ? 'selected' : null; ?> value="refund">Refund</option>
                                        <option <?= set_value('preferred_resolution') == 'adjustment' ? 'selected' : null; ?> value="adjustment">Adjustment</option>
                                        <option <?= set_value('preferred_resolution') == 'cancellation' ? 'selected' : null; ?> value="cancellation">Cancellation</option>
                                        <option <?= set_value('preferred_resolution') == 'investigation' ? 'selected' : null; ?> value="investigation">Investigation</option>
                                        <option <?= set_value('preferred_resolution') == 'credit' ? 'selected' : null; ?> value="credit">Credit</option>
                                        <option <?= set_value('preferred_resolution') == 'clarification' ? 'selected' : null; ?> value="clarification">Clarification</option>
                                        <option <?= set_value('preferred_resolution') == 'other' ? 'selected' : null; ?> value="other">Other</option>
                                    </select>

                                    <?php if ($validation->hasError('preferred_resolution')) : ?>
                                        <br>
                                        <div class="text-danger mt-1"><?= $validation->getError('preferred_resolution'); ?></div>
                                    <?php endif; ?>
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