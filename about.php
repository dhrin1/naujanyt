<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  <div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    <?php require_once('include/header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-inline" align="center" style="margin-top: 3vh; ">
                    <li class="list-inline-item" ><a href="#/my-group"><span class="fa fa-users"></span> Your group</a></li>
                    <li class="list-inline-item" ><a href="#/discovery"><span class="fa fa-location-arrow"></span> Discover</a></li>
                    <li class="list-inline-item"><a href="#/settings"><span class="fa fa-cog"></span> Settings</a></li>
                </ul>
                <div id="content"></div>
                
            </div>
        </div>
  </div>
</body>
<script type="text/javascript" src="script/ugroup.js"></script>

