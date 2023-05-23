<?php  
	$menu = array(
		array('text' => 'Dashboard', 	'url' => 'index', 'icon' => 'fa fa-th'),
		array('text' => 'Group', 		'url' => 'group', 'icon' => 'fa fa-user-friends'),
		array('text' => 'Request',	 	'url' => 'request', 'icon' => 'fa fa-bell'),
		array('text' => 'Analytics', 	'url' => 'analytics', 'icon' => 'fa fa-chart-area')
	);
	$basename = basename($_SERVER["REQUEST_URI"]);
    $dir = explode("?", $basename);
?>
<title><?php echo ucfirst(($dir[0] == 'cpanel' || $dir[0] ==  'index') ? 'dashboard' : $dir[0])?></title>
<ul class="nav nav-stacked">
    <?php foreach($menu as $item):?>
    	<?php if($item["url"] == "index"): ?>
    		<li class="<?php echo (($dir[0] == "index" || $dir[0] == "cpanel") ? "active-nav" : "") ?>"><a href="<?php echo $item["url"] ?>"><span class="<?php echo $item["icon"] ?>"></span> <?php echo $item["text"]; ?></a></li>
    	<?php else: ?>
    		<li class="<?php echo (($item["url"] == $dir[0]) ? "active-nav" : "") ?>"><a href="<?php echo $item["url"] ?>"><span class="<?php echo $item["icon"] ?>"></span> <?php echo $item["text"] ?></a></li>
    	<?php endif; ?>
    	
    <?php endforeach; ?>
 
</ul>
    

