<h3><i class="fa fa-angle-right"></i> Management Thread Category</h3>

<div class="alert-div" style="display: none;">
	<div class="alert alert-danger alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	  <strong>Gagal menambah data!</strong> Lengkapi data yang sudah ditandai untuk menambahkan data
	</div>
</div>

<div class="row mt">
	<div class="col-lg-12">
		<div class="showback">
			<h4><i class="fa fa-angle-right"></i> Data Thread Category Baru</h4>
			<form class="form-horizontal" role="form" id="form_data">
				<div class="form-group">
					<label class="control-label col-sm-2">Nama Thread Category *</label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="nama_category" placeholder="Nama Category" required>
					</div>
				</div>

				<?php 

					$query = "SELECT * FROM srt_thread_category WHERE parent_category=0 ORDER BY nama_category ASC";
					$sql = mysqli_query($connect,$query);

				?>
				<div class="form-group" style="display: none;">
					<label class="control-label col-sm-2" >Parent Category</label>
					<div class="col-md-10">
						<select class="form-control select2" id="parent">
							<option value="" selected disabled>-Pilih Parent Category-</option>
							<?php while($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
								<option value="<?php echo $data['id_category'];?>"> <?php echo $data['nama_category'];?> </option>
							<?php } ?>
						</select>
					</div>
				</div>

				<input type="hidden" id="id_category" value="0">
				
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
				<i class="fa fa-angle-right"></i> Data Thread Category  
				<button type="button"  class="btn btn-xs btn-round btn-danger pull-right" id="deleteData" data-toggle="confirmation" data-singleton="true"><i class="fa fa-trash-o"></i> Hapus Data</button>
			</h4>
			<table class="table table-striped table-bordered" id="table-data">
				<thead>
					<tr>
						<th width="5%"></th>
						<th>Nama Category</th>
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
						<label class="control-label col-sm-4">Nama Thread Category</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="nama_category_edit" placeholder="Nama Category" >
						</div>
					</div>

					<?php 

						$query = "SELECT * FROM srt_thread_category WHERE parent_category=0 ORDER BY nama_category ASC";
						$sql = mysqli_query($connect,$query);

					?>

					<div class="form-group" style="display: none;">
						<label class="control-label col-sm-4" >Parent Category</label>
						<div class="col-md-8">
							<select class="form-control select2" id="parent_edit" style="width: 100%;">
								<option value="" selected disabled>-Pilih Parent Category-</option>
								<?php while($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
									<option value="<?php echo $data['id_category'];?>"> <?php echo $data['nama_category'];?> </option>
								<?php } ?>
							</select>
						</div>
					</div>

					<input type="hidden" id="id_category_edit">
					
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
		    "ajax" : "thread_category_process.php?action=get",
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
		            "data":"nama_category",
		            "targets": 1
		        },
		        {
		            "data":null,
		            "width" : '5%',
		            "targets": 2,
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
	        $('#id_category_edit').val(tbl.row($(this).parents('tr')).data().id_category);
	        $('#parent_edit').val(tbl.row($(this).parents('tr')).data().parent_category).trigger('change');
	        $('#nama_category_edit').val(tbl.row($(this).parents('tr')).data().nama_category);
	    }); 
	    
	    select2trig();
	    	

	});

	function select2trig(){
		$(".select2").select2({
		    placeholder: "Pilih Parent Category",
	    });
	}



	function saveData(){

		if($('#nama_category').val()==''){
			$('.alert-div').fadeIn('slow');
		}else{
			$.ajax({
			    url: 'thread_category_process.php',
			    type: 'POST',
			    data: {
			        nama_category: $('#nama_category').val(),
			        parent_category: $('#parent').val(),
			        id_category : $('#id_category').val(),
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
		    url: 'thread_category_process.php',
		    type: 'POST',
		    data: {
		        nama_category: $('#nama_category_edit').val(),
		        parent_category: $('#parent').val(),
		        id_category : $('#id_category_edit').val(),
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