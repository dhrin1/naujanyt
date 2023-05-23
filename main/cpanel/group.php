<?php require_once('library.php'); ?>
<?php require_once('include/header.php'); ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
			 <?php require_once('include/nav.php'); ?>
		</div>
		<div id="content">
			<div class="col-md-10">	
				<div class="pull-right">
					<ul class="list-inline">
						<li><a class="text-muted btn" id="btn-add-nw-muncplty"><span class="fa fa-plus"></span> Create</a></li>
					</ul>
				</div>
				<h4>Group</h4>
			</div>
			<div class="col-md-10" >
				
				<div class="table-reponsive">
					<table  class="table table-hover table-condensed borderless" id="tbl-municipality">
						<thead>
							<tr>
								<td><small>ID</small></th>
								<td><small>City</small></td>
								<td><small>State</small></td>
								<td class="text-center"><small>Member</small></td>
								<td class="text-center"><small>Control</small></td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>		
	</div>	
</div>

<script  src="../../script/main.js"></script>	
<script  src="../../script/group.js"></script>	