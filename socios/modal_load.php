<?php
if (isset($con)){ 
	$sql_modal=mysqli_query($con,"select * from modal where estado=1");
	$num_rw=mysqli_num_rows($sql_modal);
	if ($num_rw==1){
		$rw_modal=mysqli_fetch_array($sql_modal);
		$titulo_modal=$rw_modal['titulo'];
		$url_image_modal=$rw_modal['url_image'];
		$url_boton_modal=$rw_modal['url_boton'];
?>
<!-- Modal -->
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
               <a href="<?php echo $url_boton_modal;?>"><img src="img/banner/<?php echo $url_image_modal;?>" class="img-responsive" alt="<?php echo $titulo_modal;?>"><a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
	<?php 
	}
}	
	
	?>