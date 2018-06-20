<div class='content-wrapper'>
        
<!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box'>
                <div class='box-header'>
                <h3 class='box-title'>Hse_sasaran_mutu_detail Read</h3>
        <table class="table table-bordered">
	    <tr><td>Id Samut</td><td><?php echo $id_samut; ?></td></tr>
	    <tr><td>Departmen</td><td><?php echo $departmen; ?></td></tr>
	    <tr><td>Pic</td><td><?php echo $pic; ?></td></tr>
	    <tr><td>Due Date</td><td><?php echo $due_date; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Goals</td><td><?php echo $goals; ?></td></tr>
	    <tr><td>Audit</td><td><?php echo $audit; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('sasaran_mutu/detail/'). $id_samut ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		</div>