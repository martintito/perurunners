	<a class="menutoggle"><i class="fa fa-bars"></i></a>
     <div class="header-right">
        <ul class="headermenu">
         <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="images/photos/admin.png" alt="" />
                <?php 
					//echo $_SESSION['full_name']; 
					echo $_SESSION['empleado']; 
				?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="login.php?logout"><i class="fa fa-sign-out"></i> <span>Salir</span></a></li>				
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->