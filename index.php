<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>MOS Sign up</title>
<meta name="description" content="Sign up for MOS">
<meta name="author" content="Sachin Lubana">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="css/mos-min.css">
<link rel="stylesheet" href="css/form.css">
<link rel="shortcut icon" href="favicon.jpg" >
</head>
<body>
<header>
      <div class="logo"><a><img alt="MOS Logo" src="images/logo_moo.png"></a></div>
      <nav id="nav-wrap">
         <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show Menu</a>
          <a class="mobile-btn" href="#" title="Hide navigation">Hide Menu</a>
         <ul id="nav" class="nav">
            <li><a class="smoothscroll" href="#features">Features</a></li>
             <li><a class="smoothscroll" href="#pricing">Pricing</a></li>
            <li><a class="smoothscroll" href="#screenshots">Screenshots</a></li>
            <li><a class="smoothscroll" href="#testimonials">Testimonials</a></li>
            <li class="current"><a class="smoothscroll" href="#signup">Sign Up</a></li>
         </ul>
      </nav>
</header>
<section id='register'>
<div class="smart-wrap">
<?php 
	error_reporting(E_ERROR);
	$passVisible = $errVisible = "style='display:none;'";
	$firstName = $lastName = $userEmail = $birthDate = $password = $repeatPassword = $address = $nationality = $verification = '';
	if(isset($_POST['btnSubmit'])) {
		$firstName		= empty($_POST['firstname']) ? '' : $_POST['firstname'];
		$lastName		= empty($_POST['lastname']) ? '' : $_POST['lastname'];
		$userEmail		= empty($_POST['useremail']) ? '' : $_POST['useremail'];
		$birthDate		= empty($_POST['datepicker1']) ? '' : $_POST['datepicker1'];
		$password		= empty($_POST['password']) ? '' : $_POST['password'];
		$repeatPassword	= empty($_POST['repeatPassword']) ? '' : $_POST['repeatPassword'];
		$address		= empty($_POST['address']) ? '' : $_POST['address'];
		$nationality	= empty($_POST['nationality']) ? '' : $_POST['nationality'];
		$verification	= empty($_POST['verification']) ? '' : $_POST['verification'];
		$terms			= empty($_POST['terms']) ? '' : $_POST['terms'];

		$msgHead = "Oops you forgot to add the following<br /><br />";
		$msg = "";

		//validate first name value
		if(empty($firstName)) $msg .= "First name<br />";

		//validate last name value
		if(empty($lastName)) $msg .= "Last name<br />";

		//validate user email address
		if(empty($userEmail) || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) $msg .= "Valid email address<br />";
		
		//validate password
		if(empty($password)) $msg .= "Password<br />";

		//validate retype password value
		if($password != $repeatPassword) $msg .= "Retype password mismatch detected<br />";

		//validate address
		if(empty($address)) $msg .= "Address<br />";

		//validate birth date
		if(empty($birthDate)) $msg .= "Birth date<br />";
		else {
			$date1 = date_create(date("Y-m-d"));
			$date2 = date_create($birthDate);
			$diff = date_diff($date1,$date2);
			$age = $diff->format("%y");
			if($age < 18) $msg .= "Age is < 18 years<br />";
		}

		//validate nationality
		if(empty($nationality)) $msg .= "Nationality<br />";

		//validate verification code
		if($verification != 19) $msg .= "Verification code is incorrect<br />";

		//validate avatar image upload
		if(!empty($_FILES["avatar"])) {
			$uploadDir = "uploads/";
			$srcFile = $_FILES['avatar']['tmp_name'];
			$destFile = $uploadDir.$_FILES["avatar"]['name'];
			if (!move_uploaded_file($srcFile, $destFile)) {
			   $msg .= "Upload avatar image failed<br />";
			}
		}

		//validate terms & conditions selected
		if(empty($terms)) $msg .= "Comply to terms & conditions<br />";

		if(!empty($msg)) $errVisible = "";
		else {
			$passVisible = "";
			$firstName = $lastName = $userEmail = $birthDate = $password = $repeatPassword = $address = $nationality = $verification = '';
		}
	}
?>
	<div class="smart-forms smart-container wrap-2">
		<div class="section" <?php echo $errVisible; ?>>
			<div class="notification alert-error spacer-t10">
			    <p><?php echo $msgHead.$msg; ?></p>
			    <a href="#" class="close-btn">&times;</a>                                  
			</div>
		</div>
		<div class="section" <?php echo $passVisible; ?>>
			<div class="notification alert-success spacer-t10">
		        <p>Registration successfully completed</p>
		        <a href="#" class="close-btn">&times;</a>                                  
		    </div>
		</div>
		<form method="post" action="index.php" id="smart-form" enctype="multipart/form-data">
			<div class="form-body">
				<!--First name & last name-->        
		        <div class="frm-row">
		            <div class="section colm colm6">
		                <label for="firstname" class="field prepend-icon">
		                    <input type="text" name="firstname" id="firstname" class="gui-input" placeholder="First name..." value="<?php echo $firstName; ?>" >
		                    <span class="field-icon"><i class="fa fa-user"></i></span>  
		                </label>
		            </div>
		            <div class="section colm colm6">
		                <label for="lastname" class="field prepend-icon">
		                    <input type="text" name="lastname" id="lastname" class="gui-input" placeholder="Last name..." value="<?php echo $lastName; ?>" >
		                    <span class="field-icon"><i class="fa fa-user"></i></span>  
		                </label>
		            </div>
		        </div>
		        <!--Email address & birth date-->
				<div class="frm-row">
		            <div class="section colm colm6">
		                <label for="useremail" class="field prepend-icon">
		            		<input type="email" name="useremail" id="useremail" class="gui-input" placeholder="Email address" value="<?php echo $userEmail; ?>" >
		                	<span class="field-icon"><i class="fa fa-envelope"></i></span>  
		            	</label>
		            </div>
		            <div class="section colm colm6">
		                <label for="datepicker1" class="field prepend-icon">
		                    <input type="text" id="datepicker1" name="datepicker1" class="gui-input" value="<?php echo $birthDate; ?>">
		                    <span class="field-icon"><i class="fa fa-calendar"></i></span>  
		                </label>
		            </div>
		        </div>
		        <!--Password & confirm password-->
		        <div class="frm-row">
		            <div class="section colm colm6">
		                <label for="password" class="field prepend-icon">
		            		<input type="password" name="password" id="password" class="gui-input" placeholder="Create a password" >
		                	<span class="field-icon"><i class="fa fa-lock"></i></span>  
		            	</label>
		            </div>
		            <div class="section colm colm6">
		                <label for="repeatPassword" class="field prepend-icon">
		                	<input type="password" name="repeatPassword" id="repeatPassword" class="gui-input" placeholder="Repeat password" >
		                    <span class="field-icon"><i class="fa fa-unlock-alt"></i></span>  
		                </label>
		            </div>
		        </div>
		        <!--Address-->
		    	<div class="section">
		        	<label for="address" class="field prepend-icon">
		            	<textarea class="gui-textarea" id="address" name="address" placeholder="Your address"><?php echo $address; ?></textarea>
		                <span class="field-icon"><i class="fa fa-comments"></i></span>
		                <span class="input-hint"> 
		                	<strong>For eg:</strong> M K Gandhi street, Sion, Mumbai, India 
		                </span>   
		            </label>
		        </div>
		        <!--Nationality-->
		        <div class="section">
		            <label class="field select">
		                <select id="nationality" name="nationality">
		                    <option value="">Select nationality...</option>
							<option value="australian">Australian</option>
							<option value="austrian">Austrian</option>
							<option value="azerbaijani">Azerbaijani</option>
							<option value="bahamian">Bahamian</option>
							<option value="bahraini">Bahraini</option>
							<option value="bangladeshi">Bangladeshi</option>
							<option value="cape verdean">Cape Verdean</option>
							<option value="central african">Central African</option>
							<option value="gambian">Gambian</option>
							<option value="georgian">Georgian</option>
							<option value="german">German</option>
							<option value="icelander">Icelander</option>
							<option value="indian">Indian</option>
							<option value="indonesian">Indonesian</option>
							<option value="iranian">Iranian</option>
							<option value="vietnamese">Vietnamese</option>
							<option value="welsh">Welsh</option>
							<option value="yemenite">Yemenite</option>
							<option value="zambian">Zambian</option>
		                </select>
		                <i class="arrow"></i>                    
		            </label>  
		        </div>
		        <!--Avatar image-->
		        <div class="section">
		            <label for="file1" class="field file">
		                <span class="button btn-primary"> Choose File </span>
		                <input type="file" class="gui-file" name="avatar" id="file1" onChange="document.getElementById('uploader1').value = this.value;">
		                <input type="text" class="gui-input" id="uploader1" placeholder="no file selected" readonly>
		            </label>
		        </div>
				<!--Solve math test-->  
		        <div class="section">
		            <div class="smart-widget sm-left sml-120">
		                <label for="verification" class="field prepend-icon">
		                    <input type="text" name="verification" id="verification" class="gui-input" placeholder="Solve verification">
		                    <span class="field-icon"><i class="fa fa-shield"></i></span>  
		                </label>
		                <label for="verification" class="button">15 + 4 = </label>
		            </div> 
		        </div>
		        <!--T&C-->
		    	<div class="section">
		            <label class="field option block">
		                <input type="checkbox" name="terms" checked>
		                <span class="checkbox"></span> 
		                You must agree to our <a href="#" class="smart-link"> terms of service </a>                
		            </label>
		        </div> 
		    </div>
		    <div class="form-footer">
		    	<button type="submit" class="button btn-primary" name="btnSubmit" > Validate Form </button>
		    </div>
		</form>
	</div>
</div>
</section>
<footer><p class="copyright">&copy; 2016 MeetOnSnap | Design by <a title="MeetOnSnap" href="http://www.meetonsnap.com/">MOS</a></p></footer>
</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery-valid.js"></script>
<script type="text/javascript" src="js/jquery.cook.js"></script>
<script type="text/javascript" src="js/app.js"></script>
</html>
