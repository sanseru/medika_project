<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_TRANSAKSI_FINANCE</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Client <?php echo form_error('client') ?></td><td><input type="text" class="form-control" name="client" id="client" placeholder="Client" value="<?php echo $client; ?>" /></td></tr>
	    <tr><td width='200'>Nama Rekening <?php echo form_error('nama_rekening') ?></td><td><input type="text" class="form-control" name="nama_rekening" id="nama_rekening" placeholder="Nama Rekening" value="<?php echo $nama_rekening; ?>" /></td></tr>
	    <tr><td width='200'>Rekening <?php echo form_error('rekening') ?></td><td><input type="text" class="form-control" name="rekening" id="rekening" placeholder="Rekening" value="<?php echo $rekening; ?>" /></td></tr>
	    <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr>
	    <tr><td width='200'>No Bukti <?php echo form_error('no_bukti') ?></td><td><input type="text" class="form-control" name="no_bukti" id="no_bukti" placeholder="No Bukti" value="<?php echo $no_bukti; ?>" /></td></tr>
	    <tr><td width='200'>Jumlah <?php echo form_error('jumlah') ?></td><td><input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" /></td></tr>
	    <tr><td width='200'>Upload <?php echo form_error('upload') ?></td><td><input type="file"  name="upload" id="upload" placeholder="Upload" value="<?php echo $upload; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="id_client" id="id_client" value="<?php echo $id_client; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('transaksi_finance') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
        $(document).ready(function(){
 
            $('#client').autocomplete({
                source: "<?php echo site_url('Transaksi_finance/get_autocomplete');?>",
				minLength: 1,
                select: function (event, ui) {
                    $('[name="client"]').val(ui.item.label); 
                    $('[name="rekening"]').val(ui.item.rekening);
                    $('[name="id_client"]').val(ui.item.id_client);
                    $('[name="nama_rekening"]').val(ui.item.bank_name); 
					 
                }
				
            });
 
        });
    </script>