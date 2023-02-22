<?php

include(APPPATH . 'views/fronted/header.php');

?>

<div class="container h-100">
    <section>
        </div>
        <div class="design">

            <?php echo form_open('api/loginuser','id="loginForm"' ,'method="post"'); ?>
            <?php  echo $this->session->flashdata('msg'); ?>
            <h2 class="text-center p-2">Login User</h2>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline p-2">
                        <?php echo form_label('Username :<span class="error">*</span>', 'Username'); ?>
                        <?php echo form_input(["name" => "email","class" => "form-control" ,"value" => set_value('email')]); ?>
                        <?php echo form_error('email', '<p class="error">', '</p>');?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline p-2">
                        <?php echo form_label('Password :<span class="error">*</span>', 'password'); ?>
                        <?php echo form_password(["name" => "password","class" => "form-control" ,"value" => set_value('password')]); ?>
                        <?php echo form_error('password', '<p class="error">', '</p>');?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="pt-3 d-flex justify-content-center">
                        <?php echo form_submit(["name" => "login","class" => "btn btn-dark","value" => 'login']); ?>
                    </div>
                </div>
            </div>
            <p class="text-center text-muted mt-3 mb-0">Don't have an account? <a href="<?php echo base_url().'api'?>" class="fw-bold text-body" ><u>Register here</u></a></p>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>

<script>

    //  login validation
    $(document).ready(function() {
        $("#loginForm").validate({
            errorElement: 'label',
            errorClass: 'jquery-error',
            rules: {
                email: {
                    required: true,
                    email:true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength:16
                },
            },
            messages: {
                email: {
                    required: "Enter your Email Address ",
                },
                password: {
                    required: "Enter password",
                    minlength: "minimum 8 length allowed",
                    maxlength:"maximum 16 length allowed",
                },
            },
        });
    });
</script>
