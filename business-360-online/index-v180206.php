<?php
session_start();
$token			= md5(uniqid(mt_rand(), true));
$_SESSION['btoken'] 	= $token;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Business 360 (Online): Business Acceleration Program | Columbia Business School</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="https://emeritus.gsb.columbia.edu/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">

	<meta name="keywords" content=""/>

	<meta property="og:title" content="Business 360 (Online): Business Acceleration Program | Columbia Business School"/>

	<meta property="og:description" content=""/>

	<meta property="og:image" content=""/>

	<meta name="twitter:card" content=""/>

	<meta name="twitter:description" content=""/>

	<meta name="twitter:title" content="Business 360 (Online): Business Acceleration Program | Columbia Business School" />

	<meta name="twitter:image" content="" />
	<link rel="stylesheet" type="text/css" href="assets-data/css/style_new.css?v=0.0.3">
	<link rel="stylesheet" type="text/css" href="assets-data/css/responsive_new.css?v=0.0.4">
	<link rel="stylesheet" type="text/css" href="assets-data/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets-data/fonts/font.css">
	<link rel="stylesheet" type="text/css" href="assets-data/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="assets-data/slick/slick-theme.css"/>
	<link rel="stylesheet" href="https://emeritus.org/programmes/common/gdpr.css">
	<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Tracking Code start-->
<!--Google tracking code new starts-->
		<style>.async-hide { opacity: 0 !important} </style>
        <script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
        h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
        (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
        })(window,document.documentElement,'async-hide','dataLayer',4000,
        {'GTM-PZHRQJ3':true});</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71668354-1','auto', {'allowLinker': true});
	ga('require', 'linker');
	ga('linker:autoLink', ['www.emeritus.org','www2.emeritus.org','eim.mit.edu','execed-emeritus.wharton.upenn.edu'] );
        ga('require', 'GTM-PZHRQJ3');
  ga('send', 'pageview');
</script>

<!--Google tracking code ends-->


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NX2MRZJ');</script>
<!-- End Google Tag Manager -->

		<script>
		function trackEvent(event, category, action, label) {
			ga('send', 'event', category, action, label);
			console.log('GA==' + event + '==' + category + '==' + action + '==' + label);
		}

		function populateOTP()
		{
			$('#resendBtn').html('Resend');
			$('#otpcode_section').fadeIn(1000);
			$('#hid_otpcode').val('');
			$('#skip_verify').val('0');
		}

		function generateOTPValue()
		{
			$('#hid_otpcode').val('');
			$('#skip_verify').val('0');
			$('#skip-verify').hide();
			$('#otpText').html('');
			
			$('#otpcode_section').show();
			$.post("sendOtp.php",$( "input[name=\'mobile\']" ).closest("form").serialize(), function (data) {				
				if (data.msg == "success") { 
					//alert(data.error);
					$('#otpText').html(data.error);
					$("#hid_otpcode").val(data.code);
					$("#hid_phoneno").val(data.phone);
					
					$('#resendBtn').html('Resend');
					generateOTP = 1;
					setTimeout(function(){ $('#skip-verify').show(); }, 10000);
				}
				else
				{
					$('#skip_verify').val('2');
					$('#otpcode_section').fadeOut(1000);
					$("#hid_phoneno").val(data.phone);
					$('#resendBtn').html('Resend');
					//alert(data.error);
					return false;
				}
			}, "json");
		}
		
		function skipVerify()
		{
			$('#otpcode_section').fadeOut(1000);
			$('#otpcode').attr('disabled','disabled');
			$('#skip_verify').val('1');
		}
		
		
		$(document).ready(function (){
			var is_otp_required = "0";
			var submitted = false;
			$("#frm").validate({ 
				rules: {
					first_name: {
						required: true,
						specialChar:true
					},
					last_name: {
						required: true,
						specialChar:true
					},
					country:{
						required: true,
						notEqual: "-1"
					},
					workexp: {
						required: true,
					},
					email:{
						required: true,
						email:true,
						customemail:true
					},
					mobile: {
						required: true,
						digits: true,
						rangelength:  function(element){
										if($("#country").val()=='India'){
											return [10, 10];
										}
										else{
											return [5, 20];
										}
									},			
					}/*,
					terms:{
						required: true,
					}*/
				}, 
				messages: {
					salutation: {
						required: "Please provide salutation"
					},
					first_name: {
						required: "Please provide your first name",
						specialChar:"Please provide only alphanumeric values",
					},
					last_name: {
						required: "Please provide your last name",
						specialChar:"Please provide only alphanumeric values",
					},
					company:{
						required: "Please provide company name",
						specialChar:"Please provide only alphanumeric values",
					},
					country:{
						required: "Please provide country name",
						notEqual: "Please provide country name",
					},
					state:{
						required: "Please provide state name",
					},
					city:{
						required: "Please provide city name",
						specialChar:"Please provide only alphanumeric values",
					},
					workexp: {
						required: "Please provide work exp",
					},
					email:{
						required: "Please provide your email",
						email: "Please provide valid email",
						customemail: "Please provide valid email",
					},
					code: {
						required: "Please provide country code",
						digits: "Please provide only digits (0 - 9) in country code",
						rangelength: "Please provide valid country code",			
					},
					mobile: {
						required: "Please provide your phone no",
						digits: "Please provide only digits (0 - 9) in phone no",
						rangelength: "Please provide valid phone no",		
					},
					otpcode: {
						required: "Please provide OTP Code / enter your phone no to generate new OTP code",
						equalTo: "Please provide valid OTP / enter your phone no to to generate new OTP code"
					},
					terms:{
						required: 'Please accept terms & condition',
					}				
				},
				/*showErrors: function(errorMap, errorList) {
					if (submitted) {
						var summary = "You have the following errors: \n";
						$.each(errorList, function() { summary += " * " + this.message + "\n"; });
						alert(summary);
						submitted = false;
					}
					this.defaultShowErrors();
				},          
				invalidHandler: function(form, validator) {
					submitted = true;
				},*/
				 errorPlacement: function(error, element){
					if(element.attr("name") == 'otpcode')
					{
						$('#otpText').html('');
						error.appendTo( element.parent().siblings('.error-text') );
					}
					else
					{
						error.appendTo( element.siblings(".error-text") );;
					}
				},
				submitHandler: function(form){
					//$('#frm')[0].submit(); // 
					trackEvent('click','B360 LP','FormSubmit','Form_Submit')
					
					var btn = $('input[type="submit"]');
					btn.val("Processing...");
					btn.attr("disabled",true);
					form.submit();
					
				}
            });
											
			//custom validation rule
			$.validator.addMethod("customemail", 
				function(value, element) {
					if ($.trim(value) != ""){
						var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
					return pattern.test(value);
					}     
					else
					{
						return true;
					}
				}, 
				"Please provide valid email format"
			);
			
			jQuery.validator.addMethod("specialChar", function(value, element) {
				 return this.optional(element) || /([0-9a-zA-Z\s])$/.test(value);
			  }, "Please Fill Correct Value in Field.");

			jQuery.validator.addMethod("notEqual", function(value, element, param) {
			  return this.optional(element) || value != param;
			},"Please select valid country");

		});

		</script>
</head>
<body>
<div class="wrapper">
		<div class="container">
			<header class="header">
				<div class="row">
				  <div class="col-sm-6">
					 <a href="https://emeritus.gsb.columbia.edu/business-360-online/index.php" target="_blank" onclick="trackEvent('click','B360 LP','Reload','Partner Logo')"><img src="assets-data/images/logo.png" alt="Columbia Business School" title="Columbia Business School"> </a>
				  </div>
				</div>
			</header>
		</div>
		<div class="banner">
			<div class="banner-bg">
				<div class="container df">
					<div class="col-md-7 no_pad">
						<div class="banner-content p-l-7">
							<h1>Business 360 (Online):</h1>
							<p>Business Acceleration Program
							</p>
						</div>
					</div>
					<div id="2" class="col-md-5 form-div no_pad">
					<form class="form-horizontal contact-form" role="form" id="frm" name="frm" method="POST" action="submit.php" novalidate="novalidate">
								<h2>GET PROGRAM INFO</h2>
								<div id="fields">
									<?php
									if(strtolower(trim($_GET['utm_source'])) == 'linkedin')
									{
										?>
										
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label class="control-label col-xs-4 col-sm-3 col-md-4"></label>
													<div class="col-xs-8 col-sm-9 col-md-8">
														<script src="https://www.linkedin.com/autofill/js/autofill.js" type="text/javascript" async></script><script type="IN/Form2" data-form="frm" data-field-firstname="first_name" data-field-lastname="last_name" data-field-phone="mobile" data-field-email="email" data-field-country="country"></script>
													</div>
												</div>
											</div>
										</div>
										<?php
									}									
									?>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">First Name*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="first_name" placeholder="" name="first_name">
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Last Name*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="last_name" placeholder="" name="last_name">
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Email*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="email" class="text" id="email" placeholder="" name="email">
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Mobile No.*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="mobile" placeholder="" name="mobile">
											<span class="error-text"></span>
											<span class="small"><!--(e.g.: 9988776623)--></span>
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Work Experience*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<select id="workexp" name="workexp" title="Work Experience" class="select">
												<option value=""></option>
												<option value="Less than 5 Years">Less than 5 Years</option>
												<option value="5-10 Years">5-10 Years</option>
												<option value="10-15 Years">10-15 Years</option>
												<option value="15-20 Years">15-20 Years</option>
												<option value="&gt; 20 Years">> 20 Years</option>
											</select>
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Country*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<select type="text" id="country" name="country" class="select">
											</select>
											<span class="error-text"></span>
										</div>
									</div>
									<!--<div class="form-group small pd-checkbox">
											<label class="control-label col-xs-4 col-sm-3 col-md-4"></label>
											<div class="col-xs-8 col-sm-9 col-md-8">
												<span class="value"><span><input type="checkbox" name="terms" id="terms" value="I allow MIT Sloan to send me email updates on Executive Education Programs"><label class="inline" for="terms" >I allow MIT Sloan to send me email updates on Executive Education Programs</label>
												</span></span>
											</div>
									</div>-->
									<div class="form-group" id="gdpr-consent" style="display:none;"> 
										
										<div class="col-sm-12">
											<label class="checkbox-inline">
											  <input type="checkbox" value="I would like to receive email & other communications from EMERITUS & its university partners about this course and other relevant courses." name="agree" id="agree">I would like to receive email & other communications from EMERITUS & its university partners about this course and other relevant courses.
											</label>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="submit" class="btn btn-default download-btn btn-1" value="DOWNLOAD BROCHURE >"/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<p><small>Your details will not be shared with third parties.</small>
											<strong><small><a href="//emeritus.org/privacy-policy/" target="_blank">Privacy Policy</a></small></strong>
											</p>
										</div>
									</div>
									<input type="hidden" name="skip_verify" id="skip_verify" value="0">
									<input type="hidden" name="utm_source" value="<?php echo $_GET['utm_source'];?>">
									<input type="hidden" name="utm_medium" value="<?php echo $_GET['utm_medium'];?>">
									<input type="hidden" name="utm_term" value="<?php echo $_GET['utm_term'];?>">
									<input type="hidden" name="utm_content" value="<?php echo $_GET['utm_content'];?>">
									<input type="hidden" name="utm_campaign" value="<?php echo $_GET['utm_campaign'];?>">
									<input type="hidden" name="matchtype" value="<?php echo $_GET['matchtype'];?>">
									<input type="hidden" name="network" value="<?php echo $_GET['network'];?>">
									<input type="hidden" name="creative" value="<?php echo $_GET['creative'];?>">
									<input type="hidden" name="keyword" value="<?php echo $_GET['keyword'];?>">
									<input type="hidden" name="placement" value="<?php echo $_GET['placement'];?>">
									<input type="hidden" name="random" value="<?php echo $_GET['random'];?>">
									<input type="hidden" name="copy" value="<?php echo $_GET['copy'];?>">
									<input type="hidden" name="adposition" value="<?php echo $_GET['adposition'];?>">
									<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>">
									<input type="hidden" name="csrf" value="<?php echo $token;?>">
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container info-row">
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="assets-data/images/start.png" alt="Starts on" title="Starts on">
					</div>
					<div class="img-content">
						<h3>Starts on</h3>
						<p>April 26, 2018</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="assets-data/images/duration.png" alt="Duration" title="Duration">
					</div>
					<div class="img-content">
						<h3>Duration</h3>
						<p> 3 months, online<br class="dis-mob">
						<span class="f18">6-8 hours per week</span>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="assets-data/images/fee.png" alt="Program Fees" title="Program Fees">
					</div>
					<div class="img-content">
						<h3>program fees</h3>
						<p>$2,489</p>
					</div>
				</div>
			</div>
		</div>
		
			<div class="container padtop">
				<h1 class="heading">Why Enroll in Business 360?</h1>
				<p class="text-center intro-text">
					The <i>Business 360 (Online): Business Acceleration Program</i> is a three-month program that tackles the fundamentals of business &mdash; leading a team, creating a customer-centric organization, and developing financial acumen.<br/><br/>
					The program is designed for those who do not have a formal education in business. Participants could be a non-business major taking on an initial managerial role or a small business owner looking to enhance core business skills. Business 360 (Online) enables participants to accelerate their impact through an intensive learning journey, which will lead to more prepared leadership and business decision-making.
				</p>
					<div class="marb92 mb92">
						<a href="#2" onclick="trackEvent('click','B360 LP','ScrollUp','Download Brochure')"><button class="btn btn-default download-btn"> DOWNLOAD BROCHURE</button></a>
					</div>
			</div>
			
			<div class="video-wrapper youtubevideo">
				<div class="aspect-ratio" style="position: relative;width: 100%; height: 0;padding-bottom: 55%;">
					<div id="player"></div>
				</div>
			</div>
			
			<div class="bg_grey">
					<div class="content-wrapper">
						<h1 class="heading">The 360 Learning Journey</h1>
						<div class="row icon-row">
							<div class="col20 box">
								<img src="assets-data/images/interactive.png" alt="video lectures" title="video lectures">
								<h4>
									135 video lectures
								</h4>
							</div>

							<div class="col20 box clear-right">
								<img src="assets-data/images/group.png" alt="assignments" title="assignments">
								<h4>
									16 assignments
								</h4>
							</div>
							
							<div class="col20 box">
								<img src="assets-data/images/icon5.png" alt="case studies" title="case studies">
								<h4>
									6 case studies
								</h4>
							</div>
							
							<div class="col20 box">
								<img src="assets-data/images/2.png" alt="discussions" title="discussions">
								<h4>
									5 discussions
								</h4>
							</div>
							
							<div class="col20 box">
								<img src="assets-data/images/icon1.png" alt="live teaching sessions" title="live teaching sessions">
								<h4>
									4 live teaching sessions
								</h4>
							</div>							
							
							<div class="col20 box">
								<img src="assets-data/images/capstone.png" alt="capstone case study" title="capstone case study">
								<h4>
									 1 capstone case study
								</h4>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="syllabus">
									<ul>
										<li><span class="ul-head">Module 1:</span> Orientation and Welcome</li>
										<li><span class="ul-head">Module 2:</span> Leadership and Decision Making</li>
										<li><span class="ul-head">Module 3:</span> Influencing Others</li>
										<li><span class="ul-head">Module 4:</span> Being Customer-Centric</li>
										<li><span class="ul-head">Module 5:</span> Developing Financial Intuition</li>
									</ul>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 your-learning-mt">
								<div class="syllabus">
									<ul>
										<li><span class="ul-head">Module 6:</span> Launching New Products</li>
										<li><span class="ul-head">Module 7:</span> Leading and Managing Teams</li>
										<li><span class="ul-head">Module 8:</span> Building Social Networks</li>
										<li><span class="ul-head">Module 9:</span> Capstone Case and Wrap Up</li>
									</ul>
								</div>
							</div>
						</div>
						<a href="#2" onclick="trackEvent('click','B360 LP','ScrollUp','Download Syllabus')" target="_blank"><button class="btn btn-default download-btn">DOWNLOAD SYLLABUS</button></a>
					</div>
				</div>
				
			<div class="container">
					<h1 class="heading mart50 marb0">Faculty</h1>
			
					<div class="row p-50 container-row">
						<div class="faculty-slider">
							<div class="col-md-4">
								<fieldset>
									<legend align="center" class="img-circle"><img src="assets-data/images/user1.png" alt="Gita V. Johar" title="Gita V. Johar"></legend>
									<h5 class="txt-color">Gita V. Johar, Faculty Co-Director </h5>
									<h5 class="data">Meyer Feldberg Professor of Business in Marketing</h5>
									<p class="data">
										Gita V. Johar is an influential scholar in the field of consumer psychology who has published several articles on consumer
									</p>
									<p><a class="txt-color" data-toggle="modal" data-target="#myModal01">Read more</a></p>
								</fieldset>
							</div>
							<div class="col-md-4">
								<fieldset>
									<legend align="center" class="img-circle"><img src="assets-data/images/user2.png" alt="Oded Netzer" title="Oded Netzer"></legend>
									<h5 class="txt-color">Oded Netzer, Faculty Co-Director</h5>
									<h5 class="data">Associate Professor of Business</h5>

									<p class="data">
										Professor Netzer's research centers on one of the major business challenges of the data-rich environment
											</p>
											<p><a class="txt-color" data-toggle="modal" data-target="#myModal02">Read more</a></p>
								</fieldset>
							</div>
							<div class="col-md-4">
								<fieldset class="col-4">
									<legend align="center" class="img-circle"><img src="assets-data/images/user3.png" alt="Adam Galinsky" title="Adam Galinsky"></legend>
									<h5 class="txt-color">Adam Galinsky, Chair of Management Division </h5>
									<h5 class="data">Vikram S. Pandit Professor of Business</h5>

									<p class="data">
										Adam Galinsky received his Ph.D. from Princeton University and his B.A. from Harvard University. Professor
										</p>
										<p><a class="txt-color" data-toggle="modal" data-target="#myModal03">Read more</a></p>
								</fieldset>
							</div><div class="col-md-4">
							<fieldset>
								<legend align="center" class="img-circle"><img src="assets-data/images/user4.png" alt="Daniel Wolfenzon" title="Daniel Wolfenzon"></legend>
								<h5 class="txt-color">Daniel Wolfenzon, Co-Director, Family Business Program</h5>
								<h5 class="data">Stefan H. Robock Professor of Finance and Economics</h5>
								<p class="data">
									Daniel Wolfenzon received a Masters and a PhD in economics from Harvard University and holds a BS in economics and a BS in mechanical engineering from MIT
								</p>
								<p><a class="txt-color" data-toggle="modal" data-target="#myModal04">Read more</a></p>
							</fieldset>
						</div>
							<div class="col-md-4">
							<fieldset>
								<legend align="center" class="img-circle"><img src="assets-data/images/user5.png" alt="Katherine Phillips" title="Katherine Phillips"></legend>
								<h5 class="txt-color">Katherine Phillips,</h5>
								<h5 class="data">Paul Calello Professor of Leadership and Ethics</h5>

								<p class="data">
									Katherine W. Phillips joined the faculty at Columbia Business School as the Paul Calello Professor of Leadership and Ethics in Fall of 2011.
								</p>
							<p><a class="txt-color" data-toggle="modal" data-target="#myModal05">Read more</a></p>
							</fieldset>
						</div>
						</div>
					</div>
			
			</div>
		
		<div class="margin-section">
			<div class="container clearfix ver-center">
					<div class="certificate-text col-sm-6">
						<div class="padl80">
							<h1 class="heading no-marg text-left">Certificate</h1>
							<p class="text-left padl80">Upon completion of the program, participants<br class="hidmb"> will receive a certificate of completion from Columbia <br class="hidmb">Business School Executive Education and one day towards a <br class="hidmb"><u><a href="https://www8.gsb.columbia.edu/execed/certificates" onclick="trackEvent('click','B360 LP','Redirect','Certificate')" target="_blank" class="anchor-text">Certificate in Business Excellence</a></u>.
							</p>
							<br/>
							<a href="https://www8.gsb.columbia.edu/execed/certificates" target="_blank" onclick="trackEvent('click','B360 LP','ScrollUp','Get Certified')"><button class="btn btn-default download-btn">GET CERTIFIED</button></a>
						</div>
					</div>
					<div class="certificate-img col-sm-6">
						<div class="padr80 text-right">
							<img src="assets-data/images/certificate_b360.png" alt="Business 360 (Online): Business Acceleration Program" title="Business 360 (Online): Business Acceleration Program" class="img-responsive">
						</div>	
					</div>
			</div>
			<div class="container clearfix">
				<p class="certificate-line">Your verified digital certificate will be issued in your legal name and emailed to you, at no additional cost, upon participation of the program, as per the stipulated requirements. All certificate images are for illustrative purposes only and may be subject to change at the discretion of the Columbia Business School Executive Education.
				</p>
			</div>
		</div>
		
		<div class="top-footer">
			<div class="text-center">
				<a href="https://emeritus-admissions.secure.force.com/StudentPrograms?pid=01t280000042BbX" onclick="trackEvent('click','B360 LP','Redirect','Apply Now')" target="_blank"><button class="btn btn-default apply-btn">Apply Now</button></a>
				<h3>Early applications are encouraged.</h3>
				<p style="padding-top:5px;">Flexible payment options available. <a href="#" onclick="trackEvent('click','B360 LP','Redirect','Flexi Pay')" style="color:#fff !important;text-decoration:underline !important;" data-toggle="modal" data-target="#myModal">Click here</a> to know more.</p>
			</div>
		</div>
		<footer class="text-center">
			<div class="container m-tb-50">
				<!--<ul class="social-network social-circle  m-tb-50">
					<li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
				</ul>-->
				<img src="assets-data/images/footer-logo.png" alt="EMERITUS Institute of Management" title="EMERITUS Institute of Management"/>
				<p class="footer_p">
					Columbia Business School Executive Education is collaborating with online education provider EMERITUS Institute of Management to offer a portfolio of high-impact online programs. These programs leverage Columbia's thought leadership in management practice developed over years of research, teaching, and practice. By collaborating with EMERITUS, we are able to broaden access beyond our on-campus offerings in a collaborative and engaging format that stays true to the quality of Columbia Business School Executive Education and Columbia as a whole.
				</p>
			</div>
		</footer>
	</div>

<div class="modal fade" id="myModal01" role="dialog">
   <div class="modal-dialog modal-lg">
   	<!-- Modal content-->
    <div class="modal-content">
       	<div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         	<img src="assets-data/images/user1.png" alt="Gita V. Johar" title="Gita V. Johar" class="img-circle">
         	<!-- <h4 class="modal-title">Modal Header</h4> -->
       	</div>
      <div class="modal-body">
         <div class="clearfix content_h5">
         <h5 class="txt-color">Gita V. Johar, Faculty Co-Director</h5>
<h5 class="data">Meyer Feldberg Professor of Business in Marketing</h5>
</div>
<div class="clearfix content_p">
<p class="data">Gita V. Johar is an influential scholar in the field of consumer psychology who has published several articles on consumer responses to marketing efforts. Her expertise in persuasion makes her uniquely qualified to lead a program on marketing and innovation, where the focus is on generating creative ideas as well as persuading consumers and colleagues to accept these ideas.</p>
<p class="data">Johar has served as associate editor for such journals as the <i>Journal of Marketing Research</i>, the <i>Journal of Consumer Research</i> and the <i>International Journal of Research in Marketing</i>. She began a term as editor of the <i>Journal of Consumer Research</i> in July 2014. At Columbia, Gita teaches in the MBA, EMBA and PhD programs and has authored cases on consumer adoption of new products and on marketing and advertising planning.</p>
<p class="data">Johar is the Meyer Feldberg Professor of Business at Columbia Business School and has been on the faculty since 1992. She received her PhD from the NYU Stern School of Business and her MBA from the Indian Institute of Management, Calcutta.</p>
</div>
       </div>
       <!-- <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div> -->
   </div>
</div>
</div>
<div class="modal fade" id="myModal02" role="dialog">
				<div class="modal-dialog modal-lg">
   	<!-- Modal content-->
    <div class="modal-content">
       	<div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         	<img src="assets-data/images/user2.png" alt="Oded Netzer" title="Oded Netzer" class="img-circle">
         	<!-- <h4 class="modal-title">Modal Header</h4> -->
       	</div>
      <div class="modal-body">
      <div class="clearfix content_h5">
         	<h5 class="txt-color">Oded Netzer, Faculty Co-Director</h5>
<h5>Associate Professor of Business</h5>
</div>
<div class="clearfix content_p">
<p>Professor Netzer's research centers on one of the major business challenges of the data-rich environment of the 21st century: developing quantitative methods that leverage data to gain a deeper understanding of customer behavior and guide firms' decisions. He focuses primarily on building statistical and econometric models to measure consumer preferences and understand how customer choices change over time, and across contexts.</p>
</div>
       </div>
       <!-- <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div> -->
   </div>
</div>
</div>
<div class="modal fade" id="myModal03" role="dialog">
   <div class="modal-dialog modal-lg">
   	<!-- Modal content-->
    <div class="modal-content">
       	<div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         	<img src="assets-data/images/user3.png" alt="Adam Galinsky" title="Adam Galinsky" class="img-circle">
         	<!-- <h4 class="modal-title">Modal Header</h4> -->
       	</div>
      <div class="modal-body">
      <div class="clearfix content_h5">
         	<h5 class="txt-color">Adam Galinsky, Chair of Management Division </h5>
<h5>Vikram S. Pandit Professor of Business</h5>
</div>
<div class="clearfix content_p">
<p>Adam Galinsky received his PhD from Princeton University and his BA from Harvard University. Professor Galinsky has published more than 200 scientific articles, chapters, and teaching cases in the fields of management and social psychology. His research and teaching focus on leadership, power, negotiations, decision-making, diversity, and ethics.</p>

<p>In 2012, Professor Galinsky was selected as one of the "World's 50 Best B-School" Professors by <i>Poets and Quants</i>. He twice won the Chair's Core Course teaching award at Kellogg for teaching excellence on the topic of leadership. He also received a teaching award at Princeton University.</p>

<p>His research and insights have appeared in <i>The Economist</i>, <i>The New York Times</i>, <i>The New Yorker</i>, <i>National Public Radio</i>, <i>Wall Street Journal</i>, <i>The Financial Times</i>, <i>Boston Globe,</i> and <i>Chicago Tribune</i>.</p>
</div>
</div>
       </div>
       <!-- <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div> -->
   </div>
</div>

<div class="modal fade" id="myModal04" role="dialog">
   <div class="modal-dialog modal-lg">
   	<!-- Modal content-->
    <div class="modal-content">
       	<div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         	<img src="assets-data/images/user4.png" alt="Daniel Wolfenzon" title="Daniel Wolfenzon" class="img-circle">
         	<!-- <h4 class="modal-title">Modal Header</h4> -->
       	</div>
      <div class="modal-body">
      <div class="clearfix content_h5">
         	<h5 class="txt-color">Daniel Wolfenzon, Co-Director, Family Business Program</h5>
<h5 class="data">Stefan H. Robock Professor of Finance and Economics</h5>
</div>
<div class="clearfix content_p">
<p class="data">Daniel Wolfenzon received a Masters and a PhD in economics from Harvard University and holds a BS in economics and a BS in mechanical engineering from MIT. Professor Wolfenzon previously taught at the University of Michigan, the University of Chicago, and NYU. He is also a faculty research fellow at the National Bureau of Economic Research.</p>

<p class="data">His research interests are in corporate finance and organizational economics. He has studied control sharing in small firms, the effects of investor protection on ownership concentration, and the structure of business groups around the world.</p>
<p class="data">His work has been published in top economic and finance journals such as the <i>Quarterly Journal of Economics</i>, <i>the Review of Economic Studies</i>, <i>the Journal of Finance</i>, and <i>the Journal of Financial Economics</i>.</p>
</div>
</div>
       </div>
       <!-- <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div> -->
   </div>

</div>
<div class="modal fade" id="myModal05" role="dialog">
   <div class="modal-dialog modal-lg">
   	<!-- Modal content-->
    <div class="modal-content">
       	<div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         	<img src="assets-data/images/user5.png" alt="Katherine Phillips" title="Katherine Phillips" class="img-circle">
         	<!-- <h4 class="modal-title">Modal Header</h4> -->
       	</div>
      <div class="modal-body">
      <div class="clearfix content_h5">
         	<h5 class="txt-color">Katherine Phillips</h5>
								<h5 class="data">Paul Calello Professor of Leadership and Ethics</h5>
								</div>
<div class="clearfix content_p">
<p class="data">Katherine W. Phillips joined the faculty at Columbia Business School as the Paul Calello Professor of Leadership and Ethics in Fall of 2011. Before joining Columbia Business School, she was Associate Professor of Management and Organizations at the Kellogg School of Management, Northwestern University and Co-Director and Founder of Northwestern's Center on the Science of Diversity.</p>

<p class="data">She has also been a Visiting Professor at the Stanford Graduate School of Business and Visiting Scholar at the Center for Advanced Studies in Behavioral Sciences. Professor Phillips received her PhD in Organizational Behavior from Stanford University's Graduate School of Business. Her Bachelor's degree is in Psychology from the University of Illinois in Urbana-Champaign.</p>

<p class="data">Her research addresses the main questions of what is the value of diversity and what are the barriers that prevent society, organizations and especially work teams from capturing the knowledge, perspectives, and unique backgrounds of every member.</p>
</div>
</div>
       </div>
       <!-- <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div> -->
   </div>
</div>
<div class="model_box">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="clearfix content_h5">
                            <h5>The Flexible payment option allows a student to pay the program fee in installments. This option is made available in the application form and should be selected before making the payment</h5>
                        </div>
                         <div class="clearfix content_p">
                            <h5>The following Flexible payment options are available for the Business 360 (Online) program:</h5>
							<ul class="ul_style"><b>Pay in Full</b></ul>
								<li>Pay the entire course fee of <b>$2,489</b> at once.
								</li>
							</ul>

                            <ul class="ul_style"><b>Pay in 2 installments</b></ul>
                            <li>The first installment of <b>$1,371</b> would be <b>due immediately</b>.</li>
							<li>The final installment of <b>$1,168</b> will be charged on <b>May 10, 2018</b>.</li>
							
                            <ul class="ul_style"><b>Pay in 3 installments</b></ul>
                            
							<li>The first installment of <b>$1,045</b> would be <b>due immediately</b>. 
                            </li>
                            <li>The second installment of <b>$784 </b> will be charged on <b>May 10, 2018</b>.
                            </li>
                           <li>The final installment of <b>$784 </b> will be charged on <b>June 1, 2018</b>.
                            </li>
							
							</ul>
                        </div>
                    </div>
		</div>
		</div>
        </div>

	
<script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets-data/slick/slick.min.js"></script>
<script type="text/javascript" src="assets-data/js/common.js"></script>
<script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0071/5326.js" async="async"></script>
<script type="text/javascript" src="https://emeritus.org/programmes/common/js/countries-new.js"></script>
<script async type="text/javascript" src="https://emeritus.org/programmes/common/gdpr.js?v=0.0.1"></script>

<script> 
populateCountries("country");
//GDPR
$(document).ready(function () {
   $.getScript("https://www.gsb.columbia.edu/cdn/js/privacyNotice/dist/js/privacy.js");
});

var tag = document.createElement('script'); 
tag.src = "https://www.youtube.com/player_api"; 
	var firstScriptTag = document.getElementsByTagName('script')[0]; 
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	
	var player; 
	function onYouTubePlayerAPIReady() { 
	player = new YT.Player('player', { 
	height: '700', 
	width: '100%', 
	videoId: 'Ia2irwfmlEU', 
	playerVars: {rel: 0},
	events: { 
	'onReady': onPlayerReady, 
	'onStateChange': onPlayerStateChange 
	} 
	}); 
	}
	function onPlayerReady(event) { 
	/// event.target.playVideo(); 
	} 
	
	function onPlayerStateChange(event) { 
		if (event.data ==YT.PlayerState.PLAYING) 
		{
			trackEvent('Play', 'DM LP', 'Watch Video', 'Play Video');
		} 
	} 
	</script> 
   
<!-- Tracking Code Start--> 
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NX2MRZJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



<!-- Tracking Code end-->

<!-- begin Pardot Website Tracking code -->

<script type="text/javascript">
piAId = '64132';
piCId = '2042';
piHostname = 'pi.pardot.com'; 

(function() {
	function async_load(){
		var s = document.createElement('script'); s.type = 'text/javascript';
		s.src = ('https:' == document.location.protocol ? 'https://pi' : 'http://cdn') + '.pardot.com/pd.js';
		var c = document.getElementsByTagName('script')[0]; c.parentNode.insertBefore(s, c);
	}
	if(window.attachEvent) { window.attachEvent('onload', async_load); }
	else { window.addEventListener('load', async_load, false); }
})();
</script>

<!-- end Pardot Website Tracking code -->
	</body>
	</html>