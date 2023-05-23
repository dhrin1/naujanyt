<div class="mt-4">
	<a href="" class="text-muted float-right"><span class="fa fa-angle-left"></span> Back</a>
	<h4>My Profile</h4>

	<div class="col-md-12 mt-2">
		<div class="row">
			<div class="col-md-12 border bg-lingth" style="height: 20vh;">
				<span class="fa fa-user-circle fa-5x" style="margin-top:13vh; position: absolute;"></span>
			</div>
			<div class="col-md-12 border" style="margin-top:5vh;">
				<ul class="nav nav-tabs row border-0">
					<li class="nav-item"><a href="#profile-tab-content" data-toggle="tab" class="nav-link active">My Profile</a></li>
					<li class="nav-item"><a href="#post-tab-content" data-toggle="tab" class="nav-link">Post and Reviews</a></li>
					<li class="nav-item"><a href="#photos-tab-content" data-toggle="tab" class="nav-link">Photos</a></li>
				</ul>
			</div>

			<div class="col-md-12 tab-content mt-2">
				<div class="tab-pane active" id="profile-tab-content"></div>
				<div class="tab-pane" id="post-tab-content">
					<p>Post and Reviews</p>
				</div>
				<div class="tab-pane" id="photos-tab-content">
					<p>Photos</p>
				</div>
			</div>

			
			<!-- <div class="col-sm-9 form-group border">
				<div class="media">
					<div class="media-left pr-3"><span class="fa fa-user-circle fa-5x"></span></div>
					<div class="media-body">
						<h4>Alhdrin Gungon</h4>
					</div>	
				</div>
			</div> -->
		</div>
	</div>


</div>

<script type="text/javascript">
	$(()=>{

		let loadtheinfobyuserrequestbymemberpage = async () => await $.post('function/function.php', {load:'loadtheinfobyuserrequestbymemberpage'}, function(data){
			$('#profile-tab-content').html(data.info);
		},'json');

		loadtheinfobyuserrequestbymemberpage();
	})
</script>