<h3><i class="fa fa-angle-right"></i> Management Informasi</h3>

<div class="row mt">
	<div class="col-lg-12">
		<div class="showback">
			<h4><i class="fa fa-angle-right"></i> Filter Kategori Informasi</h4>
			<form class="form-horizontal" role="form" id="form_data">
				

				<?php 

					$query = "SELECT * FROM srt_thread_category";
					$sql = mysqli_query($connect,$query);

				?>

				<div class="form-group">
					<label class="control-label col-sm-2" >Kategori </label>
					<div class="col-md-10">
						<select class="form-control select2" id="select-kategori">
							<option value="" selected disabled>-Pilih Kategori-</option>
							<option value="0">Tampilkan Semua</option>
							<?php while($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
								<option value="<?php echo $data['id_category'];?>"><?php echo $data['nama_category'];?></option>
							<?php } ?>
						</select>
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
							<select class="form-control select2" id="select-housing">
								<option value="" selected disabled>-Pilih Group Housing-</option>
								<option value="0">Tampilkan Semua</option>
								<?php while($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
									<option value="<?php echo $data['id_group'];?>"> <?php echo $data['nama_housing'] . " (RT. ". $data['rt']. "/RW. ". $data['rw'] .")";?> </option>
								<?php } ?>
							</select>
						</div>
					</div>
				<?php }else{ ?>
					<input type="hidden" id="select-housing" value="<?php echo $_SESSION['id_group_usr'];?>">
				<?php } ?>
				
				<div class="form-group">
					<div class="col-md-10 col-md-offset-2">
						<button type="button" class="btn btn-theme" id="ins-btn" onclick="searchData();">Submit</button>
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
				<i class="fa fa-angle-right"></i> Data Informasi Warga  
				<button type="button"  class="btn btn-xs btn-round btn-danger pull-right" id="deleteData" data-toggle="confirmation" data-singleton="true"><i class="fa fa-trash-o"></i> Hapus Data</button>
			</h4>
			<table class="table table-striped table-bordered" id="table-data">
				<thead>
					<tr>
						<th width="5%"></th>
						<th>Judul</th>
						<th>Tanggal Post</th>
						<th>Pengirim</th>
						<th>Kategori</th>
						<th>Option</th>
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
	
	jQuery(document).ready(function($) {
	

		tbl= $('#table-data').DataTable( {
			bJQueryUI: true,
			sPaginationType: "full_numbers",
		    "ajax" : {
		    	"url":"thread_process.php?action=get",
			    method:"post",
			    "data":function(d){
	              d.rt_kategori=$('#select-kategori').val();
	              d.rt_housing=$('#select-housing').val();
	            },     
		    },		        
		    select: {
		        style: 'multi+shift',
		    },
		    columns:[
		    	{"data":null},
		    	{"data":"judul"},
		    	{"data":"tgl"},
		    	{"data":"nama"},
		    	{"data":"nama_category"},
		    	{"data":null,"defaultContent":"","width":"5%"}
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
		        	"orderable":false,
		        	"searchable":false,
		        	"targets":5,
		        	"render":function(data,type,full,meta){
		        		return "<center>"+"<a href='?pg=dth&id="+full.id_thread+"' class='btn btn-xs btn-primary' title='Detail Informasi'><i class='fa fa-info-circle'></i></a>"+"</center>";
		        	}
		        }

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
                                var did=item[i]['id_thread'];
                                $.post( 'thread_process.php?action=del&id=' + did).success(function(data){
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
	        $('#display_icon_edit').val(tbl.row($(this).parents('tr')).data().id_icon).change();
	    }); 
	    
	    <?php if($_SESSION['role_usr'] == 1){ ?>
	    	select2trig();
	    <?php } ?>
	    	

	});

	function select2trig(){
		$("#select-kategori").select2({
		    placeholder: "Pilih Category",
	    });

	    $("#select-housing").select2({
	    	placeholder: "Pilih Group Housing"
	    });
	}



	function searchData(){

		tbl.ajax.reload();
	}

</script>