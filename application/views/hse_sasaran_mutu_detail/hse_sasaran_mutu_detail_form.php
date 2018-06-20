<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA HSE_SASARAN_MUTU_DETAIL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td></td><td><input type="hidden" name="id_samut" id="id_samut" value="<?php echo $id_samut; ?>" /></td></tr>
	    <tr><td width='200'>Departmen <?php echo form_error('departmen') ?></td><td><input type="text" class="form-control" name="departmen" id="departmen" placeholder="Departmen" value="<?php echo $departmen; ?>" /></td></tr>
	    <tr><td width='200'>Pic <?php echo form_error('pic') ?></td><td><input type="text" class="form-control" name="pic" id="pic" placeholder="Pic" value="<?php echo $pic; ?>" /></td></tr>
	    <tr><td width='200'>Due Date <?php echo form_error('due_date') ?></td><td><input type="text" class="form-control" name="due_date" id="due_date" placeholder="Due Date" value="<?php echo $due_date; ?>" /></td></tr>
	    <tr><td width='200'>Status <?php echo form_error('status') ?></td><td>
	    	<?php echo form_dropdown('status', array('DICIPLINE' => 'DICIPLINE', 'UNDICIPLINE' => 'UNDICIPLINE'), $status, array('class' => 'form-control')); ?>
	    	<!-- <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" /> -->
	    </td></tr>
	    <tr><td width='200'>Goals <?php echo form_error('goals') ?></td><td><input type="text" class="form-control" name="goals" id="goals" placeholder="Goals" value="<?php echo $goals; ?>" /></td></tr>
	    <tr><td width='200'>Audit <?php echo form_error('audit') ?></td><td><input type="text" class="form-control" name="audit" id="audit" placeholder="Audit" value="<?php echo $audit; ?>" /></td></tr>
	    
        <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('sasaran_mutu/detail/'. $id_samut) ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
        $(document).ready(function(){
 
            $('#departmen').autocomplete({
                source: "<?php echo site_url('Hse_sasaran_mutu_detail/get_autocomplete');?>",
				minLength: 1,
                select: function (event, ui) {
                    $('[name="client"]').val(ui.item.label); 
                    $('[name="pic"]').val(ui.item.pic);
                    // $('[name="id_client"]').val(ui.item.id_client);
                    // $('[name="nama_rekening"]').val(ui.item.bank_name); 
					 
                }
				
            });
 
        });
    </script>