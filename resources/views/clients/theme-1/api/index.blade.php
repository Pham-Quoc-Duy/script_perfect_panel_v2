@extends('clients.layouts.app')

@section('title', 'API')

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
				<div class="top-box">
					<div class="top-text">
						<h4>API</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					</div>
					<a href="/example.txt" class="btn btn-primary d-flex align-items-center" target="_blank">
                        <i class="fal fa-code me-2"></i><strong>Example of PHP code</strong>
                    </a>
			    </div>	
			    <div class="row">
					<div class="col-lg-12 api-page">
						<table class="table table-bordered">
						  <tbody>
							 <tr>
								<td class="width-40">HTTP Method</td>
								<td>POST</td>
							 </tr>
							 <tr>
								<td>API URL</td>
								<td>https://mainsmmbd.com/api/v2</td>
							 </tr>
							 <tr>
								<td>Response format</td>
								<td>JSON</td>
							 </tr>
						  </tbody>
					   </table>
					   
					   					   <h4 class="m-t-md"><strong>Service list</strong></h4>
												  <table class="table table-bordered">
							<thead>
							<tr>
							  <th class="width-40">Parameters</th>
							  <th>Description</th>
							</tr>
							</thead>
							<tbody>
														  <tr>
								<td>key</td>
								<td>Your API key</td>
							  </tr>
														  <tr>
								<td>action</td>
								<td>services</td>
							  </tr>
														</tbody>
						  </table>
											   
					   <p><strong>Example response</strong></p>
					   <div class="api-container">
						  <div class="code-block-top">
							 <span>RESPONSE</span>
							 <span class="code-block-right">JSON</span>
						  </div>
						  <div style="position: relative;"><button class="copy-blackbox-ai-btn" style="position: absolute; top: 8px; right: 8px; padding: 4px 8px; font-size: 12px; cursor: pointer; z-index: 10;">Copy to BlackBox</button><pre><code class="hljs language-json"><span class="hljs-punctuation">[</span>
    <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"service"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">1</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"name"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Followers"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"type"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Default"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"category"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"First Category"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"rate"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"0.90"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"min"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"50"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"max"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"10000"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"refill"</span><span class="hljs-punctuation">:</span> <span class="hljs-keyword">true</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"cancel"</span><span class="hljs-punctuation">:</span> <span class="hljs-keyword">true</span>
    <span class="hljs-punctuation">}</span><span class="hljs-punctuation">,</span>
    <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"service"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">2</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"name"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Comments"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"type"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Custom Comments"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"category"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Second Category"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"rate"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"8"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"min"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"10"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"max"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"1500"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"refill"</span><span class="hljs-punctuation">:</span> <span class="hljs-keyword">false</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"cancel"</span><span class="hljs-punctuation">:</span> <span class="hljs-keyword">true</span>
    <span class="hljs-punctuation">}</span>
<span class="hljs-punctuation">]</span></code></pre></div>
					   </div>
										   <h4 class="m-t-md"><strong>Add order</strong></h4>
												  							  <form class="form-inline">
								<div class="form-group">
								  <select class="form-control input-sm" id="service_type">
																		  <option value="0">Default</option>
																		  <option value="10">Package</option>
																		  <option value="2">Custom Comments</option>
																		  <option value="9">Mentions</option>
																		  <option value="3">Mentions with Hashtags</option>
																		  <option value="4">Mentions Custom List</option>
																		  <option value="6">Mentions Hashtag</option>
																		  <option value="7">Mentions User Followers</option>
																		  <option value="8">Mentions Media Likers</option>
																		  <option value="14">Custom Comments Package</option>
																		  <option value="15">Comment Likes</option>
																		  <option value="17">Poll</option>
																		  <option value="20">Invites from Groups</option>
																		  <option value="100">Subscriptions</option>
																		  <option value="102">Web Traffic</option>
																	  </select>
								</div>
							  </form>
							 					   
												<div id="type_0" style="">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>quantity</td>
									<td>Needed quantity</td>
								  </tr>
																  <tr>
									<td>runs (optional)</td>
									<td>Runs to deliver</td>
								  </tr>
																  <tr>
									<td>interval (optional)</td>
									<td>Interval in minutes</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_10" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_2" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>comments</td>
									<td>Comments list separated by \r\n or \n</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_9" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>quantity</td>
									<td>Needed quantity</td>
								  </tr>
																  <tr>
									<td>usernames</td>
									<td>Usernames list separated by \r\n or \n</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_3" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>quantity</td>
									<td>Needed quantity</td>
								  </tr>
																  <tr>
									<td>usernames</td>
									<td>Usernames list separated by \r\n or \n</td>
								  </tr>
																  <tr>
									<td>hashtags</td>
									<td>Hashtags list separated by \r\n or \n</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_4" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>usernames</td>
									<td>Usernames list separated by \r\n or \n</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_6" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>quantity</td>
									<td>Needed quantity</td>
								  </tr>
																  <tr>
									<td>hashtag</td>
									<td>Hashtag to scrape usernames from</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_7" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>quantity</td>
									<td>Needed quantity</td>
								  </tr>
																  <tr>
									<td>username</td>
									<td>URL to scrape followers from</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_8" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>quantity</td>
									<td>Needed quantity</td>
								  </tr>
																  <tr>
									<td>media</td>
									<td>Media URL to scrape likers from</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_100" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>username</td>
									<td>Username</td>
								  </tr>
																  <tr>
									<td>min</td>
									<td>Quantity min</td>
								  </tr>
																  <tr>
									<td>max</td>
									<td>Quantity max</td>
								  </tr>
																  <tr>
									<td>posts (optional)</td>
									<td>Use this parameter if you want to limit the number of new (future) posts that will be parsed and for which orders will be created. If posts parameter is not set, the subscription will be created for an unlimited number of posts.</td>
								  </tr>
																  <tr>
									<td>old_posts (optional)</td>
									<td>Number of existing posts that will be parsed and for which orders will be created, can be used if this option is available for the service.</td>
								  </tr>
																  <tr>
									<td>delay</td>
									<td>Delay in minutes. Possible values: 0, 5, 10, 15, 20, 30, 40, 50, 60, 90, 120, 150, 180, 210, 240, 270, 300, 360, 420, 480, 540, 600</td>
								  </tr>
																  <tr>
									<td>expiry (optional)</td>
									<td>Expiry date. Format d/m/Y</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_102" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>quantity</td>
									<td>Needed quantity</td>
								  </tr>
																  <tr>
									<td>runs (optional)</td>
									<td>Runs to deliver</td>
								  </tr>
																  <tr>
									<td>interval (optional)</td>
									<td>Interval in minutes</td>
								  </tr>
																  <tr>
									<td>country</td>
									<td>Country code or full country name. Format: "US" or "United States"</td>
								  </tr>
																  <tr>
									<td>device</td>
									<td>Device name. 1 - Desktop, 2 - Mobile (Android), 3 - Mobile (IOS), 4 - Mixed (Mobile), 5 - Mixed (Mobile &amp; Desktop)</td>
								  </tr>
																  <tr>
									<td>type_of_traffic</td>
									<td>1 - Google Keyword, 2 - Custom Referrer, 3 - Blank Referrer</td>
								  </tr>
																  <tr>
									<td>google_keyword</td>
									<td>required if type_of_traffic = 1</td>
								  </tr>
																  <tr>
									<td>referring_url</td>
									<td>required if type_of_traffic = 2</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_14" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>comments</td>
									<td>Comments list separated by \r\n or \n</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_15" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>quantity</td>
									<td>Needed quantity</td>
								  </tr>
																  <tr>
									<td>username</td>
									<td>Username of the comment owner</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_17" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>quantity</td>
									<td>Needed quantity</td>
								  </tr>
																  <tr>
									<td>answer_number</td>
									<td>Answer number of the poll</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    						<div id="type_20" style="display:none;">
						   <table class="table table-bordered">
							  <thead>
								 <tr>
									<th class="width-40">Parameters</th>
									<th>Description</th>
								 </tr>
							  </thead>
							  <tbody>
																  <tr>
									<td>key</td>
									<td>Your API key</td>
								  </tr>
																  <tr>
									<td>action</td>
									<td>add</td>
								  </tr>
																  <tr>
									<td>service</td>
									<td>Service ID</td>
								  </tr>
																  <tr>
									<td>link</td>
									<td>Link to page</td>
								  </tr>
																  <tr>
									<td>quantity</td>
									<td>Needed quantity</td>
								  </tr>
																  <tr>
									<td>groups</td>
									<td>Groups list separated by \r\n or \n</td>
								  </tr>
															  </tbody>
						    </table>
					    </div>
					    											   
					   <p><strong>Example response</strong></p>
					   <div class="api-container">
						  <div class="code-block-top">
							 <span>RESPONSE</span>
							 <span class="code-block-right">JSON</span>
						  </div>
						  <div style="position: relative;"><button class="copy-blackbox-ai-btn" style="position: absolute; top: 8px; right: 8px; padding: 4px 8px; font-size: 12px; cursor: pointer; z-index: 10;">Copy to BlackBox</button><pre><code class="hljs language-css">{
    "<span class="hljs-attribute">order</span>": <span class="hljs-number">23501</span>
}</code></pre></div>
					   </div>
										   <h4 class="m-t-md"><strong>Order status</strong></h4>
												  <table class="table table-bordered">
							<thead>
							<tr>
							  <th class="width-40">Parameters</th>
							  <th>Description</th>
							</tr>
							</thead>
							<tbody>
														  <tr>
								<td>key</td>
								<td>Your API key</td>
							  </tr>
														  <tr>
								<td>action</td>
								<td>status</td>
							  </tr>
														  <tr>
								<td>order</td>
								<td>Order ID</td>
							  </tr>
														</tbody>
						  </table>
											   
					   <p><strong>Example response</strong></p>
					   <div class="api-container">
						  <div class="code-block-top">
							 <span>RESPONSE</span>
							 <span class="code-block-right">JSON</span>
						  </div>
						  <div style="position: relative;"><button class="copy-blackbox-ai-btn" style="position: absolute; top: 8px; right: 8px; padding: 4px 8px; font-size: 12px; cursor: pointer; z-index: 10;">Copy to BlackBox</button><pre><code class="hljs language-json"><span class="hljs-punctuation">{</span>
    <span class="hljs-attr">"charge"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"0.27819"</span><span class="hljs-punctuation">,</span>
    <span class="hljs-attr">"start_count"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"3572"</span><span class="hljs-punctuation">,</span>
    <span class="hljs-attr">"status"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Partial"</span><span class="hljs-punctuation">,</span>
    <span class="hljs-attr">"remains"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"157"</span><span class="hljs-punctuation">,</span>
    <span class="hljs-attr">"currency"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"USD"</span>
<span class="hljs-punctuation">}</span></code></pre></div>
					   </div>
										   <h4 class="m-t-md"><strong>Multiple orders status</strong></h4>
												  <table class="table table-bordered">
							<thead>
							<tr>
							  <th class="width-40">Parameters</th>
							  <th>Description</th>
							</tr>
							</thead>
							<tbody>
														  <tr>
								<td>key</td>
								<td>Your API key</td>
							  </tr>
														  <tr>
								<td>action</td>
								<td>status</td>
							  </tr>
														  <tr>
								<td>orders</td>
								<td>Order IDs (separated by a comma, up to 100 IDs)</td>
							  </tr>
														</tbody>
						  </table>
											   
					   <p><strong>Example response</strong></p>
					   <div class="api-container">
						  <div class="code-block-top">
							 <span>RESPONSE</span>
							 <span class="code-block-right">JSON</span>
						  </div>
						  <div style="position: relative;"><button class="copy-blackbox-ai-btn" style="position: absolute; top: 8px; right: 8px; padding: 4px 8px; font-size: 12px; cursor: pointer; z-index: 10;">Copy to BlackBox</button><pre><code class="hljs language-json"><span class="hljs-punctuation">{</span>
    <span class="hljs-attr">"1"</span><span class="hljs-punctuation">:</span> <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"charge"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"0.27819"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"start_count"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"3572"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"status"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Partial"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"remains"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"157"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"currency"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"USD"</span>
    <span class="hljs-punctuation">}</span><span class="hljs-punctuation">,</span>
    <span class="hljs-attr">"10"</span><span class="hljs-punctuation">:</span> <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"error"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Incorrect order ID"</span>
    <span class="hljs-punctuation">}</span><span class="hljs-punctuation">,</span>
    <span class="hljs-attr">"100"</span><span class="hljs-punctuation">:</span> <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"charge"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"1.44219"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"start_count"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"234"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"status"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"In progress"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"remains"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"10"</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"currency"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"USD"</span>
    <span class="hljs-punctuation">}</span>
<span class="hljs-punctuation">}</span></code></pre></div>
					   </div>
										   <h4 class="m-t-md"><strong>Create refill</strong></h4>
												  <table class="table table-bordered">
							<thead>
							<tr>
							  <th class="width-40">Parameters</th>
							  <th>Description</th>
							</tr>
							</thead>
							<tbody>
														  <tr>
								<td>key</td>
								<td>Your API key</td>
							  </tr>
														  <tr>
								<td>action</td>
								<td>refill</td>
							  </tr>
														  <tr>
								<td>order</td>
								<td>Order ID</td>
							  </tr>
														</tbody>
						  </table>
											   
					   <p><strong>Example response</strong></p>
					   <div class="api-container">
						  <div class="code-block-top">
							 <span>RESPONSE</span>
							 <span class="code-block-right">JSON</span>
						  </div>
						  <div style="position: relative;"><button class="copy-blackbox-ai-btn" style="position: absolute; top: 8px; right: 8px; padding: 4px 8px; font-size: 12px; cursor: pointer; z-index: 10;">Copy to BlackBox</button><pre><code class="hljs language-json"><span class="hljs-punctuation">{</span>
    <span class="hljs-attr">"refill"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"1"</span>
<span class="hljs-punctuation">}</span></code></pre></div>
					   </div>
										   <h4 class="m-t-md"><strong>Create multiple refill</strong></h4>
												  <table class="table table-bordered">
							<thead>
							<tr>
							  <th class="width-40">Parameters</th>
							  <th>Description</th>
							</tr>
							</thead>
							<tbody>
														  <tr>
								<td>key</td>
								<td>Your API key</td>
							  </tr>
														  <tr>
								<td>action</td>
								<td>refill</td>
							  </tr>
														  <tr>
								<td>orders</td>
								<td>Order IDs (separated by a comma, up to 100 IDs)</td>
							  </tr>
														</tbody>
						  </table>
											   
					   <p><strong>Example response</strong></p>
					   <div class="api-container">
						  <div class="code-block-top">
							 <span>RESPONSE</span>
							 <span class="code-block-right">JSON</span>
						  </div>
						  <div style="position: relative;"><button class="copy-blackbox-ai-btn" style="position: absolute; top: 8px; right: 8px; padding: 4px 8px; font-size: 12px; cursor: pointer; z-index: 10;">Copy to BlackBox</button><pre><code class="hljs language-json"><span class="hljs-punctuation">[</span>
    <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"order"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">1</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"refill"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">1</span>
    <span class="hljs-punctuation">}</span><span class="hljs-punctuation">,</span>
    <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"order"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">2</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"refill"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">2</span>
    <span class="hljs-punctuation">}</span><span class="hljs-punctuation">,</span>
    <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"order"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">3</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"refill"</span><span class="hljs-punctuation">:</span> <span class="hljs-punctuation">{</span>
            <span class="hljs-attr">"error"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Incorrect order ID"</span>
        <span class="hljs-punctuation">}</span>
    <span class="hljs-punctuation">}</span>
<span class="hljs-punctuation">]</span></code></pre></div>
					   </div>
										   <h4 class="m-t-md"><strong>Get refill status</strong></h4>
												  <table class="table table-bordered">
							<thead>
							<tr>
							  <th class="width-40">Parameters</th>
							  <th>Description</th>
							</tr>
							</thead>
							<tbody>
														  <tr>
								<td>key</td>
								<td>Your API key</td>
							  </tr>
														  <tr>
								<td>action</td>
								<td>refill_status</td>
							  </tr>
														  <tr>
								<td>refill</td>
								<td>Refill ID</td>
							  </tr>
														</tbody>
						  </table>
											   
					   <p><strong>Example response</strong></p>
					   <div class="api-container">
						  <div class="code-block-top">
							 <span>RESPONSE</span>
							 <span class="code-block-right">JSON</span>
						  </div>
						  <div style="position: relative;"><button class="copy-blackbox-ai-btn" style="position: absolute; top: 8px; right: 8px; padding: 4px 8px; font-size: 12px; cursor: pointer; z-index: 10;">Copy to BlackBox</button><pre><code class="hljs language-json"><span class="hljs-punctuation">{</span>
    <span class="hljs-attr">"status"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Completed"</span>
<span class="hljs-punctuation">}</span></code></pre></div>
					   </div>
										   <h4 class="m-t-md"><strong>Get multiple refill status</strong></h4>
												  <table class="table table-bordered">
							<thead>
							<tr>
							  <th class="width-40">Parameters</th>
							  <th>Description</th>
							</tr>
							</thead>
							<tbody>
														  <tr>
								<td>key</td>
								<td>Your API key</td>
							  </tr>
														  <tr>
								<td>action</td>
								<td>refill_status</td>
							  </tr>
														  <tr>
								<td>refills</td>
								<td>Refill IDs (separated by a comma, up to 100 IDs)</td>
							  </tr>
														</tbody>
						  </table>
											   
					   <p><strong>Example response</strong></p>
					   <div class="api-container">
						  <div class="code-block-top">
							 <span>RESPONSE</span>
							 <span class="code-block-right">JSON</span>
						  </div>
						  <div style="position: relative;"><button class="copy-blackbox-ai-btn" style="position: absolute; top: 8px; right: 8px; padding: 4px 8px; font-size: 12px; cursor: pointer; z-index: 10;">Copy to BlackBox</button><pre><code class="hljs language-json"><span class="hljs-punctuation">[</span>
    <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"refill"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">1</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"status"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Completed"</span>
    <span class="hljs-punctuation">}</span><span class="hljs-punctuation">,</span>
    <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"refill"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">2</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"status"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Rejected"</span>
    <span class="hljs-punctuation">}</span><span class="hljs-punctuation">,</span>
    <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"refill"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">3</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"status"</span><span class="hljs-punctuation">:</span> <span class="hljs-punctuation">{</span>
            <span class="hljs-attr">"error"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Refill not found"</span>
        <span class="hljs-punctuation">}</span>
    <span class="hljs-punctuation">}</span>
<span class="hljs-punctuation">]</span></code></pre></div>
					   </div>
										   <h4 class="m-t-md"><strong>Create cancel</strong></h4>
												  <table class="table table-bordered">
							<thead>
							<tr>
							  <th class="width-40">Parameters</th>
							  <th>Description</th>
							</tr>
							</thead>
							<tbody>
														  <tr>
								<td>key</td>
								<td>Your API key</td>
							  </tr>
														  <tr>
								<td>action</td>
								<td>cancel</td>
							  </tr>
														  <tr>
								<td>orders</td>
								<td>Order IDs (separated by a comma, up to 100 IDs)</td>
							  </tr>
														</tbody>
						  </table>
											   
					   <p><strong>Example response</strong></p>
					   <div class="api-container">
						  <div class="code-block-top">
							 <span>RESPONSE</span>
							 <span class="code-block-right">JSON</span>
						  </div>
						  <div style="position: relative;"><button class="copy-blackbox-ai-btn" style="position: absolute; top: 8px; right: 8px; padding: 4px 8px; font-size: 12px; cursor: pointer; z-index: 10;">Copy to BlackBox</button><pre><code class="hljs language-json"><span class="hljs-punctuation">[</span>
    <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"order"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">9</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"cancel"</span><span class="hljs-punctuation">:</span> <span class="hljs-punctuation">{</span>
            <span class="hljs-attr">"error"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"Incorrect order ID"</span>
        <span class="hljs-punctuation">}</span>
    <span class="hljs-punctuation">}</span><span class="hljs-punctuation">,</span>
    <span class="hljs-punctuation">{</span>
        <span class="hljs-attr">"order"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">2</span><span class="hljs-punctuation">,</span>
        <span class="hljs-attr">"cancel"</span><span class="hljs-punctuation">:</span> <span class="hljs-number">1</span>
    <span class="hljs-punctuation">}</span>
<span class="hljs-punctuation">]</span></code></pre></div>
					   </div>
										   <h4 class="m-t-md"><strong>User balance</strong></h4>
												  <table class="table table-bordered">
							<thead>
							<tr>
							  <th class="width-40">Parameters</th>
							  <th>Description</th>
							</tr>
							</thead>
							<tbody>
														  <tr>
								<td>key</td>
								<td>Your API key</td>
							  </tr>
														  <tr>
								<td>action</td>
								<td>balance</td>
							  </tr>
														</tbody>
						  </table>
											   
					   <p><strong>Example response</strong></p>
					   <div class="api-container">
						  <div class="code-block-top">
							 <span>RESPONSE</span>
							 <span class="code-block-right">JSON</span>
						  </div>
						  <div style="position: relative;"><button class="copy-blackbox-ai-btn" style="position: absolute; top: 8px; right: 8px; padding: 4px 8px; font-size: 12px; cursor: pointer; z-index: 10;">Copy to BlackBox</button><pre><code class="hljs language-json"><span class="hljs-punctuation">{</span>
    <span class="hljs-attr">"balance"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"100.84292"</span><span class="hljs-punctuation">,</span>
    <span class="hljs-attr">"currency"</span><span class="hljs-punctuation">:</span> <span class="hljs-string">"USD"</span>
<span class="hljs-punctuation">}</span></code></pre></div>
					   </div>
										   <script>hljs.highlightAll();</script>
					</div>	
			    </div>	
			</div>			
            

</div>

<style>.particle-snow{position:fixed;top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none}.particle-snow canvas{position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none}.christmas-garland{text-align:center;white-space:nowrap;overflow:hidden;position:absolute;z-index:1;padding:0;pointer-events:none;width:100%;height:85px}.christmas-garland .christmas-garland__item{position:relative;width:28px;height:28px;border-radius:50%;display:inline-block;margin-left:20px}.christmas-garland .christmas-garland__item .shape{-webkit-animation-fill-mode:both;animation-fill-mode:both;-webkit-animation-iteration-count:infinite;animation-iteration-count:infinite;-webkit-animation-name:flash-1;animation-name:flash-1;-webkit-animation-duration:2s;animation-duration:2s}.christmas-garland .christmas-garland__item .apple{width:22px;height:22px;border-radius:50%;margin-left:auto;margin-right:auto;margin-top:8px}.christmas-garland .christmas-garland__item .pear{width:12px;height:28px;border-radius:50%;margin-left:auto;margin-right:auto;margin-top:6px}.christmas-garland .christmas-garland__item:nth-child(2n+1) .shape{-webkit-animation-name:flash-2;animation-name:flash-2;-webkit-animation-duration:.4s;animation-duration:.4s}.christmas-garland .christmas-garland__item:nth-child(4n+2) .shape{-webkit-animation-name:flash-3;animation-name:flash-3;-webkit-animation-duration:1.1s;animation-duration:1.1s}.christmas-garland .christmas-garland__item:nth-child(odd) .shape{-webkit-animation-duration:1.8s;animation-duration:1.8s}.christmas-garland .christmas-garland__item:nth-child(3n+1) .shape{-webkit-animation-duration:1.4s;animation-duration:1.4s}.christmas-garland .christmas-garland__item:before{content:"";position:absolute;background:#222;width:10px;height:10px;border-radius:3px;top:-1px;left:9px}.christmas-garland .christmas-garland__item:after{content:"";top:-9px;left:14px;position:absolute;width:52px;height:18px;border-bottom:solid #222 2px;border-radius:50%}.christmas-garland .christmas-garland__item:last-child:after{content:none}.christmas-garland .christmas-garland__item:first-child{margin-left:-40px}</style>
        
         
          		</div>
@endsection