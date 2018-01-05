<!DOCTYPE html>
<html lang="en">
<head>
<?php include("view/head.php");?>
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <div class="leftpanel">
	<?php include("view/leftpanel.php");?>
  </div><!-- leftpanel -->
  
  <div class="mainpanel">
    
    <div class="headerbar">
		<?php include("view/headerbar.php"); ?>
    </div><!-- headerbar -->
    
    <div class="pageheader">
      <?php include("view/pageheader.php");?>
    </div>
    
    <div class="contentpanel">
      <?php if ($permisos_ver==1){?>
      <div class="row">
        
        <div class="col-sm-6 col-md-4">
          <div class="panel panel-success  panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                     <img src="images/icomoon-free_2014-12-23_barcode_64_0_ffffff_none.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">TOTAL DE PRODUCTOS</small>
                    <h1><?php echo count_products();?></h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>
                
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <small class="stat-label">Inactivos</small>
                    <h4><?php count_products_status(0);?></h4>
                  </div>
				  
				  <div class="col-xs-4 text-center">
                    <small class="stat-label">En stock</small>
                    <h4><?php count_products_status(1);?></h4>
                  </div>
				  <div class="col-xs-4 text-center">
                    <small class="stat-label">Disponibles</small>
                    <h4><?php count_products_status(2);?></h4>
                  </div>
                  
                  
                </div><!-- row -->
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-4">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="images/fa-user_64_0_ffffff_none.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">TOTAL DE CLIENTES</small>
                    <h1><?php echo count_customers();?></h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>
                
                <small class="stat-label">Nuevos clientes</small>
                <h4 ><?php new_customers();?></h4>
                  
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        <div class="col-sm-6 col-md-4">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              
			 
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="images/font-awesome_4-6-3_shopping-cart_64_0_ffffff_none.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">TOTAL DE COTIZACIONES</small>
                    <h1><?php echo count_quotes();?></h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>
                
               <div class="row">
                  <div class="col-xs-4 text-center">
                    <small class="stat-label">Aceptadas</small>
                    <h4><?php count_quotes_status(1);?></h4>
                  </div>
                  
                  <div class="col-xs-4 text-center">
                    <small class="stat-label">Pendientes</small>
                    <h4><?php count_quotes_status(0);?></h4>
                  </div>
				  
				  <div class="col-xs-4 text-center">
                    <small class="stat-label">Rechazadas</small>
                    <h4><?php count_quotes_status(2);?></h4>
                  </div>
                </div><!-- row -->
                  
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
        
        
      </div><!-- row -->
	  
	 <div class="row">
              <div class="col-md-12 mb30">
                  <div id="chart_div"></div>
              </div><!-- col-md-12 -->
              
            </div><!-- row -->
			 
			 
			
      <?php 
	  } 
		
	  ?>
    </div><!-- contentpanel -->
    
  </div><!-- mainpanel -->
  

  
  
</section>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/toggles.min.js"></script>
<script src="js/retina.min.js"></script>
<script src="js/jquery.cookies.js"></script>


<script src="js/flot/jquery.flot.min.js"></script>
<script src="js/flot/jquery.flot.resize.min.js"></script>
<script src="js/flot/jquery.flot.symbol.min.js"></script>
<script src="js/flot/jquery.flot.crosshair.min.js"></script>
<script src="js/flot/jquery.flot.categories.min.js"></script>
<script src="js/flot/jquery.flot.pie.min.js"></script>

<script src="js/raphael-2.1.0.min.js"></script>

<script src="js/custom.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
 google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
		['Mes', 'Aceptadas', 'Rechazadas', 'Pendientes'],
		<?php
			 
			 $month=5;
			 while ($month>=0){
				 $fecha_hoy=date("Y-m-d");
			 $Ffecha = date ( "Ymd", strtotime (  "-$month month", strtotime(  $fecha_hoy ) ) );
			 $mes_anio=date ( "m-Y", strtotime ($Ffecha ) );
			 $mes=date ( "m", strtotime ($Ffecha ) );
			 $anio=date ( "Y", strtotime ($Ffecha ) );
			 
			 //$rechazadas=quotes_month($anio,$mes,2);
			 //$pendientes=quotes_month($anio,$mes,0);
			 $sql=mysqli_query($con,"select * from cotizaciones where estado='1' and year(fecha) = '$anio' and month(fecha)= '$mes'");
			$aceptadas=mysqli_num_rows($sql);
			$sql=mysqli_query($con,"select * from cotizaciones where estado='2' and year(fecha) = '$anio' and month(fecha)= '$mes'");
			$rechazadas=mysqli_num_rows($sql);
			$sql=mysqli_query($con,"select * from cotizaciones where estado='0' and year(fecha) = '$anio' and month(fecha)= '$mes'");
			$pendientes=mysqli_num_rows($sql);
			?>
			['<?php echo $mes_anio; ?>', <?php echo $aceptadas;?>, <?php echo $rechazadas;?>, <?php echo $pendientes;?>],
			<?php
				 
				 $month--;
			 }
		?>          
        ]);

        var options = {
          chart: {
            title: 'TOTAL DE COTIZACIONES POR MES',
            subtitle: 'Reporte de los ultimos 6 meses',
          },
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          height: 500,
          colors: ['#1b9e77', '#d95f02', '#d9534f']
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

        var btns = document.getElementById('btn-group');

        btns.onclick = function (e) {

          if (e.target.tagName === 'BUTTON') {
            options.vAxis.format = e.target.id === 'none' ? '' : e.target.id;
            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        }
      }
</script>

</body>
</html>
