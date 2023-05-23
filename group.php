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
  </div>
  <br><br><br>

  <div class="container ">
    <div class="row" id="content">
      <div class="col-md-3 pb-3">
        <div class="border bg-white ">
          <div class="card-header">Municipality</div>
          <div class="card-body">
            <div id="ld-mncplty-dstctv-rdo"></div>
          </div>
        </div>

        <div class="border bg-white mt-2">
          <div class="card-body">
            <ul class="list-unstyled">
              <li><span><span class="fa fa-star"></span> <a id="ld-num-group-list"></a></span></li>
              <li><span class="fa fa-users"></span> <a id="ld-num-member-list"></a></li>
            </ul>
         
          </div>
        </div>
        <?php if(!session::trigger() || session::get('account', 'type') == 'visitor'): else: $d = new Datalibrary(); ?>
        <div class="mt-4 border">
          <div class="card-body">
            <ul class="list-unstyled">
              <li><a href="#/pages">Pages</a></li>
              <li><a href="page?_rdr&pid=<?php echo $d->getHash(session::get('account', 'groupid'),'enc'); ?>&req_group=1#/group_source">Youth Organization</a></li>
              <li><a href="#/member">Member</a></li>
            </ul>
          </div>
        </div>
        <?php endif; ?>
      </div>
      <div class="col-md-9 pb-5 table-responsive">
        <div  class="hide page-content" id="g-lt-tble-group-list"></div>
      </div>
    </div>
  </div>

</body>
<script type="text/javascript" src="script/ugroup.js"></script>
