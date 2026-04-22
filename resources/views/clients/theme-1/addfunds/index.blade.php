@extends('clients.layouts.app')

@section('title', 'Transactions')

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
					<div class="container-fluid container-dashboard addfunds-page">
				<div class="top-box">
					<div class="top-text">
						<h4>We accept payments from worldwide!</h4>
						<p>Please don't hesitate to contact with us for your payment questions. We are always at your service.</p>
					</div>
										<button class="btn btn-primary d-flex align-items-center" data-toggle="modal" data-target="#recentDeposits" fdprocessedid="fkixqu">
                        <i class="fal fa-history ms-2"></i><strong>Recent Deposits</strong>
                    </button>
						
			    </div>	
			    <div class="row">
									<div class="col-lg-7">
						<div class="card">
							<div class="card-header">
								<i class="far fa-wallet"></i>
								<span>Add funds</span>
							</div>
							<div class="card-body">
								<div class="dropdown ui-dropdown funds-dropdown">
								  <button class="form-control dropdown-toggle payment-drop" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" fdprocessedid="9t10na">বিকাশ - নগদ - রকেট [ For Bangladeshi User ] Min 0.2$ <span class="caret"></span><img src="https://storage.perfectcdn.com/jopxu2/0uxzgmywh52ludqh.webp" alt="বিকাশ - নগদ - রকেট [ For Bangladeshi User ] Min 0.2$"></button>
								  <div class="dropdown-overlay"></div>
								  <ul class="dropdown-menu dd-menu payment-list">
                                    										 <li class="payment-option" id="btn198018" type="radio" data-value="198018">
										  <a>
											<div class="option-header">
											  <p>বিকাশ - নগদ - রকেট [ For Bangladeshi User ] Min 0.2$</p>
											</div>
											<div class="payment-icons">
												<img src="https://storage.perfectcdn.com/jopxu2/0uxzgmywh52ludqh.webp" alt="বিকাশ - নগদ - রকেট [ For Bangladeshi User ] Min 0.2$">
											</div>
										  </a>
										</li>
										<script>
											$('#btn198018').click(function(){ 
												$('#method').val('198018').trigger('change');
											});
										</script>
                                    											 <li class="payment-option" id="btn197979" type="radio" data-value="197979">
										  <a>
											<div class="option-header">
											  <p>Binance Pay - [ Auto Pay ] - Min -1$ [ 5% Bonus ]</p>
											</div>
											<div class="payment-icons">
												<img src="https://storage.perfectcdn.com/jopxu2/d5joe23oixx84dse.webp" alt="Binance Pay - [ Auto Pay ] - Min -1$ [ 5% Bonus ]">
											</div>
										  </a>
										</li>
										<script>
											$('#btn197979').click(function(){ 
												$('#method').val('197979').trigger('change');
											});
										</script>
                                    											 <li class="payment-option" id="btn197916" type="radio" data-value="197916">
										  <a>
											<div class="option-header">
											  <p>Heleket ~ 𝐔𝐒𝐃𝐓 | 𝐁𝐓𝐂 | 𝐁𝐂𝐇 | 𝐄𝐓𝐇 | 𝐋𝐓𝐂 + More Crypto</p>
											</div>
											<div class="payment-icons">
												<img src="https://storage.perfectcdn.com/jopxu2/iue71hiri2t244w9.png" alt="Heleket ~ 𝐔𝐒𝐃𝐓 | 𝐁𝐓𝐂 | 𝐁𝐂𝐇 | 𝐄𝐓𝐇 | 𝐋𝐓𝐂 + More Crypto">
											</div>
										  </a>
										</li>
										<script>
											$('#btn197916').click(function(){ 
												$('#method').val('197916').trigger('change');
											});
										</script>
                                    										</ul>
									<i class="far fa-chevron-down"></i>
								</div>
								<form method="post" action="">
																										   <div class="form-group" style="display: none">
									  <label for="method" class="control-label">Method</label>
									  <select class="form-control" id="method" name="AddFoundsForm[type]">
																				  <option value="198018">বিকাশ - নগদ - রকেট [ For Bangladeshi User ] Min 0.2$</option>
																				  <option value="197979">Binance Pay - [ Auto Pay ] - Min -1$ [ 5% Bonus ]</option>
																				  <option value="197916">Heleket ~ 𝐔𝐒𝐃𝐓 | 𝐁𝐓𝐂 | 𝐁𝐂𝐇 | 𝐄𝐓𝐇 | 𝐋𝐓𝐂 + More Crypto</option>
																			  </select>
								   </div><div class="form-group instruction" id="instruction_instruction">
    <label class="control-label">Instruction</label>
    <div class="panel-body border-solid border-rounded text-center"><p class="p1" style="text-align: center; margin-bottom: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;">প্রদত্ত ফোন নম্বরগুলো শুধুমাত্র সাময়িকভাবে ভাড়া নিয়ে ব্যবহার করা হচ্ছে। তাই অনুগ্রহ করে এসব নম্বরে কল করবেন না। কেউ যদি কল করে, তার অ্যাকাউন্ট স্থায়ীভাবে সাসপেন্ড করা হতে পারে।</p><p class="p2" style="text-align: center; margin-bottom: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;; min-height: 15px;"><br></p><p class="p1" style="text-align: center; margin-bottom: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-variant-emoji: normal; font-stretch: normal; font-size: 13px; line-height: normal; font-family: &quot;Helvetica Neue&quot;;">পেমেন্ট-সংক্রান্ত যেকোনো সমস্যার জন্য অনুগ্রহ করে একটি সাপোর্ট টিকিট ওপেন করুন অথবা আমাদের <span style="background-color: rgb(255, 255, 255);"><a href="https://wa.me/message/2RZKMFZ6IHPCC1" target="_blank"><b style="">WhatsApp</b></a>&nbsp;</span>এ যোগাযোগ করুন। সাহায্যের জন্য আমরা সবসময় প্রস্তুত।</p></div>
</div>


								   <div class="addbalance-wrapper my-4">
									  <button class="addbalance-item" type="button" data-amount="50" fdprocessedid="gnk7j">50</button>
									  <button class="addbalance-item" type="button" data-amount="100" fdprocessedid="rmfmq">100</button>
									  <button class="addbalance-item" type="button" data-amount="250" fdprocessedid="9266d5">250</button>
									  <button class="addbalance-item" type="button" data-amount="" fdprocessedid="60kiuc">Custom</button>
								   </div>
								   
									<div class="form-group">
									  <div id="amount-fields" style="display: flex;">
										<div style="flex: 1 1 0%;">
										  <label for="amount" class="control-label"><span id="amount_label">Amount</span> <span id="amount_label_currency" class="">, USD</span></label>
										  <input type="text" inputmode="decimal" class="form-control" name="AddFoundsForm[amount]" id="amount" step="0.01" fdprocessedid="finod9">
										</div>
									  
<label id="amount-converted-icon" style="display: flex;align-items: center;margin: 0 18px;margin-bottom: -25px;" class="control-label">
    <i class="fas fa-exchange" style="color: currentColor;"></i>
</label>
<div id="amount-converted" style="flex: 1 1 0%;">
    <label for="amount-converted-input" class="control-label">
        Amount, BDT
    </label>
    <input type="text" inputmode="decimal" class="form-control" name="" id="amount-converted-input" fdprocessedid="e13a67">
</div></div>
									</div><div class="form-group fields commission-fields" id="order_extra_fee">
    <label class="control-label" for="field-commission-extra_fee">Extra fee</label>
    <input class="form-control" name="AddFoundsForm[fields][fee]" value="" type="text" disabled="" id="field-commission-extra_fee" data-fixed="" data-percent="5" fdprocessedid="j7l67">
</div>
<div class="form-group fields commission-fields" id="order_total">
    <label class="control-label" for="field-commission-total">Total</label>
    <input class="form-control" name="AddFoundsForm[fields][total]" value="" type="text" disabled="" id="field-commission-total" fdprocessedid="ocqqh">
</div>



									
																		
									
								    <input type="hidden" name="_csrf" value="9H5lfZJOLoZJodNEF97uKs5cNWnqvUDjs0DAvdfsoEqYChIo5AwD6gjbpndUvZd_uS1gD9nUd7fAEPLbgabkOg==">
									<button type="submit" class="btn btn-primary" fdprocessedid="bbco1">Pay</button>
								</form>
						
							</div>	
						</div>	
					</div>	
										<div class="col-lg-5">
						<div class="card">
							<div class="card-header">
								<i class="far fa-siren-on"></i>
								<span>Attention</span>
							</div>						
							<div class="card-body">
								                                     <div class="nothing-found">
                                           <div class="p-4 p-lg-5 text-center">
                                              <div style="font-size: 64px;">
                                                  <i class="fal fa-file-search"></i>
                                              </div>
                                              <p>There is no active information text.</p>
                                           </div>
                                     </div>
															</div>	
						</div>	
					</div>
			    </div>	
				
			</div>			
			
            <script>
              $(document).ready(function () {
                $('.payment-option').click(function () {
                  var paymentId = $(this).attr('id').replace('btn', ''); 
                  var selectedPayment = $('#btn' + paymentId + ' p').text();
                  var paymentImage = $('#btn' + paymentId + ' .payment-icons img').attr('src');
                  $('.dropdown-toggle.payment-drop').html(selectedPayment + ' <span class="caret"></span>'); 
                  $('.dropdown-toggle.payment-drop').append('<img src="' + paymentImage + '" alt="' + selectedPayment + '">');
                });
              });
              setTimeout(function() {
                $('.payment-option').first().click();
              }, 200); 
			  
			$('.payment-list .payment-option').each(function () {
			  const $option = $(this);
			  const headerText = $option.find('.option-header p').text().toLowerCase(); 
			  const $img = $option.find('.payment-icons img');
			  if ($img.length === 0) return;

			  let matched = false;

			  if (headerText.includes('credit card') || headerText.includes('visa') || headerText.includes('master')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/z5zpagx8nxn6rsgn.webp');
				matched = true;
			  } 
			  else if (headerText.includes('payeer')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/lpq1njug4iuyzqkg.webp');
				matched = true;
			  } 
			  else if (headerText.includes('heleket')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/iue71hiri2t244w9.png');
				matched = true;
			  } 
			  else if (headerText.includes('coinpayments')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/926nyagzs8noqnjy.webp');
				matched = true;
			  } 
			  else if (headerText.includes('cryptomus')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/hi2gb64edi0nwoki.webp');
				matched = true;
			  } 
			  else if (headerText.includes('crypto')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/jih5ux6po14d5ash.webp');
				matched = true;
			  } 
              else if (headerText.includes('UddoktaPayV2')) {
				$img.attr('src', 'https://storage.perfectcdn.com/o5c297/3ifkj7inx6sj820t.webp');
				matched = true;
			  }
			  else if (headerText.includes('payoneer')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/zcgehus9dqlbgphb.webp');
				matched = true;
			  } 
			  else if (headerText.includes('paypal')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/472fbnt2ihmtldk2.webp');
				matched = true;
			  } 
			  else if (headerText.includes('binance')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/d5joe23oixx84dse.webp');
				matched = true;
			  } 
			  else if (headerText.includes('paytm')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/jyao3orj4jtt5uzb.webp');
				matched = true;
			  } 
			  else if (headerText.includes('wise')) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/ir4nxazp6c7wij2n.webp');
				matched = true;
			  }
			  if (!matched) {
				$img.attr('src', 'https://storage.perfectcdn.com/jopxu2/0uxzgmywh52ludqh.webp');
			  }
			});
			</script>			
			
<!-- recent deposits -->
<div class="modal fade" id="recentDeposits" data-keyboard="false" tabindex="-1" aria-labelledby="recentDepositsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
		<div class="modal-icon">
			<i class="far fa-history"></i>
		</div>
        <h5 class="modal-title">Recent Deposits</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
		<div class="modal-body">
					<div class="card updates-card mb-2">
				<div class="up-block">
					<div class="up-first">
						<div class="up-id">134</div>
						<div class="up-name">Binance Pay - [ Auto Pay ] - Min -1$ [ 5% Bonus ]</div>
					</div>
				</div>
				<div class="up-block">
					<div class="up-alt-first">
						<div class="oc-status completed">
							<span>
								+																	1.00
															</span>
						</div>
					</div>
					<div class="up-alt-last">
						2025-12-10 01:36:04
					 </div>
				</div>
			</div>
				</div>
    </div>
  </div>
</div>
			
            

		<!-- Notifications wrapper -->
		<div id="notify-wrapper" class="alert alert-success hidden" style="display: none;"></div>

		

</div>
        
         
          		</div>
@endsection
