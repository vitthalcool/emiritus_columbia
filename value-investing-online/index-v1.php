<?php
session_start();
$token			= md5(uniqid(mt_rand(), true));
$_SESSION['token'] 	= $token;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Value Investing (Online): Making Intelligent Investment Decisions | Columbia Business School</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="https://emeritus.gsb.columbia.edu/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">

	<meta name="keywords" content=""/>

	<meta property="og:title" content="Value Investing (Online): Making Intelligent Investment Decisions | Columbia Business School"/>

	<meta property="og:description" content=""/>

	<meta property="og:image" content=""/>

	<meta name="twitter:card" content=""/>

	<meta name="twitter:description" content=""/>

	<meta name="twitter:title" content="Value Investing (Online): Making Intelligent Investment Decisions | Columbia Business School" />

	<meta name="twitter:image" content="" />
	<link rel="stylesheet" type="text/css" href="css/style_new.css?v=0.0.5">
	<link rel="stylesheet" type="text/css" href="css/responsive_new.css?v=0.0.4">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://emeritus.org/programmes/common/gdpr.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
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
					trackEvent('click','CBSVI LP','FormSubmit','Form_Submit')
					
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
		<div class="container-fluid" id="header">
			<div class="container">
				<header class="header">
					<div class="row">
					  <div class="col-sm-6 nav-left-logo">
						 <a href="" onclick="trackEvent('click','CBSVI LP','Reload','Partner Logo')" class="svg" alt="Columbia Business School" title="Columbia Business School">
							<object class="img-responsive" 
							type="image/svg+xml" 
							data ="https://www.emeritus.org/upload/DSB/V180204/images/EXECED-stacked.svg" 
							alt="Columbia Business School" title="Columbia Business School" >
                            </object>
						</a>
					  </div>
					</div>
				</header>
			</div>	
		</div>
		<div class="banner"> 
			<div class="banner-bg1">
				<div class="container df">
					<div class="col-md-7 no_pad">
						<div class="banner-content p-l-7 no-bg">
							<h1>VALUE INVESTING (ONLINE):</h1>
							<h2>MAKING INTELLIGENT INVESTMENT DECISIONS</h2>
						</div>
					</div>
					<div id="2" class="col-md-5 form-div no_pad form-section">
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
											<input type="submit" class="btn btn-default download-btn" value="DOWNLOAD BROCHURE >"/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<p><small>Your details will not be shared with third parties.</small>
											<strong><small><a href="//emeritus.org/privacy-policy/" target="_blank">Privacy Policy</a></small></strong></p>
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
						<img src="images/start.png" alt="Starts on" title="Starts on">
					</div>
					<div class="img-content">
						<h3>Starts on</h3>
						<p>July 25, 2018</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="images/duration.png" alt="Duration" title="Duration">
					</div>
					<div class="img-content">
						<h3>Duration</h3>
						<p> 2 months, online<br class="mobile-show"> 
						<span class="f18">6–8 hours per week</span>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="https://emeritus.org/programmes/digital-marketing/assets-data/images/fee.png" alt="Program Fees" title="Program Fees">
					</div>
					<div class="img-content">
						<h3>program fees</h3>
						<p>$3,750</p>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container padtop">
				<h1 class="heading">Why Learn Value Investing Techniques?</h1>
				<p class="text-left intro-text">
					Columbia's two-month online program — <i class="intro">Value Investing (Online): Making Intelligent Investment Decisions </i>— teaches investors and corporate decision makers the most successful investment strategy ever developed. Investors like Warren Buffett and Mario Gabelli practice these timeless investing principles:
				</p>
				<div class="row counter-row">
						<div class="col-md-4 col-sm-4">
							<div class="abt-content bb-a">
								<div class="img-center-section">
									<img src="images/invest.png" class="img-responsive" alt="Always invest with a margin of safety." title="Always invest with a margin of safety.">
								</div>
								<p>Always invest with a margin of safety.</p>
								</div>
						</div>
						<div class="col-md-4 col-sm-4 b-r-f-1">
							<div class="abt-content bb-a">
								<div class="img-center-section">
									<img src="images/system.png" class="img-responsive" alt="Rely on a system, not emotions, to drive decisions." title="Rely on a system, not emotions, to drive decisions.">
								</div>
								<p>Rely on a system, not emotions, to drive decisions.
								</p>
								</div>
							</div>
						<div class="col-md-4 col-sm-4">
								<div class="abt-content">
									<div class="img-center-section">
									<img src="images/risk-reward.png" class="img-responsive" alt="Risk ≠ Reward Work = Return" title="Risk ≠ Reward Work = Return">
								</div>
									<p>Risk ≠ Reward <br class="dismobile"/> Work = Return</p>
								</div>
						</div>
				</div>
					<div class="mb92">
						<p class="text-left intro-text">Find the opportunities that other investors miss because they’re too enamored with the glamour stocks.
						</p>
					</div>
					<div class="mb92">
						<a href="#2" onclick="trackEvent('click','CBSVI LP','ScrollUp','Download Brochure')"><button class="btn btn-default download-btn"> DOWNLOAD BROCHURE</button></a>
					</div>
				</div>
			
			<div class="video-wrapper youtubevideo">
				<div class="aspect-ratio" style="position: relative;width: 100%; height: 0;padding-bottom: 55%;">
					<div id="player"></div>
				</div>
			</div>
			
				<div class="bg_grey">
					<div class="content-wrapper">
						<h1 class="heading">The Value Investing (Online) Learning Experience</h1>
						<div class="display_desktop text-center clearfix">
							<ul class="no-style">
								<li class="col20">
									<div class="box-section blue">
									<img src="images/frameworks.png" alt="Frameworks" title="Frameworks">
									</div>
									<h3>FRAMEWORKS</h3>
									<p class="data-section">Delivered via video lectures</p>
								</li>
								<li class="col20">
									<div class="box-section">
									<img src="images/real-world.png" alt="Real-World Examples" title="Real-World Examples">
									</div>
									<h3>REAL-WORLD <br/>EXAMPLES</h3>
									<p class="data-section">Delivered through a combination of video and relevant case studies</p>
									
								</li>
								<li class="col20">
									<div class="box-section blue">
									<img src="images/application.png" alt="Application of Learning" title="Application of Learning">
									</div>
									<h3>APPLICATION OF<br/> LEARNING</h3>
									<p class="data-section">Exercises designed to apply the concepts and tools of value investing</p>
									
								</li>
								<li class="col20">
									<div class="box-section">
									<img src="images/capstone.png" alt="Capstone Project" title="Capstone Project">
									</div>
									<h3>CAPSTONE PROJECT</h3>
									<p class="data-section">Using the value investing approach to evaluate the attractiveness of John Deere</p>
									
								</li>
							</ul>						
						</div>
						<!-- <div class="row icon-row">
							<div class="col20 box hidden-xs">
								
							</div>
							<div class="col20 box">
								<img src="images/3_06.png" alt="Live Teaching Sessions by Wharton Faculty" title="Live Teaching Sessions by Wharton Faculty">
								<h4>
									4 Live Teaching Sessions by Wharton Faculty
								</h4>
							</div>
							
							<div class="col20 box">
								<img src="images/simulation.png" alt="Data Analytics Simulation" title="Data Analytics Simulation">
								<h4>
									1 Data Analytics Simulation
								</h4>
							</div>
							<div class="col20 box hidden-xs">
								
							</div>
						</div> -->
						<div class="row clearfix">
							<div class="col-md-6 col-sm-6">
								<div class="syllabus">
									<ul>
										<li><span class="ul-head">Module 1:</span> Value Investing Framework<br/> Foundations, framework, and introduction to asset value: Overview of the valuation approach and calculating asset value.
										</li>
										<li><span class="ul-head">Module 2:</span> Earnings Power Value<br/>  The methodology to identify and buy securities priced well below their true value.</li>
										<li><span class="ul-head">Module 3:</span> Strategic Analysis<br/> Understanding the value of scale economies and barriers to entry.</li>
										<li><span class="ul-head">Module 4:</span> Magna International Case Study<br/> Valuation exercise for the automotive market in the aftermath of the financial crisis.</li>
									</ul>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 your-learning-mt">
								<div class="syllabus">
									<ul>
										<li><span class="ul-head">Module 5:</span> Growth and Value<br/> Estimating future earnings and accounting for growth using Walmart as an example.</li>
										<li><span class="ul-head">Module 6:</span> Amazon Case Study<br/> Calculating the value of a high-growth company in dynamic industry segments.</li>
										<li><span class="ul-head">Module 7:</span> Risk Management<br/> Managing the risks of individual stocks and portfolios through proven financial and management strategies.</li>
										<li><span class="ul-head">Module 8:</span> John Deere Case Study <br/> Using the value investing approach to evaluate the attractiveness of John Deere.</li>
									</ul>
								</div>
							</div>
						</div>
					</div>		
					<div class="marb92">	
						<a href="#2" onclick="trackEvent('click','CBSVI LP','ScrollUp','Download Syllabus')" target="_blank"><button class="btn btn-default download-btn">DOWNLOAD SYLLABUS</button></a>
					</div>	
				</div>
				
			<div class="container">
				<h1 class="heading">Case Studies</h1>	
									
					<div class="row p-50 container-row">
					<div class="mb92">
						<p class="text-left datatext padd-lf">We apply concepts by valuing real companies through case studies from Walmart, Amazon, Intel, Nestle, John Deere, and others. And we’ll tackle highly-debated topics like: When does growth create value? How can we measure competitive advantage? How should we value risk?
						</p>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="images/wal.png" alt="Walmart" title="Walmart" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    						    <h5 class="alumni_featured_name">Walmart</h5>
								 <p class="alumni_featured_data">
									How does Walmart’s expansion into China affect our valuation estimates?</p> 
							</div>		
  						</div>
					</div>
					
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="images/hudson.png" alt="Hudson General" title="Hudson General" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Hudson General</h5>
								 <p class="alumni_featured_data">
									What does it mean when a company has a higher Earning Power Value (EPV) than its Asset Value (AV)?</p>
							</div>		
  						</div>
					</div>
					
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="images/int.png" alt="Intel" title="Intel" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Intel</h5>
								 <p class="alumni_featured_data">
									Does the shrinking market for personal computers spell trouble for Intel?</p>
							</div>									
  						</div>
					</div>
					
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="images/nestle.png" alt="Nestle" title="Nestle" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Nestle</h5>
								 <p class="alumni_featured_data">
									How has Nestle grown over the years — organically or via acquisitions?</p>
							</div>									
  						</div>
					</div>
					
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="images/am.png" alt="Amazon" title="Amazon" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Amazon</h5>
								 <p class="alumni_featured_data">
									How does one even approach the valuation of a market giant growing approximately 30 percent per year?</p>
							</div>		
  						</div>
					</div>
					
					
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="images/mgn.png" alt="Magna International" title="Magna International" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    						    <h5 class="alumni_featured_name">Magna International</h5>
								 <p class="alumni_featured_data">
									How can we find value in an industry in deep decline?</p> 
							</div>		
  						</div>
					</div>
					
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="images/ferr.png" alt="Ferrovial" title="Ferrovial" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">Ferrovial</h5>
								 <p class="alumni_featured_data">
									When and how can an investor take advantage of a real estate bubble?</p>
							</div>									
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left">
								<img src="images/JohnDeere.png" alt="John Deere" title="John Deere" class="img-responsive">
							</div>
							<div class="alumni_featured_band triangle-down">
    							<h5 class="alumni_featured_name">John Deere</h5>
								 <p class="alumni_featured_data">
									Capstone case study that cultivates understanding by pulling all the pieces together</p>
							</div>									
  						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 col-sm-12 col-xs-12 text-right loadm">
						<a href="" onclick="trackEvent('click','CBSVI LP','Expand','Load More')" class="load_more" id="loadMore">Load more</a>
					</div>
					
					<div class="mb92">
						<p class="text-left padd-lf padd-top"><i class="note">Note: All product and company names are trademarks™ or registered® trademarks of their respective holders. Use of them does not imply any affiliation with or endorsement by them.</i>
						</p>
					</div>
				</div>
			
				</div>	
		<div class="container-fluid" id="faculty">	
			<div class="container" >
					<h1 class="heading mart50 marb0">Faculty</h1>
					<div class="row p-50 p-80 container-row text-center">
						<div class="tett-center">
							<img src="https://emeritus.org/upload/CBSVI/images/Tano.png" alt="Tano Santos" title="Tano Santos" class="border-radius">
						</div>
						<h5 class="txt-color">Tano Santos</h5>
						<p class="data">Faculty Director and Head of Research of the Heilbrunn Center for Graham & Dodd Investing; David L. and Elise M. Dodd Professor of Finance</p>
						<p class="disription">Tano Santos is an expert in value investing at Columbia Business School. His current research focuses on two distinct areas: asset pricing, with an emphasis on theoretical and empirical models that can account for the predictability of returns, and applied economic theory, specifically, the economics of financial innovations as well as theory of organizations. Santos joined the Columbia Business School faculty in 2003.</p>
					</div>
			</div>
			</div>
		<div class="margin-section">
			<div class="container clearfix certificate">
					<div class="certificate-text col-sm-6">
						<div class="text-left">
							<h1 class="heading no-marg">Certificate</h1>
							<p class="text-left padl80">Upon completion of the program, participants<br/> will receive a certificate of completion from Columbia <br/>Business School Executive Education and one day towards a <br/><u><a href="https://www8.gsb.columbia.edu/execed/certificates" onclick="trackEvent('click','CBSVI LP','Redirect','Certificate')" target="_blank" class="anchor-text">Certificate in Business Excellence</a></u>.
							</p>							
							<div class="get-certified">
								<a href="#2" onclick="trackEvent('click','CBSVI LP','ScrollUp','Get Certified')" target="_blank"><button class="btn btn-default download-btn">GET CERTIFIED</button></a>
							</div>	
						</div>
					</div>
					<div class="certificate-img col-sm-6">
						<div class="padr80 text-right">
							<img src="images/certificate.png" alt="Value Investing (Online): Making Intelligent Investment Decisions" title="Value Investing (Online): Making Intelligent Investment Decisions" class="img-responsive">
						</div>	
					</div>
			</div>
			<div class="container clearfix">
				<p class="certificate-line">Your verified digital certificate will be issued in your legal name and emailed to you, at no additional cost, upon completion of the program, as per the stipulated requirements. All certificate images are for illustrative purposes only and may be subject to change at the discretion of the Columbia Business School Executive Education.
				</p>
			</div>
		</div>
		<div class="top-footer">
			<div class="text-center">
				<a href="https://emeritus-admissions.secure.force.com/StudentPrograms?pid=01t0I000005XYnE" onclick="trackEvent('click','CBSVI LP','Redirect','Apply Now')" target="_blank"><button class="btn btn-default apply-btn">Apply Now</button></a>
				<h3>Early applications are encouraged.</h3>
				<h5>Flexible payment options available. <a href="#" onclick="trackEvent('click','CBSVI LP','Pop Up','Flexi Pay')" class="applynow" data-toggle="modal" data-target="#myModal">Click here</a> to know more.</h5>
			</div>
		</div>
		<footer class="text-center">
			<div class="container m-tb-50 nav-left-logo">
				<!--<ul class="social-network social-circle  m-tb-50">
					<li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
				</ul>-->
						<a href="https://emeritus.org/" class="svg" onclick="trackEvent('click','CBSVI LP','Redirect','EM Logo')" target="_blank" alt="Emeritus Institue of Management" title="Emeritus Institue of Management" >
							<object 
							class="img-responsive" 
							type="image/svg+xml"
							alt="Emeritus Institue of Management" title="Emeritus Institue of Management"
							data="https://www.emeritus.org/upload/DSB/V180202/images/logo-01.svg">
						</object>
							
						</a>
				<p class="footer_p text-center">
					Columbia Business School Executive Education is collaborating with online education provider EMERITUS Institute of Management to offer a portfolio of high-impact online programs. These programs leverage Columbia's thought leadership in management practice developed over years of research, teaching, and practice. By collaborating with EMERITUS, we are able to broaden access beyond our on-campus offerings in a collaborative and engaging format that stays true to the quality of Columbia Business School Executive Education and Columbia as a whole.
				</p>
				<p class="fotter-line footer_p"><i>Note: Information contained herein should not be considered professional financial investment advice. The ideas and strategies should never be used without first assessing your own personal and financial situation, or without consulting a financial professional.</i></p>
			</div>
		</footer>
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
              <h5>The flexible payment option allows a student to pay the program fee in installments. This option is made available in the application form and should be selected before making the payment.</h5>
            </div>
            <div class="clearfix content_p">
              <h5>The following payment options are available for the <i class="data-program">Value Investing (Online) </i><i>program</i>.</h5>
				<ul class="ul_style">Pay in Full</ul>
					<li>Pay the entire course fee of <b>$3,750</b> at once.</b>
					</li>
				</ul>

				<ul class="ul_style">Pay in 2 installments</ul>
					<li>The first installment of <b>$2,066</b> would be <b>due immediately</b>.
					</li>
					<li>The second installment of <b>$1,760</b> will be charged on <b>Aug 12, 2018</b>.
					</li>
				</ul>

				<ul class="ul_style">Pay in 3 installments</ul>
					<li>The first installment of <b>$1,575</b> would be <b>due immediately</b>.
					</li>
					<li>The second installment of <b>$1,181</b> will be charged on <b>Aug 12, 2018</b>.
					</li>
					<li>The third installment of <b>$1,181</b> will be charged on <b>Sep 05, 2018</b>.
					</li>
				</ul>
            </div>
    </div>

<script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script async type="text/javascript" src="js/com.js"></script>
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
	videoId: 'MO3rqHwmdRM', 
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
		trackEvent('Play', 'CBSVI LP', 'Watch Video', 'Play Video');
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
<script>
var sr = 3;
	$(function () {
    $(".load_more_show").slice(0, 0).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".load_more_show:hidden").slice(0, 3).slideDown();
		sr	= sr+3;
        if ($(".load_more_show:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
		if(sr == 9)
		{
			$("#loadMore").hide();
		}
    });
});

function resetHeight()
{
 var maxHeight = 0;
 $(".alumni_featured_band").each(function(){
    if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
 });
 $(".alumni_featured_band").height(maxHeight);
 $(".alumni_featured_band").css('background','#0080cc');
 $(".alumni_featured_band").css('padding-bottom','20px');
 $(".alumni_featured_band").css('padding-top','18px');
 $(".alumni_featured_band").css('margin-bottom','19px');
}

$(window).on('resize', function() {
 resetHeight()
});
resetHeight();
</script>
<!-- end Pardot Website Tracking code -->
</body>
</html>