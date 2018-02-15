<h3><i class="fa fa-angle-right"></i> Management Layanan</h3>


<div class="row mt">
	<div class="col-lg-12">
		<div class="showback">
			<h4>
				<i class="fa fa-angle-right"></i> Data Layanan Warga 
				<button type="button"  class="btn btn-xs btn-round btn-danger pull-right" id="deleteData" data-toggle="confirmation" data-singleton="true"><i class="fa fa-trash-o"></i> Hapus Data</button>
			</h4>
			<table class="table table-striped table-bordered" id="table-data">
				<thead>
					<tr>
						<th width="5%"></th>
						<th>Nama</th>
						<th>No KTP</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>Jenis kelamin</th>
						<th>Status Pernikahan</th>
						<th>Keperluan</th>
						<th>Keterangan</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
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
		    "ajax" : "layanan_process.php?action=get&group="+group,
		    select: {
		        style: 'multi+shift',
		    },
		    columns:[
		    	{"data":null},
		    	{"data":"nama"},
		    	{"data":"nomor_ktp"},
		    	{"data":"tempat_lahir"},
		    	{"data":"tanggal_lahir"},
		    	{"data":"jenis_kelamin"},
		    	{"data":"status_pernikahan"},
		    	{"data":"keperluan"},
		    	{"data":"detail_keperluan"},
		    	{"data":"tanggal"},
		    	{"data":"status"},
		    	{"data":null,"defaultContent":""},
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
		        	"targets": 10,
		        	"render":function(data,type,full,meta){

		        		if(data==2){
		        			return '<span class="label label-primary">Selesai</span>';
		        		}

		        		return '<span class="label label-warning">Pending</span>';

		        	}
		        },
		        {
		            "data":null,
		            "width" : '10%',
		            "targets": 11,
		            "render":function(data, type, full, meta ){
		            	var cetak = '<a href="surat.php?id='+full.id_layanan+'" class="btn btn-info btn-xs" title="Cetak Surat"><i class="fa fa-print"></i></a> ';
		            	
		            	return '<center>'+cetak+'</center>';
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
                                var did=item[i]['id_layanan'];
                                $.post( 'layanan_process.php?action=del&id=' + did).success(function(data){
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


	    $('#table-data tbody').on('click','.edit-btn2',function(){
	    	$('#edit-modal2').modal();
	    	$('#email_edit').val(tbl.row($(this).parents('tr')).data().email);
	    	$('#role_edit').val(tbl.row($(this).parents('tr')).data().role).trigger('change');
	    	$('#id_user_edit').val(tbl.row($(this).parents('tr')).data().id_user);
	    });
	    

	});





</script>