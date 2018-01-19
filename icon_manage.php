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
			<h4><i class="fa fa-angle-right"></i> Data Icon Baru</h4>
			<form class="form-horizontal" role="form" id="form_data">
				<div class="form-group">
					<label class="control-label col-sm-2">Nama Icon *</label>
					<div class="col-md-10">
						<input type="text" class="form-control" id="nama_icon" placeholder="Icon" required>
					</div>
				</div>

				<input type="hidden" id="id_icon" value="0">
				
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
				<i class="fa fa-angle-right"></i> Data Icon  
				<button type="button"  class="btn btn-xs btn-round btn-danger pull-right" id="deleteData" data-toggle="confirmation" data-singleton="true"><i class="fa fa-trash-o"></i> Hapus Data</button>
			</h4>
			<table class="table table-striped table-bordered" id="table-data">
				<thead>
					<tr>
						<th width="5%"></th>
						<th>Nama Icon</th>
						<th>Icon</th>
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
						<label class="control-label col-sm-3">Nama Icon</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="nama_icon_edit" placeholder="Nama Icon" >
						</div>
					</div>

					<input type="hidden" id="id_icon_edit">
					
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
		    "ajax" : "icon_process.php?action=get",
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
		            "data":"nama_icon",
		            "targets": 1
		        },
		        {
		        	"data":null,
		        	"targets":2,
		        	"width": "2%",
		        	"render": function(data,type,full,meta){

		        		if(full.id_icon>0){
			        		var icon = full.nama_icon;
			        		icon = icon.replace("ic_","");
			        		icon = icon.replace("_black_24dp","");
		        			return "<center><i class='material-icons'>"+icon+"</i></center>";
			        	}

			        	return "";

		        	}
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
                                var did=item[i]['id_icon'];
                                $.post( 'icon_process.php?action=del&id=' + did).success(function(data){
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
	        $('#id_icon_edit').val(tbl.row($(this).parents('tr')).data().id_icon);
	        $('#nama_icon_edit').val(tbl.row($(this).parents('tr')).data().nama_icon);
	    }); 
	    
	    select2trig();
	    	

	});

	function select2trig(){
		$(".select2").select2({
		    placeholder: "Pilih Icon",
	    });
	}



	function saveData(){

		if($('#nama_icon').val()==''){
			$('.alert-div').fadeIn('slow');
		}else{
			$.ajax({
			    url: 'icon_process.php',
			    type: 'POST',
			    data: {
			        nama_icon: $('#nama_icon').val(),
			        id_icon : $('#id_icon').val(),
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
		    url: 'icon_process.php',
		    type: 'POST',
		    data: {
		        nama_icon: $('#nama_icon_edit').val(),
		        id_icon : $('#id_icon_edit').val(),
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