<div class="container contenedor_principal">
        
<div class ="col-xs-12 col-sm-12 col-md-3 col-lg-3 visible-lg">
	<div id="vt_menu">
	
         <ul class="navigation">
            <li><a href=""><i class="fa fa-home"></i>Categorías</a></li>
             
		<!-------- Menu Full -------->
		<?php
		$sql="select * from categorias where parent=0 order by nombre_categoria";
		$str=mysqli_query($con,$sql);
		while ($rw=mysqli_fetch_array($str)){
			$id_categoria=$rw["id_categoria"];
			$sql2="select * from categorias where parent='$id_categoria' order by nombre_categoria";
			$str2=mysqli_query($con,$sql2);
			$num=mysqli_num_rows($str2);
			if ($num>0){
			?>
		<li><a href="categoria/<?php echo intval($id_categoria);?>/<?php echo create_slug($rw['nombre_categoria'])?>"><i class="fa fa-pluss"></i><?php echo $rw['nombre_categoria'];?><span class="main_links_span"><i class="fa fa-angle-double-right"></i></span></a>
               <div class="typography_5_col">
                  <div class="col_5_container">
                     <h4><?php echo $rw['nombre_categoria'];?></h4>
                     <div class="col_3_fullwidth">
                       
					   <ol class="other_links">
					   <?php
							while  ($row2=mysqli_fetch_array($str2))
							{
								$id_categoria2=$row2['id_categoria'];	
								$nombre2=$row2["nombre_categoria"];
						?>
							
                        	<li><a href="categoria/<?php echo intval($id_categoria2);?>/<?php echo create_slug($rw['nombre_categoria'])?>/<?php echo create_slug($nombre2);?>"><i class="fa fa-check"></i><?php echo $nombre2;?></a></li>
                                                  
						<?php						
							}	
						?>		
                       	</ol>
                     </div>
                    
                     
                  </div>
               </div>
        </li>	
			<?php
			} else {
				?>
				<li><a href="categoria/<?php echo intval($id_categoria);?>/<?php echo create_slug($rw['nombre_categoria'])?>"><i class="fa fa-pluss"></i><?php echo $rw['nombre_categoria'];?><span class="main_links_span"><i class="fa fa-angle-double-right"></i></a></li>
				<?php 
			}
			
		}
		?>
		

           
         </ul>


      </div>
	  

</div>