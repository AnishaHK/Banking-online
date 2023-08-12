<?php
include("header.php");
include("sidebar.php");
?>
          <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <ol class="breadcrumb">
            <li><a href="index.html">Admin Panel</a></li>
            <li><a href="#">Maps</a></li>
            <li class="active">Location</li>
          </ol>
          <h1>Maps</h1>
          <p>Credit goes to <a href="http://jqvmap.com">JQVMap</a></p>         
          <div class="templatemo-maps">
            <div class="row">
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">World</h4>
                  </div>
                  <div class="panel-body">
                    <div id="vmap_world" class="vmap"></div>
                  </div>
                </div>                
              </div>
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">United States of America</h4>
                  </div>
                  <div class="panel-body">
                    <div id="vmap_usa" class="vmap"></div>
                  </div>
                </div>  
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">Asia</h4>
                  </div>
                  <div class="panel-body">
                    <div id="vmap_asia" class="vmap"></div>
                  </div>
                </div>  
              </div>
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">Europe</h4>
                  </div>
                  <div class="panel-body">
                    <div id="vmap_europe" class="vmap"></div>
                  </div>
                </div>  
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">Australia</h4>
                  </div>
                  <div class="panel-body">
                    <div id="vmap_australia" class="vmap"></div>
                  </div>
                </div>  
              </div>
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">Africa</h4>
                  </div>
                  <div class="panel-body">
                    <div id="vmap_africa" class="vmap"></div>
                  </div>
                </div>  
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">North America</h4>
                  </div>
                  <div class="panel-body">
                    <div id="vmap_northamerica" class="vmap"></div>
                  </div>
                </div>  
              </div>
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">South America</h4>
                  </div>
                  <div class="panel-body">
                    <div id="vmap_southamerica" class="vmap"></div>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>

     <?php
	 include("footer.php");
	 ?>
	 