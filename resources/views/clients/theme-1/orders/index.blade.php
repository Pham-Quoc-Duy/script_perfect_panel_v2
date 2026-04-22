@extends('clients.layouts.app')

@section('title', 'Orders')

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
				<div class="container-fluid container-dashboard">
				<div class="orders-filters">
					   <div class="sfc-item">
						  <div class="dropdown ui-dropdown">
							 <button type="button" class="btn btn-line-icon dropdown-toggle" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							 <span class="btn-icon">
								<i class="far fa-filter"></i>
							 </span>
							 <span class="btn-text">Filter Orders</span>
							 <span class="btn-chevron">
								<i class="far fa-angle-down"></i>
							 </span>
							 </button>
							 <div class="dropdown-overlay"></div>
							 <div class="dropdown-menu dd-menu" aria-labelledby="dropdownFilter">
								<ul class="dropdown-list">
								   <li>
									  <a href="/orders" class="dropdown-link">
									  <span class="text">All</span>
									  </a>
								   </li>
								   <li>
									  <a href="/orders/pending" class="dropdown-link">
									  <span class="text">Pending</span>
									  </a>
								   </li>
								   <li>
									  <a href="/orders/inprogress" class="dropdown-link">
									  <span class="text">In progress</span>
									  </a>
								   </li>
								   <li>
									  <a href="/orders/completed" class="dropdown-link">
									  <span class="text">Completed</span>
									  </a>
								   </li>
								   <li>
									  <a href="/orders/partial" class="dropdown-link">
									  <span class="text">Partial</span>
									  </a>
								   </li>
								   <li>
									  <a href="/orders/processing" class="dropdown-link">
									  <span class="text">Processing</span>
									  </a>
								   </li>
								   <li>
									  <a href="/orders/canceled" class="dropdown-link">
									  <span class="text">Canceled</span>
									  </a>
								   </li>
								</ul>
							 </div>
						  </div>
					   </div>
					   <div class="sf-item search">
						 <form action="/orders" method="get" id="history-search">
						  <label class="search-box">
							 <input type="text" class="search-box--input" id="service-search" name="search" value="" placeholder="Search">
							 <div class="search-box--icon">
								<i class="far fa-search"></i>
							 </div>
						   </label>
						  </form>
					   </div>
					</div>
				
								
				
				<div class="orders-wrapper">
											<div class="order-date" data-order-date="2025-12-11" style="display: flex;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-11</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="517">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">517</div>
								 <div class="oc-name">6281 - TikTok Likes [ Max 10K ] | Hidden Profiles | Cancel Enable | No Refill ⚠️ | Instant Start | Day 10K 🚀 𝗦𝗟𝗢𝗪</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status processing "><span>Processing</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6281" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal517">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://vt.tiktok.com/ZSP2DPgdr/" target="_blank">https://vt.tiktok.com/ZSP2DPgdr/</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.0075</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>1000</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>-</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>1000</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal517" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform517">
          <div id="sonuc517"></div>
          <input type="hidden" name="order_id" value="517">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #517">Cancellation</option>
              <option value="Dropped #517">The amount sent has decreased</option>
              <option value="Order has not started #517">Order not started</option>
              <option value="Other #517">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder517" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "517";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display: flex;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="508">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">508</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal508">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://vt.tiktok.com/ZSPYtNRKg/" target="_blank">https://vt.tiktok.com/ZSPYtNRKg/</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.0006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>2000</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>543</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal508" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform508">
          <div id="sonuc508"></div>
          <input type="hidden" name="order_id" value="508">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #508">Cancellation</option>
              <option value="Dropped #508">The amount sent has decreased</option>
              <option value="Order has not started #508">Order not started</option>
              <option value="Other #508">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder508" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "508";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="505">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">505</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal505">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@nhanthichreview71/video/7581426394584911112" target="_blank">https://www.tiktok.com/@nhanthichreview71/video/7581426394584911112</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.0009</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>3000</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>2768</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal505" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform505">
          <div id="sonuc505"></div>
          <input type="hidden" name="order_id" value="505">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #505">Cancellation</option>
              <option value="Dropped #505">The amount sent has decreased</option>
              <option value="Order has not started #505">Order not started</option>
              <option value="Other #505">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder505" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "505";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="504">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">504</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal504">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@nhanthichreview71/video/7581426031693778194" target="_blank">https://www.tiktok.com/@nhanthichreview71/video/7581426031693778194</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.0009</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>3000</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>2802</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal504" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform504">
          <div id="sonuc504"></div>
          <input type="hidden" name="order_id" value="504">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #504">Cancellation</option>
              <option value="Dropped #504">The amount sent has decreased</option>
              <option value="Order has not started #504">Order not started</option>
              <option value="Other #504">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder504" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "504";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="503">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">503</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal503">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@nhanthichreview71/video/7581425821508766983" target="_blank">https://www.tiktok.com/@nhanthichreview71/video/7581425821508766983</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.0009</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>3000</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>2733</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal503" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform503">
          <div id="sonuc503"></div>
          <input type="hidden" name="order_id" value="503">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #503">Cancellation</option>
              <option value="Dropped #503">The amount sent has decreased</option>
              <option value="Order has not started #503">Order not started</option>
              <option value="Other #503">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder503" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "503";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="502">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">502</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal502">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@nhanthichreview71/video/7581425375360634119" target="_blank">https://www.tiktok.com/@nhanthichreview71/video/7581425375360634119</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.0009</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>3000</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>4896</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal502" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform502">
          <div id="sonuc502"></div>
          <input type="hidden" name="order_id" value="502">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #502">Cancellation</option>
              <option value="Dropped #502">The amount sent has decreased</option>
              <option value="Order has not started #502">Order not started</option>
              <option value="Other #502">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder502" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "502";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="501">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">501</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal501">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@nhanthichreview71/video/7581423981295619336" target="_blank">https://www.tiktok.com/@nhanthichreview71/video/7581423981295619336</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00009</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>300</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>9963</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal501" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform501">
          <div id="sonuc501"></div>
          <input type="hidden" name="order_id" value="501">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #501">Cancellation</option>
              <option value="Dropped #501">The amount sent has decreased</option>
              <option value="Order has not started #501">Order not started</option>
              <option value="Other #501">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder501" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "501";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="499">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">499</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal499">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://vt.tiktok.com/ZSPYuhwcc/" target="_blank">https://vt.tiktok.com/ZSPYuhwcc/</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.003</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>10000</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>113</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal499" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform499">
          <div id="sonuc499"></div>
          <input type="hidden" name="order_id" value="499">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #499">Cancellation</option>
              <option value="Dropped #499">The amount sent has decreased</option>
              <option value="Order has not started #499">Order not started</option>
              <option value="Other #499">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder499" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "499";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="494">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">494</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal494">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@tin.trn3088/video/7580668018649222418" target="_blank">https://www.tiktok.com/@tin.trn3088/video/7580668018649222418</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.003</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>10000</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>527</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal494" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform494">
          <div id="sonuc494"></div>
          <input type="hidden" name="order_id" value="494">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #494">Cancellation</option>
              <option value="Dropped #494">The amount sent has decreased</option>
              <option value="Order has not started #494">Order not started</option>
              <option value="Other #494">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder494" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "494";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="489">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">489</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal489">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7461033678983023890" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7461033678983023890</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>618</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal489" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform489">
          <div id="sonuc489"></div>
          <input type="hidden" name="order_id" value="489">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #489">Cancellation</option>
              <option value="Dropped #489">The amount sent has decreased</option>
              <option value="Order has not started #489">Order not started</option>
              <option value="Other #489">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder489" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "489";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="488">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">488</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal488">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7463809150384983304" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7463809150384983304</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>94</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal488" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform488">
          <div id="sonuc488"></div>
          <input type="hidden" name="order_id" value="488">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #488">Cancellation</option>
              <option value="Dropped #488">The amount sent has decreased</option>
              <option value="Order has not started #488">Order not started</option>
              <option value="Other #488">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder488" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "488";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="487">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">487</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal487">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7471610903474031879" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7471610903474031879</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>94</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal487" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform487">
          <div id="sonuc487"></div>
          <input type="hidden" name="order_id" value="487">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #487">Cancellation</option>
              <option value="Dropped #487">The amount sent has decreased</option>
              <option value="Order has not started #487">Order not started</option>
              <option value="Other #487">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder487" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "487";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="486">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">486</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal486">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7472351499293658375" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7472351499293658375</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>165</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal486" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform486">
          <div id="sonuc486"></div>
          <input type="hidden" name="order_id" value="486">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #486">Cancellation</option>
              <option value="Dropped #486">The amount sent has decreased</option>
              <option value="Order has not started #486">Order not started</option>
              <option value="Other #486">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder486" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "486";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="485">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">485</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal485">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7472746438389288200" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7472746438389288200</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>141</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal485" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform485">
          <div id="sonuc485"></div>
          <input type="hidden" name="order_id" value="485">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #485">Cancellation</option>
              <option value="Dropped #485">The amount sent has decreased</option>
              <option value="Order has not started #485">Order not started</option>
              <option value="Other #485">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder485" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "485";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="484">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">484</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal484">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/photo/7473463559691701511" target="_blank">https://www.tiktok.com/@hoangkha2003bg/photo/7473463559691701511</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>114</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal484" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform484">
          <div id="sonuc484"></div>
          <input type="hidden" name="order_id" value="484">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #484">Cancellation</option>
              <option value="Dropped #484">The amount sent has decreased</option>
              <option value="Order has not started #484">Order not started</option>
              <option value="Other #484">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder484" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "484";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="483">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">483</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal483">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7474190257102097682" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7474190257102097682</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>136</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal483" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform483">
          <div id="sonuc483"></div>
          <input type="hidden" name="order_id" value="483">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #483">Cancellation</option>
              <option value="Dropped #483">The amount sent has decreased</option>
              <option value="Order has not started #483">Order not started</option>
              <option value="Other #483">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder483" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "483";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="482">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">482</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal482">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7474472120894934280" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7474472120894934280</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>137</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal482" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform482">
          <div id="sonuc482"></div>
          <input type="hidden" name="order_id" value="482">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #482">Cancellation</option>
              <option value="Dropped #482">The amount sent has decreased</option>
              <option value="Order has not started #482">Order not started</option>
              <option value="Other #482">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder482" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "482";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="481">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">481</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal481">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7476059806676028679" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7476059806676028679</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>152</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal481" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform481">
          <div id="sonuc481"></div>
          <input type="hidden" name="order_id" value="481">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #481">Cancellation</option>
              <option value="Dropped #481">The amount sent has decreased</option>
              <option value="Order has not started #481">Order not started</option>
              <option value="Other #481">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder481" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "481";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="480">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">480</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal480">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7476430201749097735" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7476430201749097735</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>34</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal480" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform480">
          <div id="sonuc480"></div>
          <input type="hidden" name="order_id" value="480">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #480">Cancellation</option>
              <option value="Dropped #480">The amount sent has decreased</option>
              <option value="Order has not started #480">Order not started</option>
              <option value="Other #480">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder480" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "480";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="479">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">479</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal479">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/photo/7484098166900444423" target="_blank">https://www.tiktok.com/@hoangkha2003bg/photo/7484098166900444423</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>146</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal479" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform479">
          <div id="sonuc479"></div>
          <input type="hidden" name="order_id" value="479">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #479">Cancellation</option>
              <option value="Dropped #479">The amount sent has decreased</option>
              <option value="Order has not started #479">Order not started</option>
              <option value="Other #479">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder479" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "479";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="478">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">478</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal478">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7486086431220190472" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7486086431220190472</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>151</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal478" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform478">
          <div id="sonuc478"></div>
          <input type="hidden" name="order_id" value="478">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #478">Cancellation</option>
              <option value="Dropped #478">The amount sent has decreased</option>
              <option value="Order has not started #478">Order not started</option>
              <option value="Other #478">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder478" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "478";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="477">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">477</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal477">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/photo/7492425031939591431" target="_blank">https://www.tiktok.com/@hoangkha2003bg/photo/7492425031939591431</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>175</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal477" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform477">
          <div id="sonuc477"></div>
          <input type="hidden" name="order_id" value="477">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #477">Cancellation</option>
              <option value="Dropped #477">The amount sent has decreased</option>
              <option value="Order has not started #477">Order not started</option>
              <option value="Other #477">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder477" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "477";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="476">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">476</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal476">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7492679682035305736" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7492679682035305736</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>0</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal476" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform476">
          <div id="sonuc476"></div>
          <input type="hidden" name="order_id" value="476">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #476">Cancellation</option>
              <option value="Dropped #476">The amount sent has decreased</option>
              <option value="Order has not started #476">Order not started</option>
              <option value="Other #476">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder476" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "476";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="475">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">475</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal475">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7494611607872359687" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7494611607872359687</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>396</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal475" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform475">
          <div id="sonuc475"></div>
          <input type="hidden" name="order_id" value="475">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #475">Cancellation</option>
              <option value="Dropped #475">The amount sent has decreased</option>
              <option value="Order has not started #475">Order not started</option>
              <option value="Other #475">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder475" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "475";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="474">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">474</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal474">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7494679328635014418" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7494679328635014418</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>676</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal474" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform474">
          <div id="sonuc474"></div>
          <input type="hidden" name="order_id" value="474">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #474">Cancellation</option>
              <option value="Dropped #474">The amount sent has decreased</option>
              <option value="Order has not started #474">Order not started</option>
              <option value="Other #474">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder474" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "474";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="473">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">473</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal473">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7494945152323144968" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7494945152323144968</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>0</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal473" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform473">
          <div id="sonuc473"></div>
          <input type="hidden" name="order_id" value="473">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #473">Cancellation</option>
              <option value="Dropped #473">The amount sent has decreased</option>
              <option value="Order has not started #473">Order not started</option>
              <option value="Other #473">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder473" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "473";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="472">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">472</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal472">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7495287658365635847" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7495287658365635847</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>701</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal472" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform472">
          <div id="sonuc472"></div>
          <input type="hidden" name="order_id" value="472">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #472">Cancellation</option>
              <option value="Dropped #472">The amount sent has decreased</option>
              <option value="Order has not started #472">Order not started</option>
              <option value="Other #472">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder472" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "472";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="471">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">471</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal471">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7495736668800978184" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7495736668800978184</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>383</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal471" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform471">
          <div id="sonuc471"></div>
          <input type="hidden" name="order_id" value="471">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #471">Cancellation</option>
              <option value="Dropped #471">The amount sent has decreased</option>
              <option value="Order has not started #471">Order not started</option>
              <option value="Other #471">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder471" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "471";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="470">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">470</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal470">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/photo/7496058928325823752" target="_blank">https://www.tiktok.com/@hoangkha2003bg/photo/7496058928325823752</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>342</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal470" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform470">
          <div id="sonuc470"></div>
          <input type="hidden" name="order_id" value="470">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #470">Cancellation</option>
              <option value="Dropped #470">The amount sent has decreased</option>
              <option value="Order has not started #470">Order not started</option>
              <option value="Other #470">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder470" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "470";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="469">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">469</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal469">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7497622362653871368" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7497622362653871368</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>474</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal469" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform469">
          <div id="sonuc469"></div>
          <input type="hidden" name="order_id" value="469">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #469">Cancellation</option>
              <option value="Dropped #469">The amount sent has decreased</option>
              <option value="Order has not started #469">Order not started</option>
              <option value="Other #469">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder469" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "469";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="468">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">468</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal468">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7498571340169973000" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7498571340169973000</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>414</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal468" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform468">
          <div id="sonuc468"></div>
          <input type="hidden" name="order_id" value="468">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #468">Cancellation</option>
              <option value="Dropped #468">The amount sent has decreased</option>
              <option value="Order has not started #468">Order not started</option>
              <option value="Other #468">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder468" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "468";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="467">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">467</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal467">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7498679650638482696" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7498679650638482696</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>283</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal467" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform467">
          <div id="sonuc467"></div>
          <input type="hidden" name="order_id" value="467">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #467">Cancellation</option>
              <option value="Dropped #467">The amount sent has decreased</option>
              <option value="Order has not started #467">Order not started</option>
              <option value="Other #467">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder467" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "467";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="466">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">466</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal466">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7498945950296067336" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7498945950296067336</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>437</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal466" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform466">
          <div id="sonuc466"></div>
          <input type="hidden" name="order_id" value="466">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #466">Cancellation</option>
              <option value="Dropped #466">The amount sent has decreased</option>
              <option value="Order has not started #466">Order not started</option>
              <option value="Other #466">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder466" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "466";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="465">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">465</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal465">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7499088629390789906" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7499088629390789906</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>142</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal465" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform465">
          <div id="sonuc465"></div>
          <input type="hidden" name="order_id" value="465">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #465">Cancellation</option>
              <option value="Dropped #465">The amount sent has decreased</option>
              <option value="Order has not started #465">Order not started</option>
              <option value="Other #465">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder465" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "465";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="464">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">464</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal464">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7499333423849540872" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7499333423849540872</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>228</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal464" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform464">
          <div id="sonuc464"></div>
          <input type="hidden" name="order_id" value="464">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #464">Cancellation</option>
              <option value="Dropped #464">The amount sent has decreased</option>
              <option value="Order has not started #464">Order not started</option>
              <option value="Other #464">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder464" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "464";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="463">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">463</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal463">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7499703079160286472" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7499703079160286472</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>172</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal463" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform463">
          <div id="sonuc463"></div>
          <input type="hidden" name="order_id" value="463">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #463">Cancellation</option>
              <option value="Dropped #463">The amount sent has decreased</option>
              <option value="Order has not started #463">Order not started</option>
              <option value="Other #463">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder463" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "463";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="462">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">462</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal462">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7499841078539865362" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7499841078539865362</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>234</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal462" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform462">
          <div id="sonuc462"></div>
          <input type="hidden" name="order_id" value="462">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #462">Cancellation</option>
              <option value="Dropped #462">The amount sent has decreased</option>
              <option value="Order has not started #462">Order not started</option>
              <option value="Other #462">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder462" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "462";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="461">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">461</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal461">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7500575839994514695" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7500575839994514695</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>169</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal461" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform461">
          <div id="sonuc461"></div>
          <input type="hidden" name="order_id" value="461">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #461">Cancellation</option>
              <option value="Dropped #461">The amount sent has decreased</option>
              <option value="Order has not started #461">Order not started</option>
              <option value="Other #461">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder461" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "461";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="460">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">460</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal460">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7500821739333537042" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7500821739333537042</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>450</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal460" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform460">
          <div id="sonuc460"></div>
          <input type="hidden" name="order_id" value="460">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #460">Cancellation</option>
              <option value="Dropped #460">The amount sent has decreased</option>
              <option value="Order has not started #460">Order not started</option>
              <option value="Other #460">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder460" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "460";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="459">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">459</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal459">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7501204034200653064" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7501204034200653064</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>892</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal459" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform459">
          <div id="sonuc459"></div>
          <input type="hidden" name="order_id" value="459">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #459">Cancellation</option>
              <option value="Dropped #459">The amount sent has decreased</option>
              <option value="Order has not started #459">Order not started</option>
              <option value="Other #459">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder459" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "459";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="458">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">458</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal458">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7501708599526165768" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7501708599526165768</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>482</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal458" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform458">
          <div id="sonuc458"></div>
          <input type="hidden" name="order_id" value="458">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #458">Cancellation</option>
              <option value="Dropped #458">The amount sent has decreased</option>
              <option value="Order has not started #458">Order not started</option>
              <option value="Other #458">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder458" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "458";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="457">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">457</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal457">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7501945577811365128" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7501945577811365128</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>241</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal457" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform457">
          <div id="sonuc457"></div>
          <input type="hidden" name="order_id" value="457">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #457">Cancellation</option>
              <option value="Dropped #457">The amount sent has decreased</option>
              <option value="Order has not started #457">Order not started</option>
              <option value="Other #457">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder457" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "457";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="456">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">456</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal456">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7502791107324022034" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7502791107324022034</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>229</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal456" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform456">
          <div id="sonuc456"></div>
          <input type="hidden" name="order_id" value="456">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #456">Cancellation</option>
              <option value="Dropped #456">The amount sent has decreased</option>
              <option value="Order has not started #456">Order not started</option>
              <option value="Other #456">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder456" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "456";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="455">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">455</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal455">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7504303150640254215" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7504303150640254215</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>161</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal455" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform455">
          <div id="sonuc455"></div>
          <input type="hidden" name="order_id" value="455">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #455">Cancellation</option>
              <option value="Dropped #455">The amount sent has decreased</option>
              <option value="Order has not started #455">Order not started</option>
              <option value="Other #455">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder455" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "455";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="454">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">454</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal454">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7504908407506291976" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7504908407506291976</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>171</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal454" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform454">
          <div id="sonuc454"></div>
          <input type="hidden" name="order_id" value="454">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #454">Cancellation</option>
              <option value="Dropped #454">The amount sent has decreased</option>
              <option value="Order has not started #454">Order not started</option>
              <option value="Other #454">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder454" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "454";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="453">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">453</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal453">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7505364537563057416" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7505364537563057416</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>150</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal453" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform453">
          <div id="sonuc453"></div>
          <input type="hidden" name="order_id" value="453">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #453">Cancellation</option>
              <option value="Dropped #453">The amount sent has decreased</option>
              <option value="Order has not started #453">Order not started</option>
              <option value="Other #453">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder453" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "453";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="452">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">452</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal452">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7506547172356164882" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7506547172356164882</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>180</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal452" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform452">
          <div id="sonuc452"></div>
          <input type="hidden" name="order_id" value="452">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #452">Cancellation</option>
              <option value="Dropped #452">The amount sent has decreased</option>
              <option value="Order has not started #452">Order not started</option>
              <option value="Other #452">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder452" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "452";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="451">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">451</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal451">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7506860597527727367" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7506860597527727367</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>377</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal451" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform451">
          <div id="sonuc451"></div>
          <input type="hidden" name="order_id" value="451">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #451">Cancellation</option>
              <option value="Dropped #451">The amount sent has decreased</option>
              <option value="Order has not started #451">Order not started</option>
              <option value="Other #451">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder451" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "451";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="450">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">450</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal450">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7507867315531353351" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7507867315531353351</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>144</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal450" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform450">
          <div id="sonuc450"></div>
          <input type="hidden" name="order_id" value="450">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #450">Cancellation</option>
              <option value="Dropped #450">The amount sent has decreased</option>
              <option value="Order has not started #450">Order not started</option>
              <option value="Other #450">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder450" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "450";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="449">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">449</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal449">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7509107366231608594" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7509107366231608594</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>215</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal449" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform449">
          <div id="sonuc449"></div>
          <input type="hidden" name="order_id" value="449">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #449">Cancellation</option>
              <option value="Dropped #449">The amount sent has decreased</option>
              <option value="Order has not started #449">Order not started</option>
              <option value="Other #449">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder449" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "449";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="448">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">448</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal448">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/photo/7510220635210059015" target="_blank">https://www.tiktok.com/@hoangkha2003bg/photo/7510220635210059015</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>214</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal448" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform448">
          <div id="sonuc448"></div>
          <input type="hidden" name="order_id" value="448">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #448">Cancellation</option>
              <option value="Dropped #448">The amount sent has decreased</option>
              <option value="Order has not started #448">Order not started</option>
              <option value="Other #448">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder448" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "448";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="447">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">447</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal447">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7512081737858518290" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7512081737858518290</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>166</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal447" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform447">
          <div id="sonuc447"></div>
          <input type="hidden" name="order_id" value="447">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #447">Cancellation</option>
              <option value="Dropped #447">The amount sent has decreased</option>
              <option value="Order has not started #447">Order not started</option>
              <option value="Other #447">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder447" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "447";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="446">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">446</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal446">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7512456428444060936" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7512456428444060936</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>205</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal446" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform446">
          <div id="sonuc446"></div>
          <input type="hidden" name="order_id" value="446">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #446">Cancellation</option>
              <option value="Dropped #446">The amount sent has decreased</option>
              <option value="Order has not started #446">Order not started</option>
              <option value="Other #446">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder446" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "446";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="445">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">445</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal445">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7513820936534248710" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7513820936534248710</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>160</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal445" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform445">
          <div id="sonuc445"></div>
          <input type="hidden" name="order_id" value="445">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #445">Cancellation</option>
              <option value="Dropped #445">The amount sent has decreased</option>
              <option value="Order has not started #445">Order not started</option>
              <option value="Other #445">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder445" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "445";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="444">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">444</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal444">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7515647068573060370" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7515647068573060370</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>181</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal444" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform444">
          <div id="sonuc444"></div>
          <input type="hidden" name="order_id" value="444">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #444">Cancellation</option>
              <option value="Dropped #444">The amount sent has decreased</option>
              <option value="Order has not started #444">Order not started</option>
              <option value="Other #444">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder444" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "444";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="443">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">443</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal443">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7518739681412959495" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7518739681412959495</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>189</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal443" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform443">
          <div id="sonuc443"></div>
          <input type="hidden" name="order_id" value="443">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #443">Cancellation</option>
              <option value="Dropped #443">The amount sent has decreased</option>
              <option value="Order has not started #443">Order not started</option>
              <option value="Other #443">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder443" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "443";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="442">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">442</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal442">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7524714249860533511" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7524714249860533511</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>1317</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal442" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform442">
          <div id="sonuc442"></div>
          <input type="hidden" name="order_id" value="442">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #442">Cancellation</option>
              <option value="Dropped #442">The amount sent has decreased</option>
              <option value="Order has not started #442">Order not started</option>
              <option value="Other #442">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder442" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "442";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="441">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">441</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal441">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7526529101453135111" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7526529101453135111</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>180</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal441" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform441">
          <div id="sonuc441"></div>
          <input type="hidden" name="order_id" value="441">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #441">Cancellation</option>
              <option value="Dropped #441">The amount sent has decreased</option>
              <option value="Order has not started #441">Order not started</option>
              <option value="Other #441">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder441" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "441";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="440">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">440</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal440">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7526907552668437778" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7526907552668437778</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>196</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal440" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform440">
          <div id="sonuc440"></div>
          <input type="hidden" name="order_id" value="440">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #440">Cancellation</option>
              <option value="Dropped #440">The amount sent has decreased</option>
              <option value="Order has not started #440">Order not started</option>
              <option value="Other #440">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder440" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "440";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="439">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">439</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal439">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7528030098650352914" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7528030098650352914</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>174</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal439" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform439">
          <div id="sonuc439"></div>
          <input type="hidden" name="order_id" value="439">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #439">Cancellation</option>
              <option value="Dropped #439">The amount sent has decreased</option>
              <option value="Order has not started #439">Order not started</option>
              <option value="Other #439">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder439" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "439";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="438">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">438</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal438">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7529464882979179794" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7529464882979179794</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>199</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal438" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform438">
          <div id="sonuc438"></div>
          <input type="hidden" name="order_id" value="438">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #438">Cancellation</option>
              <option value="Dropped #438">The amount sent has decreased</option>
              <option value="Order has not started #438">Order not started</option>
              <option value="Other #438">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder438" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "438";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="437">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">437</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal437">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7529719845483531528" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7529719845483531528</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>207</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal437" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform437">
          <div id="sonuc437"></div>
          <input type="hidden" name="order_id" value="437">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #437">Cancellation</option>
              <option value="Dropped #437">The amount sent has decreased</option>
              <option value="Order has not started #437">Order not started</option>
              <option value="Other #437">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder437" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "437";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="436">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">436</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal436">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7530846325311540487" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7530846325311540487</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>251</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal436" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform436">
          <div id="sonuc436"></div>
          <input type="hidden" name="order_id" value="436">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #436">Cancellation</option>
              <option value="Dropped #436">The amount sent has decreased</option>
              <option value="Order has not started #436">Order not started</option>
              <option value="Other #436">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder436" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "436";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="435">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">435</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal435">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7531614013457714439" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7531614013457714439</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>92</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal435" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform435">
          <div id="sonuc435"></div>
          <input type="hidden" name="order_id" value="435">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #435">Cancellation</option>
              <option value="Dropped #435">The amount sent has decreased</option>
              <option value="Order has not started #435">Order not started</option>
              <option value="Other #435">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder435" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "435";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="434">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">434</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal434">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7531988199829196050" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7531988199829196050</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>190</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal434" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform434">
          <div id="sonuc434"></div>
          <input type="hidden" name="order_id" value="434">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #434">Cancellation</option>
              <option value="Dropped #434">The amount sent has decreased</option>
              <option value="Order has not started #434">Order not started</option>
              <option value="Other #434">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder434" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "434";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="433">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">433</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal433">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7533266370650328338" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7533266370650328338</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>231</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal433" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform433">
          <div id="sonuc433"></div>
          <input type="hidden" name="order_id" value="433">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #433">Cancellation</option>
              <option value="Dropped #433">The amount sent has decreased</option>
              <option value="Order has not started #433">Order not started</option>
              <option value="Other #433">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder433" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "433";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="432">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">432</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal432">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7533468047068105991" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7533468047068105991</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>579</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal432" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform432">
          <div id="sonuc432"></div>
          <input type="hidden" name="order_id" value="432">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #432">Cancellation</option>
              <option value="Dropped #432">The amount sent has decreased</option>
              <option value="Order has not started #432">Order not started</option>
              <option value="Other #432">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder432" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "432";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="431">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">431</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal431">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7533813991412419848" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7533813991412419848</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>242</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal431" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform431">
          <div id="sonuc431"></div>
          <input type="hidden" name="order_id" value="431">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #431">Cancellation</option>
              <option value="Dropped #431">The amount sent has decreased</option>
              <option value="Order has not started #431">Order not started</option>
              <option value="Other #431">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder431" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "431";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="430">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">430</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal430">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7534329305900338440" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7534329305900338440</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>305</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal430" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform430">
          <div id="sonuc430"></div>
          <input type="hidden" name="order_id" value="430">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #430">Cancellation</option>
              <option value="Dropped #430">The amount sent has decreased</option>
              <option value="Order has not started #430">Order not started</option>
              <option value="Other #430">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder430" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "430";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="429">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">429</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal429">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7536731642161941778" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7536731642161941778</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>372</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal429" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform429">
          <div id="sonuc429"></div>
          <input type="hidden" name="order_id" value="429">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #429">Cancellation</option>
              <option value="Dropped #429">The amount sent has decreased</option>
              <option value="Order has not started #429">Order not started</option>
              <option value="Other #429">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder429" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "429";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="428">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">428</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal428">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7536843594162883848" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7536843594162883848</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>101</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal428" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform428">
          <div id="sonuc428"></div>
          <input type="hidden" name="order_id" value="428">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #428">Cancellation</option>
              <option value="Dropped #428">The amount sent has decreased</option>
              <option value="Order has not started #428">Order not started</option>
              <option value="Other #428">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder428" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "428";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="427">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">427</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal427">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7537924528047918344" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7537924528047918344</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>249</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal427" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform427">
          <div id="sonuc427"></div>
          <input type="hidden" name="order_id" value="427">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #427">Cancellation</option>
              <option value="Dropped #427">The amount sent has decreased</option>
              <option value="Order has not started #427">Order not started</option>
              <option value="Other #427">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder427" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "427";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="426">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">426</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal426">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7539499374326320405" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7539499374326320405</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>240</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal426" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform426">
          <div id="sonuc426"></div>
          <input type="hidden" name="order_id" value="426">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #426">Cancellation</option>
              <option value="Dropped #426">The amount sent has decreased</option>
              <option value="Order has not started #426">Order not started</option>
              <option value="Other #426">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder426" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "426";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="425">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">425</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal425">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7540256502360116501" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7540256502360116501</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>185</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal425" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform425">
          <div id="sonuc425"></div>
          <input type="hidden" name="order_id" value="425">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #425">Cancellation</option>
              <option value="Dropped #425">The amount sent has decreased</option>
              <option value="Order has not started #425">Order not started</option>
              <option value="Other #425">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder425" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "425";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="424">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">424</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal424">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7540651829042924816" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7540651829042924816</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>89</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal424" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform424">
          <div id="sonuc424"></div>
          <input type="hidden" name="order_id" value="424">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #424">Cancellation</option>
              <option value="Dropped #424">The amount sent has decreased</option>
              <option value="Order has not started #424">Order not started</option>
              <option value="Other #424">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder424" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "424";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="423">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">423</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal423">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7541324761796840705" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7541324761796840705</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>219</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal423" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform423">
          <div id="sonuc423"></div>
          <input type="hidden" name="order_id" value="423">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #423">Cancellation</option>
              <option value="Dropped #423">The amount sent has decreased</option>
              <option value="Order has not started #423">Order not started</option>
              <option value="Other #423">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder423" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "423";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="422">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">422</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal422">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7541611352503241991" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7541611352503241991</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>226</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal422" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform422">
          <div id="sonuc422"></div>
          <input type="hidden" name="order_id" value="422">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #422">Cancellation</option>
              <option value="Dropped #422">The amount sent has decreased</option>
              <option value="Order has not started #422">Order not started</option>
              <option value="Other #422">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder422" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "422";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="421">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">421</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal421">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7541738934573812993" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7541738934573812993</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>208</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal421" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform421">
          <div id="sonuc421"></div>
          <input type="hidden" name="order_id" value="421">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #421">Cancellation</option>
              <option value="Dropped #421">The amount sent has decreased</option>
              <option value="Order has not started #421">Order not started</option>
              <option value="Other #421">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder421" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "421";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="420">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">420</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal420">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7542454398220274964" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7542454398220274964</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal420" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform420">
          <div id="sonuc420"></div>
          <input type="hidden" name="order_id" value="420">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #420">Cancellation</option>
              <option value="Dropped #420">The amount sent has decreased</option>
              <option value="Order has not started #420">Order not started</option>
              <option value="Other #420">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder420" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "420";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="419">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">419</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal419">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7543054721855048980" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7543054721855048980</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>9160</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal419" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform419">
          <div id="sonuc419"></div>
          <input type="hidden" name="order_id" value="419">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #419">Cancellation</option>
              <option value="Dropped #419">The amount sent has decreased</option>
              <option value="Order has not started #419">Order not started</option>
              <option value="Other #419">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder419" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "419";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="418">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">418</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal418">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7543820842124184833" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7543820842124184833</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>436</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal418" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform418">
          <div id="sonuc418"></div>
          <input type="hidden" name="order_id" value="418">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #418">Cancellation</option>
              <option value="Dropped #418">The amount sent has decreased</option>
              <option value="Order has not started #418">Order not started</option>
              <option value="Other #418">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder418" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "418";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="417">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">417</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal417">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7545106313521483029" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7545106313521483029</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>260</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal417" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform417">
          <div id="sonuc417"></div>
          <input type="hidden" name="order_id" value="417">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #417">Cancellation</option>
              <option value="Dropped #417">The amount sent has decreased</option>
              <option value="Order has not started #417">Order not started</option>
              <option value="Other #417">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder417" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "417";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="416">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">416</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal416">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7545330103404793108" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7545330103404793108</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>227</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal416" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform416">
          <div id="sonuc416"></div>
          <input type="hidden" name="order_id" value="416">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #416">Cancellation</option>
              <option value="Dropped #416">The amount sent has decreased</option>
              <option value="Order has not started #416">Order not started</option>
              <option value="Other #416">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder416" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "416";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="415">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">415</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal415">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7545660943967997205" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7545660943967997205</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>253</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal415" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform415">
          <div id="sonuc415"></div>
          <input type="hidden" name="order_id" value="415">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #415">Cancellation</option>
              <option value="Dropped #415">The amount sent has decreased</option>
              <option value="Order has not started #415">Order not started</option>
              <option value="Other #415">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder415" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "415";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="414">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">414</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal414">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/photo/7546571472089648401" target="_blank">https://www.tiktok.com/@hoangkha2003bg/photo/7546571472089648401</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>572</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal414" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform414">
          <div id="sonuc414"></div>
          <input type="hidden" name="order_id" value="414">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #414">Cancellation</option>
              <option value="Dropped #414">The amount sent has decreased</option>
              <option value="Order has not started #414">Order not started</option>
              <option value="Other #414">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder414" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "414";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="413">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">413</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal413">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7548821558899281173" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7548821558899281173</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>286</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal413" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform413">
          <div id="sonuc413"></div>
          <input type="hidden" name="order_id" value="413">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #413">Cancellation</option>
              <option value="Dropped #413">The amount sent has decreased</option>
              <option value="Order has not started #413">Order not started</option>
              <option value="Other #413">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder413" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "413";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="412">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">412</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal412">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7550216791281192212" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7550216791281192212</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>244</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal412" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform412">
          <div id="sonuc412"></div>
          <input type="hidden" name="order_id" value="412">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #412">Cancellation</option>
              <option value="Dropped #412">The amount sent has decreased</option>
              <option value="Order has not started #412">Order not started</option>
              <option value="Other #412">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder412" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "412";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="411">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">411</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal411">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7561777026366016788" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7561777026366016788</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>211</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal411" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform411">
          <div id="sonuc411"></div>
          <input type="hidden" name="order_id" value="411">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #411">Cancellation</option>
              <option value="Dropped #411">The amount sent has decreased</option>
              <option value="Order has not started #411">Order not started</option>
              <option value="Other #411">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder411" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "411";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="410">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">410</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal410">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7562518102781512980" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7562518102781512980</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>449</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal410" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform410">
          <div id="sonuc410"></div>
          <input type="hidden" name="order_id" value="410">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #410">Cancellation</option>
              <option value="Dropped #410">The amount sent has decreased</option>
              <option value="Order has not started #410">Order not started</option>
              <option value="Other #410">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder410" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "410";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="409">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">409</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal409">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7563265151793745172" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7563265151793745172</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>154</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal409" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform409">
          <div id="sonuc409"></div>
          <input type="hidden" name="order_id" value="409">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #409">Cancellation</option>
              <option value="Dropped #409">The amount sent has decreased</option>
              <option value="Order has not started #409">Order not started</option>
              <option value="Other #409">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder409" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "409";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="408">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">408</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal408">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7563825084926922004" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7563825084926922004</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>160</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal408" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform408">
          <div id="sonuc408"></div>
          <input type="hidden" name="order_id" value="408">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #408">Cancellation</option>
              <option value="Dropped #408">The amount sent has decreased</option>
              <option value="Order has not started #408">Order not started</option>
              <option value="Other #408">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder408" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "408";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="407">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">407</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal407">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7564286542567460117" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7564286542567460117</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>300</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal407" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform407">
          <div id="sonuc407"></div>
          <input type="hidden" name="order_id" value="407">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #407">Cancellation</option>
              <option value="Dropped #407">The amount sent has decreased</option>
              <option value="Order has not started #407">Order not started</option>
              <option value="Other #407">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder407" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "407";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="406">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">406</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal406">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7566231159751970069" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7566231159751970069</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>267</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal406" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform406">
          <div id="sonuc406"></div>
          <input type="hidden" name="order_id" value="406">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #406">Cancellation</option>
              <option value="Dropped #406">The amount sent has decreased</option>
              <option value="Order has not started #406">Order not started</option>
              <option value="Other #406">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder406" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "406";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="405">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">405</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal405">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7568426450542431508" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7568426450542431508</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>190</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal405" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform405">
          <div id="sonuc405"></div>
          <input type="hidden" name="order_id" value="405">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #405">Cancellation</option>
              <option value="Dropped #405">The amount sent has decreased</option>
              <option value="Order has not started #405">Order not started</option>
              <option value="Other #405">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder405" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "405";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="404">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">404</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal404">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7573701023357783316" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7573701023357783316</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>264</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal404" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform404">
          <div id="sonuc404"></div>
          <input type="hidden" name="order_id" value="404">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #404">Cancellation</option>
              <option value="Dropped #404">The amount sent has decreased</option>
              <option value="Order has not started #404">Order not started</option>
              <option value="Other #404">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder404" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "404";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="403">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">403</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal403">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7575524081060056338" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7575524081060056338</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>333</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal403" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform403">
          <div id="sonuc403"></div>
          <input type="hidden" name="order_id" value="403">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #403">Cancellation</option>
              <option value="Dropped #403">The amount sent has decreased</option>
              <option value="Order has not started #403">Order not started</option>
              <option value="Other #403">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder403" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "403";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="402">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">402</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal402">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7575730723034975506" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7575730723034975506</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>664</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal402" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform402">
          <div id="sonuc402"></div>
          <input type="hidden" name="order_id" value="402">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #402">Cancellation</option>
              <option value="Dropped #402">The amount sent has decreased</option>
              <option value="Order has not started #402">Order not started</option>
              <option value="Other #402">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder402" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "402";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="401">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">401</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal401">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7576130392831315218" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7576130392831315218</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>215</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal401" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform401">
          <div id="sonuc401"></div>
          <input type="hidden" name="order_id" value="401">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #401">Cancellation</option>
              <option value="Dropped #401">The amount sent has decreased</option>
              <option value="Order has not started #401">Order not started</option>
              <option value="Other #401">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder401" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "401";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="400">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">400</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal400">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7577352978714168594" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7577352978714168594</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>6380</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal400" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform400">
          <div id="sonuc400"></div>
          <input type="hidden" name="order_id" value="400">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #400">Cancellation</option>
              <option value="Dropped #400">The amount sent has decreased</option>
              <option value="Order has not started #400">Order not started</option>
              <option value="Other #400">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder400" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "400";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												<div class="order-date" data-order-date="2025-12-10" style="display:none;">
							<span class="order-date-icon">
								<i class="fas fa-calendar-week"></i>
							 </span>
							<span>2025-12-10</span>
						</div>	
						<div class="card orders-card">
						   <div class="oc-block">
							  <div class="oc-first">
								 <div class="oc-checkbox">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="order_checkbox" value="399">
											<div class="checkbox-icon"></div>
										</label>
									</div>
								 </div>
								 <div class="oc-id">399</div>
								 <div class="oc-name">6094 - Tiktok Views | 1M/D | Cancel Button | Instant Start | No Refill</div>
							  </div>
							  <div class="oc-last">
								 <div class="oc-status completed "><span>Completed</span></div>
								 <div class="oc-repeat">
                                   <a href="https://mainsmmbd.com/?select_service_id=6094" class="btn-repeat"><i class="far fa-repeat"></i><span class="order-tooltip">Repeat Order</span>
									</a>
								 </div>
                                <div class="oc-repeat">
									<a style="background:#007bff!important;border:1px solid #007bff!important" class="btn-repeat" data-toggle="modal" data-target="#reportModal399">
										<i class="fas fa-headset"></i><span class="order-tooltip">Report an Issue</span>
									</a>
								 </div>
																  </div>
						   </div>
						   <div class="oc-block">
							  <div class="oc-alt-first">
								 <div class="oc-item oc-link">
									<span><span class="icon"><i class="fas fa-link primary-color"></i></span><span class="link"><a href="https://www.tiktok.com/@hoangkha2003bg/video/7485222476880907528" target="_blank">https://www.tiktok.com/@hoangkha2003bg/video/7485222476880907528</a></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-tags primary-color"></i></span><span class="text"><span class="primary-color">Charge:</span> <span>0.00006</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-list-ol primary-color"></i></span><span class="text"><span class="primary-color">Quantity:</span> <span>200</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="fas fa-sort-amount-up primary-color"></i></span><span class="text"><span class="primary-color">Start count:</span> <span>1500</span></span></span>
								 </div>
								 <div class="oc-item">
									<span><span class="icon"><i class="far fa-stopwatch primary-color"></i></span><span class="text"><span class="primary-color">Remains:</span> <span>0</span></span></span>
								 </div>
							  </div>
						   </div>
						</div>	

<!-- report modal -->
<div class="modal fade" id="reportModal399" data-keyboard="false" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-icon">
          <i class="far fa-flag-checkered"></i>
        </div>
        <h5 class="modal-title">Report an Issue</h5>
        <button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
          <span>×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="gonderilenform399">
          <div id="sonuc399"></div>
          <input type="hidden" name="order_id" value="399">
          <div class="form-group mb-3">
            <label for="subject" class="control-label">Your request</label>
            <select class="form-select" id="subject" name="TicketForm[subject]">
              <option value="Cancellation #399">Cancellation</option>
              <option value="Dropped #399">The amount sent has decreased</option>
              <option value="Order has not started #399">Order not started</option>
              <option value="Other #399">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Detail of the problem</label>
            <textarea class="form-control" rows="7" id="message" name="TicketForm[message]" style="min-height: 125px" required=""></textarea>
          </div>
          <input type="hidden" name="_csrf" value="Jj-7bMI2O-Z4dezJkV0x4zQ3Z-OdUxEUlPC3-n1UuoNKS8w5tHQWijkPmfrSPki2Q0Yyha46JkDnoIWcKx7-8w==">
          <button id="gonder399" class="btn btn-primary btn-100 mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var orderId = "399";
    var siteDomain = "mainsmmbd.com";
    var siteLanguage = "en";

    var gonderBtnId = "#gonder" + orderId;
    var formId = "#gonderilenform" + orderId;
    var sonucId = "#sonuc" + orderId;

    if ($(gonderBtnId).length && $(formId).length) {
        $(gonderBtnId).on("click", function(e) {
            e.preventDefault();

            var formData = $(formId).serialize();

            $.ajax({
                url: "https://" + siteDomain + "/ticket-create",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.status === 'error') {
                        $(sonucId).html('<div class="alert alert-danger text-center">' + response.error + '</div>');
                    } else {
                        var successMessage = siteLanguage === "ar" 
                            ? "لقد وصل طلبك إلينا، وسنقوم بالرد عليك في أقرب وقت ممكن."
                            : "Your request has reached us, we will get back to you as soon as possible.";

                        $(sonucId).html('<div class="alert alert-success text-center">' + successMessage + '</div>');

                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    }
});
 </script>

												
				</div>	
				
		  							<section class="mt-3">
					<div class="container text-center d-flex justify-content-center">
						<nav aria-label=""> 
							<ul class="pagination ">
														
							  
							  															  
							  
							  								
													
							  																	<li class="page-item active"><a class="page-link" href="/orders/all/1">1</a></li>
															  																	<li class="page-item "><a class="page-link" href="/orders/all/2">2</a></li>
															  																	<li class="page-item "><a class="page-link" href="/orders/all/3">3</a></li>
															  								
																<li class="page-item pi-pn">
									<a class="page-link" href="/orders/all/2" aria-label="Next">
										<i class="far fa-chevron-right"></i>
									</a>
								</li>
															</ul>
						</nav>
					</div>
				</section>	
						
				<div class="filter-dropdown hidden">
					<div class="dropdown ui-dropdown">
					  <button class="btn btn-line-icon dropdown-toggle" type="button" id="dropdownCopy" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="btn-icon">
							<i class="fas fa-filter"></i>
						</span>
						<span class="btn-text">
						   
						</span>
						<span class="btn-chevron">
							<i class="far fa-angle-up"></i>
						</span>
					  </button>
					  <div class="dropdown-overlay"></div>
						  <div class="dropdown-menu dd-menu" aria-labelledby="dropdownCopy">
							<ul class="dropdown-list">
							  <li>
								<a href="#" class="dropdown-link" onclick="event.preventDefault();" data-action="copy" data-value="">
								  <i class="far fa-copy primary-color"></i>
								  <span>Copy ID's</span>
								</a>
								<a href="#" class="dropdown-link" data-action="remove">
								  <i class="far fa-times text-danger"></i>
								  <span>Remove Selected</span>
								</a>
							  </li>
							</ul>
						  </div>
					</div>
				</div>				
			
		</div> 
		
	<script>
	$(".cancel-btn").click(function () {
		$(this).addClass("hidden");
	});
	</script>
	<script>
	  const dateList = ["2025-12-11", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", "2025-12-10", ];
	  const dataDate = Array.from(new Set(dateList));
	  for(let i = 0; i < dataDate.length; i++){
		 document.querySelector('[data-order-date="'+dataDate[i]+'"]').style.display = "flex";
	  }
	</script>		
            

		<!-- Notifications wrapper -->
		<div id="notify-wrapper" class="alert alert-success hidden" style="display: none;"></div>

		


</div>
        
         
          		</div>
@endsection
