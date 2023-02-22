<?php

include(APPPATH . 'views/fronted/header.php');
?>

<div class="container h-100">
    <section>
        <div class="design">
            <?php echo form_open('crud_demo/book/changePass', 'id="pass"', 'method="post"'); ?>
            <?php if ($this->session->flashdata('msg')) {
                echo $this->session->flashdata('msg');
            } ?>
            <h3 class="text-center p-2">Change Password</h3>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline p-2">
                        <?php echo form_label('old password :<span class="error">*</span>'); ?>
                        <?php echo form_password(["name" => "old", "class" => "form-control", "value" => set_value('old')]); ?>
                        <?php echo form_error('old', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline p-2">
                        <?php echo form_label('new password :<span class="error">*</span>'); ?>
                        <?php echo form_password(["name" => "new", "class" => "form-control", "value" => set_value('new'), "id" => "new_pass"]); ?>
                        <?php echo form_error('new', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline p-2">
                        <?php echo form_label('confirm password :<span class="error">*</span>'); ?>
                        <?php echo form_password(["name" => "confirm", "class" => "form-control", "value" => set_value('confirm')]); ?>
                        <?php echo form_error('confirm', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="pt-3 d-flex justify-content-center">
                        <?php echo form_submit(["name" => "submit", "class" => "btn btn-dark", "value" => 'submit']); ?>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>

<script>

    $(document).ready(function() {
        // jquery validation
        jQuery.validator.addMethod("rejex", function(value, element) {
            return this.optional(element) || /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9!@#$%&*]+$/.test(value)
        });

        $("#pass").validate({
            errorElement: 'label',
            errorClass: 'jquery-error',
            rules: {
                old: {
                    required: true,
                },
                new: {
                    required: true,
                    rejex: true
                },
                confirm: {
                    required: true,
                    equalTo: "#new_pass"
                }
            },
            messages: {
                old: {
                    required: "Old Password is required",
                    rejex: "alpha numeric value must be required"
                },
                new: {
                    required: "New password is required",
                    rejex: "At least one capital small character and one number and special character must be requird"
                },
                confirm: {
                    required: "confirm password is required",
                    equalTo: "confirm password must be same as password"
                },

            }
        });
    });
</script>