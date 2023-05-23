<?php  
	require('../classes.php');
	date_default_timezone_set('Asia/Manila');
	session::start();
	$datahelper = new Datahelper();
	$datalibrary = new Datalibrary();
	$groupid = session::get('request', 'groupid');
	$userid	= session::get('account', 'accid');
	$accgid = session::get('account', 'groupid');
	
	if(!empty($_POST)){
		if(isset($_POST["action"])){
			$action = $_POST["action"];
			if($action == 'getrequestocreategroup'){

				$fields = array(
					':id'				=>		$datalibrary->generateid(),
					':state'			=>		$_POST["state"],
					':city'				=>		$_POST["city"],
					':security' 		=>	 	isset($_POST["security"]) ? 'A' : 'B',
					':post'				=>		isset($_POST["post"]) ? 'A' : 'B',
					':assign'			=>		isset($_POST["assign"]) ? 'A' : 'B',
					':banned'			=>		isset($_POST["banned"]) ? 'A' : 'B',
					':stat'				=>		'A',
					':dtview'			=>		'A'
				);

				$request = $datahelper->SQLCUD("INSERT INTO tblgroupattr (id, state, city, security, post, assign, banned, status, dtview) VALUES(:id, :state, :city, :security, :post, :assign, :banned, :stat, :dtview)", $fields);
				echo $request ? 'New state successfully created' : 'Unable to process this request';



			}


			if($action == 'letchangeathegroupcontroladmin'){

				$parsing = $_POST["parse"];
				$id = $_POST["id"];
				if($parsing == "groupRemove"):
					$request = $datahelper->SQLCUD("DELETE FROM tblgroupattr WHERE id=:id",[":id"=>$id]);
				echo $request ? "Delete" : "Failed";
				elseif($parsing == "groupAct"):
					$request = $datahelper->SQLCUD("UPDATE  tblgroupattr SET status = CASE WHEN status = 'A' THEN 'B' ELSE 'A' END WHERE id=:id",[":id"=>$id]);
				endif;
			}

			if($action == 'leteditthecontentthetitle'){
				$fields = array(
					':state' 	=> 	$_POST["value"],
					':id'		=>	$_POST["id"]
				);
				$request = $datahelper->SQLCUD("UPDATE tblgroupattr SET state=:state WHERE id=:id", $fields);
			}

			if($action == 'letmemberegisterthenewgroup'){
				$entryid = $fname = $mname = $lname = $address = $gender = $dob = $cntnumber = $term = $city = $state = $desig = $email = $password = null;
				$fname = $_POST["fname"];
				$mname = $_POST["mname"];
				$lname = $_POST["lname"];
				$address = $_POST["address"];
				$gender = $_POST["gender"];
				$dob = $_POST["dob"];
				$cntnumber = $_POST["contact"];
				$term = $_POST["term"];
				$city = $_POST["city"];
				$state = $_POST["state"];
				$desig = $_POST["designation"];
				$email = $_POST["email"];
				$password = $_POST["password"];
				$pass_encrypt = password_hash($password, PASSWORD_BCRYPT);
				$entryid = $datalibrary->generateid();

				$fieldsf = array(
					':id'			=> 	$entryid,
					':fname'		=>	$fname,
					':mname'		=>	$mname,
					':lname'		=>	$lname,
					':address'		=>	$address,
					':dob'			=> 	$dob,
					':gender'		=>	$gender,
					':cntct'		=>	$cntnumber,
					':trm'			=>	$term,
					':desig'		=>	$desig,
					':stat'			=>	'A'
				);
				$fieldss = array(':accid' => $entryid, ':grpid'=>$state, ':typeid'=>'233013024', ':email'=>$email, ':pass'=>$pass_encrypt, ':stat' => 'A');

				$sqlinsertf = $datahelper->SQLCUD("INSERT INTO tblaccinfo (id, firstname, middlename, lastname, address, dob, gender, contact, term, designation, status ) VALUES(:id, :fname, :mname, :lname, :address, :dob, :gender, :cntct, :trm, :desig, :stat)", $fieldsf);
				$sqlinserts = $datahelper->SQLCUD("INSERT INTO tblaccattr (accid, groupid, typeid, email, password, status) VALUES(:accid, :grpid, :typeid, :email, :pass, :stat)", $fieldss);

				if($sqlinsertf && $sqlinserts):
					session::set('request', array(
						'groupid'	=>	$state
					));

					$reqFields = array(
						':id'			=>	$datalibrary->generateid(),
						':uid'			=>	$entryid,
						':gid'			=>	$state,
						':step'			=>	'R',
						':stat'			=>	'N',
						':dtv'			=>	'A'
					);
				$reqgroup = $datahelper->SQLCUD('INSERT INTO tblugroup (id, userid, groupid, step, status, dtview) VALUES(:id, :uid, (SELECT a.id FROM tblgroupattr a WHERE a.id = :gid AND a.dtview IN ("A")), :step, :stat, :dtv)', $reqFields);

				endif;

				

			}

			if($action == 'letsigninrequestforthedbreqand'){
				$output = array();
				$email = $_POST["email"];
				$pass = $_POST["password"];
				$dtble = $datahelper->SQLROW("SELECT a.password AS pswd, b.id AS accid, a.groupid AS grpid, IFNULL((SELECT t.description FROM tblacctype t INNER JOIN tblaccattr r ON t.id = r.typeid WHERE r.accid = a.accid), 'undefined') AS type, CONCAT(b.firstname,' ',b.lastname) AS fname FROM tblaccattr a INNER JOIN tblaccinfo b ON a.accid = b.id WHERE a.email = :email", [":email"=>$email]);
				if($dtble):
					if(password_verify($pass, $dtble["pswd"])):
						session::set('account', 
							array(
								'accid'		=>	$dtble['accid'],
								'groupid'	=>	$dtble['grpid'],
								'name'		=>	$dtble['fname'],
								'type'		=>	$dtble["type"]	
							)
						);
						if(!empty($_POST["remember"])){
									setcookie("set_email", $email, time() + (10 * 365 * 24 * 60 * 60));
									setcookie("set_pass", $pass, time() + (10 * 365 * 24 * 60 * 60));
									
								}else{

									if(isset($_COOKIE["set_email"])){
										setcookie("set_email", ''); 
									}
									if(isset($_COOKIE["set_pass"])){
										setcookie("set_pass", '');
									}
						}
					else:
						$output["pass"]	= "Incorrect Password";
					endif;
					
				else:
					$output["email"] = "Incorrect Email";
				endif;

				echo json_encode($output);
			}

			if($action == 'letapprovedadminsubadminfromgroup'){
				$output = null;
				$id = $_POST["id"];
				$request = $datahelper->SQLCUD("UPDATE tblugroup b SET b.step = IF(b.step = 'R', 'A', 'R'), b.status = IF((SELECT c.designation FROM tblaccinfo c WHERE c.id = b.userid) = 'Chairman', 'F', 'M') WHERE b.id = :id;UPDATE tblaccattr a  SET a.typeid = (CASE WHEN (SELECT b.status FROM tblugroup b WHERE b.id = :id) = 'F' THEN (SELECT c.id FROM tblacctype c WHERE c.description = 'subadmin') ELSE (SELECT c.id FROM tblacctype c WHERE c.description = 'user') END ) WHERE a.accid = (SELECT d.userid FROM tblugroup d WHERE d.id = :id)", [":id"=>$id]);
					echo $request ? "You have been change status" : "Dismiss"; 
			}

			if($action == 'letcreatenewarticlefromgrouppage'){
				
				$dataid = $datalibrary->generateid();
				$content = $_POST['editor'];
				$groupid = $datalibrary->getHash($_POST["group"], 'dec');	
				$dtpost = date('Y-m-d h:i:s A');
				$title = 'This is Article';
				$type = $_POST["type"];

				$fields = array(

					// Content
					':id'		=>	$dataid,
					':title'	=>	$title,
					':content'	=>	$content,
					':stat'		=>	'A',
					':dtview'	=>	'A',
					// Attribute
					':pid'		=>	$dataid,
					':gip'		=>	$groupid,
					':postby'	=>	$userid,
					':type'		=>	$type,
					':dtpost'	=>	$dtpost,

				);
				if(!empty($_POST["editor"])):
				$request = $datahelper->SQLCUD("INSERT INTO tblpost (id, title,content, status,dtview) VALUES(:id,:title,:content,:stat,:dtview); INSERT INTO tblpostattr (postid, groupid, postby, type, dtpost, status, dtview  ) VALUES(:pid, :gip, :postby, :type, :dtpost, :stat, :dtview)",$fields);

				echo $request ? "Published" : "";
				else:
					echo "No article writen";
				endif;
				
			}

			if($action == 'letremovethepostbyadminart'){
				$postid = $_POST["id"];
				$parsing = $_POST["parse"];
				if($parsing == 'getRpost'):
					$verify = $datahelper->SQLROW("SELECT a.step FROM tblugroup a WHERE a.userid = :uid AND a.status IN ('F', 'M')", [":uid"=>$userid]);
					if($verify):
						$request = $datahelper->SQLCUD("DELETE FROM tblpost  WHERE id = :pid; DELETE FROM tblpostattr WHERE postid = :pid", [":pid"=>$postid]);
					endif;
				endif;
			}

			if($action == 'letaddthenewprofilingsubmitbysadmin'){
				$grpid = $fname = $lname = $age = $gender = $year = $decr  = null;

				$grpid = $datalibrary->getHash($_POST["groupid"], 'dec');
				$fname = $_POST["fname"];
				$lname = $_POST["lname"];
				$gender = $_POST["gender"];
				$age = $_POST["age"];
				$decr = $_POST["descr"];
				$year = $_POST["year"];

				$fields = array(
					':id' 		=> 	$datalibrary->generateid(),
					':gid'		=>	$grpid,
					':fname'	=>	$fname,
					':lname'	=>	$lname,
					':gendr'	=>	$gender,
					':age'		=>	$age,
					':descr'	=>	$decr,
					':year'		=>	$year,
					':dtise'	=>	$datalibrary->getcurtime(),
					':status'	=>	'A',
					':dtvi'		=>	'A',
					':isby'		=>	$userid
				);

				$request = $datahelper->SQLCUD("INSERT INTO tblprofile (id, gid, fname, lname, gender, age, descr, year, dtissue, status, dtview, issueby)
					VALUES (:id, :gid, :fname, :lname, :gendr, :age, :descr, :year, :dtise, :status, :dtvi, :isby)", $fields);
				echo $request ? "You have been submitted to new profile" : "Failed to process, Server Error(500)";

			}

			if($action == 'letupdateprofilinginfowheresubadact'){
				$parse = $_POST["parse"];
				$col = $_POST["fields"];
				if($parse == 'upInfo'):


					if($col == "fname"){
						$name = $id = null;
						$name = explode(" ", $_POST["value"]);
						$id = $_POST["id"];
						$fields = array(
							':fname' 	=> $name[0],
							':lname'	=>	$name[1],
							':id'		=>	$id
						);
						$request = $datahelper->SQLCUD("UPDATE tblprofile SET fname=:fname, lname=:lname WHERE id=:id",$fields);
					}
					if($col == "age"){
						$age = $id = null;
						$age = $_POST["value"];
						$id = $_POST["id"];
						$fields = array(
							':age'	=>	$age,
							':id'	=>	$id
						);
						$request = $datahelper->SQLCUD("UPDATE tblprofile SET age=:age WHERE id=:id",$fields);
					}
					if($col == "gender"){
						$gender = $id = null;
						$gender = $_POST["value"];
						$id = $_POST["id"];
						$fields = array(
							':gender'	=>	$gender,
							':id'		=>	$id
						);
						$request = $datahelper->SQLCUD("UPDATE tblprofile SET gender=:gender WHERE id=:id",$fields);
					}
					if($col == "type"){
						$type = $id = null;
						$type = $_POST["value"];
						$id = $_POST["id"];
						$fields = array(
							':type'		=>	$type,
							':id'		=>	$id
						);
						$request = $datahelper->SQLCUD("UPDATE tblprofile SET descr=:type WHERE id=:id",$fields);
						echo $request ? 'update' : 'no';
					}
					
				endif;
			}

			if($action == 'letresgiterthesuserbyregular'){
				$output = null;
				$fname = $lname = $paddress = $gender = $contact = $dob = $email = $password = $entryid =  null;
				$fname = $_POST["fname"];
				$lname = $_POST["lname"];
				$gender = $_POST["gender"];
				$paddress = $_POST["paddress"];
				$contact = $_POST["contact"];
				$dob = $_POST["dob"];
				$email = $_POST["email"];
				$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
				$entryid = $datalibrary->generateid();
				$fields_A = array(
					':id'		=>	$entryid,
					':fname'	=>	$fname,
					':lname'	=>	$lname,
					':address'	=>	$paddress,
					':dob'		=>	$dob,
					':gender'	=>	$gender,
					':contact'	=>	$contact,
					':status'	=>	'A'
				);

				$fields_B = array(
					':id'		=>	$entryid,
					':typeid'	=>	'862638129',
					':email' 	=>	$email,
					':pass'		=>	$password,
					':status'	=>	'A'
					
				);

				$request = $datahelper->SQLCUD("INSERT INTO tblaccinfo (id, firstname, lastname, address, dob, gender, contact, status) VALUES(:id, :fname, :lname, :address, :dob, :gender, :contact, :status)", $fields_A);
				$request1 = $datahelper->SQLCUD("INSERT INTO tblaccattr (accid, typeid, email, password, status) VALUES(:id, :typeid, :email, :pass, :status)", $fields_B);
				echo $request && $request1 ? "ok" : "Failed";
			}

		}

		if(isset($_POST["load"])){



			$load = $_POST["load"];

			if($load == 'getCookieloaduser'){
				$output  = array();
				if(!empty($_COOKIE)){
					$output["email"] = $_COOKIE["set_email"];
					$output["pass"] = $_COOKIE["set_pass"];
					
				}
				echo json_encode($output);
			}

			if($load == 'loadthestatetablewithdatatble'){	
				function checkAttr($val){
					return (($val == 'A') ? '<center><small><span class="fa fa-check-circle text-success"></span></small></center>' : '<center><small><span class="fa fa-times-circle text-danger"></span></small></center>');
				}
				$valueOf = $_POST["cty"];
				$dtble = $datahelper->SQLROWS("SELECT a.id AS id, a.city AS city, a.status AS view, a.state AS brgy, (SELECT COUNT(*) FROM tblugroup b WHERE b.groupid = a.id) AS memnum   FROM tblgroupattr a WHERE a.city IN (:cty) AND a.dtview IN ('A', 'B')", [":cty"=>$valueOf]);
				foreach($dtble as $num => $row):
					$data = array();
					$data[] = $row->id;
					$data[] = $row->city;
					$data[] = '<div contenteditable class="inputedit" data-id="'.$row->id.'">'.$row->brgy.'</div>';
					$data[]	= '<center><a href="?r='.$row->brgy.'&i='.$datalibrary->getHash($row->id, 'enc').'#/member" >'.$row->memnum.'</a></center>';
					$data[] = '<center><small><a class="btn btn-xs text-muted" id="btn-acti-ctrl-group" data-id="'.$row->id.'">'.(($row->view == 'A') ? 'Dismiss' : 'Activate').'</a> <a class="btn btn-xs text-muted" id="btn-remove-ctrl-group" data-id="'.$row->id.'">Remove</a> </small></center>';
					$r["data"][] = $data;
				endforeach;
				echo json_encode($r);
			}



			if($load == 'loadcomponentmemberRequest'){
				$id = $datalibrary->getHash($_POST["id"], 'dec');
				$data = array();
				$dataTitle = $dataCol = null;
				$dtble = $datahelper->SQLROWS("SELECT b.userid AS uid, b.status AS stat, IFNULL(a.state, '0') AS state, b.step AS statStep, b.id AS memberid ,IFNULL((SELECT CONCAT(c.firstname,' ',c.lastname,' ',c.designation) FROM tblaccinfo c WHERE c.id = b.userid), ' ') AS memberInfo FROM tblgroupattr a LEFT JOIN tblugroup b ON b.groupid =  a.id WHERE a.id = :id", [":id"=>$id]);
				foreach($dtble as $num => $row):
					$dataTitle = $row->state;

					if($row->memberInfo == ' '):
						$dataCol .= '<div class="col-md-12"><div class="jumbotron"></div></div>';
					else:
						$info = explode(" ", $row->memberInfo);
						$dataCol .= '<a class="cursor-pointer" id="btn-view-info-member" data-vid="'.$row->uid.'">
										<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body media">
												<div class="media-left">
													<span class="fa fa-user-circle text-muted fa-3x"></span>
												</div>
												<div class="media-body">
													<h4>'.$info[0].' '.$info[1].' '.($info[2] == 'Chairman' ? '<span class="fa fa-star text-warning"></span>' : '').'</h4>
													<small class="text-muted">SK '.$info[2].'</small>
												</div>	
											</div>	</a>
											<div class="panel-footer">
												<small class="text-muted">'.(($info[2] == 'Chairman' && $row->stat == 'F') ?  'Founder' : 'Member').'</small>
												<small class="pull-right">'.(($info[2] == 'Chairman') ? '<a class="btn btn-xs" id="btn-apr-b-admin"  data-vid="'.$row->memberid.'" >'.(($row->statStep == 'R') ? 'Approved' : 'Dismiss').'</a>' : '' ).'</small>

											</div>
										</div>
								  		</div>
								  ';	
					endif;
				endforeach;
				// 
				$data["colSpan"] = $dataCol;
				$data["title"] = $dataTitle;
				echo json_encode($data);
				
			}


			if($load == 'loadthegrouplistbytable'){
				$parse = $_POST["parse"];
				
				if($parse == 'getTable'):
						$data = array(); $html = null;
						$cty = $_POST["cty"];
						$dtble = $datahelper->SQLROWS("SELECT a.*, IFNULL((SELECT COUNT(DISTINCT b.postid) FROM tblpostattr b WHERE b.groupid = a.id),0) AS numPost, IFNULL((SELECT COUNT(DISTINCT c.userid) FROM tblugroup c WHERE c.groupid = a.id),0) AS numOffi, IFNULL((SELECT COUNT(DISTINCT d.id) FROM tblprofile d WHERE d.gid = a.id AND d.status IN ('A') AND d.year = (SELECT DISTINCT(MAX(e.year)) FROM tblprofile e)),0) AS numMember   FROM tblgroupattr a WHERE a.dtview = 'A' AND a.city=:city ORDER BY a.state ASC", [":city"=>$cty]);
						$html .= '<table class="table table-condensed borderless" id="table-group-list">
									<thead>
										<tr><td>Page</th></td>
									</thead>
									<tbody>
										';
						foreach($dtble as $num => $row):
							$html .= '<tr>
										<td class="text-muted"><a href="page?_rdr&pid='.$datalibrary->getHash($row->id, "enc").'&req_page='.$row->state.'#/group_source" class="cursor-pointer" >
							 				<div class="card">
							 					<div class="card-body">
							 						<div class="media">
							 							<div class="media-heading pr-3 ">
							 								<img src="assets/images/logo/sk.png" class="rounded-circle border" style="width:10vh;" />
							 							</div>
							 							<div class="media-body ">
							 								<h6 class="card-text">Sangguniang Kabataan of '.$row->state.'</h6>
							 								<ul class="list-inline small">
							 									<li class="list-inline-item">Post and reviews ('.$row->numPost.')</li>
							 									<li class="list-inline-item">Officials ('.$row->numOffi.')</li>
							 									<li class="list-inline-item">Members ('.(($row->numMember >= 1) ? $row->numMember : $row->numMember).')</li>
							 								</ul>
							 							</div>
							 						</div>
							 					</div>	
							 				</div>
							 			</a></td>
									  </tr>';

							$data["getTable"]  = $html;		  
						endforeach;
						$html .= '<tbody>
								</table>';
						echo json_encode($data);	
					
					
				elseif($parse == 'getCount'):
					$cty = $_POST["cty"];
					$data = array();
					$dtble = $datahelper->SQLROW("SELECT COUNT(DISTINCT a.state) AS numState, a.city AS cname, (SELECT COUNT(b.userid) FROM tblugroup b WHERE b.step = 'A' AND b.status IN ('F', 'M') ) AS cntMem FROM tblgroupattr a WHERE a.dtview=:view AND a.city=:cty",[":view"=>'A', ":cty"=>$cty]);
					$data["attr"] = $dtble["numState"].' List of barangay in ('.$dtble["cname"].')';
					$data["member"] = $dtble["cntMem"].' Registered Officials';
					echo json_encode($data); 
				endif;



			}

			if($load == 'loadthetitlestateindatasortbydistinct'){
				$output = array();
				$dtble = $datahelper->SQLROWS("SELECT * FROM tblgroupattr WHERE dtview=:view", [":view"=>'A']);
				foreach($dtble as $row):
				$output[] = array("state"=>$row->state, "id"=>$row->id);
				endforeach;
				echo json_encode($output);
			}

			if($load == 'loadthedesignatedstatelidbgetdrop'){
				$output = array();
				$parsing = $_POST["parse"];

				if($parsing == 'getCity'){
					$dtble = $datahelper->SQLROWS("SELECT DISTINCT(city) AS cty FROM tblgroupattr WHERE dtview=:view",[":view"=>'A']);
					if($dtble):
						foreach($dtble as $row):
							$output[] = array("city" => $row->cty);
						endforeach;
						echo json_encode($output);
					endif;
				}

				if($parsing == 'getState'){
					$dtble = $datahelper->SQLROWS("SELECT state AS state, id AS id FROM tblgroupattr WHERE city =  :city AND dtview='A' ", [":city"=>$_POST["city"]]);
					foreach($dtble as $row):
						$output[] = array("state"=> $row->state, "id" => $row->id);
					endforeach;
					echo json_encode($output);
				}
			}

			if($load == 'loadtheattributegroupcomponentname'){
				$output = array();
				$id = $datalibrary->getHash($_POST["id"], "dec");
				$dtble = $datahelper->SQLROW("SELECT * FROM tblgroupattr WHERE id=:id  AND dtview=:view", [":id"=> $id, ":view"=>'A']);
				$output = array(
					'state' 	=> 	$dtble["state"],
					'city'		=>	$dtble['city']

				);
				echo json_encode($output);
			}

			if($load == 'loadtheaccountinfoRequest'){
				$output = array();
				$id = $_POST["id"];
				$dtble = $datahelper->SQLROW("SELECT b.id As uid, b.step AS ugroupStat, CONCAT(a.lastname,', ',a.firstname,' ',a.middlename) AS  fullname, a.designation  AS desig, IF(a.designation = 'Chairman', 'Y', 'N')  AS accStat, a.term AS numTerm, a.gender AS gender, a.dob AS dob, a.address AS address, a.contact  AS cnt, (SELECT CONCAT(c.state,'-',c.city) FROM tblgroupattr c WHERE c.id = b.groupid) AS muni, (SELECT d.email FROM tblaccattr d WHERE d.accid = a.id ) AS email FROM tblaccinfo a LEFT JOIN tblugroup b ON a.id = b.userid WHERE a.id = :id", [":id"=>$id]);
				$dir = explode("-", $dtble["muni"]);
				
				$ctrl = (($dtble["accStat"] == 'Y') ? '<button class="btn btn-primary pull-right" data-vid="'.$dtble["uid"].'" id="btn-apr-b-admin">'.(($dtble["ugroupStat"] == "R") ? 'Approved' : 'Dismiss').'</button>' : '');
				
				$output = array(
					"fname"			=>	$dtble["fullname"], 
					"desig"			=>	'SK '.$dtble["desig"], 
					"term" 			=> 	$dtble["numTerm"], 
					"gender"		=> 	$dtble["gender"], 
					"dob" 			=> 	$dtble["dob"], 
					"address"	 	=>	$dtble["address"],
					"contact"		=>	$dtble["cnt"],
					"email"			=>	$dtble["email"],
					"state"			=>	$dir[0],
					"city"			=>	$dir[1],
					"age"			=>	(date_diff(date_create($dtble["dob"]), date_create('now'))->y),
					"verify"		=>	$ctrl,
					"subVerify"		=>	(($dtble['ugroupStat'] == 'R' || 'A' && $dtble['desig'] != 'Chairman') ? '<button id="btn-acc-act-frm-sb-a" data-vid="'.$id.'"  data-id="'.$dtble['uid'].'" class="btn btn-sm btn-primary"  ">'.(($dtble['ugroupStat'] == 'R') ? 'Approved' : 'Dismiss').'</button>' : '')


	
				);
				echo json_encode($output);
			}

			if($load == 'loadthecontrolsubadminbyaccattribute'){
				$output = array();
				$groupid = $datalibrary->getHash($_POST["id"], "dec");
				$parse = $_POST["parse"];
				
				if($parse == 'getCounts'){
					$dtble = $datahelper->SQLROW("SELECT (SELECT COUNT(DISTINCT u.userid) FROM tblugroup u WHERE u.groupid = a.id AND u.status IN ('F', 'M') AND u.step = 'A') AS regOffi, (SELECT COUNT(DISTINCT u.userid) FROM tblugroup u WHERE u.groupid = a.id AND u.status IN ('F', 'M') AND u.step = 'R') AS reqOffi FROM tblgroupattr a WHERE a.id = :id", [":id"=>$groupid]);
						
						
					$output["member"] = '<ul class="list-unstyled">
												<li class="list-unstyled-item">'.$dtble["regOffi"].' - Registered</li>
												<li class="list-unstyled-item">'.$dtble["reqOffi"].' - Requesting</li>
											</ul>';
					
				}

				if($parse == 'getStatus'){
					$dtble = $datahelper->SQLROW("SELECT (CASE WHEN a.step = 'A' THEN 'Approved' ELSE 'Requesting' END) AS rStat, a.status AS sVerfy, (SELECT b.status FROM tblgroupattr b WHERE b.id = a.groupid) AS groupStat  FROM tblugroup a WHERE a.userid = :uid AND a.groupid = :gid AND a.step IN ('A', 'R') ",[":uid"=>$userid, ":gid"=>$groupid]);
					if($dtble):
						if($dtble["groupStat"] == 'B'):
							$output["status"] = '<div class="jumbotron">This page you requested is temporary down</div>';
						else:
					$output["status"] = $dtble["rStat"] == 'Approved' || $dtble["sVerfy"] == 'F' ? 
										'<div class="border-0">
											<div class="btn-group btn-group-sm nav-tabs nav border-0" role="group">
												<a href="#post"  data-toggle="tab" class="btn text-muted active btn-ctrl mr-2" id="btn-ctrl-post" ><span class="fa fa-bookmark"></span> Post</a>
											  	<a href="#create" data-toggle="tab" class="btn text-muted btn-ctrl mr-2"><span class="fa fa-plus"></span> Create</a>
											  	<a class="btn text-muted btn-ctrl mr-2" id="btn-my-info-group-ctrl"><span class="fa fa-user-alt"></span> My Profile</a>
							                    '.(($dtble["sVerfy"] == 'F') ? 
							                    	'<a href="#member" data-toggle="tab" class="btn text-muted btn-ctrl mr-2"><span class="fa fa-user-cog"></span> Member</a>
											   		<a class="btn text-muted btn-ctrl mr-2" id="btn-req-pro-group-ctrl"><span class="fa fa-address-card"></span> Profiling</a>' : '' ).'

											</div>
										</div>' : '<div class="jumbotron"><span class="fa fa-info-circle text-secondary fa-4x float-right"></span><p>This state has been registered to your profile.</p><button class="btn btn-primary btn-sm" disabled data-tooltip="tooltip" title="Waiting for confirmation of administrator or maybe you have been dismised">'.$dtble["rStat"].'</button></div>';
						endif;
										
					endif;
				}


				
				echo json_encode($output);
			}

			if($load == 'loadthepostattributeanddistinct'){
				$output = array();
				$groupid = $datalibrary->getHash($_POST["id"], 'dec');
				$html = null;
				$dtble = $datahelper->SQLROWS("SELECT a.id AS postid, b.type AS posttype, a.content AS artContent, (SELECT CONCAT(c.id,' ',c.firstname,' ',c.lastname,' ',c.designation) FROM tblaccinfo c WHERE c.id = b.postby) AS fname, b.dtpost AS dt  FROM tblpost a INNER JOIN tblpostattr b ON a.id = b.postid WHERE b.groupid = :id ORDER BY b.dtpost DESC", [":id"=>$groupid]); 
				if($dtble):
					foreach($dtble as $row): $accinfo = explode(' ', $row->fname);
						$html .= '
								<div class="border mb-3 mt-3">
									<div class="card-body">
										<div class="card-title" style="margin-left:-5px;">
										<div class="media">
										  <span class="fa fa-user-circle fa-2x mr-2"></span>
										  <div class="media-body">
										   <label>'.$accinfo[1].' '.$accinfo[2].'</label>
										   <small>(SK '.$accinfo[3].')</small> &bullet; <small class="text-muted">'.$datalibrary->getconverttimeago($row->dt).'</small>';
										if($accinfo[0] == $userid):
						$html .=	'	<a class="dropdown-toggle float-right text-sm text-muted" href="#" id="navbarDropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
												<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					                        		<small class="dropdown-item cursor-pointer" >Edit</small>
					                        		<small class="dropdown-item cursor-pointer" data-id="'.$row->postid.'" id="btn-rmve-ths-pst-adm">Remove this</small>
					                      		</div>
			                      			';
			                      		endif;
						$html .=	'			</div>
											</div>
										</div>
									
										'.$row->artContent.'
										<small><i>'.$datalibrary->getexduedatetime($row->dt).'</i> </small>
									</div>
								</div>';
					endforeach;
				else:
					$html .= '<div class="text-center"><img src="assets/images/tools/no-result.png" width="40%;"><p class="text-muted">No post to review</p></div>';
				endif;
				$output["content"] = $html;
				echo json_encode($output);
			}


			if($load == 'loadtheuseradminlistgroupmemberctrl'){
				$output = array();

				$groupid = $datalibrary->getHash($_POST["id"], 'dec');
				$filter = $_POST["filter"]; 

				$html = $filt = null;
				switch ($filter) {
					case 'all':
						$filt = "IN ('R', 'A')";
						break;
					case 'request':
						$filt = "= 'R'";
						break;
					default:
						$filt = "IN ('R', 'A')";
						break;
				}
				$dtble = $datahelper->SQLROWS("SELECT CONCAT(b.firstname,' ',b.lastname) AS fname, b.designation AS design, b.id AS userid, a.step AS acGroupAct FROM tblugroup a LEFT JOIN tblaccinfo b ON a.userid = b.id WHERE a.groupid = :gid AND a.status IN ('F', 'M', 'N') AND a.step $filt", [":gid"=>$groupid]);
				if($dtble):
				foreach($dtble as $row):
					$html .= '<div class="col-md-3">
								'.(($row->acGroupAct == 'A') ? '<span class="fa fa-check-circle text-success float-right"></span>' : '<span class="fa fa-info-circle text-primary float-right"></span>' ).'
								<div class="border">
									<div class="card-img-top text-center pt-3">	<span class="fa fa-user-circle fa-5x"></span> </div>
									<div class="card-body">
										<div class="card-title"><label>'.$row->fname.'<br><small>'.$row->design.'</small></label></div>
										'.(($row->userid != $userid) ? '<div class="form-group">
											<a class="btn btn-primary btn-sm text-white" data-id="'.$row->userid.'" id="btn-view-info-by-r-member" >View Profile</a>
										</div>' : '<small>Founder</small>' ).'
									</div>
								</div>
							</div>';
				endforeach;
				else:
					$html .= '<div class="col-md-12 text-center"><img src="assets/images/tools/no-result.png" width="30%;"><p>No member join request</p></div>';
				endif;
				$output["memcontent"] = $html;

				echo json_encode($output);
			}


			if($load == 'loadtheprofilenumberofinfobasepage'){
			
				$valueof = $datalibrary->getHash($_POST["pid"], 'dec'); 

				$parsing = $_POST["parse"];
				 // $year = $_POST["year"];

				if($parsing == "getYear"):
					$data  = array();
					$dtble = $datahelper->SQLROWS("SELECT DISTINCT(a.year) AS diSyear FROM tblprofile a WHERE a.gid = :id", [":id"=>$valueof]);
					foreach($dtble as $row):
						$data[] = array("year"=>$row->diSyear);
					endforeach;
					echo json_encode($data);
				endif;


				if($parsing == "getTable"):
					$r = array(); 
					$html = $filter = $details  = null; $m = $f = $re = 0;
					$statParse = $_POST["stat"];
					
					switch ($statParse) {
						case 'O':
							$filter = "= 'O'";
							break;
						case 'U':
							$filter = "= 'U'";
							break;
						case 'T':
							$filter = "= 'T'";
						break;
						case 'I':
							$filter = "= 'I'";
						break;
						case 'all':
							$filter = "IN ('O', 'U', 'T', 'I')";
							break;
					} 
					
					$dtble = $datahelper->SQLROWS("SELECT  a.id AS id, CONCAT(a.fname,' ',a.lname) AS fname, a.age AS age, a.gender AS gender, a.dtissue AS dateis, a.status AS verify, (
						CASE 
							WHEN a.descr = 'O' THEN 'Out of school'
							WHEN a.descr = 'U' THEN 'Unemployed'
							WHEN a.descr = 'T' THEN 'Tennage Pregnancy'
							WHEN a.descr = 'I' THEN 'Indigenous Youth'
						END) AS type, a.year AS y, IFNULL((SELECT COUNT(*) FROM tblprofile c WHERE c.gid = a.gid AND c.year = a.year AND c.gender = 'Male' AND c.descr $filter),0) AS numMale, IFNULL((SELECT COUNT(*) FROM tblprofile c WHERE c.gid = a.gid AND c.year = a.year AND c.gender = 'Female' AND c.descr $filter), 0) AS numFmale  FROM tblprofile a WHERE a.gid = :gid AND a.year = :y AND a.status IN ('A', 'R') AND a.descr $filter ORDER BY a.dtissue DESC", [':gid'=>$valueof, ":y"=>$_POST["year"]]);
					$html .= '<table class="table table-bordered table-sm borderless table-hover" id="tbl-profiling-single">
						<thead class="th-primary">
							<tr>
								<td width="5%">No</td>
								<td>Name</td>
								<td width="5%">Age</td>
								<td width="10%">Gender</td>
								<td>Description</td>
								<td>Date Registered</td>
								<td class="text-center">Status</td>
							</tr>
						</thead>
						<tbody>';
						// $(".inputGender> [value="+$(this).attr("id")+"]").attr("selected", "true"); 
						$gen = ["Male", "Female"];
						$arg = array(
							array('value' => 'O', 'text' => 'Out of School'),
							array('value' => 'U', 'text' => 'Unemployed'),
							array('value' => 'T', 'text' => 'Tennage Pregnancy'),
							array('value' => 'I', 'text' => 'Indigenous Youth'),
						);
					foreach($dtble as $key => $row): $no = $key + 1; $res = $no;
						$html .= '<tr>
									<td class="small">'.$no.'.</td>
									<td contenteditable data-id="'.$row->id.'" id="inputedit" class="small">'.$row->fname.'</td>
									<td contenteditable data-id="'.$row->id.'" id="inputeditAge" class="small">'.$row->age.'</td>
									<td class="small">
									<select class="border-0" style="background: transparent;" name="gen[]" data-id="'.$row->id.'">';
									foreach($gen as $item):
										$html .= '<option '.(($item == $row->gender) ? 'selected="true" ' : '').' value="'.$item.'">'.$item.'</option>';
									endforeach;							
						$html .=    '</select>
									</td>
									<td class="small">
									<select class="border-0" style="background: transparent;" name="type[]" data-id="'.$row->id.'">';
									foreach($arg as $item):
										$html .=  '<option '.(($item['text'] == $row->type) ? 'selected="true" ' : '').' value="'.$item['value'].'">'.$item['text'].'</option>';
									endforeach;
						$html .=	'</select>
									</td>
									<td class="small">'.$datalibrary->getexduedatetime($row->dateis).'</td>
									<td class="small text-center">'.(($row->verify != 'A') ? '<a class="cursor-pointer" data-id="'.$row->id.'" id="btn-reg-ac-act">Register <small class="badge badge-none">New</small></a>' : '<span class="fa fa-check-circle text-success"></span>').'</td>
								</tr>';
							$m = $row->numMale;
							$f = $row->numFmale;
							$re = $res;
					endforeach;
					$details = '<ul class="list-inline">
										<li class="list-inline-item">Male - '.$m.'</li>
										<li class="list-inline-item">Female - '.$f.'</li>
										<li class="list-inline-item float-right">Showing Result - '.$re.'</li>
									</ul>';	
					$html .= '</tbody>
							<table>';
					$r["tble"] = $html;
					$r["tdtls"] = $details;
					echo json_encode($r);

				endif;

				if($parsing == "getCount"):
					$data = array();
					$year = $_POST["year"];
					$dtble = $datahelper->SQLROW("SELECT (SELECT COUNT(b.descr) FROM tblprofile b WHERE b.year = a.year AND b.descr = 'O' AND b.gid = a.gid) AS osy, (SELECT COUNT(c.descr) FROM tblprofile c WHERE c.year = a.year AND c.descr = 'U'  AND c.gid = a.gid) AS uem,  (SELECT COUNT(d.descr) FROM tblprofile d WHERE d.year = a.year AND d.descr = 'T'  AND d.gid = a.gid) AS tep,  (SELECT COUNT(e.descr) FROM tblprofile e WHERE e.year = a.year AND e.descr = 'I'  AND e.gid = a.gid) AS iyt FROM tblprofile a WHERE a.year = :year AND a.gid = :gid", [":year"=>$year, ":gid"=>$valueof]);
					$data = array("osy"=>$dtble["osy"], "uem" =>$dtble["uem"], "tep"=>$dtble["tep"], "iyt"=>$dtble["iyt"]);

					echo json_encode($data);
				endif;



			}

			if($load == 'loadtheyearnumberbrgypagerequest'){
				$pid = $datalibrary->getHash($_POST["pid"], 'dec');

				$dtble = $datahelper->SQLROWS("SELECT DISTINCT(a.year) AS year, (SELECT COUNT(b.id) FROM tblprofile b WHERE b.year = a.year AND b.descr = 'O') AS osy,(SELECT COUNT(c.id) FROM tblprofile c WHERE c.year = a.year AND c.descr = 'U') AS uem, (SELECT COUNT(d.id) FROM tblprofile d WHERE d.year = a.year AND d.descr = 'T') AS tep, (SELECT COUNT(e.id) FROM tblprofile e WHERE e.year = a.year AND e.descr = 'I') AS iyt   FROM tblprofile a WHERE a.gid = :gid", [":gid"=>$pid]);
				foreach($dtble as $key => $row):
					$data = array();
					$data[] = '<div class="text-left small">'.$row->year.'</div>';
					$data[] = '<div class="text-center small">'.$row->osy. '</div>';
					$data[] = '<div class="text-center small">'.$row->uem. '</div>';
					$data[] = '<div class="text-center small">'.$row->tep. '</div>';
					$data[] = '<div class="text-center small">'.$row->iyt. '</div>';
					$r["data"][] = $data;
				endforeach;
				echo json_encode($r);	
			}

			if($load == 'loadtheinfobyuserrequestbymemberpage'){
				$output = array();
				$html = null;
				$dtble = $datahelper->SQLROW("SELECT a.firstname, a.middlename, a.lastname, a.gender, b.* FROM tblaccinfo a INNER JOIN tblaccattr b ON a.id = b.accid WHERE a.id = :uid AND a.status = 'A'", [":uid"=>$userid]);
				if($dtble):
					$html .= '<div class="card row">
								<div class="card-header">Basic Info</div>
								<div class="card-body row">
									<div class="form-group col-sm-3">
										<input type="text" class="form-control input-none" value="'.$dtble["firstname"].'">
										<small class="text-muted pl-2">Firstname</small>
									</div>
									<div class="form-group col-sm-3">
										<input type="text" class="form-control input-none" value="'.$dtble["middlename"].'">
										<small class="text-muted pl-2">Middlename</small>
									</div>
									<div class="form-group col-sm-3">
										<input type="text" class="form-control input-none" value="'.$dtble["lastname"].'">
										<small class="text-muted pl-2">Lastname</small>
									</div>
									<div class="form-group col-sm-3">
										<select class="form-control input-none">
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
										<small class="text-muted pl-2">Gender</small>
									</div>
								 </div>
								</div> ';
				endif;

				$output["info"] = $html;

				echo json_encode($output);
			}




		}
	}

	

	
?>