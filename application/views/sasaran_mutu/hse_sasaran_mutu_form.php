
<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA HSE_SASARAN_MUTU</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
		<table class='table table-bordered>'        
	    <tr><td width='200'>Periode <?php echo form_error('periode') ?></td><td><input type="text" class="form-control" name="periode" id="periode" placeholder="Periode" value="<?php echo $periode; ?>" /></td></tr>

        <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td></tr>
	    <tr><td width='200'>Due Date <?php echo form_error('due_date') ?></td><td><input type="text" class="form-control" name="due_date" id="due_date" placeholder="Due Date" value="<?php echo $due_date; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('sasaran_mutu') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>
