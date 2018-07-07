<?php
/*
	---------------------------------------------------
	Coding done by  Version 1.0
	---------------------------------------------------
*/
session_start();
require_once 'xss_clean1.php';
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$xssClean = new xssClean1;
$con=mysqli_connect("localhost","gsbcolum_program","6riDagKNTGApzkiZ","gsbcolum_programs") or die("cannot connect");

$csrf	= isset($_POST['csrf'])?trim($_POST['csrf']):'';


function getEmailStatus($emailId = '')
{
	$url 	 	 = 'https://bpi.briteverify.com/emails.json?apikey=16254e3c-13ac-4eb1-9604-7f1c1fac90ad&address='.$emailId;
	
	
	try
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT ,3); 
		curl_setopt($curl, CURLOPT_TIMEOUT, 60);
		curl_setopt($curl, CURLOPT_HEADER, 0); 
		$json_response = curl_exec($curl);
		curl_close($curl);
	} catch (Exception $ex) {
		curl_close($curl);
	}
	
	return json_decode($json_response,true);
}

function saveAPILog($phone = '',$response = '')
{
	$con=mysqli_connect("localhost","gsbcolum_program","6riDagKNTGApzkiZ","gsbcolum_programs") or die("cannot connect");
	$query=mysqli_query($con,"INSERT INTO api_log(phone,response,date) VALUES ('".$phone."','".$response."','".date('Y-m-d H:i:s')."')");
}


$arraySources	= array('Web','Advertisement', 'Employee Referral', 'External Referral', 'Partner', 'Public Relations', 'Seminar - Internal', 'Seminar - Partner', 'Trade Show', 'Web', 'Word of mouth', 'Other', 'EruditusEmailer', 'Shine emailer', 'Shine sms', 'Monster', 'Timesjob', 'Headhonchos', 'IIMJobs', 'Naukri', 'ValueDirect', 'CareerJunction', 'EMERITUSEmailer', 'Adserve', 'Fb Lead Ads', 'Trade_Briefs', 'Adcanopus', 'Li Lead Ads', 'Credila', 'BusinessStandard', 'IndianExpress', 'Rediff', 'Google-Display', 'B2B-LP', 'Microsite', 'The Hindu', 'Recro-Media', 'BBC', 'BBC International-USA', 'CNN International-India', 'CNN International-USA', 'India Today-HBR', 'India Today-Time', 'India Today-Banners', 'HTTPool', 'Forbes.com', 'Reuters.com', 'ArabianBusiness.com', 'Gulfnews.com-Network', 'Gulfnews.com-Email', 'Khaleejtimes.com', 'Khaleejtimes.com-Email', 'Entrepreneur.com', 'Entrepreneur.com-Email', 'Microsite-FB', 'Indian Express', 'Financial Express', 'Business Std', 'AdSurf Media', 'Forbes India', 'Reuters India', 'India Today HBR', 'India Today Time', 'Tunica Labs', 'GDN Brazil', 'GDN Mex', 'GDN Thai', 'GDN Mal', 'GDN Sin', 'GDN Swiss', 'GDN Ger', 'GDN Brazil RT', 'GDN Mex RT', 'GDN Thai RT', 'GDN Mal RT', 'GDN Sin RT', 'GDN Swiss RT', 'GDN Ger RT', 'tun', 'busline', 'SkillsFuture', 'Quora', 'ColumbiaWeb', 'PMO-MENA', 'Nucleo Media', 'MITWEBSITE', 'MIT-EMAILER', 'DGM', 'MonsterGulf', 'Vertoz', 'MIT-Twitter', 'MIT-Facebook', 'Opicle media', 'Icubes', 'MorrisMedia', 'Bigtrunk', 'BaytMedia', 'DigitalMailers', 'Adready', 'Intellect ads', 'GoogleNaturalSearch', 'MediaMath', 'CNNMoney', 'CNNInternational', 'CNNInternationalFacebook', 'BBC.com', 'LiveMint', 'Firstpost', 'Keystone', 'MEALeads', 'Leads_DB', 'Outbrain', 'Taboola', 'CBS-WEB', 'Intercom Chat','Facebook','Twitter','Google','Linkedin','VCCircle','GooglePlacements','GoogleRemarketing','EMERITUSEmailer','REFEREE-Programme','Timesjobs','EruditusEmailer','Reddit');
	
/**
 * Case-insensitive in_array() wrapper.
 *
 * @param  mixed $needle   Value to seek.
 * @param  array $haystack Array to seek in.
 *
 * @return bool
 */
function in_arrayi($needle,$haystack)
{
	return array_search(strtolower($needle), array_map('strtolower', $haystack));
}
	
$salutation		=isset($_POST['salutation'])?$xssClean->clean_input(trim($_POST['salutation'])):'';
$firstname		=isset($_POST['first_name'])?$xssClean->clean_input(trim($_POST['first_name'])):'';
$lastname		=isset($_POST['last_name'])?$xssClean->clean_input(trim($_POST['last_name'])):'';
$company		=isset($_POST['company'])?$xssClean->clean_input(trim($_POST['company'])):'';;
$city			=isset($_POST['city'])?$xssClean->clean_input(trim($_POST['city'])):'';
$state			=isset($_POST['state'])?$xssClean->clean_input(trim($_POST['state'])):'';
$country		=isset($_POST['country'])?$xssClean->clean_input(trim($_POST['country'])):'';
$phone			=isset($_POST['mobile'])?$xssClean->clean_input(trim($_POST['mobile'])):'';
$email			=isset($_POST['email'])?$xssClean->clean_input(trim($_POST['email'])):'';
$workexp		=isset($_POST['workexp'])?$xssClean->clean_input(trim($_POST['workexp'])):'';
$attenddate		=isset($_POST['attenddate'])?$xssClean->clean_input(trim($_POST['attenddate'])):'';
$finance		=isset($_POST['finance'])?$xssClean->clean_input(trim($_POST['finance'])):'';
$designation	=isset($_POST['designation'])?$xssClean->clean_input(trim($_POST['designation'])):'';


$source			=isset($_POST['utm_source'])?$xssClean->clean_input(trim($_POST['utm_source'])):'';
$medium			=isset($_POST['utm_medium'])?$xssClean->clean_input(trim($_POST['utm_medium'])):'';
$term			=isset($_POST['utm_term'])?$xssClean->clean_input(trim($_POST['utm_term'])):'';
$content		=isset($_POST['utm_content'])?$xssClean->clean_input(trim($_POST['utm_content'])):'';
$campaign		=isset($_POST['utm_campaign'])?$xssClean->clean_input(trim($_POST['utm_campaign'])):'';
$matchtype		=isset($_POST['matchtype'])?$xssClean->clean_input(trim($_POST['matchtype'])):'';
$network		=isset($_POST['network'])?$xssClean->clean_input(trim($_POST['network'])):'';
$creative		=isset($_POST['creative'])?$xssClean->clean_input(trim($_POST['creative'])):'';
$keyword		=isset($_POST['keyword'])?$xssClean->clean_input(trim($_POST['keyword'])):'';
$placement		=isset($_POST['placement'])?$xssClean->clean_input(trim($_POST['placement'])):'';
$random			=isset($_POST['random'])?$xssClean->clean_input(trim($_POST['random'])):'';
$copy			=isset($_POST['copy'])?$xssClean->clean_input(trim($_POST['copy'])):'';
$adposition		=isset($_POST['adposition'])?$xssClean->clean_input(trim($_POST['adposition'])):'';
$url			=isset($_POST['url'])?$xssClean->clean_input(trim($_POST['url'])):'';

$MIT_Email_Consent			=isset($_POST['terms'])?$xssClean->clean_input(trim($_POST['terms'])):'false';
/*
$MIT_Email_Consent = '0';
if($terms)
{
	$MIT_Email_Consent = 'I allow MIT Sloan to send me email updates on Executive Education Programs';
}
*/
$agree = isset($_POST['agree'])?trim($_POST['agree']):'';
if(!empty($agree))
{
	$agree = 'Yes I Agree';
}


$Phone_verified = '';
$email_verified = '';
$arr_email_status = array();

/*
$skip_verify =  (isset($_POST['skip_verify']) && $_POST['skip_verify'])?$_POST['skip_verify']:0;

if($_POST['otpcode'] == $_POST['hid_otpcode'])
{
	$Phone_verified = 'Verified';
}

if($skip_verify == 1)
{
	$Phone_verified = 'Skipped';
}
else if($skip_verify == 2)
{
	$Phone_verified = 'Error';
}
*/
if(!empty($email))
{
	//$arr_email_status = getEmailStatus($email);
	//saveAPILog('Email',json_encode($arr_email_status));
}

if(isset($arr_email_status['status']) && $arr_email_status['status'] == 'valid')
{
	$email_verified = 'YES';
}
else if(isset($arr_email_status['status']) && $arr_email_status['status'] == 'unknown')
{
	$email_verified = 'UN';
}
else if(isset($arr_email_status['status']) && $arr_email_status['status'] == 'accept_all')
{
	$email_verified = 'UN';
}
else{
	$email_verified = 'NO';
}


$lead_source 	= "";
if(!empty($source))
{
	
	$cp_source 		= strtolower($source);
	$isExists		= in_arrayi($cp_source,$arraySources);
	if($isExists)
	{
		$lead_source = $arraySources[$isExists];
	}
}

if(empty($lead_source))
	$lead_source = "Web";

$thankyoupage = "thankyou.html";
$lead_id 	  = '';
if(empty($firstname) || empty($lastname) || empty($country) || empty($workexp) ||  empty($phone) || empty($email) )
{
	header("Location: index.php");
	exit;
}
else
{
	
?>
<!DOCTYPE html>
<html>
<head>
<title>VALUE INVESTING (ONLINE): MAKING INTELLIGENT INVESTMENT DECISIONS | Columbia Business School.</title>
</head>
<body>
<center>
	<img src="images/ajax-loader.gif" class="loading, please wait..."/>
</center>
<?php
$msg = '<table>';
$msg .= "<tr><td height='10' colspan='3'></td></tr>";
$msg .= "<tr><td height='2' colspan='3' bgcolor='#e5e5e5'></td></tr>";
$msg .= "<tr><td height='10' colspan='3'></td></tr>";
$msg .= "<tr><td bgcolor='#eaeaea' style='padding-left:3px;' colspan='3'><font face='helvetica' size='2' style='line-height:1.7' style='line-height:1.5' color='#000000'><b>Personal Information</b>:</font></b></td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Salutation</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $salutation </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>First Name</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $firstname </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Last Name</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $lastname </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Company</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $company </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Designation</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $designation </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>City</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $city </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Country</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $country </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Work Experience</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $workexp </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>When are you planning to attend program</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $attenddate </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>How will you be financing your program</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $finance </td></tr><br />";


$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Mobile Phone Number</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $phone </td></tr><br />";

/*$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Phone Status</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $Phone_verified </td></tr><br />";*/

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Email</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $email </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Email Status</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $email_verified </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Source</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $source </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Medium</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $medium </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Term</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $term </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Content</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $content </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Campaign</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $campaign </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Matchtype</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $matchtype </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Network</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $network </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Creative</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $creative </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Keyword</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $keyword </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Placement</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $placement </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Random</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $random </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Copy</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $copy </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Adposition</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $adposition </td></tr><br />";



$msg .= "</td></tr></table>";
$date=date('Y-m-d H:i:s');

$detect = new Mobile_Detect;
if($detect->isMobile() || $detect->isTablet())
{
	if(isset($campaign))
		$subject="VALUE INVESTING (ONLINE) Query - [".$campaign."] [".$lead_source."] [".$country."] - M";
	else
		$subject="VALUE INVESTING (ONLINE) Query - [".$lead_source."] [".$country."] - M";
}
else
{
	if(isset($campaign))
		$subject="VALUE INVESTING (ONLINE) Query - [".$campaign."] [".$lead_source."] [".$country."]";
	else
		$subject="VALUE INVESTING (ONLINE) Query - [".$lead_source."] [".$country."]";
}


$query=mysqli_query($con,"INSERT INTO  value_investing(vd_leadid, salutation,firstname,lastname,company,designation,city,country,phone,phone_status,email,email_status,workexp,attenddate,finance,subject,date,source,medium,term,content,campaign,matchtype,network,creative,keyword,placement,random,copy,adposition,url,email_consent,agree) VALUES ('".$lead_id."','".$salutation."','".$firstname."','".$lastname."','".$company."','".$designation."','".$city."','".$country."','".$phone."','".$Phone_verified."','".$email."','".$email_verified."','".$workexp."','".$attenddate."','".$finance."','".$subject."','".$date."','".$source."','".$medium."','".$term."','".$content."','".$campaign."','".$matchtype."','".$network."','".$creative."','".$keyword."','".$placement."','".$random."','".$copy."','".$adposition."','".$url."','".$MIT_Email_Consent."','".$agree."')");

/*
$from="admissions@emeritus.org";
$mailheaders ="From: $email\nContent-Type: text/html; charset=iso-8859-1";
$to = "trilokchand.modi@gmail.com";
//$to = "cool.jigs@gmail.com";

mail($to,$subject, wordwrap($msg), $mailheaders);
*/

//$mailheaders1 ="From: $from\nContent-Type: text/html; charset=iso-8859-1";
//mail($email, "MIT EPGM Program - Thank You!", $msg1, $mailheaders1);


}
?>
<form class="form-horizontal mCustomScrollbar" role="form" id="frm" name="frm" action="https://www2.emeritus.org/l/134351/2018-03-22/3jxl49" method="post">
<input type="hidden" name="retURL" value="https://emeritus.gsb.columbia.edu/value-investing-online/<?php echo $thankyoupage;?>">						
<input type="hidden" name="lead_source" value="<?php echo $lead_source;?>">	
<input type="hidden" id="first_name" name="first_name" value="<?php echo $firstname;?>">				
<input type="hidden" id="last_name" name="last_name" value="<?php echo $lastname;?>">		
<input type="hidden" id="email" name="email" value="<?php echo $email;?>">
<input type="hidden" id="mobile" name="mobile" value="<?php echo $phone;?>">
<input type="hidden" id="country" name="Country" value="<?php echo $country;?>">
<input type="hidden" id="work_experience" name="work_experience" value="<?php echo html_entity_decode($workexp, ENT_COMPAT, 'UTF-8');?>">
<input type="hidden" id="utm_campaign" name="utm_campaign" value="<?php echo $campaign;?>">
<input type="hidden" id="utm_content" name="utm_content" value="<?php echo $content;?>">
<input type="hidden" id="utm_medium" name="utm_medium" value="<?php echo $medium;?>">
<input type="hidden" id="utm_source" name="utm_source" value="<?php echo $source;?>">
<input type="hidden" id="utm_term" name="utm_term" value="<?php echo $term;?>">
<input type="hidden" id="email_verified" name="Email_verified" value="<?php echo $email_verified;?>">
<input type="hidden" id="agree" name="agree" value="<?php echo $agree;?>">
</form>
<script>
document.frm.submit();
</script>
</body>
</html>
