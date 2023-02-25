<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH . 'views/fronted/header.php');
?>
<!DOCTYPE html>
<html lang="en">
 <head> 
   <meta charset="utf-8"> 
   <title>Export MySQL data to CSV file in CodeIgniter 3</title>
 </head>
 <body>
   <!-- Export Data --> 
   <a href='<?= base_url() . 'customer/csv_import' ?>' class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i>Import</a>
   <a href='<?= base_url() . 'customer/csv_export' ?>' class="btn btn-primary"><i class="fa fa-download"></i>Export</a><br><br>

   <!-- User Records --> 
   <table border='1' style='border-collapse: collapse;'> 
     <thead> 
      <tr> 
       <th>id</th> 
       <th>firstname</th> 
       <th>lastname</th> 
      </tr> 
     </thead> 
     <tbody> 
     <?php
     foreach($usersData as $key=>$val){ 
       echo "<tr>"; 
       echo "<td>".$val['customer_id']."</td>"; 
       echo "<td>".$val['firstname']."</td>"; 
       echo "<td>".$val['lastname']."</td>"; 
       echo "</tr>"; 
      } 
      ?> 
     </tbody> 
    </table>
  </body>
</html>
