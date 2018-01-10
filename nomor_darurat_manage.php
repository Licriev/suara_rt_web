<h3><i class="fa fa-angle-right"></i> Management Kota</h3>

<div class="alert-div" style="display: none;">
	<div class="alert alert-danger alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	  <strong>Gagal menambah data!</strong> Lengkapi data yang sudah ditandai untuk menambahkan data
	</div>
</div>

<div class="row mt">
	<div class="col-lg-12">
		<div class="showback">
			<h4><i class="fa fa-angle-right"></i> Data Nomor Darurat Baru</h4>
			<form class="form-horizontal" role="form" id="form_data">
				<div class="form-group">
					<label class="control-label col-sm-2">Nama Kontak *</label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="nama_kontak" placeholder="Nama Kontak" required>
					</div>
				</div>

				<input type="hidden" id="id_emergency" value="0">

				<div class="form-group">
					<label class="control-label col-sm-2">Telp *</label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="nomor_telp" placeholder="Nomor Telepon / HP" required>
					</div>
				</div>

				<?php if($_SESSION['role_usr'] == 1){ ?>
					<?php 

						$query = "SELECT a.*,b.nama_housing FROM srt_group a LEFT JOIN srt_housing b ON a.id_housing=b.id_housing ORDER BY b.nama_housing ASC";
						$sql = mysqli_query($connect,$query);

					?>

					<div class="form-group">
						<label class="control-label col-sm-2" >Group Housing</label>
						<div class="col-md-10">
							<select class="form-control select2" id="group_user">
								<option value="" selected disabled>-Pilih Group Housing-</option>
								<?php while($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
									<option value="<?php echo $data['id_group'];?>"> <?php echo $data['nama_housing'] . " (RT. ". $data['rt']. "/RW. ". $data['rw'] .")";?> </option>
								<?php } ?>
							</select>
						</div>
					</div>
				<?php }else{ ?>
					<input type="hidden" id="group_user" value="<?php echo $_SESSION['id_group_usr'];?>">
				<?php } ?>
				
				
				<div class="form-group">
					<div class="col-md-10 col-md-offset-2">
						<button type="button" class="btn btn-theme" id="ins-btn" onclick="saveData();">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row mt">
	<div class="col-lg-12">
		<div class="showback">
			<h4>
				<i class="fa fa-angle-right"></i> Data Nomor Darurat  
				<button type="button"  class="btn btn-xs btn-round btn-danger pull-right" id="deleteData" data-toggle="confirmation" data-singleton="true"><i class="fa fa-trash-o"></i> Hapus Data</button>
			</h4>
			<table class="table table-striped table-bordered" id="table-data">
				<thead>
					<tr>
						<th width="5%"></th>
						<th>Nama Kontak</th>
						<th>Telp</th>
						<th>Option</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Ubah Data</h4>
			</div>
			<div class="modal-body">
				
				<form class="form-horizontal" role="form" id="form_data_edit">
					<div class="form-group">
						<label class="control-label col-sm-3">Nama Kontak *</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="nama_kontak_edit" placeholder="Nama Kontak" required>
						</div>
					</div>

					<input type="hidden" id="id_emergency_edit">

					<div class="form-group">
						<label class="control-label col-sm-3">Telp *</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="nomor_telp_edit" placeholder="Nomor Telepon / HP" required>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<button type="button" class="btn btn-theme" id="ins-btn" onclick="editData();">Submit</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	var tbl;
	var notif;
	var group = 0;
	
	jQuery(document).ready(function($) {
		
		<?php if($_SESSION['role_usr']!=1){?>
			group = "<?php echo $_SESSION['id_group_usr'];?>";
		<?php } ?>

		tbl= $('#table-data').DataTable( {
			bJQueryUI: true,
			sPaginationType: "full_numbers",
		    "ajax" : "nomor_darurat_process.php?action=get&group="+group,
		    select: {
		        style: 'multi+shift',
		    },
		    columnDefs: [                
		        {
		            "orderable": false,
		            "className": 'select-checkbox',
		            "targets": 0,
		            "data":null,
		            "defaultContent": ""
		        },
		        {
		            "data":"nama_kontak",
		            "targets": 1
		        },
		        {
		            "data":"telp",
		            "targets": 2
		        },
		        {
		            "data":null,
		            "width" : '5%',
		            "targets": 3,
		            "render":function(data, type, full, meta ){
		            	return '<center><button class="btn btn-info btn-xs edit-btn" title="edit data"><i class="fa fa-edit"></i></button></center>';
		            }
		        },
		    ],
		    select: {
		        style:    'os',
		        selector: 'td:first-child'
		    },
		    order: [[ 1, 'asc' ]]
		});

	    

	    $('#deleteData').click( function(){
            /* get selected row count and its data */
            var count = tbl.rows('.selected').data().length;
            var item = tbl.rows('.selected').data();
            var delcount=0;

            /* perform deletion */
            if(count > 0){ /* if has selected count >= 1 */
            	
            	$.confirm({
            		theme: 'bootstrap',
            	    title: 'Hapus Data',
            	    content: 'Hapus '+ count +' yang telah dipilih?',
            	    icon: 'fa fa-warning',
            	    buttons: {
            	        confirm: function () {
            	            for (var i = 0; i <= count - 1; i++) {
                                var did=item[i]['id_emergency'];
                                $.post( 'nomor_darurat_process.php?action=del&id=' + did).success(function(data){
                                	var result = jQuery.parseJSON(data);

                                	tbl.ajax.reload(); 
                                });


                            };

        	            	$.gritter.add({
        		                // (string | mandatory) the heading of the notification
        		                title: 'Hapus Data',
        		                sticky: false,
        	                    time: '5000',
        	                    text: count +' data berhasil di hapus!',
        		            });
                            
                        	
            	        },
            	        cancel: function () {
            	            
            	        },
            	    }
            	});

            	
               
            }else{

            	$.alert({
            		theme: 'bootstrap',
            	    title: 'Hapus Data',
            	    icon: 'fa fa-warning',
            	    content: 'Tidak ada data yang terpilih untuk dihapus!',
            	});            
            }
        });

        $('#table-data tbody').on('click', '.edit-btn', function () {
	        $('#edit-modal').modal();
	        $('#id_emergency_edit').val(tbl.row($(this).parents('tr')).data().id_emergency);
	        $('#nama_kontak_edit').val(tbl.row($(this).parents('tr')).data().nama_kontak);
	        $('#nomor_telp_edit').val(tbl.row($(this).parents('tr')).data().telp);
	    }); 
	    
	  
	    	

	});



	function saveData(){

		if($('#nama_kontak').val()=='' || $('#nomor_telp').val()=='' || $('#group_user').val() <= 0){
			$('.alert-div').fadeIn('slow');
		}else{
			$.ajax({
			    url: 'nomor_darurat_process.php',
			    type: 'POST',
			    data: {
			        nama_kontak: $('#nama_kontak').val(),
			        telp:$('#nomor_telp').val(),
			        id_emergency : $('#id_emergency').val(),
			        id_group:$('#group_user').val(),
			        action:'add'
			    },
			    success: function(data){
			    	var result = jQuery.parseJSON(data);
			        document.getElementById("form_data").reset();		        
			      	
			        tbl.ajax.reload();

			        $.gritter.add({
		                // (string | mandatory) the heading of the notification
		                title: 'Tambah Data',
		                sticky: false,
	                    time: '5000',
	                    text: result.msg,
		            });
			    }
			});
		}
	}

	function editData(){
		$.ajax({
		    url: 'nomor_darurat_process.php',
		    type: 'POST',
		    data: {
		        nama_kontak: $('#nama_kontak_edit').val(),
		        telp:$('#nomor_telp_edit').val(),
		        id_emergency : $('#id_emergency_edit').val(),
		        id_group:"0",
		        action:'add'
		    },
		    success: function(data){

		    	var result = jQuery.parseJSON(data);

		        document.getElementById("form_data_edit").reset();
		      
		        tbl.ajax.reload();
		        $('#edit-modal').modal('toggle');

		        $.gritter.add({
	                // (string | mandatory) the heading of the notification
	                title: 'Ubah Data',
	                sticky: false,
                    time: '5000',
                    text: result.msg,
	            });
		    }
		});
	}
</script>