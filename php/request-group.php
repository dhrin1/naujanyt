<script type="text/javascript" src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> <!-- << ckeditor - ! it must redirect to content original script -->
<script type="text/javascript" src="library/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="library/font-awesome/css/fontawesome.min.css">

<div class="container">
	<div class="row">
		<?php require_once('nav-group.php'); ?>	
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<div class="tab-content">
						<div class="tab-pane active" id="home">
							<div class="row">
								<div class="col-md-12">
									<div class="sk-background border"></div>	
								</div>
								<div class="col-md-12" id="ld-ctrl-sub-a-dmn"></div>
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="post">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-sm-12">
													<div id="ld-div-post-ance-sc"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane mt-3" id="create">
									
									<form id="frm-article" method="post" enctype="multipart/form-data">
										
										<div id="msg-alert-pub"></div>
										<div class="form-group row">
											<div class="col-md-1 ">
												<button class="btn btn-success btn-sm">Publish</button>
											</div>
											<div class="col-md-11  pt-1 d-flex text-right">
												<p class="pr-3"><input type="radio" name="type" value="announcement"  checked=""> Announcement</p>
												<p class="pr-3"><input type="radio" name="type" value="news"> News</p>
												<p class="pr-3"><input type="radio" name="type" value="article"> Article</p>
											</div>
										</div>
										<input type="hidden" name="action" value="letcreatenewarticlefromgrouppage">
										<input type="hidden" name="group" id="txt-groupid-holder">
										 <textarea  class="ckeditor" id="editor" name="editor"></textarea>
						                <script>CKEDITOR.replace( 'editor' );</script>
									</form>
								
								</div>
								<div class="tab-pane mt-2" id="member">
									<small>
										<select id="mem-filter" class="float-right border-0">
											<option value="all">All</option>
											<option value="request">Request</option>
										</select>
									</small>
									<h5>Member</h5>
									
									<div id="ld-memb-u-grp-list" class="row"></div>
								
									<div class="modal" id="mdl-view-d-mem">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<label>Profile</label>
													<small data-dismiss="modal" class="close float-right btn-sm">&times;</small>
												</div>
												<div id="msg-alert-act"></div>
												<div class="modal-body media">
													<span class="fa fa-user-circle fa-3x mr-3"></span>
													<div class="media-body">
														<div class="row">
															<div class="form-group col-md-6">
																<label id="txt-fname"></label><br>
																<small class="text-muted">Full Name</small>
															</div>
															<div class="form-group col-md-3">
																<label id="txt-desig"></label><br>
																<small class="text-muted">Designation</small>
															</div>
															<div class="form-group col-md-3">
																<label id="txt-term"></label><br>
																<small class="text-muted">Term</small>
															</div>
														</div>
														<div class="row">
															<div class="form-group col-md-6">
																<label id="txt-paddre"></label><br>
																<small class="text-muted">Permanent Address</small>
															</div>
															<div class="form-group col-md-2">
																<label id="txt-age"></label><br>
																<small class="text-muted">Age</small>
															</div>
															<div class="form-group col-md-4">
																<label id="txt-gender"></label><br>
																<small class="text-muted">Gender</small>
															</div>
														</div>
														<hr>
														<div class="row">
															<div class="form-group col-md-6">
																<label id="txt-muni"></label><br>
																<small class="text-muted">Registered Municipality/State</small>
															</div>
														
														</div>
														<div class="row">
															<div class="form-group col-md-6">
																<label id="txt-email"></label><br>
																<small class="text-email">Email</small>
															</div>
															<div class="form-group col-md-6">
																<label id="txt-contact"></label><br>
																<small class="text-email">Contact Number</small>
															</div>
														
														</div>
														<hr>
														<div class="row">
															<div class="form-group col-md-12"  id="ld-ctrl-vrfy"></div>
														</div>
														
													</div>
												</div>
												<div class="modal-footer"></div>
											</div>
										</div>
									</div>
								
								</div>
								<div class="tab-pane" id="profile"><h4>Profile</h4></div>
							</div>
							</div>
						<div class="tab-pane" id="announcement">Announcement</div>
						<div class="tab-pane" id="activity">Activity</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="script/reqpage.min.js"></script>
