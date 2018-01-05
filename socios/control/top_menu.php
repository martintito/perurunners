<?php
$user_id_db=$_SESSION['user_id_posv'];
?>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
		<?php if ($user_id_db==1){?>	
            <li class="<?php if (isset($active_productos)){echo $active_productos;}?>"><a href="productslist.php"><i class='glyphicon glyphicon-barcode'></i> Productos</a></li>
			<li class="<?php if (isset($active_fabricantes)){echo $active_fabricantes;}?>"><a href="manufacturerslist.php"><i class='glyphicon glyphicon-tags'></i> Fabricantes</a></li>
            <li class="<?php if (isset($active_categorias)){echo $active_categorias;}?>"><a href="categorylist.php"><i class='glyphicon glyphicon-list'></i> Categorías</a></li>
			<li class="<?php if (isset($active_clientes)){echo $active_clientes;}?>"><a href="customerslist.php"><i class='glyphicon glyphicon-user'></i> Clientes</a></li>
		<?php }?>	
			<li class="<?php if (isset($active_cotizaciones)){echo $active_cotizaciones;}?>"><a href="quoteslist.php"><i class='glyphicon glyphicon-shopping-cart'></i> Cotizaciones</a></li>
		<?php if ($user_id_db==1){?>	
			<li class="<?php if (isset($active_paginas)){echo $active_paginas;}?>"><a href="pageslist.php"><i class='glyphicon glyphicon-file'></i> Paginas</a></li>
			<li class="<?php if (isset($active_boletin)){echo $active_boletin;}?>"><a href="subscriberslist.php"> <i class='glyphicon glyphicon-envelope'></i> Suscriptores</a></li>
			<li class="dropdown <?php if (isset($active_config)){echo $active_config;}?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class='glyphicon glyphicon-cog'></i> Configuración <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="<?php if (isset($active_config)){echo $active_slider;}?>"><a href="sliderslist.php"><i class="glyphicon glyphicon-blackboard"></i> Slider principal</a></li>
            <li class="<?php if (isset($active_config)){echo $active_banner;}?>"><a href="bannerlist.php"><i class="glyphicon glyphicon-film"></i> Banner</a></li>
			<li class="<?php if (isset($active_config)){echo $active_modal;}?>"><a href="modaledit.php"><i class="glyphicon glyphicon-picture"></i> Ventana modal</a></li>
			<li class="<?php if (isset($active_usuarios)){echo $active_usuarios;}?>"><a href="userslist.php"><i class='glyphicon glyphicon-user'></i> Usuarios</a></li>
		<?php }?>	
          </ul>
        </li>
               
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
			 <li><a href="salir.php"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
           
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>