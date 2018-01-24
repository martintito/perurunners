<div class="panel panel-default">
    <div class="panel-heading">
        <div class="box-header with-border">
            <h3 class="box-title">Editar artículo</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <form role="form" name="frmArticulosE" id="frmArticulosE" enctype="multipart/form-data" >
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label>Los campos con (*) son obligatorios</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 left">
                    <label>Categoría (*):</label>
                    <div class="form-group  has-success">
                        <input id="txtIdArticulo" type="hidden" maxlength="50" class="form-control" name="txtIdArticulo" required="" placeholder="" autofocus="" value="<?php echo $_GET["id"] ?>" />               
                        <select id="cboCategoriaE" name="cboCategoriaE" class="form-control">
                            <?php foreach ($arrayCategoria as $item) { ?>                    
                                <option value="<?php echo $item['idcategoria'] ?>" <?php if ($arrayArticulo['idcategoria'] == $item['idcategoria']) {
                                echo "selected";
                            } ?> ><?php echo $item['nombre'] ?></option>
<?php } ?>
                        </select>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 left">
                    <label>U. Medida (*):</label>
                    <div class="form-group  has-success">
                        <select id="cboUnidadMedidaE" name="cboUnidadMedidaE" class="form-control">
                            <?php foreach ($arrayUnidad as $item) { ?>                    
                                <option value="<?php echo $item['idunidad_medida'] ?>" <?php if ($arrayArticulo['unidad_medida'] == $item['nombre']) {
                                echo "selected";
                            } ?> ><?php echo $item['nombre'] ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">
                    <label>Nombre (*):</label>
                    <div class="form-group  has-success">                        
                        <input id="txtNombre" type="text" maxlength="50" class="form-control" name="txtNombre" required="" placeholder="Ingrese el nombre del artículo" autofocus="" value='<?php echo $arrayArticulo['nombre']; ?>'/>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
                    <label for="inputInscripcion">Descripción:</label>
                    <div class="form-group  has-success">

                        <textarea id="txtDescripcion" class="form-control" name="txtDescripcion" placeholder=""><?php echo $arrayArticulo['descripcion']; ?></textarea>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">
                    <label for="inputInscripcion">Imagen:</label>
                    <div class="form-group  has-success">

                        <input id="imagenArt" type="file" class="form-control" name="imagenArt" autofocus="" />
                        <input id="txtRutaImgArt" type="text" class="form-control" name="txtRutaImgArt" autofocus="" />
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
                    <h5></h5>
                    <button id="submitBtnE" class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Registrar</button>                                
                    <a href="Articulo.php" class="btn btn-primary" ><i class="fa fa-remove"></i> Cancelar</a>
                    <hr>
                    <span class="lead text-primary"></span>
                </div>
            </div>
        </form>
    </div>
</div>




