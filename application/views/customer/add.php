<?php

defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'views/fronted/header.php';
?>

<!DOCTYPE html>
<html lang="en">
 <head> 
   <meta charset="utf-8"> 
   <title>Export MySQL data to CSV file in CodeIgniter 3</title>
 </head>
 <body>
   <!-- Export Data --> 
   <a href='<?= base_url() .
       'export/csv_export' ?>' class="btn btn-primary"><i class="fa fa-download"></i>Export To csv</a>
   <a href="<?php echo site_url() .
      'export/excel_export'; ?>" class="btn btn-warning"><i class="fa fa-download"></i>Export to Excel</a>

	<br><br>
	
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
                <?php if (!empty($usersData)) {
                    foreach ($usersData as $key => $val) { ?>
                <tr>
                    <td><?php echo $val['customer_id']; ?></td>
                    <td><?php echo $val['firstname']; ?></td>
                    <td><?php echo $val['lastname']; ?></td>
                    <td><?php echo $val['email']; ?></td>
                </tr>
                <?php }
                } else {
                     ?>
                <tr><td colspan="5">No member(s) found...</td></tr>
                <?php
                } ?>
            </tbody>
        </table>
  </body>
</html>
