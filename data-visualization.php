<?php
include("header.php");
include("sidebar.php");
?>
  
        <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <ol class="breadcrumb">
            <li><a href="index.html">Admin Panel</a></li>
            <li><a href="#">Data Visualization</a></li>
            <li class="active">Charts</li>
          </ol>
          <h1>Data Visualization</h1>
          <p>Credit goes to <a href="http://www.chartjs.org">chartjs.org</a></p>         
          <div class="templatemo-charts">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-info">
                  <div class="panel-heading">Pie Chart &amp; Doughnut Chart</div>
                </div>
                <div class="row templatemo-chart-row">

                  <div class="templatemo-chart-box col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <canvas id="templatemo-pie-chart"></canvas>
                    <h4>Pie Chart</h4>
                    <span class="text-muted">Maecenas non</span>  
                  </div>
                  
                  <div class="templatemo-chart-box col-lg-3 col-md-3 col-sm-4 col-xs-12">           
                    <canvas id="templatemo-doughnut-chart"></canvas>
                    <h4>Doughnut Chart</h4>
                    <span class="text-muted">Sodales orci aliquet</span> 
                  </div>
                  
                  <div class="templatemo-chart-box col-lg-3 col-md-3 col-sm-4 col-xs-12">           
                    <canvas id="templatemo-radar-chart"></canvas>
                    <h4>Radar Chart</h4>
                    <span class="text-muted">Lorem sed</span> 
                  </div>

                  <div class="templatemo-chart-box col-lg-3 col-md-3 col-sm-4 col-xs-12">           
                    <canvas id="templatemo-polar-chart"></canvas>
                    <h4>Polar Area Chart</h4>
                    <span class="text-muted">Curabitur</span> 
                  </div>

                </div>                  
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="panel panel-success">
                  <div class="panel-heading">Line Chart</div>
                  <canvas id="templatemo-line-chart"></canvas>
                </div>                       
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="panel panel-primary">
                  <div class="panel-heading">Bar Chart</div>
                  <canvas id="templatemo-bar-chart"></canvas>
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
      
      
<?php
include("footer.php");
?>