<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html>
<head>
<title>Email Form</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Sending email</h1>
<form method="post" action="mailer/send">
<input type="email" id="to" name="to" placeholder="Email">
<input type="submit" value="Send" />
</form>
</body>
</html>
