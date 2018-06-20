<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA HSE_SASARAN_MUTU_DETAIL</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('hse_sasaran_mutu_detail/create/'.$id), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('hse_sasaran_mutu_detail/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?></div>
            <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Id Samut</th>
		    <th>Departmen</th>
		    <th>Pic</th>
		    <th>Due Date</th>
		    <th>Status</th>
            <th>Last_update</th>
		    <th>Goals</th>
		    <th>Audit</th>
		    <th>Keterangan</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
	    <tbody>
         <?php
         $no = 1;
         foreach ($all as $row) {
            
         ?>   
         <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row->departmen; ?></td>
            <td><?php echo $row->pic; ?></td>
            <td><?php echo $row->pic; ?></td>
            <td><?php echo $row->due_date; ?></td>
            <td><?php echo $row->status; ?></td>
            <td><?php echo $row->modify_date; ?></td>
            <td><?php echo $row->goals; ?></td>
            <td><?php echo $row->audit; ?></td>
            <td><?php echo $row->keterangan;?></td>
            
            <td style="width:100px">
            <a class="btn btn-info btn-xs" href="<?php echo site_url('hse_sasaran_mutu_detail/read/'.$row->id);?>"><i class="fa fa-eye"></i>View</a>
            <a class="btn btn-info btn-xs" href="<?php echo site_url('hse_sasaran_mutu_detail/update/'.$row->id);?>"><i class="fa fa-pencil"></i> Edit</a>
            <a class="btn btn-danger btn-xs" href="<?php echo site_url('hse_sasaran_mutu_detail/delete/'.$row->id);?>"
                onclick="return confirm('Anda yakin akan menghapus data ?')"> <i class="fa fa-trash"></i> Hapus</a>
            </td>
         </tr>
         <?php
         }
         ?>   
        </tbody>
        </table>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>

        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
       