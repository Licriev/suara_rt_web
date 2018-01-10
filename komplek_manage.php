<h3><i class="fa fa-angle-right"></i> Management Housing</h3>

<div class="alert-div" style="display: none;">
	<div class="alert alert-danger alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	  <strong>Gagal menambah data!</strong> Lengkapi data yang sudah ditandai untuk menambahkan data
	</div>
</div>

<div class="row mt">
	<div class="col-lg-12">
		<div class="showback">
			<h4><i class="fa fa-angle-right"></i> Data Housing Baru</h4>
			<form class="form-horizontal" role="form" id="form_data">
				<div class="form-group">
					<label class="control-label col-sm-2">Nama Housing *</label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="nama_housing" placeholder="Nama Komplek / Kampung / Perumahan" required>
					</div>
				</div>

				<?php 

					$query = "SELECT * FROM srt_kota WHERE id_kota>1 ORDER BY nama_kota ASC";
					$sql = mysqli_query($connect,$query);

				?>
				<div class="form-group">
					<label class="control-label col-sm-2" >Kota</label>
					<div class="col-md-10">
						<select class="form-control select2" id="kota">
							<option value="" selected disabled>-Pilih Kota-</option>
							<?php while($data_kota = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
								<option value="<?php echo $data_kota['id_kota'];?>"> <?php echo $data_kota['nama_kota'];?> </option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Kelurahan</label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="kelurahan" placeholder="Kelurahan" >
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Kecamatan</label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="kecamatan" placeholder="Kecamatan" >
					</div>
				</div>

				<input type="hidden" id="id_housing" value="0">
				
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
				<i class="fa fa-angle-right"></i> Data Housing  
				<button type="button"  class="btn btn-xs btn-round btn-danger pull-right" id="deleteData" data-toggle="confirmation" data-singleton="true"><i class="fa fa-trash-o"></i> Hapus Data</button>
			</h4>
			<table class="table table-striped table-bordered" id="table-data">
				<thead>
					<tr>
						<th></th>
						<th>Nama Housing</th>
						<th>Kota</th>
						<th>Kelurahan</th>
						<th>Kecamatan</th>
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
						<label class="control-label col-sm-3">Nama Housing</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="nama_housing_edit" placeholder="Nama Komplek / Kampung / Perumahan" >
						</div>
					</div>

					<?php 

						$query = "SELECT * FROM srt_kota WHERE id_kota>1 ORDER BY nama_kota ASC";
						$sql = mysqli_query($connect,$query);

					?>
					<div class="form-group">
						<label class="control-label col-sm-3" >Kota</label>
						<div class="col-md-9">
							<select class="form-control select2" id="kota_edit" style="width: 100%">
								<option value="" selected disabled>-Pilih Kota-</option>
								<?php while($data_kota = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
									<option value="<?php echo $data_kota['id_kota'];?>"> <?php echo $data_kota['nama_kota'];?> </option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Kelurahan</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="kelurahan_edit" placeholder="Kelurahan" >
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Kecamatan</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="kecamatan_edit" placeholder="Kecamatan" >
						</div>
					</div>

					<input type="hidden" id="id_housing_edit">
					
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
	
	jQuery(document).ready(function($) {
	

		tbl= $('#table-data').DataTable( {
			bJQueryUI: true,
			sPaginationType: "full_numbers",
		    "ajax" : "komplek_process.php?action=get",
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
		            "data":"nama_housing",
		            "targets": 1
		        },
		        {
		            "data":"nama_kota",
		            "targets": 2
		        },
		        {
		            "data":"kelurahan",
		            "targets": 3
		        },
		        {
		            "data":"kecamatan",
		            "targets": 4
		        },
		        {
		            "data":null,
		            "width" : '5%',
		            "targets": 5,
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
                                var did=item[i]['id_housing'];
                                $.post( 'komplek_process.php?action=del&id=' + did).success(function(data){
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
	        $('#id_housing_edit').val(tbl.row($(this).parents('tr')).data().id_housing);
	        $('#nama_housing_edit').val(tbl.row($(this).parents('tr')).data().nama_housing);
	        $('#kota_edit').val(tbl.row($(this).parents('tr')).data().id_kota).trigger('change');
	        $('#kelurahan_edit').val(tbl.row($(this).parents('tr')).data().kelurahan);
	        $('#kecamatan_edit').val(tbl.row($(this).parents('tr')).data().kecamatan);
	    }); 
	    
	    select2trig();
	    	

	});

	function select2trig(){
		$(".select2").select2({
		    placeholder: "Pilih Kota",
	    });
	}



	function saveData(){

		if($('#nama_housing').val()==''){
			$('.alert-div').fadeIn('slow');
		}else{
			$.ajax({
			    url: 'komplek_process.php',
			    type: 'POST',
			    data: {
			        nama_housing: $('#nama_housing').val(),
			        kota: $('#kota').val(),
			        kelurahan: $('#kelurahan').val(),
			        kecamatan: $('#kecamatan').val(),
			        id_housing : $('#id_housing').val(),
			        action:'add'
			    },
			    success: function(data){
			    	var result = jQuery.parseJSON(data);
			        document.getElementById("form_data").reset();		        
			        select2trig();
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
		    url: 'komplek_process.php',
		    type: 'POST',
		    data: {
		        nama_housing: $('#nama_housing_edit').val(),
		        kota: $('#kota_edit').val(),
		        kelurahan: $('#kelurahan_edit').val(),
		        kecamatan: $('#kecamatan_edit').val(),
		        id_housing : $('#id_housing_edit').val(),
		        action:'add'
		    },
		    success: function(data){

		    	var result = jQuery.parseJSON(data);

		        document.getElementById("form_data_edit").reset();
		        select2trig();
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