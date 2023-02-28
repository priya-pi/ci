<?php

defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'views/fronted/header.php';
?>
<div class="container">
    <h2>Members List</h2>
	
    <?php if (!empty($success_msg)) { ?>
    <div class="col-xs-12">
        <div class="alert alert-success"><?php echo $success_msg; ?></div>
    </div>
	<?php } ?>
    <?php if (!empty($error_msg)) { ?>
    <div class="col-xs-12">
        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
    </div>
    <?php } ?>
	

    <div class="row">
        <div class="col-md-12 head">
            <div class="float-right">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
            </div>
		<a href='<?= base_url() .
     'export/csv_export' ?>' class="btn btn-primary"><i class="fa fa-download"></i>Export To csv</a>
   <a href="<?php echo site_url() .
       'export/excel_export'; ?>" class="btn btn-warning"><i class="fa fa-download"></i>Export to Excel</a>
        </div>
		
        <div class="col-md-12" id="importFrm" style="display: none;">
            <form action="<?php echo base_url() .
                'import/csv_import'; ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="import to csv">
            </form>

			<form action="<?php echo base_url() .
       'import/excel_import'; ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="file" />
                <input type="submit" class="btn btn-warning" name="importSubmit" value="import to excel">
            </form>

			<?php if ($this->session->flashdata('error')) { ?>
			<p><?= $this->session->flashdata('error') ?></p>
			<?php } ?>

			<?php if ($this->session->flashdata('success')) { ?>
			<p><?= $this->session->flashdata('success') ?></p>
			<?php } ?>
        </div>
        
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>firstname</th>
                    <th>lastname</th>
                    <th>email</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($members)) {
                    foreach ($members as $row) { ?>
                <tr>
                    <td><?php echo $row['customer_id']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
                <?php }
                } else {
                     ?>
                <tr><td colspan="5">No member(s) found...</td></tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>
</div>


<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
</body>
</html>





