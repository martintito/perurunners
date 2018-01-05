    
    <div class="logopanel">
        <h1>PERU RUNNERS</h1>
    </div><!-- logopanel -->
        
    <div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <img alt="" src="images/photos/admin.png" class="media-object">
                <div class="media-body">
                    <h4><?php echo $_SESSION['full_name']; ?></h4>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Cuenta</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
               <li><a href="login.php?logout"><i class="fa fa-sign-out"></i> <span>Salir</span></a></li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Navegación</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li class="<?php if (isset($home) and $home==1){echo "active";}?>"><a href="index.php"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        
        
		
		<li  class="<?php if (isset($product_active) and $product_active==1){echo "active";}else {echo "";}?>"><a href="productslist.php"><i class="fa fa-barcode"></i> <span>Productos</span></a></li>
		
		<li  class="<?php if (isset($manufacturerslist_active) and $manufacturerslist_active==1){echo "active";}else {echo "";}?>"><a href="manufacturerslist.php"><i class="fa fa-tags"></i> <span>Fabricantes</span></a></li>
		<li class="<?php if (isset($category_active) and $category_active==1){echo "active";}else {echo "";}?>"><a href="categorylist.php"><i class="fa fa-list"></i> <span>Categorías</span></a></li>
		<li class="<?php if (isset($customers_active) and $customers_active==1){echo "active";}else {echo "";}?>"><a href="customerslist.php"><i class="fa fa-users"></i> <span>Clientes</span></a></li>
		<li class="<?php if (isset($quotes_active) and $quotes_active==1){echo "active";}else {echo "";}?>"><a href="quoteslist.php"><i class="fa fa-shopping-cart"></i> <span>Cotizaciones</span></a></li>
		<li class="<?php if (isset($pages_active) and $pages_active==1){echo "active";}else {echo "";}?>"><a href="pageslist.php"><i class="fa fa-file"></i> <span>Páginas</span></a></li>
		<li class="<?php if (isset($subscribers_active) and $subscribers_active==1){echo "active";}else {echo "";}?>"><a href="subscriberslist.php"><i class="fa fa-envelope-o"></i> <span>Suscriptores</span></a></li>
		
		<li class="<?php if (isset($slider_active) and $slider_active==1){echo "active";}else {echo "";}?>"><a href="sliderslist.php"><i class="fa fa-desktop"></i> <span>Slider </span></a></li>
		
		<li class="<?php if (isset($banner_active) and $banner_active==1){echo "active";}else {echo "";}?>"><a href="bannerlist.php"><i class="fa fa-film"></i> <span>Banner</span></a></li>

		
        <li class="nav-parent  <?php if (isset($access_active) and $access_active==1){echo "nav-active active";}else {echo "";}?>"><a href=""><i class="fa fa-cog"></i> <span>Configuración</span></a>
          <ul class="children" style="<?php if (isset($access_active) and $access_active==1){echo "display: block";}else {echo "";}?>">
            <li class="<?php if (isset($group_active) and $group_active==1){echo "active";}else {echo "";}?>"><a href="group_list.php"><i class="fa fa-caret-right"></i> Grupos de usuarios</a></li>
            <li class="<?php if (isset($users_active) and $users_active==1){echo "active";}else {echo "";}?>"><a href="user_list.php"><i class="fa fa-caret-right"></i> Usuarios</a></li>
			<li class="<?php if (isset($profile_active) and $profile_active==1){echo "active";}else {echo "";}?>"><a href="business_profile.php"><i class="fa fa-caret-right"></i> Empresa</a></li>
			<li class="<?php if (isset($modal_active) and $modal_active==1){echo "active";}else {echo "";}?>"><a href="modaledit.php"><i class="fa fa-caret-right"></i> Ventana modal</a></li>
          </ul>
        </li>
        
      </ul>
  </div><!-- leftpanelinner -->