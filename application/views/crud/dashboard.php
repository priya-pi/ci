<?php

include APPPATH . 'views/fronted/header.php';

$url = base_url() . 'crud_demo/dashboard';
// echo insert;

?>

<!-- all book data show -->
<div class="container-fluid back mt-5">
    <div class="mt-5 p-3 mb-5">
        <div class="container w-50">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <h3 class="text-center p-3 theme">userBook Details</h3>

        <div class="row mb-2">
            <div class="col-md-8">

                <?php echo anchor('crud_demo/logout', 'Logout', 'class="btn btn-danger"'); ?>
                <?php echo anchor('crud_demo/book/store', 'ADD', 'class="btn btn-success"'); ?>
                <a href="<?php echo base_url() . 'crud_demo/display' ?>" class="btn btn-primary">ServerSide</a>
                <a href="<?php echo base_url() . 'crud_demo/book/changePass' ?>" class="btn btn-info">Change Password</a>

            </div>
            <div class="col-md-4">

                <form class="d-flex" action="<?php echo base_url() . 'crud_demo/dashboard' ?>" method="get">
                    <input class="form-control me-2" type="search" name="search" id="search" placeholder="Search" value="<?php echo $search; ?>">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>

        </div>

        <label>show
            <select class="btn btn-light dropdown-toggle" onchange="selectId(this)" id="length">
                <option value="5" <?php if ($limit == 5) {echo "selected";}?>>5</option>
                <option value="10" <?php if ($limit == 10) {echo "selected";}?>>10</option>
                <option value="20" <?php if ($limit == 20) {echo "selected";}?>>20</option>
                <option value="50" <?php if ($limit == 50) {echo "selected";}?>>50</option>
            </select>
        </label>

        <table class="table table-light" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th>
                        <a href="<?php echo $url; ?>?column=id&order=<?php echo $asc_or_desc; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                            book_id
                            <i class="fas fa-sort<?php echo $column == 'id' ? '-' . $up_or_down : ''; ?>  ps-1"></i>
                        </a>
                    </th>

                    <th> <a href="<?php echo $url; ?>?column=name&order=<?php echo $asc_or_desc; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                            name
                            <i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>  ps-1"></i>
                        </a>
                    </th>

                    <th> <a href="<?php echo $url; ?>?column=description&order=<?php echo $asc_or_desc; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                            description
                            <i class="fas fa-sort<?php echo $column == 'description' ? '-' . $up_or_down : ''; ?>  ps-1"></i>
                        </a>
                    </th>

                    <th>
                        <a href="<?php echo $url; ?>?column=no_of_page&order=<?php echo $asc_or_desc; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                            no_of_page
                            <i class="fas fa-sort<?php echo $column == 'no_of_page' ? '-' . $up_or_down : ''; ?>  ps-1"></i>
                        </a>
                    </th>

                    <th>
                        <a href="<?php echo $url; ?>?column=author&order=<?php echo $asc_or_desc; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                            author
                            <i class="fas fa-sort<?php echo $column == 'author' ? '-' . $up_or_down : ''; ?>  ps-1"></i>
                        </a>
                    </th>

                    <th>
                        <a href="<?php echo $url; ?>?column=category&order=<?php echo $asc_or_desc; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                            category
                            <i class="fas fa-sort<?php echo $column == 'category' ? '-' . $up_or_down : ''; ?>  ps-1"></i>
                        </a>
                    </th>

                    <th>
                        <a href="<?php echo $url; ?>?column=price&order=<?php echo $asc_or_desc; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                            price
                            <i class="fas fa-sort<?php echo $column == 'price' ? '-' . $up_or_down : ''; ?>  ps-1"></i>
                        </a>
                    </th>

                    <th>
                        <a href="<?php echo $url; ?>?column=released_year&order=<?php echo $asc_or_desc; ?>&search=<?php echo $search; ?>&limit=<?php echo $limit; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                            released_year
                            <i class="fas fa-sort<?php echo $column == 'released_year' ? '-' . $up_or_down : ''; ?>  ps-1"></i>
                        </a>
                    </th>

                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                        if ($this->session->userdata('user_id') == null) {
                            //    echo '<script>alert("first add book")</script>';
                        } else {

                        if (!empty($data)) {
                        foreach ($data as $item) {?>

                        <tr>
                            <td><?php echo $item->id; ?></td>
                            <td><?php echo $item->name; ?></td>
                            <td><?php echo $item->description; ?></td>
                            <td><?php echo $item->no_of_page; ?></td>
                            <td><?php echo $item->author; ?></td>
                            <td><?php echo $item->category; ?></td>
                            <td><?php echo $item->price; ?></td>
                            <td><?php echo $item->released_year; ?></td>
                            <td>
                                <div class="form-switch">
                                    <input type="checkbox" class="form-check-input" name="status" id="<?php echo $item->id ?>" value="<?php echo $item->status ?>" <?php echo $item->status == '1' ? 'checked' : ''; ?> />
                                </div>
                            </td>
                            <td>
                                <a onclick='deleteData("<?php echo $item->id; ?>")'><i class="fa-solid fa-trash-can"></i></a>
                                <a onclick='editData("<?php echo $item->id; ?>")'><i class="fa-solid fa-pen"></i></a>
                            </td>
                        </tr>

                <?php }}}?>

            </tbody>
        </table>
            <?php

                if ($this->session->userdata('user_id') == null) {
                    // not show data

                } else {if (!empty($data)) {?>

                <div class="row">
                    <div id="pageLink" class="col-md-12 text-center">
                        <?php echo $links; ?>
                    </div>
                </div>

            <?php }}?>

    </div>
</div>

<!-- update modal -->
<div class="modal" tabindex="-1" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <?php echo form_open('action="#"', 'id="updateModal"', 'method="post"', 'validate'); ?>

                <input type="hidden" id="editid" name="id" value="">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline p-2">
                            <?php echo form_label('Bookname: <span class="error" >*</span>', 'name'); ?>
                            <?php echo form_input(["name" => "name", "class" => "form-control", "id" => "name"]); ?>
                            <span class="error" id="nameError"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-outline p-2">
                            <?php echo form_label('Description: <span class="error">*</span>', 'description'); ?>
                            <?php echo form_input(["name" => "desc", "class" => "form-control", "id" => "description"]); ?>
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
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="save">Update</button>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>


<script>
    
    //show data with dropdownlist
    function selectId(value) {

        var value = $(value).val();
        var origin = window.location.href;
        var url = '';
        if (value) {

            url = '?length=' + value;
        }
        location.href = "<?php echo base_url('crud_demo/dashboard') ?>" + url  + '&search=' + $('#search').val();
    }

    // pagination
    $('#pageLink a').each(function() {

        var href = $(this).attr('href');
        href += '?length=' + $('#length').val() + '&search=' + $('#search').val();
        $(this).attr('href', href);

    });

    // delete
    function deleteData(id) {

        swal("Are you sure you want to delete a book no: " + id, {
            dangerMode: true,
            buttons: true,
            icon: "warning",
        }).then(function(isConfirm) {

            if (isConfirm) {

                $.ajax({
                    url: "<?php echo base_url() . 'crud_demo/book/delete/' ?>" + id,
                    type: "get",
                    dataType: 'json',

                    success: function(data) {

                        if (data == true) {

                            location.reload();
                        }
                    }
                });
            }
        });
    }

    //edit
    function editData(id) {

        $.ajax({
            url: "<?php echo base_url() . 'crud_demo/book/edit/' ?>" + id,
            type: "get",
            dataType: "json",
            success: function(data) {

                console.log(data);
                $('#editid').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#no_of_page').val(data.no_of_page);
                $('#category').val(data.category);
                $('#author').val(data.author);
                $('#price').val(data.price);
                $('#released_year').val(data.released_year);

                $('#edit').modal('show');

            }
        });
    }

    // update
    $(document).on('click', '#save', function() {

        if ($("#updateModal").valid() == true) {
            // true
        } else {
            return false;
        }

        var id = $('#editid').val();
        var name = $('#name').val();
        var desc = $('#description').val();
        var no_of_page = $('#no_of_page').val();
        var author = $('#author').val();
        var category = $('#category').val();
        var price = $('#price').val();
        var released_year = $('#released_year').val();

        $.ajax({

            url: "<?php echo base_url() . 'crud_demo/book/update/' ?>" + id,
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

                if (data.error == true) {
                    $('#nameError').html(data.nameError);
                    $('#descError').html(data.descError);
                    $('#no_of_pageError').html(data.no_of_pageError);
                    $('#authorError').html(data.authorError);
                    $('#categoryError').html(data.categoryError);
                    $('#priceError').html(data.priceError);
                    $('#released_yearError').html(data.released_yearError);

                } else {

                    // $('#edit').modal('hide');
                    location.reload();
                }
            }
        });
        return false;

    });

    // status column
    $('input[name=status]').click(function() {

        var id = $(this).attr('id');
        var status = $(this).val();

        let updateStatus = status == 1 ? status = 0 : status = 1;

        $.ajax({
            url: '<?php echo base_url() . 'crud_demo/book/updatestatus/' ?>' + id + '/' + updateStatus,
            type: 'post',
            dataType: 'json',
            success: function(data) {

                if (data == true) {
                    location.reload();
                }
            }
        });
    });

    
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
    }

    <?php if ($this->session->flashdata('success')) {?>
        toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } else if ($this->session->flashdata('delete')) {?>
        toastr.error("<?php echo $this->session->flashdata('delete'); ?>");
    <?php }?>


    $(document).ready(function() {

        // jquery validation for update modal
        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || /^[A-Za-z ]+$/.test(value)
        });

        $("#updateModal").validate({
            errorElement: 'label',
            errorClass: 'jquery-error',
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
                    required: "enter some description about book",
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
                    required: "Enter Released_year of book",
                    digits: "Only number allowed",
                    maxlength: "Maxmum 4 length required",
                    minlength:"minmum 4 length required"
                },
            },
        });

    });

</script>

<?php
include APPPATH . 'views/fronted/footer.php';

?>
