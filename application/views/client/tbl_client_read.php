<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tbl_client Read</h2>
        <table class="table">
	    <tr><td>Client Name</td><td><?php echo $client_name; ?></td></tr>
	    <tr><td>Bank Name</td><td><?php echo $bank_name; ?></td></tr>
	    <tr><td>Account Name</td><td><?php echo $account_name; ?></td></tr>
	    <tr><td>Client Bank Account</td><td><?php echo $client_bank_account; ?></td></tr>
	    <tr><td>Telephone</td><td><?php echo $telephone; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Created Date</td><td><?php echo $created_date; ?></td></tr>
	    <tr><td>Created By</td><td><?php echo $created_by; ?></td></tr>
	    <tr><td>Modify Date</td><td><?php echo $modify_date; ?></td></tr>
	    <tr><td>Modify By</td><td><?php echo $modify_by; ?></td></tr>
	    <tr><td>Saldo</td><td><?php echo $saldo; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('client') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>