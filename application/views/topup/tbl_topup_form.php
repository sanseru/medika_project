<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_TOPUP</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        
        <tr><td width='200'>Client <?php echo form_error('client') ?></td><td><input type="text" class="form-control" name="client" id="client" placeholder="Client" value="<?php echo $client; ?>" /></td></br></tr>
	    <tr><td width='200'>Rekening <?php echo form_error('rekening') ?></td><td><input type="text" class="form-control" name="rekening" id="rekening" placeholder="Rekening" value="<?php echo $rekening; ?>" /></td></tr>
        
	    <tr><td width='200'>No Bukti <?php echo form_error('no_bukti') ?></td><td><input type="text" class="form-control" name="no_bukti" id="no_bukti" placeholder="No Bukti" value="<?php echo $no_bukti; ?>" /></td></tr>
	    <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr>
		
		
		<tr><td width='200'>Jml Topup <?php echo form_error('jml_topup') ?></td><td><input type="text" class="form-control" name="jml_topup" id="jml_topup" placeholder="Jml Topup" value="<?php echo $jml_topup; ?>" /></td></tr>
	    <!-- <tr><td width='200'>Created Date <?php echo form_error('created_date') ?></td><td><input type="text" class="form-control" name="created_date" id="created_date" placeholder="Created Date" value="<?php echo $created_date; ?>" /></td></tr>
	    <tr><td width='200'>Created By <?php echo form_error('created_by') ?></td><td><input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" /></td></tr> -->
	    
        <tr><td><input type="hidden" name="id_client" id="id_client" value="<?php echo $id_client; ?>" /> 
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('topup') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>

</div>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
        $(document).ready(function(){
 
            $('#client').autocomplete({
                source: "<?php echo site_url('topup/get_autocomplete');?>",
				minLength: 1,
                select: function (event, ui) {
                    $('[name="client"]').val(ui.item.label); 
                    $('[name="rekening"]').val(ui.item.rekening);
                    $('[name="id_client"]').val(ui.item.id_client); 
                }
				
            });
 
        });
    </script>