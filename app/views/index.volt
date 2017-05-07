<!DOCTYPE html>
<html>
	<head>
		{{ stylesheet_link('css/normalize.css') }}
		{{ stylesheet_link('css/font-awesome.css') }}
		{{ stylesheet_link('css/base.css') }}
		{{ stylesheet_link('css/bootstrap.css') }}
		{{ stylesheet_link('css/jquery-ui.css') }}
		{{ stylesheet_link('css/msgBoxLight.css') }}
		{{ stylesheet_link('css/validetta.css') }}
		{{ stylesheet_link('css/owl.carousel.css') }}
		{{ stylesheet_link('css/owl.theme.css') }}
		{{ stylesheet_link('css/owl.transitions.css') }}
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name='viewport' content='width=1220'>
		<meta name="description" content="{{ mainTitle }}">
		<meta name="keywords" content="Escort {{ wcountry }}, Escort, {{ wcountry }}, Sex {{ wcountry }}, {{ wcountry }} escorts">
		<meta name="author" content="{{ mainLogo }}">
		<title>{{ mainTitle }}</title>
		<link rel="icon" type="image/png" href="../../favicon.png" />
	</head>
	<body>

	{{ content() }}

	<!-- START MODALS -->
	<!-- Login popup -->
	<div id="popupBottom" class="popover logon">
		<div class="popover-content">
			{{ form('login', 'role': 'form') }}
			<div class="inner-addon left-addon">
				<i class="glyphicon glyphicon-user"></i>
				{{ text_field('email', 'class': 'form-control', 'placeholder': 'e-mail') }}
			</div>
			<br>
			<div class="inner-addon left-addon">
				<i class="glyphicon glyphicon-lock"></i>
				{{ password_field('password', 'class': 'form-control', 'placeholder': 'password') }}
			</div>
			<br>
			<div id="loginsubmit">
				<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
				<a id="forgotpwd" href="{{ url.getBaseUri() }}forgotPassword">Forgot your password?</a>
				{{ submit_button('Log In', 'class': 'myButton3') }}
			</div>
			</form>
		</div>
	</div>
	<!-- Filter Modal -->
	<div class="modal" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Filters</h4>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button id="savefiltersbtn" type="button" class="btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Comment Modal -->
	<div class="modal" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				{{ form('comment', 'role': 'form', 'id': 'outside_form') }}
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Write comment</h4>
					</div>
					<div class="modal-body">
						<input class="id_input" type="hidden" name="ad_id">
						<input class="name_input" type="hidden" name="name">
						{{ text_area('comment', 'class': 'form-control', 'rows': '6', 'placeholder': 'e.g., Comment about this escort', 'data-validetta': 'required') }}
					</div>
					<div class="modal-footer">
						{{ submit_button('Comment', 'class': 'myButton3') }}
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Withdraw Modal -->
	<div class="modal" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				{{ form('withdraw', 'id': 'outside_form') }}
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Withdraw request</h4>
					</div>
					<div class="modal-body">
						Please write available amount to make a withdraw request. All withdraws are handled in 48 hours from submitting this form.
						<br><br>
						Amount to withdraw: {{ text_field('amount', 'class': 'form-control', 'placeholder': 'e.g. 100', 'data-validetta': 'required,positive') }}
					</div>
					<div class="modal-footer">
						{{ submit_button('Submit', 'class': 'myButton3') }}
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Upload documents Modal -->
	<div class="modal" id="docsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Upload documents</h4>
				</div>
				<form action="documents" method='post' enctype='multipart/form-data'>
				<div class="modal-body">
					Please upload following photo/scan documents so that you can start withdrawing your earnings.
					Please upload both files together, not one by one:
					<br>
					- Photo/scan of your ID (Passport, ID Card (available only for EU, USA, CA, AU citizens)
					<br>
					- Proof of residence photo/scan (Utility bill, credit card statement or similar paper where your address is stated)
					<br><br>
					ID document: <input class="form-control1" type='file' name='files[]'>
					<br>
					Proof of residence:<input class="form-control1" type='file' name='files[]'>
				</div>
				<div class="modal-footer">
					<input value="Upload" class="myButton3" type="submit">
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Earnings Modal -->
	<div class="modal" id="earningsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Earnings</h4>
				</div>
				<div class="modal-body">
					Hello!<br><br>
					Now you are member of the best escort directory.<br><br>
					When you registered you got your bonus code, which gives you a possibility to earn some more money. Please continue reading. <br><br>
					For you we invented special system that gives you the possibility to earn additional money. It is called s3xBusiness.
					If you want to be part of this system you have to pay for packages at least 200 EUR each month. Then you will be placed in the
					system where you will be able to acquire new members with your bonus code (if someone registers with your bonus code and pays
					at least 200 EUR for packages that one will be under your system) or you will get new members when they register with no bonus
					code (system will automatically place them on the first empty spot in the system). <br><br>

					System is placed so that you have options:
					In 1. depth add 2 members, in 2. depth add 4 members and do on until you have full 5 levels deep and have 63 members including
					yourself in the system. You get total of 10% of the revenue your system did, including your payments. <br><br>

					Let's say you have:<br><br>
					63 members (with yourself) already in your system and each of you paid only 200 EUR for all ads they have, you would get: <br><br>
					63 x 200 EUR = 12600 EUR<br><br>
					Your earning:<br>
					10% of 12600 EUR = 1260 EUR<br><br>

					If you pay each more money then 200 EUR for your ads each month, then the earnings can be a lot more then just 1260 EUR.<br><br>

					Of course it does not have to be that your system ends with only 63 members (including you). You can create a new account anytime
					you want and pay ads from that account also (min 200 EUR) and you will be able to start making another 63 member scheme. We allow
					that each makes as many accounts as he want. <br><br>

					All you have pay attention is that you must pay each month for at least 200 EUR for ads if you want to earn this money generated
					by your down lines. If this requirement is not met you will not earn anything this month. And if this goes for 2 month you will be
					removed from earnings system and lose your spot.<br><br>

					When you register you get either first empty spot in the system or first
					empty spot in the scheme of your up line (if you entered in the registration form bonus code). Then you have 24H time to
					make payment for your ad/ads for at least 200 EUR, otherwise it can happen that you lose a good top spot, because a lot
					of registrations happens in the meantime. <br><br>

					We payout the earning from fourth day next month.
				</div>
			</div>
		</div>
	</div>
	<!-- Enter/Leave Modal -->
	<div class="modal fade" id="myModal">
		<div class="modalcontent">
			<div class="modal-head2"></div>
			<br /><br />
			<div class="modal-body2">
				<div id="left-body">
					<img src="img/{{ mainLogo }}.png" />
					<div id="left-content">
						<b>Responsability</b>
						<br /><br />
						Surfing this site and by clicking on any links on this web site, you will confirm that you have read, understand, and accepted the
						terms and conditions of this web site. In no case the administrators of this web site will be held responsible regarding the
						services offered from the advertisers ads or for the content that will be added by escorts on their escort web site.
						You are solely responsible for any text, reference, and information to your services.
						<br /><br />
						<b>Not employer</b>
						<br /><br />
						We are not the employer of the escorts introduced on our web sites. They are agencies and/or independent escorts, who assured that
						all services offered are in full compliance with applicable law.
						<br /><br />
						<b>You are an adult</b>
						<br /><br />
						You are an adult, being at least 18 years of age and you are not offended by adult content.
						<br /><br />
						<b>No offence</b>
						<br /><br />
						You are not accessing this material to use against any person, real or otherwise, in any conceivable manner. Your interest in all
						the data is of purely private character and the content of this site is only for your own use.
						<br /><br />
						<b>No defamation</b>
						<br /><br />
						If you are speaking about someone in a way that they may not approve, then you are defaming them. Content which is intended to injure
						another person's reputation is a violation. We do not tolerate disrespect of other individuals.
						<br /><br />
						<b>Use only original photos</b>
						<br /><br />
						If we find you are using unauthorized photos in your ad, we will suspend your ad without refund.
						<br /><br />
						<b>No copy</b>
						<br /><br />
						No portion of this web site may be copied, reproduced, duplicated, downloaded, transmitted, sold, resold or exploit for any
						commercial purposes, any portion of the service, use of the service, access to the service or otherwise used without the prior
						written consent of our site.
						<br /><br />
						<b>Do not steal</b>
						<br /><br />
						You are not allowed to post on our network any copied content from any source (escort web sites or not). In case we find any
						copyright infringement we will suspend your account without notice. No link should be placed without the consent of the linked
						web site.
						<br /><br />
						<b>Do reciprocal</b>
						<br /><br />
						If you have your own web site running, and are using our service as a second option, you need to post our banner or link, into
						your web site. You can find the banners and html code on the contact page. In case that you don`t respect this condition, you
						can have your account suspended without notice.
						<br /><br />
						<b>`Sex for money` and/or prostitution</b>
						<br /><br />
						Marketing for services which are illegal in your country is prohibited and not allowed. If we receive complaints or we suspect
						that the services you are advertising are not legal in your country, we will suspend your account without notice.
						<br /><br />
						<b>Be informed</b>
						<br /><br />
						You further acknowledge that we reserve the right to modify these general practices and limits from time to time without further notice.
					</div>
					<b class="consent">I am 18 years old and i want to</b><br /><br />
					<a href="#" class="myButton buttone" data-dismiss="modal" aria-hidden="true">Accept and enter</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="#" class="myButton1 buttonx" style="margin-bottom: 10px !important;">Refuse and leave</a>
				</div>
				<div id="right-body">
					<img src="../img/pinup-menu.jpg">
				</div>
			</div>
		</div>
	</div>
	<!-- END MODALS -->

	{{ javascript_include('js/jquery-1.12.4.min.js') }}
	{{ javascript_include('js/owl.carousel.js') }}
	{{ javascript_include('js/jquery.cookie.js') }}
	{{ javascript_include('js/jquery-ui.js') }}
	{{ javascript_include('js/jquery.msgBox.js') }}
	{{ javascript_include('js/bootstrap.js') }}
	{{ javascript_include('js/validetta.js') }}
	{{ javascript_include('js/jquery.countdown.js') }}
	{{ javascript_include('js/s3xnetworks.js') }}
	{{ javascript_include('js/cycle.js') }}
	{{ javascript_include('js/cycle2.js') }}
	{{ javascript_include('js/liqpay.js') }}

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-86682699-1', 'auto');
		ga('send', 'pageview');
	</script>
	</body>
</html>