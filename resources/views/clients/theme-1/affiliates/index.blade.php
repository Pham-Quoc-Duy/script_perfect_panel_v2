@extends('clients.layouts.app')

@section('title', 'affiliates')

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
			    <div class="row">
					<div class="col-lg-12">
						<div class="card mb-3">
							<div class="card-header">
								<i class="far fa-tachometer-alt-fast"></i>
								<span>Easy to Use</span>
							</div>
							<div class="card-body">
								<div class="fast-mass">
									<div class="fast-item">
										<input type="number" class="form-control" name="mass-id" placeholder="ID" fdprocessedid="a6vbx">
									</div>
									<div class="fast-item">
										<input type="text" class="form-control" name="mass-link" placeholder="Link" fdprocessedid="lzlwu">
									</div>
									<div class="fast-item">
										<input type="number" class="form-control" name="mass-quantity" placeholder="Quantity" fdprocessedid="s3a1tr">
									</div>
									<div class="fast-item">
										<button class="add-more" fdprocessedid="cedmg">
											<i class="fas fa-plus-circle"></i>
											<span>Add</span>
										</button>
										<button class="remove-more hidden">
											<i class="fas fa-minus-circle"></i>
											<span>Remove</span>
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<form method="post" action="/massorder">
																											<div class="form-group">
										<label for="links" class="control-label">One order per line in format</label>
										<textarea class="form-control" name="MassOrderForm[orders]" rows="15" id="links" placeholder="service_id | link | quantity"></textarea>
									</div>
								  
								  <div class="btn-flex">
									<input type="hidden" name="_csrf" value="f5DrtmzMTLTfBEaAeUveFJJAKjrWYa9u9tun1am1h9gT5JzjGo5h2J5-M7M6KKdB5TF_XOUImDqFi5Wz___DqA==">
									<button type="submit" class="btn btn-primary" fdprocessedid="4zaoj8">Submit</button>
									<a href="" class="btn btn-light" data-toggle="modal" data-target="#howtoModal"><i class="far fa-question-circle me-2"></i>How it works?</a>
								  </div>	
								</form>
							</div>	
						</div>	
					</div>	
			    </div>	
			</div>			
			
			<!-- howitworks -->
			<div class="modal fade" id="howtoModal" data-keyboard="false" tabindex="-1" aria-labelledby="howtoModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<div class="modal-icon">
						<i class="far fa-question-circle"></i>
					</div>
					<h5 class="modal-title">How it works?</h5>
					<button type="button" class="btn btn-line-icon" data-dismiss="modal" aria-label="Close">
					  <span>×</span>
					</button>
				  </div>
					<div class="modal-body">
						<div class="howto-slider">
						   <div class="howto-item">
							  <div class="howto-content">
								 <div class="howto-header">
									<h3 class="howto-title">Step <div class="howto-count">1</div></h3>
								 </div>
								 <img src="https://storage.perfectcdn.com/j71eqe/44tlm67semqif2iy.png" class="img-fluid">
								 <div class="howto-text">
									   <h4>
										  Enter details:									   </h4>
									   <p>
										  Add three details for each order (Service ID | Target Link | Quantity you would like to purchase) in the correct format. Separate the orders by a line break. See the examples below for a better understanding.									   </p>
									   <span>3628 | https://www.instagram.com/username/ | 9300</span><br>
									   <span>10379 | https://www.instagram.com/p/abcDEF/ | 3460</span>
								 </div>
							  </div>
						   </div>
						   <div class="howto-item">
							  <div class="howto-content">
								 <div class="howto-header">
									<h3 class="howto-title">Step <div class="howto-count">2</div></h3>
								 </div>
								 <img src="https://storage.perfectcdn.com/j71eqe/44tlm67semqif2iy.png" class="img-fluid">
								 <div class="howto-text">
									   <h4>
										  Confirm and Submit:									   </h4>
									   <p>Make sure all the details for each order are correct and press submit. Congratulations! You have successfully placed a mass order.									   </p>
								 </div>
							  </div>
						   </div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="buttons-howto">
						  <div class="dots-howto"></div>
						</div>
					</div>
				</div>
			  </div>
			</div>	

		<script>
			$('#howtoModal').on('shown.bs.modal', function () {
				if ($('.howto-slider').hasClass('slick-initialized')) {
					$('.howto-slider').slick('unslick');
				}
				$('.howto-slider').slick({
					dots: true,
					arrows: true,
					infinite: false,
					speed: 300,
					slidesToShow: 1,
					slidesToScroll: 1,
					initialSlide: 0,
					adaptiveHeight: true,
					appendArrows: $(".buttons-howto"),
					appendDots: $(".dots-howto"),
					dotsClass: 'custom-dots',
					nextArrow: '<button class="btn btn-primary">Next</button>',
					prevArrow: '<button class="btn btn-light">Back</button>',
				});
			});

			$('.howto-slider').on('afterChange', function (event, slick, currentSlide) {
				const totalSlides = slick.slideCount;
				if (currentSlide < totalSlides - 1) {
					$('.modal-footer .btn-light').text("Back");
					$('.modal-footer .btn-primary').text("Next");
				} else {
					$('.modal-footer .btn-primary').text("Done");
				}
			});
			
			$(document).on('click', '.modal-footer .btn-primary', function () {
				const text = $(this).text().trim().toLowerCase();
				if (text === "finish") {
					$('#howtoModal').modal('hide');
					localStorage.setItem("donemsg", "done");
				} else if (text === "done") {
					$('#howtoModal').modal('hide');
				}
			});
		</script>			
            

		<!-- Notifications wrapper -->
		<div id="notify-wrapper" class="alert alert-success hidden" style="display: none;"></div>

		


</div>
        
         
          		</div>
@endsection