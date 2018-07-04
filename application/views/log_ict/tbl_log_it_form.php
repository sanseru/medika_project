<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        
		<tr><td width='200'>User <?php echo form_error('kode_kasus') ?></td><td><input type="text" class="form-control" name="kodekasus" id="kodekasus"  value="<?php echo $kodekasus ?>" /></td></tr>
	    <tr><td width='200'>User <?php echo form_error('user') ?></td><td><input type="text" class="form-control" name="user" id="user" placeholder="User" value="<?php echo $this->session->userdata('full_name',TRUE); ?>" /></td></tr>
	    <tr><td width='200'>Client <?php echo form_error('client') ?></td><td><input type="text" class="form-control" name="client" id="client" placeholder="Client" value="<?php echo $client; ?>" /></td></tr>
	    <tr><td width='200'>Nik User <?php echo form_error('nik_user') ?></td><td><input type="text" class="form-control" name="nik_user" id="nik_user" placeholder="Nik User" value="<?php echo $nik_user; ?>" /></td></tr>
	    <tr><td width='200'>Permasalahan <?php echo form_error('permasalahan') ?></td><td>
            <div class="box-body pad">
                <textarea name="permasalahan" id="permasalahan" class="textarea" placeholder="Place some text here" 
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" ><?php echo $permasalahan; ?></textarea>
            </div>
		
		</td></tr>
	    <tr><td width='200'>Resolusi <?php echo form_error('resolusi') ?></td><td><input type="text" class="form-control" name="resolusi" id="resolusi" placeholder="Resolusi" value="<?php echo $resolusi; ?>" /></td></tr>
	    <tr><td width='200'>Waktu <?php echo form_error('waktu') ?></td><td><input type="text" class="form-control" name="waktu" id="waktu" placeholder="Waktu" value="<?php date_default_timezone_set("Asia/Jakarta"); echo date(" h:i:s d/m/Y "); ?>" readonly=="" /></td></tr>
	    <tr><td width='200'>Status <?php echo form_error('status') ?></td><td>
		<?php echo form_dropdown('status', array('s' => 'SELESAI','p'=> 'PROGRES'), $status, array('class' => 'form-control')); ?>
		</td></tr>
		<tr><td></td><td>
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('log_ict') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>
