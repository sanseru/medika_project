<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_CLIENT</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Client Name <?php echo form_error('client_name') ?></td><td><input type="text" class="form-control" name="client_name" id="client_name" placeholder="Client Name" value="<?php echo $client_name; ?>" /></td></tr>
	    <tr><td width='200'>Bank Name <?php echo form_error('bank_name') ?></td><td><input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" value="<?php echo $bank_name; ?>" /></td></tr>
	    <tr><td width='200'>Account Name <?php echo form_error('account_name') ?></td><td><input type="text" class="form-control" name="account_name" id="account_name" placeholder="Account Name" value="<?php echo $account_name; ?>" /></td></tr>
	    <tr><td width='200'>Client Bank Account <?php echo form_error('client_bank_account') ?></td><td><input type="text" class="form-control" name="client_bank_account" id="client_bank_account" placeholder="Client Bank Account" value="<?php echo $client_bank_account; ?>" /></td></tr>
	    <tr><td width='200'>Telephone <?php echo form_error('telephone') ?></td><td><input type="text" class="form-control" name="telephone" id="telephone" placeholder="Telephone" value="<?php echo $telephone; ?>" /></td></tr>
		<tr><td width='200'>Email <?php echo form_error('email') ?></td><td><input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" /></td></tr>
		<tr><td width='200'>Saldo <?php echo form_error('saldo') ?></td><td><input type="text" class="form-control" name="saldo" id="saldo" placeholder="Saldo" value="<?php echo $saldo; ?>" /></td></tr>
	    <!-- <tr><td width='200'>Created Date <?php echo form_error('created_date') ?></td><td><input type="text" class="form-control" name="created_date" id="created_date" placeholder="Created Date" value="<?php echo $created_date; ?>" /></td></tr>
	    <tr><td width='200'>Created By <?php echo form_error('created_by') ?></td><td><input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" /></td></tr>
	    <tr><td width='200'>Modify Date <?php echo form_error('modify_date') ?></td><td><input type="text" class="form-control" name="modify_date" id="modify_date" placeholder="Modify Date" value="<?php echo $modify_date; ?>" /></td></tr>
	    <tr><td width='200'>Modify By <?php echo form_error('modify_by') ?></td><td><input type="text" class="form-control" name="modify_by" id="modify_by" placeholder="Modify By" value="<?php echo $modify_by; ?>" /></td></tr> -->
	    <tr><td></td><td><input type="hidden" name="id_client" value="<?php echo $id_client; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('client') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>