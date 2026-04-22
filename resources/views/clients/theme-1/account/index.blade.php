@extends('clients.layouts.app')

@section('title', 'Account')

@section('content')
<div class="app-content">
			<div class="page-head">
              <div class="container-fluid">
                              </div>
			   <div class="page-head-bg">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" width="100%" height="250" preserveAspectRatio="none" viewBox="0 0 1440 250"><g mask="url(&quot;#SvgjsMask1003&quot;)" fill="none"><path d="M36 250L286 0L604 0L354 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M258.6 250L508.6 0L634.6 0L384.6 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M484.20000000000005 250L734.2 0L956.2 0L706.2 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M740.8000000000001 250L990.8000000000001 0L1311.8000000000002 0L1061.8000000000002 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M1428 250L1178 0L866 0L1116 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M1157.4 250L907.4000000000001 0L788.9000000000001 0L1038.9 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M961.8 250L711.8 0L572.3 0L822.3 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M691.1999999999999 250L441.19999999999993 0L214.69999999999993 0L464.69999999999993 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M1199.0621593075448 250L1440 9.062159307544675L1440 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M0 250L240.93784069245532 250L 0 9.062159307544675z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path></g><defs><mask id="SvgjsMask1003"><rect width="1440" height="250" fill="var(--tw)"></rect></mask><linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="SvgjsLinearGradient1004"><stop stop-color="var(--mc)" offset="0"></stop><stop stop-opacity="0" stop-color="var(--main-bg)" offset="0.66"></stop></linearGradient></defs></svg>
			   </div>
			</div>
		
       
		<!-- Main variables *content* -->
		<style>
.rtl .select2-container--open .select2-dropdown {
    transform: translate(0%);
}
.rtl .select2-container--default .select2-selection--single .select2-selection__arrow {
    left: 12px;
    right: auto;
}
.rtl .select2.select2-container .select2-selection .select2-selection__rendered {
    display: block;
}
</style>
<div class="container-fluid container-dashboard">
				<div class="top-box">
					<div class="top-box-left">
						<div class="top-avatar" data-toggle="tooltip" title="" data-original-title="Change Avatar">
							<span data-sm="avatar" data-toggle="modal" data-target="#avatarModal"><img src="https://storage.perfectcdn.com/j71eqe/9ux9lbtkpqgitpjw.png" class="avatar" alt="Avatar 1"></span>
							<div class="pick-avatar">
								<i class="fas fa-pencil"></i>
							</div>
						</div>
						<div class="top-text">
							<h4><span>xoankhong00</span> <div class="alert alert-warning"></div></h4>
							<div class="top-phone"><span><i class="far fa-envelope primary-color mr-2"></i>xoankhong00@gmail.com</span> </div>
						</div>
					</div>
					<button class="btn btn-primary d-flex align-items-center" id="changeEmailLink" fdprocessedid="o12ugf9">
                        <i class="far fa-at me-2"></i><strong>Change email</strong>
                    </button>
			    </div>	

												
			  			  			  				<div style=" display: none; " class="alert alert-dismissible alert-danger ">
				  <button type="button" class="close">×</button>
				  <span></span>
				</div>
				
			    <div class="account-area">
					<div class="account-menu">
						<ul class="nav" id="tabAccount" role="tablist">
						  <li class="nav-item">
							<a class="nav-link active" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="true">
							  <i class="far fa-shield-alt"></i>
							  Security							</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" id="twofa-tab" data-toggle="tab" href="#twofa" role="tab" aria-controls="twofa" aria-selected="false">
							 <i class="far fa-qrcode"></i>
							  2FA							</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" id="timezone-tab" data-toggle="tab" href="#timezone" role="tab" aria-controls="timezone" aria-selected="false">
							  <i class="far fa-globe-europe"></i>
							  Region &amp; API							</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="/notifications">
							  <i class="far fa-bell"></i>
							  Notifications
							</a>
						  </li>
						</ul>
					</div>	
					<div class="account-content card">
						<div class="tab-content" id="tabAccountContent">
                            <div class="tab-pane fade show active" id="security" role="tabpanel" aria-labelledby="security-tab">
								<div class="tab-header">
									<i class="far fa-shield-alt"></i>
									<span></span>
								</div>
								 <form method="post" action="">
								   <div class="form-group">
									  <label for="current-password" class="control-label">Current password</label>
									  <input type="password" class="form-control" id="current-password" name="SettingsFrom[current_password]" fdprocessedid="n2o61i">
								   </div>
								   <div class="form-group">
									  <label for="new-password" class="control-label">New password</label>
									  <input type="password" class="form-control" id="new-password" name="SettingsFrom[password]" fdprocessedid="0d0d7t">
								   </div>
								   <div class="form-group">
									  <label for="confirm-password" class="control-label">Confirm new password</label>
									  <input type="password" class="form-control" id="confirm-password" name="SettingsFrom[confirm_password]" fdprocessedid="zyidnt">
								   </div>
								   <input type="hidden" name="_csrf" value="IvyDHqBzu3S1fxoXP8tsLLjfMxzGdsW0tg69v_B--SlOiPRL1jGWGPQFbyR8qBV5z65mevUf8uDFXo_ZpjS9WQ==">
								   <button type="submit" class="btn btn-primary btn-full" fdprocessedid="he4n3">Change password</button>
								</form>
							</div>
                            <div class="tab-pane fade" id="twofa" role="tabpanel" aria-labelledby="twofa-tab">
								<div class="tab-header">
									<i class="far fa-qrcode"></i>
									<span>
									  Two-factor authentication
									  									
									</span>
								</div>


								<div id="2fa-approve-error-block" style=" display: none; " class="alert alert-dismissible alert-danger ">
								  <button type="button" class="close">×</button>
								  <span id="2fa-error-text"></span>
								</div>

								<!-- 2FA Form generate code -->
								<form id="2fa-generate-form" method="post" action="/account/2fa/generate" style=" display: block; ">
								  <p>Email-based option to add an extra layer of protection to your account. When signing in you’ll need to enter a code that will be sent to your email address.</p>
								  <input type="hidden" name="enabled" value="1">
								  <input type="hidden" name="_csrf" value="IvyDHqBzu3S1fxoXP8tsLLjfMxzGdsW0tg69v_B--SlOiPRL1jGWGPQFbyR8qBV5z65mevUf8uDFXo_ZpjS9WQ==">
								  <button id="2fa-generate" type="submit" class="btn btn-primary">
																		  Enable
																	  </button>
								</form>

								<!-- 2FA Form approve code -->
								<form id="2fa-approve-form" method="post" action="/account/2fa/approve" style=" display: none; ">
								  <p>Please check your email and enter the code below.</p>
								  <div class="form-group">
									<label for="code" class="control-label">Code</label>
									<input type="text" id="code" name="code" class="form-control">
								  </div>
								  <input type="hidden" name="enabled" value="1">
								  <input type="hidden" name="_csrf" value="IvyDHqBzu3S1fxoXP8tsLLjfMxzGdsW0tg69v_B--SlOiPRL1jGWGPQFbyR8qBV5z65mevUf8uDFXo_ZpjS9WQ==">
								  <button id="2fa-approve" type="submit" class="btn btn-primary">
																		  Enable
																	  </button>
								</form>								
							</div>
                            <div class="tab-pane fade" id="timezone" role="tabpanel" aria-labelledby="timezone-tab">
							
								<div class="tab-header">
									<i class="fal fa-brackets-curly"></i>
									<span>API key</span>
								</div>
								<form action="/account/newkey" method="post">
								   <div class="form-group">
								   									  <input type="text" class="form-control" id="api_key" value="********************************" readonly="" data-original-title="" title="">
									  <small class="help-block">Created: 2025-12-10 01:39:09</small>
									  
								   </div>
								   <input type="hidden" name="_csrf" value="IvyDHqBzu3S1fxoXP8tsLLjfMxzGdsW0tg69v_B--SlOiPRL1jGWGPQFbyR8qBV5z65mevUf8uDFXo_ZpjS9WQ==">
								   <button type="submit" class="btn btn-primary">Generate new</button>
								</form>
								
								<div class="tab-header mt-5">
									<i class="far fa-globe-europe"></i>
									<span>Timezone</span>
								</div>
								<form action="" method="post">
								   <div class="form-group">
									  <select name="SettingsFrom[timezone]" id="timezone" class="form-select select2-hidden-accessible" style="width: 100%" data-select2-id="select2-data-timezone" tabindex="-1" aria-hidden="true">
										  											<option value="-43200">(UTC -12:00) Baker/Howland Island</option>
										  											<option value="-39600">(UTC -11:00) Niue</option>
										  											<option value="-36000">(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti</option>
										  											<option value="-34200">(UTC -9:30) Marquesas Islands</option>
										  											<option value="-32400">(UTC -9:00) Alaska Standard Time, Gambier Islands</option>
										  											<option value="-28800">(UTC -8:00) Pacific Standard Time, Clipperton Island</option>
										  											<option value="-25200">(UTC -7:00) Mountain Standard Time</option>
										  											<option value="-21600">(UTC -6:00) Central Standard Time</option>
										  											<option value="-18000">(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time</option>
										  											<option value="-16200">(UTC -4:30) Venezuelan Standard Time</option>
										  											<option value="-14400">(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time</option>
										  											<option value="-12600">(UTC -3:30) Newfoundland Standard Time</option>
										  											<option value="-10800">(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay</option>
										  											<option value="-7200">(UTC -2:00) South Georgia/South Sandwich Islands</option>
										  											<option value="-3600">(UTC -1:00) Azores, Cape Verde Islands</option>
										  											<option value="0">(UTC) Greenwich Mean Time, Western European Time</option>
										  											<option value="3600">(UTC +1:00) Central European Time, West Africa Time</option>
										  											<option value="7200">(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time</option>
										  											<option value="10800">(UTC +3:00) Moscow Time, East Africa Time, Arabia Standard Time</option>
										  											<option value="12600">(UTC +3:30) Iran Standard Time</option>
										  											<option value="14400">(UTC +4:00) Azerbaijan Standard Time, Samara Time</option>
										  											<option value="16200">(UTC +4:30) Afghanistan</option>
										  											<option value="18000">(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time</option>
										  											<option value="19800">(UTC +5:30) Indian Standard Time, Sri Lanka Time</option>
										  											<option value="20700">(UTC +5:45) Nepal Time</option>
										  											<option value="21600">(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time</option>
										  											<option value="23400">(UTC +6:30) Cocos Islands, Myanmar</option>
										  											<option value="25200" selected="" data-select2-id="select2-data-2-t7h0">(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam</option>
										  											<option value="28800">(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time</option>
										  											<option value="31500">(UTC +8:45) Australian Central Western Standard Time</option>
										  											<option value="32400">(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time</option>
										  											<option value="34200">(UTC +9:30) Australian Central Standard Time</option>
										  											<option value="36000">(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time</option>
										  											<option value="37800">(UTC +10:30) Lord Howe Island</option>
										  											<option value="39600">(UTC +11:00) Srednekolymsk Time, Solomon Islands, Vanuatu</option>
										  											<option value="41400">(UTC +11:30) Norfolk Island</option>
										  											<option value="43200">(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time</option>
										  											<option value="45900">(UTC +12:45) Chatham Islands Standard Time</option>
										  											<option value="46800">(UTC +13:00) Samoa Time Zone, Phoenix Islands Time, Tonga</option>
										  											<option value="50400">(UTC +14:00) Line Islands</option>
										  									  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-1-ejie" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-timezone-container" aria-controls="select2-timezone-container"><span class="select2-selection__rendered" id="select2-timezone-container" role="textbox" aria-readonly="true" title="(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam">(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
								   </div>
								    <input type="hidden" name="_csrf" value="IvyDHqBzu3S1fxoXP8tsLLjfMxzGdsW0tg69v_B--SlOiPRL1jGWGPQFbyR8qBV5z65mevUf8uDFXo_ZpjS9WQ==">
								   <button type="submit" class="btn btn-primary">Save</button>
								</form>
								 								<div class="tab-header mt-5">
									<i class="far fa-language"></i>
									<span>Language</span>
								</div>
								<form action="" method="post">
								   <div class="form-group">
									  <select nid="language" name="SettingsFrom[lang]" class="form-select select2-hidden-accessible" style="width: 100%" data-select2-id="select2-data-3-gvjy" tabindex="-1" aria-hidden="true">
																						  <option value="en" selected="" data-select2-id="select2-data-5-dxq9">English</option>
																						  <option value="ru">Russian</option>
																						  <option value="ar">Arabic</option>
																						  <option value="id">Indonesian</option>
																				  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-4-mgsr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-SettingsFromlang-89-container" aria-controls="select2-SettingsFromlang-89-container"><span class="select2-selection__rendered" id="select2-SettingsFromlang-89-container" role="textbox" aria-readonly="true" title="English">English</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
								   </div>
								    <input type="hidden" name="_csrf" value="IvyDHqBzu3S1fxoXP8tsLLjfMxzGdsW0tg69v_B--SlOiPRL1jGWGPQFbyR8qBV5z65mevUf8uDFXo_ZpjS9WQ==">
								   <button type="submit" class="btn btn-primary">Save</button>
								</form>
															</div>
						</div>
					</div>	
			    </div>	
				
			</div>			
			

<!-- Change Mail -->
<div class="modal fade" id="changeEmailModal" data-keyboard="false" tabindex="-1">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
		<form id="changeEmailForm" class="modal-content" method="post" action="/change-email">
		  <div class="modal-header">
			<div class="modal-icon">
				<i class="far fa-at"></i>
			</div>
			<h5 class="modal-title">Change email</h5>
			<button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
			  <span>×</span>
			</button>
		  </div>
			<div class="modal-body">
				<div id="changeEmailError" class="error-summary alert alert-dismissible alert-danger hidden"></div>
				<div class="form-group">
				  <label for="current-email">Current email</label>
				  <span class="form-control" id="current-email" disabled="">xoankhong00@gmail.com</span>
				</div>
				<div class="form-group">
				  <label for="new-email">New email</label>
				  <input type="email" class="form-control" id="new-email" name="ChangeEmailForm[email]">
				</div>
				<div class="form-group">
				  <label for="current-password">Current password</label>
				  <input type="password" class="form-control" id="current-password" name="ChangeEmailForm[password]">
				</div>
				<input type="hidden" name="_csrf" value="IvyDHqBzu3S1fxoXP8tsLLjfMxzGdsW0tg69v_B--SlOiPRL1jGWGPQFbyR8qBV5z65mevUf8uDFXo_ZpjS9WQ==">
			</div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" id="changeEmailSubmitBtn">Change email</button>
			  </div>
		</form>	
    </div>
  </div>
</div>
            

		<!-- Notifications wrapper -->
		<div id="notify-wrapper" class="alert alert-success hidden" style="display: none;"></div>

		
</div>
        
         
          		</div>
@endsection