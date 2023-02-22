<?php

include(APPPATH . 'views/fronted/header.php');
$url = base_url() . 'crud_demo/display/get';

?>

<div class="container-fluid back p-2 justify-content-center mt-4">
    <div class="mt-5 p-3 mb-5">
        <h3 class="text-center p-3 theme">serverBook Details</h3>

        <div class="mb-3">
            <a href="<?php echo base_url() . 'crud_demo/logout' ?>" class="btn btn-danger">Logout</a>
            <button type="button" onclick="insertModal()" class="btn btn-success">Add</button>
            <a href="<?php echo base_url() . 'crud_demo/dashboard' ?>" class="btn btn-primary">codelgniter</a>
            <a href="<?php echo base_url() . 'crud_demo/book/changePass' ?>" class="btn btn-info">Change Password</a>

        </div>
        <table class="table table-light" id="myTable">
            <thead class="table">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>description</th>
                    <th>no_of_page</th>
                    <th>author</th>
                    <th>category</th>
                    <th>price</th>
                    <th>released_year</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal" tabindex="-1" id="edit" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title formBookTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">

                <?php echo form_open('action="#"', 'id="updateModal"', 'method="post"', 'validate'); ?>

                <input type="hidden" id="editid" name="id" value="">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline p-2">
                            <?php echo form_label('Bookname: <span class="error" >*</span>', 'name'); ?>
                            <?php echo form_input(["name" => "name", "class" => "form-control", "id" => "name"]); ?>
                            <label id="name-error" class="error" for="name"></label>
                            <span class="error" id="nameError"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline p-2">
                            <?php echo form_label('Description: <span class="error">*</span>', 'description'); ?>
                            <?php echo form_input(["name" => "desc", "class" => "form-control", "id" => "desc"]); ?>
                            <span class="error" id="descError"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-outline p-2">
                            <?php echo form_label('No_of_page: <span class="error">*</span>', 'no_of_page'); ?>
                            <?php echo form_input(["name" => "no_of_page", "class" => "form-control", "id" => "no_of_page"]); ?>
                            <span class="error" id="no_of_pageError"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline p-2">
                            <?php echo form_label('Author: <span class="error">*</span>', 'author'); ?>
                            <?php echo form_input(["name" => "author", "class" => "form-control", "id" => "author"]); ?>
                            <span class="error" id="authorError"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-outline p-2">
                            <?php echo form_label('Category:<span class="error">*</span>', 'category'); ?>
                            <?php echo form_input(["name" => "category", "class" => "form-control", "id" => "category"]); ?>
                            <span class="error" id="categoryError"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline p-2">
                            <?php echo form_label('Price: <span class="error">*</span>', 'price'); ?>
                            <?php echo form_input(["name" => "price", "class" => "form-control", "id" => "price"]); ?>
                            <span class="error" id="priceError"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-outline p-2">
                            <?php echo form_label('Released_year: <span class="error">*</span>', 'released_year'); ?>
                            <?php echo form_input(["name" => "released_year", "class" => "form-control", "id" => "released_year"]); ?>
                            <span class="error" id="released_yearError"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-outline">
                            <div class="form-outline">
                                <?php echo form_label('status: <span class="error">*</span>', 'status', 'id="statusId"'); ?><br>
                                <div class="form-check form-check-inline">
                                    <?php echo form_radio("status", 1, set_radio('status', 1), 'id="on"'); ?>
                                    <?php echo form_label('on', 'on'); ?>
                                </div>
                                <div class="form-check form-check-inline">
                                    <?php echo form_radio("status", 0, set_radio('status', 0, true), 'id="off"'); ?>
                                    <?php echo form_label('off', 'off'); ?>
                                </div>
                                <span class="error" id="statusError"></span>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary resetBtn">Reset</button>
                    <button type="button" class="btn btn-primary addBtn" id="add">Add</button>

                    <button type="button" class="btn btn-secondary closeBtn" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success updateBtn" id="save">Update</button>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>


<script>
    
    // datatable 
    $(document).ready(function() {

        $('#myTable').dataTable({

            "bProcessing": false,
            "serverSide": true,
            "searchable": true,
            "orderable": true,
            "ajax": {
                url: "<?php echo $url; ?>",
                type: "POST"
            },
            "columns": [

                {
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "description"
                },
                {
                    "data": "no_of_page"
                },
                {
                    "data": "author"
                },
                {
                    "data": "category"
                },
                {
                    "data": "price"
                },
                {
                    "data": "released_year"
                },
                {
                    "data": "status"
                },
                {
                    "data": "action"
                },
            ],
            'columnDefs': [{
                'targets': [8, 9], // disable column for sorting
                'orderable': false, // set orderable false for selected columns
            }],
            'lengthMenu': [
                [5, 10, 25, 50],
                [5, 10, 25, 'All'],
            ],

        });

        // jquery validation
        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || /^[A-Za-z ]+$/.test(value)
        });

        // modal jquery validation
        var validator = $("#updateModal").validate({
            rules: {
                name: {
                    required: true,
                    alpha: true
                },
                desc: {
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
                    digits: true,
                    maxlength: 4,
                    minlength:4
                }
            },
            messages: {
                name: {
                    required: "Enter book name",
                    alpha: "Only alphabets allowed",
                },
                desc: {
                    required: "Enter some description about book",
                },
                no_of_page: {
                    required: "Enter no_of_page",
                    digits: "Only number allowed",
                },
                author: {
                    required: "Enter author name",
                    alpha: "Only alphabets allowed",
                },
                category: {
                    required: "Enter category name",
                    alpha: "Only alphabets allowed",
                },
                price: {
                    required: "Enter price of book",
                    number: "Only number allowed",
                },
                released_year: {
                    required: "Enter released_year of book",
                    digits: "Only number allowed",
                    maxlength: "maximum 4 length required",
                    minlength:"minmum 4 length required"
                }
            }
        });

        $('.resetBtn').click(function() {
            validator.resetForm();
        });

        $(".btn-close").click(function() {

            $("label.error").hide();
            $("#name").removeClass("error");
            $("#desc").removeClass("error");
            $("#no_of_page").removeClass("error");
            $("#author").removeClass("error");
            $("#category").removeClass("error");
            $("#price").removeClass("error");
            $("#released_year").removeClass("error");
        });

    });

    // insert modal open 
    function insertModal() {

        $('#updateModal').get(0).reset();
        $("label.error").hide();
        $("#name").removeClass("error");
        $("#desc").removeClass("error");
        $("#no_of_page").removeClass("error");
        $("#author").removeClass("error");
        $("#category").removeClass("error");
        $("#price").removeClass("error");
        $("#released_year").removeClass("error");

        $('#edit').modal('show');
        $('.formBookTitle').text('Add book');
        $('.addBtn').show();
        $('.resetBtn').show();
        $('.updateBtn').hide();
        $('.closeBtn').hide();

    }

    // insert data
    $(document).on('click', '#add', function(e) {

        e.preventDefault();
        if ($("#updateModal").valid() == true) {
            // debugger
        } else {
            return false;
        }
        var name = $('#name').val();
        var desc = $('#desc').val();
        var no_of_page = $('#no_of_page').val();
        var author = $('#author').val();
        var category = $('#category').val();
        var price = $('#price').val();
        var released_year = $('#released_year').val();
        var status = $('input[type="radio"]:checked').val();

        $.ajax({
            url: "<?php echo base_url() . 'crud_demo/display/insert' ?>",
            type: "post",
            dataType: 'json',
            data: {
                name: name,
                desc: desc,
                no_of_page: no_of_page,
                author: author,
                category: category,
                price: price,
                released_year: released_year,
                status: status
            },
            success: function(data) {

                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": 1000,
                }

                if (data.error == true) {

                    $('#nameError').html(data.nameError);
                    $('#descError').html(data.descError);
                    $('#no_of_pageError').html(data.no_of_pageError);
                    $('#authorError').html(data.authorError);
                    $('#categoryError').html(data.categoryError);
                    $('#priceError').html(data.priceError);
                    $('#released_yearError').html(data.released_yearError);

                } else {

                    $('#edit').modal('hide');
                    toastr.success(data.message);
                    $('#myTable').DataTable().ajax.reload();
                }

            }
        });
    });

    //edit data
    function editData(id) {

        $.ajax({
            url: "<?php echo base_url() . 'crud_demo/display/edit/' ?>" + id,
            type: "get",
            dataType: "json",
            success: function(data) {

                var editId = $('#editid').val(data.id);

                if (editId) {

                    $("label.error").hide();
                    $("#name").removeClass("error");
                    $("#desc").removeClass("error");
                    $("#no_of_page").removeClass("error");
                    $("#author").removeClass("error");
                    $("#category").removeClass("error");
                    $("#price").removeClass("error");
                    $("#released_year").removeClass("error");

                    $('.formBookTitle').text('Edit book');
                    $('.closeBtn').show();
                    $('.updateBtn').show();
                    $('.resetBtn').hide();
                    $('.addBtn').hide();

                    $('#name').val(data.name);
                    $('#desc').val(data.description);
                    $('#no_of_page').val(data.no_of_page);
                    $('#category').val(data.category);
                    $('#author').val(data.author);
                    $('#price').val(data.price);
                    $('#released_year').val(data.released_year);
                    if (data.status == '1') {
                        $('#on').prop('checked', true);
                    } else {
                        $('#off').prop('checked', true);
                    }
                }
                $('#edit').modal('show');
            }
        });
    }

    // update data :
    $(document).on('click', '#save', function(e) {

        e.preventDefault();
        if ($("#updateModal").valid() == true) {
            // debugger
        } else {
            return false;
        }

        var id = $('#editid').val();
        var name = $('#name').val();
        var desc = $('#desc').val();
        var no_of_page = $('#no_of_page').val();
        var author = $('#author').val();
        var category = $('#category').val();
        var price = $('#price').val();
        var released_year = $('#released_year').val();

        $.ajax({
            url: "<?php echo base_url() . 'crud_demo/display/update/' ?>" + id,
            type: "post",
            dataType: 'json',
            data: {
                id: id,
                name: name,
                desc: desc,
                no_of_page: no_of_page,
                author: author,
                category: category,
                price: price,
                released_year: released_year
            },
            success: function(data) {

                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "3000",
                }
                if (data.error == true) {

                    $('#nameError').html(data.nameError);
                    $('#descError').html(data.descError);
                    $('#no_of_pageError').html(data.no_of_pageError);
                    $('#authorError').html(data.authorError);
                    $('#categoryError').html(data.categoryError);
                    $('#priceError').html(data.priceError);
                    $('#released_yearError').html(data.released_yearError);

                } else {

                    $('#edit').modal('hide');
                    $('#updateModal')[0].reset();
                    toastr.success(data.message);
                    $('#myTable').DataTable().ajax.reload();
                }
            }
        });

    });

    //delete
    function deleteData(id) {

        swal("Are you sure you want to delete a book no = " + id, {
            dangerMode: true,
            buttons: true,
            icon: "warning",
        }).then(function(isConfirm) {

            if (isConfirm) {

                $.ajax({
                    url: "<?php echo base_url() . 'crud_demo/display/delete/' ?>" + id,
                    type: "get",
                    dataType: 'JSON',
                    success: function(data) {

                        if (data == true) {
                            toastr.options = {
                                "closeButton": true,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "timeOut": "3000",
                            }
                            toastr.error('Data Deleted Successfully');
                            $('#myTable').DataTable().ajax.reload();

                        }
                    }
                });
            }
        });
    }

    // status changed :
    function statusData(id, status) {

        let updateStatus = status == 1 ? status = 0 : status = 1;

        $.ajax({

            url: '<?php echo base_url() . 'crud_demo/display/updateStatus/' ?>' + id + '/' + updateStatus,
            type: 'post',
            dataType: 'json',
            success: function(data) {

                if (data == true) {
                    toastr.options = {
                        "closeButton": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "timeOut": "3000",
                    }
                    toastr.success('Status change successfully');
                    $('#myTable').DataTable().ajax.reload();

                }
            }
        });
    }
</script>


<?php
include(APPPATH . 'views/fronted/footer.php');

?>
