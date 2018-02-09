<h3><i class="fa fa-angle-right"></i> Management Kandidat Pemilihan Ketua RT</h3>

<div class="alert-div" style="display: none;">
	<div class="alert alert-danger alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	  <strong>Gagal menambah data!</strong> Lengkapi data yang sudah ditandai untuk menambahkan data
	</div>
</div>

<div class="row mt" id="btn-row">
	<div class="col-md-12">
		<a href="javascript:;" class="btn btn-info" id="add-data"><i class="fa fa-plus"></i> Tambah Kandidat Pemilihan</a>
	</div>
</div>


<?php

	if(!isset($_GET['id'])){
		echo "<script>window.location.replace('?pg=pkr');</script>";
	}
	
	$query = "SELECT * FROM srt_sesi_pemilihan WHERE id_sesi_pemilihan='".$_GET['id']."'";
	$sql =mysqli_query($connect,$query);

	$data_sesi = mysqli_fetch_array($sql);

	$query = "SELECT * FROM srt_warga WHERE id_group='".$data_sesi['id_group']."'";
	$sql =mysqli_query($connect,$query);

	$num_warga = mysqli_num_rows($sql);

	$query = "SELECT * FROM srt_suara_masuk WHERE id_sesi_pemilihan='".$_GET['id']."'";
	$sql =mysqli_query($connect,$query);

	$num_suara = mysqli_num_rows($sql);

?>

<div class="row mt">
	<div class="col-lg-12">
		<div class="showback">
			<h4><i class="fa fa-angle-right"></i> Informasi</h4>
			<form class="form-horizontal" role="form" id="forms">
				<div class="form-group">
					<label class="control-label col-sm-2">Periode Pemilihan</label>
					<label class="control-label col-sm-10">: <?php echo $data_sesi['periode_pemilihan'];?></label>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Tanggal Mulai</label>
					<label class="control-label col-sm-10">: <?php echo date('d-m-Y H:i', strtotime($data_sesi['tanggal_mulai']));?></label>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Tanggal selesai</label>
					<label class="control-label col-sm-10">: <?php echo date('d-m-Y H:i', strtotime($data_sesi['tanggal_selesai']));?></label>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Total Suara Masuk / Total Warga</label>
					<label class="control-label col-sm-10">: <?php echo $num_suara."/".$num_warga;?></label>
				</div>

				
			</form>
		</div>
	</div>
</div>

<div class="row mt" id="form-row" style="display: none;">
	<div class="col-lg-12">
		<div class="showback">
			<h4><i class="fa fa-angle-right"></i> Kandidat Pemilihan Baru</h4>
			<form class="form-horizontal" role="form" id="form_data" action="pemilihan_detail_process.php" enctype="multipart/form-data">
				<div class="form-group">
					<label class="control-label col-sm-2">Kandidat <span class="required">*</span></label>

					<?php

						if($_SESSION['role_usr']==1){
							$query = "SELECT * FROM srt_warga";
						}else{
							$query = "SELECT * FROM srt_warga WHERE id_group='".$_SESSION['id_group_usr']."'";
						}


						$sql = mysqli_query($connect,$query);


					?>

					<div class="col-md-10">
						<select class="form-control select2" id="Kandidat_pemilihan" name="kandidat_pemilihan">
							<option value="" disabled selected>-Pilih Kandidat-</option>
							<?php while ($data_warga=mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
								<option value="<?php echo $data_warga['id_user'];?>"><?php echo $data_warga['nama'];?></option>
							<?php } ?>
						</select>
					</div>
				
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Visi <span class="required">*</span></label>
					<div class="col-md-10">
						<textarea class="form-control" rows="4" id="visi" name="visi"></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Misi <span class="required">*</span></label>
					<div class="col-md-10">
						<textarea class="form-control" rows="4" id="misi" name="misi"></textarea>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-2">Foto <span class="required">*</span></label>
					<div class="col-md-10">
						<input type="file" class="default" id="fileToUpload" name="fileToUpload">
					</div>
				</div>



				
				<input type="hidden" id="id_sesi_pemilihan" name="id_sesi_pemilihan" value="<?php echo $_GET['id'];?>">
				<input type="hidden" id="id_kandidat" name="id_kandidat" value="0">
				<input type="hidden" id="action" value="add" name="action">
				
				<div class="form-group">
					<div class="col-md-10 col-md-offset-2">
						<button type="submit" class="btn btn-theme" id="ins-btn">Submit</button>
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
						<th>Kandidat</th>
						<th>Visi</th>
						<th>Misi</th>
						<th>Foto</th>
						<th>Jumlah Suara</th>
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
						<label class="control-label col-sm-2">Kandidat <span class="required">*</span></label>
						<div class="col-md-10">
							<input type="text" class="form-control" disabled readonly id="kandidat_edit">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2">Visi <span class="required">*</span></label>
						<div class="col-md-10">
							<textarea class="form-control" rows="4" id="visi_edit" name="visi_edit"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2">Misi <span class="required">*</span></label>
						<div class="col-md-10">
							<textarea class="form-control" rows="4" id="misi_edit" name="misi_edit"></textarea>
						</div>
					</div>

					<input type="hidden" id="id_kandidat_pemilihan">
					
					
					<div class="form-group">
						<div class="col-md-9 col-md-offset-2">
							<button type="button" class="btn btn-theme" id="ins-btn" onclick="editData();">Submit</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="img-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Ubah Data</h4>
			</div>
			<div class="modal-body">
				
				<form class="form-horizontal" role="form" id="form_data_img" action="pemilihan_detail_process.php" enctype="multipart/form-data">

					<div class="form-group">
						<label class="control-label col-sm-2">Kandidat <span class="required">*</span></label>
						<div class="col-md-10">
							<input type="text" class="form-control" disabled readonly id="kandidat_img">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2">Foto <span class="required">*</span></label>
						<div class="col-md-10">
							<input type="file" class="default" id="fileToUpload" name="fileToUpload">
						</div>
					</div>

					
					<input type="hidden" id="id_kandidat_img" name="id_kandidat_img">
					<input type="hidden" name="action" value="edit_img">
					
					
					<div class="form-group">
						<div class="col-md-9 col-md-offset-2">
							<button type="submit" class="btn btn-theme" id="ins-btn"">Submit</button>
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


	    $('#form_data').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
    		    	var result = jQuery.parseJSON(data);

    		        tbl.ajax.reload();

    		        $.gritter.add({
    	                // (string | mandatory) the heading of the notification
    	                title: 'Ubah Data',
    	                sticky: false,
                        time: '5000',
                        text: result.msg,
    	            });
    	            document.getElementById("fileToUpload").value = "";
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            });
        }));

        $('#form_data_img').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
    		    	var result = jQuery.parseJSON(data);

    		        tbl.ajax.reload();

    		        $.gritter.add({
    	                // (string | mandatory) the heading of the notification
    	                title: 'Ubah Data',
    	                sticky: false,
                        time: '5000',
                        text: result.msg,
    	            });

    	            $('#img-modal').modal('toggle');
    	            document.getElementById("fileToUpload").value = "";
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            });
        }));


		tbl= $('#table-data').DataTable( {
			bJQueryUI: true,
			sPaginationType: "full_numbers",
		    "ajax" : "pemilihan_detail_process.php?action=get&sesi=<?php echo $_GET['id'];?>",
		    select: {
		        style: 'multi+shift',
		    },
		    columns:[
		    	{"data":null,"defaultContent":""},
		    	{"data":"nama"},
		    	{"data":"visi"},
		    	{"data":"misi"},
		    	{"data":"image"},
		    	{"data":"jumlah_suara","width":"14%"},
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
		        	"targets":4,
		        	"render":function(data,type,full,meta){
		        		return "<center><img src='"+data+"' class='img' style='max-width: 50px;'></center>";
		        	}
		        },
		        {
		        	"targets":5,
		        	"render":function(data,type,full,meta){
		        		return "<center>"+(data>0 ? data : 0)+" Suara </center>";
		        	}
		        },
		        {
		            "data":null,
		            "width" : '10%',
		            "targets": 6,
		            "render":function(data, type, full, meta ){
		            	var editWarga = '<button class="btn btn-info btn-xs edit-btn" title="edit data"><i class="fa fa-edit"></i></button> ';
		            	var editimg = '<button class="btn btn-warning btn-xs img-btn" title="edit foto"><i class="fa fa-image"></i></button> ';
	

		            	return '<center>' + editWarga+ editimg +'</center>';
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
                                var did=item[i]['id_kandidat_pemilihan'];
                                $.post( 'pemilihan_detail_process.php?action=del&id=' + did).success(function(data){
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
	        $('#kandidat_edit').val(tbl.row($(this).parents('tr')).data().nama);
	        $('#visi_edit').val(tbl.row($(this).parents('tr')).data().visi);
	        $('#misi_edit').val(tbl.row($(this).parents('tr')).data().misi);
	        $('#id_kandidat_pemilihan').val(tbl.row($(this).parents('tr')).data().id_kandidat_pemilihan);
	    });

	    $('#table-data tbody').on('click', '.img-btn', function () {
	        $('#img-modal').modal();
	        $('#id_kandidat_img').val(tbl.row($(this).parents('tr')).data().id_kandidat_pemilihan);
	        $('#kandidat_img').val(tbl.row($(this).parents('tr')).data().nama);
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
		$("#Kandidat_pemilihan").select2({
		    placeholder: "Pilih Kandidat",
	    });


	}




	function editData(){
	

		$.ajax({
		    url: 'pemilihan_detail_process.php',
		    type: 'POST',
		    data: {
		    	visi: $('#visi_edit').val(),
			    misi: $('#misi_edit').val(),
			    id_kandidat_pemilihan:$('#id_kandidat_pemilihan').val(),
		        action:'edit'
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