<?php require('library.php'); ?>
<title><?php echo basename($_SERVER["REQUEST_URI"]) ?></title>
<div class="container">
	<div class="row mt-5">
		<div class="col-md-3"></div>
		<div class="col-md-6 media">
			<span class="fa fa-exclamation-triangle mr-3 fa-7x"></span>
			<div class="media-body">
				<p><b>404.</b> That's an error</p>
				<p>The page you are looking for doen't exist or an either error occured</p>
				<p><a href="./">Go Back</a> to the home page.</p>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
