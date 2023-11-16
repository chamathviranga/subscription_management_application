<?= $this->extend('layout/app.layout.php') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Subscription</h1>
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
                        // echo session()->getFlashdata('error'); 
                        // echo validation_list_errors();
                        //validation_show_error('name');

                        $validation = \Config\Services::validation();
                        ?>

                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <form action="<?= url_to('subscription.submit') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Type here.." value="<?= set_value('name') ?>">

                                <?php if ($validation->hasError('name')) : ?>
                                    <div class="text-danger mt-1"><?= $validation->getError('name'); ?></div>
                                <?php endif; ?>

                            </div>

                            <div class="form-group">
                                <label for="">Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="" cols="30" rows="5" class="form-control" placeholder="Type here.."><?= set_value('description') ?></textarea>

                                <?php if ($validation->hasError('description')) : ?>
                                    <div class="text-danger mt-1"><?= $validation->getError('description'); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="">Price (LKR) <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control text-right" placeholder="1200.00" value="<?= set_value('price') ?>">

                                <?php if ($validation->hasError('price')) : ?>
                                    <div class="text-danger mt-1"><?= $validation->getError('price'); ?></div>
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