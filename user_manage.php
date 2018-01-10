<h3><i class="fa fa-angle-right"></i> Management User</h3>

<div class="alert-div" style="display: none;">
	<div class="alert alert-danger alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	  <strong>Gagal menambah data!</strong> Lengkapi data yang sudah ditandai untuk menambahkan data
	</div>
</div>

<div class="row mt" id="btn-row">
	<div class="col-md-12">
		<a href="javascript:;" class="btn btn-info" id="add-data"><i class="fa fa-plus"></i> Add user</a>
	</div>
</div>

<div class="row mt" id="form-row" style="display: none;">
	<div class="col-lg-12">
		<div class="showback">
			<h4><i class="fa fa-angle-right"></i> Data User Baru</h4>
			<form class="form-horizontal" role="form" id="form_data">
				<div class="form-group">
					<label class="control-label col-sm-2">Nama <span class="required">*</span></label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="nama" placeholder="Nama" required>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">E-mail <span class="required">*</span></label>
					<div class="col-md-10">
						<input type="email" class="form-control" id="email" placeholder="email" required>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Jenis Kelamin</label>
					<div class="col-md-10">
						<select id="jk" class="form-control">
							<option value="1">Laki-laki</option>
							<option value="0">Perempuan</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Tanggal Lahir <span class="required">*</span></label>
					<div class="col-md-10">
						<input type="text" class="form-control datepicker" id="tanggal_lahir" placeholder="Tanggal lahir" required>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Blok <span class="required">*</span></label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="blok" placeholder="Blok Rumah" required>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">No. Rumah <span class="required">*</span></label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="no_rumah" placeholder="Nomor Rumah" required>
					</div>
				</div>

				<?php if($_SESSION['role_usr']!=1){ ?>
					<input type="hidden" name="group_housing" value="<?php echo $_SESSION['id_group_usr'];?>">
				<?php }else{ ?>

					<?php 

						$query = "SELECT a.*,b.nama_housing FROM srt_group a LEFT JOIN srt_housing b ON a.id_housing=b.id_housing ORDER BY b.nama_housing ASC";
						$sql = mysqli_query($connect,$query);

					?>

					<div class="form-group">
						<label class="control-label col-sm-2" >Group Housing</label>
						<div class="col-md-10">
							<select class="form-control select2" id="group_housing">
								<option value="" selected disabled>-Pilih Group Housing-</option>
								<?php while($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
									<option value="<?php echo $data['id_group'];?>"> <?php echo $data['nama_housing'] . " (RT. ". $data['rt']. "/RW. ". $data['rw'] .")";?> </option>
								<?php } ?>
							</select>
						</div>
					</div>

				<?php } ?>

				<?php

					if($_SESSION['role_usr']!=1){

				?>
						<input type="hidden" id="role" value="3">

				<?php }else{ 

						$query = "SELECT * FROM srt_role ORDER BY id_role ASC";
						$sql = mysqli_query($connect,$query);

				?>	

						<div class="form-group">
							<label class="control-label col-sm-2" >Role</label>
							<div class="col-md-10">
								<select class="form-control select2" id="role">
									<option value="" selected disabled>-Pilih User Role-</option>
									<?php while($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
										<option value="<?php echo $data['id_role'];?>"> <?php echo $data['nama_role'];?> </option>
									<?php } ?>
								</select>
							</div>
						</div>
				<?php } ?>

				<div class="form-group">
					<label class="control-label col-sm-2">Ketua RT</label>
					<div class="col-sm-10">
					    <div class="switch switch-square"
					         data-on-label="<i class=' fa fa-check'></i>"
					         data-off-label="<i class='fa fa-times'></i>">
					        <input type="checkbox" id="ketua_rt" />
					    </div>
					</div>
				</div>

				<input type="hidden" id="id_warga" value="0">
				
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
				<i class="fa fa-angle-right"></i> Data Thread Category  
				<button type="button"  class="btn btn-xs btn-round btn-danger pull-right" id="deleteData" data-toggle="confirmation" data-singleton="true"><i class="fa fa-trash-o"></i> Hapus Data</button>
			</h4>
			<table class="table table-striped table-bordered" id="table-data">
				<thead>
					<tr>
						<th width="5%"></th>
						<th>Nama</th>
						<th>Email</th>
						<th>Jenis Kelamin</th>
						<th>Tanggal Lahir</th>
						<th>Nama Housing</th>
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
						<label class="control-label col-sm-3">Nama <span class="required">*</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="nama_edit" placeholder="Nama" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Jenis Kelamin</label>
						<div class="col-md-9">
							<select id="jk_edit" class="form-control">
								<option value="1">Laki-laki</option>
								<option value="0">Perempuan</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Tanggal Lahir <span class="required">*</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control datepicker" id="tanggal_lahir_edit" placeholder="Tanggal lahir" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">Blok <span class="required">*</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="blok_edit" placeholder="Blok Rumah" required>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3">No. Rumah <span class="required">*</span></label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="no_rumah_edit" placeholder="Nomor Rumah" required>
						</div>
					</div>

					<?php if($_SESSION['role_usr']!=1){ ?>
						<input type="hidden" name="group_housing_edit" value="<?php echo $_SESSION['id_group_usr'];?>">
					<?php }else{ ?>

						<?php 

							$query = "SELECT a.*,b.nama_housing FROM srt_group a LEFT JOIN srt_housing b ON a.id_housing=b.id_housing ORDER BY b.nama_housing ASC";
							$sql = mysqli_query($connect,$query);

						?>

						<div class="form-group">
							<label class="control-label col-sm-3" >Group Housing</label>
							<div class="col-md-9">
								<select class="form-control select2" id="group_housing_edit">
									<option value="" selected disabled>-Pilih Group Housing-</option>
									<?php while($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
										<option value="<?php echo $data['id_group'];?>"> <?php echo $data['nama_housing'] . " (RT. ". $data['rt']. "/RW. ". $data['rw'] .")";?> </option>
									<?php } ?>
								</select>
							</div>
						</div>

					<?php } ?>

					<div class="form-group">
						<label class="control-label col-sm-3">Ketua RT</label>
						<div class="col-md-9">
						    <div class="switch switch-square" id="switcher"
						         data-on-label="<i class=' fa fa-check'></i>"
						         data-off-label="<i class='fa fa-times'></i>">
						        <input type="checkbox" id="ketua_rt_edit" />
						    </div>
						</div>
					</div>

					<input type="hidden" id="id_warga_edit">
					
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

<div class="modal fade" id="edit-modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Ubah Data Login</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form" id="form_data_edit2">
					<div class="form-group">
						<label class="control-label col-sm-2">E-mail <span class="required">*</span></label>
						<div class="col-md-10">
							<input type="email" class="form-control" id="email_edit" placeholder="email" required>
						</div>
					</div>

					<?php

						if($_SESSION['role_usr']!=1){

					?>
							<input type="hidden" id="role_edit" value="3">

					<?php }else{ 

							$query = "SELECT * FROM srt_role ORDER BY id_role ASC";
							$sql = mysqli_query($connect,$query);

					?>	

							<div class="form-group">
								<label class="control-label col-sm-2" >Role</label>
								<div class="col-md-10">
									<select class="form-control select2" id="role_edit">
										<option value="" selected disabled>-Pilih User Role-</option>
										<?php while($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
											<option value="<?php echo $data['id_role'];?>"> <?php echo $data['nama_role'];?> </option>
										<?php } ?>
									</select>
								</div>
							</div>
					<?php } ?>

					<input type="hidden" id="id_user_edit">

					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<button type="button" class="btn btn-theme" id="ins-btn2" onclick="editDataLogin();">Submit</button>
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

		tbl= $('#table-data').DataTable( {
			bJQueryUI: true,
			sPaginationType: "full_numbers",
		    "ajax" : "user_process.php?action=get&group="+group,
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
		            "data":"nama",
		            "targets": 1
		        },
		        {
		            "data":"email",
		            "targets": 2
		        },
		        {
		            "data":"jk",
		            "targets": 3,
		            "render": function(data,type,full,meta){
		            	if(data==1){
		            		return "Laki-laki";
		            	}

		            	return "Perempuan";
		            }
		        },
		        {
		            "data":"tgl_lahir",
		            "targets": 4
		        },
		        {
		            "data":"nama_housing",
		            "targets": 5
		        },
		        {
		            "data":null,
		            "width" : '10%',
		            "targets": 6,
		            "render":function(data, type, full, meta ){
		            	var editWarga = '<button class="btn btn-info btn-xs edit-btn" title="edit data"><i class="fa fa-edit"></i></button> ';
		            	var editLogin = '<button class="btn btn-warning btn-xs edit-btn2" title="edit detail login"><i class="fa fa-user"></i></button> ';
		            	var resetPassword = '<button class="btn btn-success btn-xs reset-passwd" title="reset user password"><i class="fa fa-refresh"></i></button> ';

		            	return '<center>'+editLogin + editWarga+resetPassword+'</center>';
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
                                var did=item[i]['id_category'];
                                $.post( 'thread_category_process.php?action=del&id=' + did).success(function(data){
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
	        $('#id_warga_edit').val(tbl.row($(this).parents('tr')).data().id_warga);
	        $('#nama_edit').val(tbl.row($(this).parents('tr')).data().nama)
	        $('#jk_edit').val(tbl.row($(this).parents('tr')).data().jk);
	        $('#tanggal_lahir_edit').val(tbl.row($(this).parents('tr')).data().tgl_lahir);
	        $('#blok_edit').val(tbl.row($(this).parents('tr')).data().blok);
	        $('#no_rumah_edit').val(tbl.row($(this).parents('tr')).data().no);
	        $('#group_housing_edit').val(tbl.row($(this).parents('tr')).data().id_group).trigger('change');
	        if(tbl.row($(this).parents('tr')).data().type==1){
	        	$('#ketua_rt_edit').prop("checked",true);	
	        	$('#switcher .switch-animate').removeClass('switch-off').addClass('switch-on');	
	        }else{
	        	$('#ketua_rt_edit').prop("checked",false);	
	        	$('#switcher .switch-animate').removeClass('switch-on').addClass('switch-off');	
	        }
	    });

	    $('#table-data tbody').on('click','.edit-btn2',function(){
	    	$('#edit-modal2').modal();
	    	$('#email_edit').val(tbl.row($(this).parents('tr')).data().email);
	    	$('#role_edit').val(tbl.row($(this).parents('tr')).data().role).trigger('change');
	    	$('#id_user_edit').val(tbl.row($(this).parents('tr')).data().id_user);
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

		if($('#nama').val()=='' || $('#email').val()=='' || $('#blok').val()=='' || $('#nomor').val()=='' || $('#tanggal_lahir').val()=='' ){
			$('.alert-div').fadeIn('slow');
		}else{

			var ketua_rt = 0;

			if($('#ketua_rt').is(':checked')){
				ketua_rt = 1;
			}

			$.ajax({
			    url: 'user_process.php',
			    type: 'POST',
			    data: {
			        nama: $('#nama').val(),
			        email: $('#email').val(),
			        jk: $('#jk').val(),
			        tanggal_lahir: $('#tanggal_lahir').val(),
			        blok: $('#blok').val(),
			        no_rumah: $('#no_rumah').val(),
			        group_housing: $('#group_housing').val(),
			        role: $('#role').val(),
			        ketua_rt: ketua_rt,
			        id_warga: $('#id_warga').val(),
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
		
		var ketua_rt = 0;

		if($('#ketua_rt_edit').is(':checked')){
			ketua_rt = 1;
		}

		$.ajax({
		    url: 'user_process.php',
		    type: 'POST',
		    data: {
		    	nama: $('#nama_edit').val(),
		    	jk: $('#jk_edit').val(),
		    	tanggal_lahir: $('#tanggal_lahir_edit').val(),
		    	blok: $('#blok_edit').val(),
		    	no_rumah: $('#no_rumah_edit').val(),
		    	group_housing: $('#group_housing_edit').val(),
		    	ketua_rt: ketua_rt,
		    	id_warga: $('#id_warga_edit').val(),
		        action:'edit'
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

	function editDataLogin(){

		$.ajax({
		    url: 'user_process.php',
		    type: 'POST',
		    data: {
		    	email: $('#email_edit').val(),
		    	role: $('#role_edit').val(),
		    	id_user: $('#id_user_edit').val(),
		        action:'editlogin'
		    },
		    success: function(data){

		    	var result = jQuery.parseJSON(data);

		        document.getElementById("form_data_edit2").reset();
		        select2trig();
		        tbl.ajax.reload();
		        $('#edit-modal2').modal('toggle');

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