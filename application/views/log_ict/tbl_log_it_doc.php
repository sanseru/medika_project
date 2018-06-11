<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Tbl_log_it List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>User</th>
		<th>Id User</th>
		<th>Client</th>
		<th>Nik User</th>
		<th>Permasalahan</th>
		<th>Resolusi</th>
		<th>Waktu</th>
		<th>Created Date</th>
		<th>Status</th>
		<th>Created By</th>
		<th>Modify Date</th>
		<th>Modify By</th>
		
            </tr><?php
            foreach ($log_ict_data as $log_ict)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $log_ict->user ?></td>
		      <td><?php echo $log_ict->id_user ?></td>
		      <td><?php echo $log_ict->client ?></td>
		      <td><?php echo $log_ict->nik_user ?></td>
		      <td><?php echo $log_ict->permasalahan ?></td>
		      <td><?php echo $log_ict->resolusi ?></td>
		      <td><?php echo $log_ict->waktu ?></td>
		      <td><?php echo $log_ict->created_date ?></td>
		      <td><?php echo $log_ict->status ?></td>
		      <td><?php echo $log_ict->created_by ?></td>
		      <td><?php echo $log_ict->modify_date ?></td>
		      <td><?php echo $log_ict->modify_by ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>