<?php require('library.php'); ?>
<title>Signin</title> 
<body class="text-center">
    <form class="form-signin mt-5" method="post" enctype="multipart/form-data" id="frm-sign">
      <a href="index"><img class="mb-4 rounded-circle border" src="assets/images/logo/sk.png"   alt="" width="40%"></a>
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <div id="msg-err-div"></div>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="email" id="email" required data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" placeholder="Email">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" id="password"  data-parsley-length="[8,16]" data-parsley-trigger="keyup" class="form-control" placeholder="Password">
      <div class="checkbox mb-2">
        <label>
          <input type="checkbox" name="remember" id="remember"> Remember me
        </label>
        <a href="register#/member">Signup?</a>
      </div>
      	<input type="hidden" name="action" value="letsigninrequestforthedbreqand">
		<input type="submit" name="btn-submit" value="Signin" class="btn btn-lg btn-primary btn-block">
     	<p class="mt-5 mb-3 text-muted">&copy; 2017- <?php echo date('Y'); ?></p>
    </form>
</body>
<script src="script/sign.js"></script>


