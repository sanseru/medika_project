<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA M_DIVISION_HSE</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nm Divisi <?php echo form_error('nm_divisi') ?></td><td><input type="text" class="form-control" name="nm_divisi" id="nm_divisi" placeholder="Nm Divisi" value="<?php echo $nm_divisi; ?>" /></td></tr>
	    <tr><td width='200'>Pic <?php echo form_error('pic') ?></td><td><input type="text" class="form-control" name="pic" id="pic" placeholder="Pic" value="<?php echo $pic; ?>" /></td></tr>
	    <tr><td width='200'>Created Date <?php echo form_error('created_date') ?></td><td><input type="text" class="form-control" name="created_date" id="created_date" placeholder="Created Date" value="<?php echo $created_date; ?>" /></td></tr>
	    <tr><td width='200'>Created By <?php echo form_error('created_by') ?></td><td><input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" /></td></tr>
	    <tr><td width='200'>Modify Date <?php echo form_error('modify_date') ?></td><td><input type="text" class="form-control" name="modify_date" id="modify_date" placeholder="Modify Date" value="<?php echo $modify_date; ?>" /></td></tr>
	    <tr><td width='200'>Modify By <?php echo form_error('modify_by') ?></td><td><input type="text" class="form-control" name="modify_by" id="modify_by" placeholder="Modify By" value="<?php echo $modify_by; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('m_division_hse') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>