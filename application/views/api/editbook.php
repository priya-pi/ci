<?php

include(APPPATH . 'views/fronted/header.php');
?>

<div class="container h-100">
    <section>
        <div class="design">
            <?php echo form_open('api/book/update', 'id="addForm"', 'method="post"'); ?>
            <h2 class="text-center p-2">Add Book</h2>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline p-2">
                        <?php echo form_label('Bookname: <span class="error">*</span>', 'name'); ?>
                        <?php echo form_input(["name" => "name", "class" => "form-control", "value" => set_value('name')]); ?>
                        <?php echo form_error('name', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-outline p-2">
                        <?php echo form_label('Description: <span class="error">*</span>', 'description'); ?>
                        <?php echo form_input(["name" => "description", "class" => "form-control", "value" => set_value('description')]); ?>
                        <?php echo form_error('description', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-outline p-2">
                        <?php echo form_label('No_of_page: <span class="error">*</span>', 'no_of_page'); ?>
                        <?php echo form_input(["name" => "no_of_page", "class" => "form-control", "value" => set_value('no_of_page')]); ?>
                        <?php echo form_error('no_of_page', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-outline p-2">
                        <?php echo form_label('Author: <span class="error">*</span>', 'author'); ?>
                        <?php echo form_input(["name" => "author", "class" => "form-control", "value" => set_value('author')]); ?>
                        <?php echo form_error('author', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-outline p-2">
                        <?php echo form_label('Category:<span class="error">*</span>', 'category'); ?>
                        <?php echo form_input(["name" => "category", "class" => "form-control", "value" => set_value('category')]); ?>
                        <?php echo form_error('category', '<p class="error">', '</p>'); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-outline p-2">
                        <?php echo form_label('Price: <span class="error">*</span>', 'price'); ?>
                        <?php echo form_input(["name" => "price", "class" => "form-control", "value" => set_value('price')]); ?>
                        <?php echo form_error('price', '<p class="error">', '</p>'); ?>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-md-6">
                    <div class="form-outline p-2">
                        <?php echo form_label('Released_year: <span class="error">*</span>', 'released_year'); ?>
                        <?php echo form_input(["name" => "released_year", "class" => "form-control", "value" => set_value('released_year')]); ?>
                        <?php echo form_error('released_year', '<p class="error">', '</p>'); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-outline p-2">
                        <?php echo form_label('status: <span class="error">*</span>', 'status'); ?><br>
                        <div class="form-check form-check-inline">
                            <?php echo form_radio("status", 1, set_radio('status', 1), 'id="on"'); ?>
                            <?php echo form_label('on', '1'); ?>
                        </div>
                        <div class="form-check form-check-inline">
                            <?php echo form_radio("status", 0, set_radio('status', 0,true), 'id="off"'); ?>
                            <?php echo form_label('off', '0'); ?>
                        </div><br>
                        <?php echo form_error('status', '<p class="error">', '</p>'); ?>
                        <label id="status-error" class="error" for="status"></label>
                        <br>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="pt-3">
                        <?php echo form_reset(["name" => "reset", "class" => "btn btn-dark", "value" => 'Reset', "id" => "reset"]); ?>
                        <?php echo form_submit(["name" => "update", "class" => "btn btn-dark", "value" => 'update']); ?>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {

        // insert book validation
        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || /^[A-Za-z_ ]+$/.test(value)
        });

        var validator = $("#addForm").validate({
            errorElement: 'label',
            errorClass: 'jquery-error',
            rules: {
                name: {
                    required: true,
                    alpha: true
                },
                description: {
                    required: true,
                },
                no_of_page: {
                    required: true,
                    digits: true
                },
                author: {
                    required: true,
                    alpha: true
                },
                category: {
                    required: true,
                    alpha: true
                },
                price: {
                    required: true,
                    number: true
                },
                released_year: {
                    required: true,
                    maxlength: 4,
                    minlength:4,
                    digits: true
                }
            },
            messages: {
                name: {
                    required: "Enter  book name",
                    alpha: "Only alphabets allowed"
                },
                description: {
                    required: "Enter book description 3-20 characters",
                },
                no_of_page: {
                    required: "Enter no_of_page",
                    digits: "Only number allowed"
                },
                author: {
                    required: "Enter author name",
                    alpha: "Only alphabets allowed"
                },
                category: {
                    required: "Enter category name",
                    alpha: "Only alphabets allowed"
                },
                price: {
                    required: "Enter price",
                    number: "Only number allowed"
                },
                released_year: {
                    required: "Enter Released_year",
                    maxlength: "Minmum 4 length required",
                    minlength:"minmum 4 length required",
                    digits: "Only number allowed",
                }
            }

        });

        $('#reset').click(function() {
            validator.resetForm();
        });
    });
</script>
