<?php require_once("library.php"); ?>
<?php 
  require('classes.php');
  session::start();
  $d = new Datalibrary();
  $r = ($d->getattributeuser(session::get('account', 'accid')) == 'admin' ? 'main/cpanel' : '');
  header('location:'.$r);
 ?>

<div class="header-top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-lg-7 d-flex">
            <a href="./" class="site-logo">
            	<h4><img src="assets/images/logo/naujan_logo.png" width="10%;"> Naujan Youth: Official Website</h4>
            </a>
            <a href="#" class="ml-auto d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                class="icon-menu h3"></span></a>
          </div>
	      <div class="col-12 col-lg-5 ml-auto d-flex">
	         <div class="ml-md-auto top-social d-none d-lg-inline-block">
	            <a href="#" class="d-inline-block p-3"><span class="icon-facebook"></span></a>
	            <a href="#" class="d-inline-block p-3"><span class="icon-twitter"></span></a>
	            <a href="#" class="d-inline-block p-3"><span class="icon-instagram"></span></a>
	         </div>
	         <form action="#" class="search-form d-inline-block">
	              <div class="d-flex">
	                <input type="email" class="form-control" placeholder="Search...">
	                <button type="submit" class="btn btn-secondary" ><span class="icon-search"></span></button>
	              </div>
	         </form>
	      </div>
        </div>
      </div>
      <div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-0 d-lg-block" style="height: 65px; margin-top: -17px;" role="banner">
      <div class="container">
        <div class="d-flexes">
          <div class="mr-auto">
             <nav class="site-navigation position-relative navbar navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto site-menu main-menu js-clone-nav mr-auto d-none pl-0 d-lg-inline-block">
                  <?php  
                    $arg = array(

                      array('text' => 'Home', 'url'=> 'index'),
                      array('text' => 'Municipality', 'url'=> 'municipality'),
                      array('text' => 'Group', 'url'=> 'group'),
                      array('text' => 'Services', 'url'=> 'services'),
                      array('text' => 'Register', 'url'=>'register')

                    );
                    $curpage = basename($_SERVER['REQUEST_URI']);
                    $dir = explode("?", $curpage);
                  ?>
                  <title><?php echo  str_replace(".php", " ",ucfirst(($dir[0] == 'naujanyt' || $dir[0] == 'index') ? 'Home' : $dir[0])); ?> - Naujanyt</title>
                  <?php foreach($arg as $item): ?>
                    <?php if($item["url"] == "index"): ?>
                      <li class="<?php echo (($dir[0] == "index" || $dir[0] == "naujanyt") ? "active-link" : "")?> nav-link text-left"><a href="<?php echo $item["url"] ?>"><?php echo $item['text'] ?></a></li>
                    <?php else: ?>
                    <li class="<?php echo ($dir[0] == $item['url']) ? "active-link" : "" ?> nav-link text-left"><a href="<?php echo $item['url'] ?>"><?php echo $item["text"]; ?></a></li>
                   <?php endif; ?>
                   <?php if($item['url'] == 'services'): ?>
                      <?php break; ?>
                    <?php endif; ?> 
                  <?php endforeach; ?>

                   <li class="nav-item dropdown <?php echo (($arg[4]['url'] == $dir[0]) ? 'active-link' : ''); ?>">
                    <a class="nav-link navbarDropdownMenuLink dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Register
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="register#/member">Member</a>
                      <a class="dropdown-item" href="register#/visitor">Visitor</a>
                    </div>
                  </li>
                  </ul>
                   <ul class="ml-auto site-menu main-menu js-clone-nav">
                       <?php if(session::trigger()):  ?>
                      <li class="nav-item dropdown ml-auto">
                        <a class="nav-link  navbarDropdownMenuLink" href="#"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo session::get('account', 'name'); ?></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <?php if(session::get('account', 'type') != 'visitor'): ?>
                          <a  class="dropdown-item" href="page?_rdr&pid=<?php echo $d->getHash(session::get('account', 'groupid'), 'enc') ?>&req_page=1#/group_source">Organization</a>
                        <?php endif; ?>
                          <a class="dropdown-item" href="function/redirect?log=1">Logout</a>
                        </div>
                      </li>
                    <?php else: ?>
                      <li class="nav-link text-left" ><a  href="signin">Signin</a></li>
                    <?php endif; ?>
                  </ul>
                </div>
              </nav> 
          </div> 
        </div>
    </div>
  </div>
</div>
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>