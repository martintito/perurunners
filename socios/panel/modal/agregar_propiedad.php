	<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" id="datos_tecnicos">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Datos técnicos</h4>
			  </div>
			  <div class="modal-body">
				
					  <div class="form-group">
						<label for="propiedad" class="col-sm-2 control-label">Propiedad</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="propiedad" name="propiedad" placeholder="Propiedad" required>
							<input type="hidden" id="id_producto_ficha" name="id_producto_ficha" value="<?php echo $id_producto;?>">	
						</div>
					  </div>
					  <div class="form-group">
						<label for="valor" class="col-sm-2 control-label">Valor</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" required>
						</div>
					  </div>
					 
					 
					
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
				 </div>
			  </form>
			</div>
		  </div>
		</div>