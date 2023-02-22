<?php

include(APPPATH . 'views/fronted/header.php');

?>

<div class="container h-100">
    <section>
        <div class="design">
            <?php echo form_open_multipart('api/register', 'id="Register_form"', 'method="post"'); ?>
            <h2 class="text-center p-2">Register User</h2>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline p-2">
                        <?php echo form_label('Name :<span class="error">*</span>', 'name'); ?>
                        <?php echo form_input(["name" => "name", "class" => "form-control", "value" => set_value('name')]); ?>
                        <?php echo form_error('name', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline p-2">
                        <?php echo form_label('Email :<span class="error">*</span>', 'email'); ?>
                        <?php echo form_input(["name" => "email", "class" => "form-control", "value" => set_value('email')]); ?>
                        <?php echo form_error('email', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-outline p-2">
                        <?php echo form_label('Password :<span class="error">*</span>', 'password'); ?>
                        <?php echo form_password(["name" => "password", "class" => "form-control", "value" => set_value('password')]); ?>
                        <?php echo form_error('password', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-outline p-2">
                        <?php echo form_label('Gender :','gender'); ?><br>

                        <div class="form-check form-check-inline">
                            <?php echo form_radio("gender", "male", set_radio('gender', 'male', true), 'id="male1"'); ?>
                            <?php echo form_label('male', 'male1'); ?>
                        </div>
                        <div class="form-check form-check-inline">
                            <?php echo form_radio("gender", "female", set_radio('gender', 'female'), 'id="female1"'); ?>
                            <?php echo form_label('female', 'female1'); ?>
                        </div>
                        <?php echo form_error('gender', '<p class="error">', '</p>'); ?>
                        <br>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php echo form_label('Interest :<span class="error">*</span>', 'interest'); ?>

                    <div class="form-check">
                        <?php echo form_checkbox(["name" => "interests[]", "id" => "reading", "class" => "form-check-input ml-0", "value" => "reading", 'checked' => set_checkbox('interests[]', 'reading')]); ?>
                        <?php echo form_label('Reading', 'reading'); ?>
                    </div>
                    <div class="form-check">
                        <?php echo form_checkbox(["name" => "interests[]",  "id" => "writing", "class" => "form-check-input ml-0", "value" => "writing", 'checked' => set_checkbox('interests[]', 'writing')]); ?>
                        <?php echo form_label('Writing', 'writing'); ?>
                    </div>
                    <div class="form-check">
                        <?php echo form_checkbox(["name" => "interests[]", "id" => "coding", "class" => "form-check-input ml-0", "value" => "coding", 'checked' => set_checkbox('interests[]', 'coding')]); ?>
                        <?php echo form_label('Coding', 'coding'); ?>
                    </div>
                    <div class="form-check">
                        <?php echo form_checkbox(["name" => "interests[]", "id" => "playing", "class" => "form-check-input ml-0", "value" => "playing", 'checked' => set_checkbox('interests[]', 'playing')]); ?>
                        <?php echo form_label('Playing', 'playing'); ?>
                    </div>
                    <label id="interests[]-error" class="jquery-error" for="interests[]"></label>
                    <?php echo form_error('hobby', '<p class="error">', '</p>'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline p-2">
                        <?php echo form_label('Atachment :<span class="error">*</span>', 'Atachment'); ?>
                        <?php echo form_upload(["type" => "file", "name" => "image", "class" => "form-control"]); ?>
                        <?php echo form_error('image', '<p class="error">', '</p>'); ?>
                        <span class="text-danger"><?php if (isset($error)) {
                                                        echo $error;
                                                    } ?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-check d-flex justify-content-start pt-2">
                        <input class="form-check-input me-2 p-2" type="checkbox" value="" id="form2Example3cg" />
                        <label class="form-check-label" for="form2Example3g">
                            I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="pt-3 d-flex justify-content-center">
                        <?php echo form_submit(["name" => "register", "class" => "btn btn-dark", "value" => 'Register']); ?>
                    </div>
                </div>
            </div>

            <?php echo form_close(); ?>
            <p class="text-center text-muted mt-3 mb-0">Have already an account? <a href="<?php echo base_url() . 'api/login' ?>" class="fw-bold text-body"><u>Login here</u></a></p>
        </div>
    </section>
</div>

<script>

    $(document).ready(function() {
        // register
            jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || /^[A-Za-z ]+$/.test(value)
            });

            jQuery.validator.addMethod("regex", function(value, element) {
                return this.optional(element) || /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9!@#$%&*]+$/.test(value)
            });

        $('#Register_form').validate({
            errorElement: 'label',
            errorClass: 'jquery-error',
            rules: {
                name: {
                    required: true,
                    alpha: true
                },
                email: {
                    required: true,
                    email: true
                },
                pass: {
                    required: true,
                    regex:true,
                    minlength: 8,
                    maxlength:16
                },
                "hobby[]": {
                    required: function(elem) {
                        return $("input.select:checked").length >= 0;
                    },
                },
                imagefile: {
                    required: true,
                    accept:"jpg,png,jpeg,gif"
                },
            },
            messages: {
                name: {
                    required: "Enter your full name",
                    alpha: "Only alphabets allowed",
                },
                email: {
                    required: "Enter your Email Address",
                },
                pass: {
                    required: "Enter password",
                    regex:"At least one capital small character and one number and special character must be requird",
                    minlength: "minimum 8 length allowed",
                    maxlength:"maximum 16 length allowed",
                },
                "hobby[]": {
                    required: "Interest must be selected",
                },
                imagefile: {
                    required: "Image must be selected",
                    accept:"Only image type jpg/png/jpeg/gif is allowed"
                },
            },
    
        });

    });
</script>
