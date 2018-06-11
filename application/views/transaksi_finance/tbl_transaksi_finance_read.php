<div class='content-wrapper'>
        
<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                <h3 class='box-title'>Tbl_transaksi_finance Read</h3>
        <table class="table table-bordered">
	    <tr><td>Client</td><td><?php echo $client; ?></td></tr>
	    <tr><td>Id Client</td><td><?php echo $id_client; ?></td></tr>
	    <tr><td>Nama Rekening</td><td><?php echo $nama_rekening; ?></td></tr>
	    <tr><td>Rekening</td><td><?php echo $rekening; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>No Bukti</td><td><?php echo $no_bukti; ?></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
	    <tr><td>Created By</td><td><?php echo $created_by; ?></td></tr>
	    <tr><td>Created Date</td><td><?php echo $created_date; ?></td></tr>
	    <tr><td>Upload</td><td><a href="<?php echo base_url() ?>assets/foto_profil/<?php echo $upload ?>" class="btn btn-primary">Download</a> <?php echo $upload; ?></tr>
	    <tr><td></td><td><a href="<?php echo site_url('transaksi_finance') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		</div>