<h3><i class="fa fa-angle-right"></i> Informasi</h3>

<?php
	
	if(isset($_GET['id'])){

		include "config/koneksi.php";

		$id = $_GET['id'];

		$query = "SELECT a.*, b.nama, c.nama_category FROM srt_thread a LEFT JOIN srt_warga b ON b.id_user = a.id_user LEFT JOIN srt_thread_category c ON a.id_category=c.id_category WHERE a.id_thread='$id'";
		$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

		$data = mysqli_fetch_array($sql,MYSQLI_ASSOC);

		$query = "SELECT * FROM srt_thread_content WHERE id_thread='$id' ORDER BY id_content ASC LIMIT 1";
		$sql = mysqli_query($connect,$query) or die(mysqli_error($connect));

		$data_thread= mysqli_fetch_array($sql,MYSQLI_ASSOC);

	}else{
		echo "<script>window.location.replace('?pg=thm');</script>";
	}

?>


<div class="row mt">
	<div class="col-lg-12">
		<div class="showback">
			<h4><i class="fa fa-angle-right"></i> Informasi</h4>
			<form class="form-horizontal" role="form" id="form_data">
				<div class="form-group">
					<label class="control-label col-sm-2">Judul</label>
					<label class="control-label col-sm-10">: <?php echo $data['judul'];?></label>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Pengirim</label>
					<label class="control-label col-sm-10">: <?php echo $data['nama'];?></label>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Tanggal Post</label>
					<label class="control-label col-sm-10">: <?php echo date('d-m-Y', strtotime($data['tanggal_post']));?></label>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Kategori</label>
					<label class="control-label col-sm-10">: <?php echo $data['nama_category'];?></label>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2">Konten</label>
					<div class="col-sm-10">
						<p>
							: <?php echo $data_thread['content'];?>
						</p>
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
						<th>Komentar</th>
						<th>Pengirim</th>
						<th>Tanggal Post</th>
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
	
	jQuery(document).ready(function($) {
		

		tbl= $('#table-data').DataTable( {
			bJQueryUI: true,
			sPaginationType: "full_numbers",
		    "ajax" : "thread_detail_process.php?action=get&id=<?php echo $_GET['id'];?>",
		    select: {
		        style: 'multi+shift',
		    },
		    columns:[
		    	{"data":null},
		    	{"data":"content"},
		    	{"data":"nama"},
		    	{"data":"tgl"}
		    ],
		    columnDefs: [                
		        {
		            "orderable": false,
		            "className": 'select-checkbox',
		            "targets": 0,
		            "data":null,
		            "defaultContent": ""
		        },
		    ],
		    select: {
		        style:'os',
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
                                var did=item[i]['id_content'];
                                $.post( 'thread_detail_process.php?action=del&id=' + did).success(function(data){
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

	});

</script>