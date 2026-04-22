<div class="header">
		   <div class="container-fluid">
			  <div class="header-row">
				 <div class="header-start">
					<nav aria-label="breadcrumb">
					   <ol class="breadcrumb">
						  <li class="breadcrumb-item">
							 <a href="/">New order</a>
						  </li>
					   </ol>
					</nav>
				 </div>
				 <div class="header-end">
					<div class="dropdown ui-dropdown">
					   <button class="btn btn-line-icon dropdown-toggle wallet-mobile" type="button" id="dropdownCurrency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  <span class="btn-icon">
							<i class="fas fa-wallet"></i>
						  </span>
						  <span class="btn-text balance" data-real="{{ Auth::user()->balance }}" style="visibility: visible;">{{ Auth::user()->balance }}</span>
						  						  <span class="btn-chevron">
							<i class="far fa-angle-down"></i>
						  </span>
						  					   </button>
					   					   <div class="dropdown-overlay"></div>
					   <div class="dropdown-menu dd-menu wallet-auto" aria-labelledby="dropdownCurrency">
						  <ul class="dropdown-list" id="currencies-list">
							 <li>
								<a href="/addfunds" class="dropdown-link">
								<i class="fas fa-plus-circle"></i>
								Add funds
								</a>
							 </li>
							 							 <li>
								<a href="#" id="currencies-item" data-rate-key="BDT" data-rate-symbol="৳" class="dropdown-link">
								৳ - BDT
								</a>
							 </li>
							 							 <li>
								<a href="#" id="currencies-item" data-rate-key="INR" data-rate-symbol="₹" class="dropdown-link">
								₹ - INR
								</a>
							 </li>
							 							 <li>
								<a href="#" id="currencies-item" data-rate-key="PKR" data-rate-symbol="Rs" class="dropdown-link">
								Rs - PKR
								</a>
							 </li>
							 							 <li>
								<a href="#" id="currencies-item" data-rate-key="RUB" data-rate-symbol="₽" class="dropdown-link">
								₽ - RUB
								</a>
							 </li>
							 						  </ul>
					   </div>
					   					</div>
					<div class="dropdown ui-dropdown">
					   <button class="btn btn-line-icon dropdown-toggle" type="button" id="dropdownAccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					   <span class="avatar-dot"></span>
					   <span class="btn-icon btn-avatar" data-sm="avatar"><img src="https://storage.perfectcdn.com/j71eqe/9ux9lbtkpqgitpjw.png" class="avatar" alt="Avatar 1"></span>
					   <span class="btn-chevron">
							<i class="far fa-angle-down"></i>
					   </span>
					   </button>
					   <div class="dropdown-overlay"></div>
					   <div class="dropdown-menu dd-menu" id="home-settings" aria-labelledby="dropdownAccount" style="min-width: 240px">
						  <div class="acc-user">
							 <div>
								<div class="acc-name">{{ Auth::user()->name ?? ''}}</div>
								<div class="acc-mail">{{ Auth::user()->email ?? ''}}</div>
							 </div>
							 <a class="btn btn-primary" href="/account">
							 Account
							 </a>
						  </div>
                                                     <div class="acc-section">
                                <span>Language</span>
                                <div class="lang-switcher">
                                                                                                                        <span>English</span>
											                                            <i class="far fa-angle-right"></i>
											                                                                                                                                                                                                                                                                                                                                                </div>
                            </div>
                          					  
						  <div class="acc-section">
							<span>Theme Mode</span>
							<div class="switcher" data-active="light">
							   <button class="switcher-item light-btn active" onclick="changeTheme('light')" aria-label="Light">
								  <i class="fas fa-sun"></i>
							   </button>
							   <button class="switcher-item dark-btn" onclick="changeTheme('dark')" aria-label="Dark">
								  <i class="fas fa-moon"></i>
							   </button>
							</div>
						  </div>
						  <div class="acc-alt mt-1">
							 <ul class="dropdown-list">
								<li>
								   <a class="dropdown-link" href="/affiliates">
								   <span class="dropdown-icon">
										<i class="far fa-handshake"></i>
								   </span>
								   Affiliates
								   </a>
								</li>
								<li>
								   <a class="dropdown-link" href="/logout">
								   <span class="dropdown-icon text-danger">
										<i class="far fa-power-off"></i>
								   </span>
								   Logout
								   </a>
								</li>
							 </ul>
						  </div>
                                                      <div class="lang-header hidden">
                                <p>Select Language</p>
                                 <div type="button" class="lang-back">
									                                        <i class="far fa-angle-left"></i>
									                                     <span>Back</span>
                                </div>
                            </div>
                             <ul class="dropdown-list lang-drop hidden">
                                                                    <li>
                                        <a href="/" class="dropdown-link active">
                                            English
                                        </a>
                                    </li>
                                                                    <li>
                                        <a href="/ru" class="dropdown-link ">
                                            Russian
                                        </a>
                                    </li>
                                                                    <li>
                                        <a href="/ar" class="dropdown-link ">
                                            Arabic
                                        </a>
                                    </li>
                                                                    <li>
                                        <a href="/id" class="dropdown-link ">
                                            Indonesian
                                        </a>
                                    </li>
                                                            </ul>	
                        						  
					   </div>
					</div>
				 </div>
			  </div>
		   </div>
		</div>