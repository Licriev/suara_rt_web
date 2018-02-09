<h3><i class="fa fa-angle-right"></i> Management Sesi Pemilihan Ketua RT</h3>

<div class="alert-div" style="display: none;">
	<div class="alert alert-danger alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	  <strong>Gagal menambah data!</strong> Lengkapi data yang sudah ditandai untuk menambahkan data
	</div>
</div>

<div class="row mt" id="btn-row">
	<div class="col-md-12">
		<a href="javascript:;" class="btn btn-info" id="add-data"><i class="fa fa-plus"></i> Tambah Sesi Pemilihan</a>
	</div>
</div>

<div class="row mt" id="form-row" style="display: none;">
	<div class="col-lg-12">
		<div class="showback">
			<h4><i class="fa fa-angle-right"></i> Sesi Pemilihan Baru</h4>
			<form class="form-horizontal" role="form" id="form_data">
				<div class="form-group">
					<label class="control-label col-sm-2">Periode Pemilihan <span class="required">*</span></label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="periode_pemilihan" placeholder="Periode Pemilihan" required>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Waktu Pemilihan <span class="required">*</span></label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="waktu_pemilihan" placeholder="Waktu Pemilihan" required>
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
				
				<input type="hidden" id="id_user" value="<?php echo $_SESSION['user_id_usr'];?>">
				
				<div class="form-group">
					<div class="col-md-10 col-md-offset-2">
						<button type="button" class="btn btn-theme" id="ins-btn" onclick="saveData();">Submit</button>
						<button type="button" class="btn btn-warning" id="close-add">Close</button>

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
				<i class="fa fa-angle-right"></i> Data User 
				<button type="button"  class="btn btn-xs btn-round btn-danger pull-right" id="deleteData" data-toggle="confirmation" data-singleton="true"><i class="fa fa-trash-o"></i> Hapus Data</button>
			</h4>
			<table class="table table-striped table-bordered" id="table-data">
				<thead>
					<tr>
						<th width="5%"></th>
						<th>Periode Pemilihan</th>
						<th>Waktu Mulai</th>
						<th>Waktu Selesai</th>
						<th>Options</th>
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
						<label class="control-label col-sm-2">Periode Pemilihan <span class="required">*</span></label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="periode_pemilihan_edit" placeholder="Periode Pemilihan" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2">Waktu Pemilihan <span class="required">*</span></label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="waktu_pemilihan_edit" placeholder="Waktu Pemilihan" required>
						</div>
					</div>

					<input type="hidden" id="id_sesi_pemilihan">
					
					
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

	<?php if($_SESSION['role_usr']!=1){?>
		group = "<?php echo $_SESSION['id_group_usr'];?>";
	<?php } ?>
	
	jQuery(document).ready(function($) {


	    $('#waktu_pemilihan,#waktu_pemilihan_edit').daterangepicker({
	        timePicker: true,
	        timePickerIncrement: 30,
	        "timePicker24Hour": true,
	        "timePickerIncrement": 5,
	        locale: {
	            format: 'DD-MM-YYYY h:mm'
	        }
	    });


		tbl= $('#table-data').DataTable( {
			bJQueryUI: true,
			sPaginationType: "full_numbers",
		    "ajax" : "pemilihan_process.php?action=get&group="+group,
		    select: {
		        style: 'multi+shift',
		    },
		    columns:[
		    	{"data":null,"defaultContent":""},
		    	{"data":"periode_pemilihan"},
		    	{"data":"tgl_mulai"},
		    	{"data":"tgl_selesai"},
		    	{"data":null,"defaultContent":""}
		    ],
		    columnDefs: [                
		        {
		            "orderable": false,
		            "className": 'select-checkbox',
		            "targets": 0,
		            "data":null,
		            "defaultContent": ""
		        },
		       	{
		       		"targets":1,
		       		"render":function(data,type,full,meta){
		       			return "<a href='?pg=dpkr&id="+full.id_sesi_pemilihan+"'>"+data+"</a>";
		       		}
		       	},
		        {
		            "data":null,
		            "width" : '10%',
		            "targets": 4,
		            "render":function(data, type, full, meta ){
		            	var editWarga = '<button class="btn btn-info btn-xs edit-btn" title="edit data"><i class="fa fa-edit"></i></button> ';
	

		            	return '<center>' + editWarga+'</center>';
		            }
		        },
		    ],
		    select: {
		        style:    'os',
		        selector: 'td:first-child'
		    },
		    
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
                                var did=item[i]['id_sesi_pemilihan'];
                                $.post( 'pemilihan_process.php?action=del&id=' + did).success(function(data){
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
	        $('#periode_pemilihan_edit').val(tbl.row($(this).parents('tr')).data().periode_pemilihan);
	        $('#waktu_pemilihan_edit').val(tbl.row($(this).parents('tr')).data().tgl_mulai+" - "+tbl.row($(this).parents('tr')).data().tgl_selesai);
	        $('#id_sesi_pemilihan').val(tbl.row($(this).parents('tr')).data().id_sesi_pemilihan)
	    });

	    
	   	select2trig();		
	    
	    
	    $('#add-data').click(function(event) {
	    	$('#btn-row').fadeOut('fast');
	    	$("#form-row").fadeIn('fast');
	    });

	    $('#close-add').click(function(event) {
	    	$('#btn-row').fadeIn('fast');
	    	$("#form-row").fadeOut('fast');
	    });

	    $('#table-data tbody').on('click','.reset-passwd',function(){
	    	var id_user = tbl.row($(this).parents('tr')).data().id_user;
	    	$.confirm({
	    		theme: 'bootstrap',
	    	    title: 'Reset Password',
	    	    content: 'Reset Password User '+tbl.row($(this).parents('tr')).data().nama+'?',
	    	    icon: 'fa fa-warning',
	    	    buttons: {
	    	        confirm: function () {

	        			$.ajax({
	        			    url: 'user_process.php',
	        			    type: 'POST',
	        			    data: {
	        			    	id_user: id_user,
	        			        action:'reset'
	        			    },
	        			    success: function(data){

	        			    	var result = jQuery.parseJSON(data);

	        			        tbl.ajax.reload();

	        			        $.gritter.add({
	        		                // (string | mandatory) the heading of the notification
	        		                title: 'Ubah Data',
	        		                sticky: false,
	        	                    time: '5000',
	        	                    text: result.msg,
	        		            });
	        			    }
	        			});


		            	
	                    
	                	
	    	        },
	    	        cancel: function () {
	    	            
	    	        },
	    	    }
	    	});
	    });

	});

	function select2trig(){
			$("#group_housing").select2({
			    placeholder: "Pilih Group Housing",
		    });


		<?php if($_SESSION['role_usr']==1){ ?>
		    $("#role").select2({
		    	placeholder: "Pilih User Role"
		    })
	    <?php } ?>
	}



	function saveData(){

		if($('#periode_pemilihan').val()=='' || $('#waktu_pemilihan').val()=='' || $('#group_user').val()==''){
			$('.alert-div').fadeIn('slow');
		}else{

			$.ajax({
			    url: 'pemilihan_process.php',
			    type: 'POST',
			    data: {
			        periode_pemilihan: $('#periode_pemilihan').val(),
			        waktu_pemilihan: $('#waktu_pemilihan').val(),
			        group_user: $('#group_user').val(),
			        id_user:$("#id_user").val(),
			        id_pemilihan:0,
			        action:'add'
			    },
			    success: function(data){
			    	var result = jQuery.parseJSON(data);

			    	if(result.result){
				        document.getElementById("form_data").reset();		        
				        select2trig();
				        tbl.ajax.reload();

			    	}

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
		    url: 'pemilihan_process.php',
		    type: 'POST',
		    data: {
		    	periode_pemilihan: $('#periode_pemilihan_edit').val(),
			        waktu_pemilihan: $('#waktu_pemilihan_edit').val(),
			        group_user: $('#group_user').val(),
			        id_user:$("#id_user").val(),
			        id_pemilihan:$('#id_sesi_pemilihan').val(),
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