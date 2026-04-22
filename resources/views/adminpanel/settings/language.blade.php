@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        
        @include('adminpanel.settings.partials.header')
        
        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="Language">Ngôn ngữ</h3>
        </div>

        <div class="row g-6">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <label class="form-label" data-lang="Current language by country">Ngôn ngữ hiện tại theo quốc gia</label>
                        <select class="form-select form-select-solid sl-current-language"
                            data-kt-select2="true" data-hide-search="false" data-allow-clear="false"
                            data-placeholder="Choose language" data-lang="Choose language"
                            onchange="_settings.on.change.loadLanguage(this.value)">
                            <option value="" data-lang="Choose language">Choose language</option>
                            <option value="us">United States</option>
                            <option value="vn">Vietnam</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <label class="form-label" data-lang="New language by country">Ngôn ngữ mới theo quốc gia</label>
                        <select class="form-select form-select-solid sl-new-language"
                            data-kt-select2="true" data-hide-search="false" data-allow-clear="false"
                            data-placeholder="Choose language" data-lang="Choose language"
                            onchange="_settings.on.change.loadLanguage(this.value, 1)">
                            <option value="" data-lang="Choose language">Choose language</option>
                            <option value="af">Afghanistan</option>
                            <option value="al">Albania</option>
                            <option value="dz">Algeria</option>
                            <option value="as">American Samoa</option>
                            <option value="ad">Andorra</option>
                            <option value="ao">Angola</option>
                            <option value="ai">Anguilla</option>
                            <option value="aq">Antarctica</option>
                            <option value="ag">Antigua and Barbuda</option>
                            <option value="ar">Argentina</option>
                            <option value="am">Armenia</option>
                            <option value="aw">Aruba</option>
                            <option value="au">Australia</option>
                            <option value="at">Austria</option>
                            <option value="az">Azerbaijan</option>
                            <option value="bs">Bahamas</option>
                            <option value="bh">Bahrain</option>
                            <option value="bd">Bangladesh</option>
                            <option value="bb">Barbados</option>
                            <option value="by">Belarus</option>
                            <option value="be">Belgium</option>
                            <option value="bz">Belize</option>
                            <option value="bj">Benin</option>
                            <option value="bm">Bermuda</option>
                            <option value="bt">Bhutan</option>
                            <option value="bo">Bolivia</option>
                            <option value="ba">Bosnia and Herzegovina</option>
                            <option value="bw">Botswana</option>
                            <option value="br">Brazil</option>
                            <option value="io">British Indian Ocean Territory</option>
                            <option value="vg">British Virgin Islands</option>
                            <option value="bn">Brunei</option>
                            <option value="bg">Bulgaria</option>
                            <option value="bf">Burkina Faso</option>
                            <option value="bi">Burundi</option>
                            <option value="kh">Cambodia</option>
                            <option value="cm">Cameroon</option>
                            <option value="ca">Canada</option>
                            <option value="cv">Cape Verde</option>
                            <option value="ky">Cayman Islands</option>
                            <option value="cf">Central African Republic</option>
                            <option value="td">Chad</option>
                            <option value="cl">Chile</option>
                            <option value="cn">China</option>
                            <option value="cx">Christmas Island</option>
                            <option value="cc">Cocos Islands</option>
                            <option value="co">Colombia</option>
                            <option value="km">Comoros</option>
                            <option value="ck">Cook Islands</option>
                            <option value="cr">Costa Rica</option>
                            <option value="hr">Croatia</option>
                            <option value="cu">Cuba</option>
                            <option value="cw">Curacao</option>
                            <option value="cy">Cyprus</option>
                            <option value="cz">Czech Republic</option>
                            <option value="cd">Democratic Republic of the Congo</option>
                            <option value="dk">Denmark</option>
                            <option value="dj">Djibouti</option>
                            <option value="dm">Dominica</option>
                            <option value="">Dominican Republic</option>
                            <option value="tl">East Timor</option>
                            <option value="ec">Ecuador</option>
                            <option value="eg">Egypt</option>
                            <option value="sv">El Salvador</option>
                            <option value="gq">Equatorial Guinea</option>
                            <option value="er">Eritrea</option>
                            <option value="ee">Estonia</option>
                            <option value="et">Ethiopia</option>
                            <option value="fk">Falkland Islands</option>
                            <option value="fo">Faroe Islands</option>
                            <option value="fj">Fiji</option>
                            <option value="fi">Finland</option>
                            <option value="fr">France</option>
                            <option value="pf">French Polynesia</option>
                            <option value="ga">Gabon</option>
                            <option value="gm">Gambia</option>
                            <option value="ge">Georgia</option>
                            <option value="de">Germany</option>
                            <option value="gh">Ghana</option>
                            <option value="gi">Gibraltar</option>
                            <option value="gr">Greece</option>
                            <option value="gl">Greenland</option>
                            <option value="gd">Grenada</option>
                            <option value="gu">Guam</option>
                            <option value="gt">Guatemala</option>
                            <option value="gg">Guernsey</option>
                            <option value="gn">Guinea</option>
                            <option value="gw">Guinea-Bissau</option>
                            <option value="gy">Guyana</option>
                            <option value="ht">Haiti</option>
                            <option value="hn">Honduras</option>
                            <option value="hk">Hong Kong</option>
                            <option value="hu">Hungary</option>
                            <option value="is">Iceland</option>
                            <option value="in">India</option>
                            <option value="id">Indonesia</option>
                            <option value="ir">Iran</option>
                            <option value="iq">Iraq</option>
                            <option value="ie">Ireland</option>
                            <option value="im">Isle of Man</option>
                            <option value="il">Israel</option>
                            <option value="it">Italy</option>
                            <option value="ci">Ivory Coast</option>
                            <option value="jm">Jamaica</option>
                            <option value="jp">Japan</option>
                            <option value="je">Jersey</option>
                            <option value="jo">Jordan</option>
                            <option value="kz">Kazakhstan</option>
                            <option value="ke">Kenya</option>
                            <option value="ki">Kiribati</option>
                            <option value="xk">Kosovo</option>
                            <option value="kw">Kuwait</option>
                            <option value="kg">Kyrgyzstan</option>
                            <option value="la">Laos</option>
                            <option value="lv">Latvia</option>
                            <option value="lb">Lebanon</option>
                            <option value="ls">Lesotho</option>
                            <option value="lr">Liberia</option>
                            <option value="ly">Libya</option>
                            <option value="li">Liechtenstein</option>
                            <option value="lt">Lithuania</option>
                            <option value="lu">Luxembourg</option>
                            <option value="mo">Macau</option>
                            <option value="mk">Macedonia</option>
                            <option value="mg">Madagascar</option>
                            <option value="mw">Malawi</option>
                            <option value="my">Malaysia</option>
                            <option value="mv">Maldives</option>
                            <option value="ml">Mali</option>
                            <option value="mt">Malta</option>
                            <option value="mh">Marshall Islands</option>
                            <option value="mr">Mauritania</option>
                            <option value="mu">Mauritius</option>
                            <option value="yt">Mayotte</option>
                            <option value="mx">Mexico</option>
                            <option value="fm">Micronesia</option>
                            <option value="md">Moldova</option>
                            <option value="mc">Monaco</option>
                            <option value="mn">Mongolia</option>
                            <option value="me">Montenegro</option>
                            <option value="ms">Montserrat</option>
                            <option value="ma">Morocco</option>
                            <option value="mz">Mozambique</option>
                            <option value="mm">Myanmar</option>
                            <option value="na">Namibia</option>
                            <option value="nr">Nauru</option>
                            <option value="np">Nepal</option>
                            <option value="nl">Netherlands</option>
                            <option value="an">Netherlands Antilles</option>
                            <option value="nc">New Caledonia</option>
                            <option value="nz">New Zealand</option>
                            <option value="ni">Nicaragua</option>
                            <option value="ne">Niger</option>
                            <option value="ng">Nigeria</option>
                            <option value="nu">Niue</option>
                            <option value="kp">North Korea</option>
                            <option value="mp">Northern Mariana Islands</option>
                            <option value="no">Norway</option>
                            <option value="om">Oman</option>
                            <option value="pk">Pakistan</option>
                            <option value="pw">Palau</option>
                            <option value="ps">Palestine</option>
                            <option value="pa">Panama</option>
                            <option value="pg">Papua New Guinea</option>
                            <option value="py">Paraguay</option>
                            <option value="pe">Peru</option>
                            <option value="ph">Philippines</option>
                            <option value="pn">Pitcairn</option>
                            <option value="pl">Poland</option>
                            <option value="pt">Portugal</option>
                            <option value="qa">Qatar</option>
                            <option value="cg">Republic of the Congo</option>
                            <option value="re">Reunion</option>
                            <option value="ro">Romania</option>
                            <option value="ru">Russia</option>
                            <option value="rw">Rwanda</option>
                            <option value="bl">Saint Barthelemy</option>
                            <option value="sh">Saint Helena</option>
                            <option value="kn">Saint Kitts and Nevis</option>
                            <option value="lc">Saint Lucia</option>
                            <option value="mf">Saint Martin</option>
                            <option value="pm">Saint Pierre and Miquelon</option>
                            <option value="vc">Saint Vincent and the Grenadines</option>
                            <option value="ws">Samoa</option>
                            <option value="sm">San Marino</option>
                            <option value="st">Sao Tome and Principe</option>
                            <option value="sa">Saudi Arabia</option>
                            <option value="sn">Senegal</option>
                            <option value="rs">Serbia</option>
                            <option value="sc">Seychelles</option>
                            <option value="sl">Sierra Leone</option>
                            <option value="sg">Singapore</option>
                            <option value="sx">Sint Maarten</option>
                            <option value="sk">Slovakia</option>
                            <option value="si">Slovenia</option>
                            <option value="sb">Solomon Islands</option>
                            <option value="so">Somalia</option>
                            <option value="za">South Africa</option>
                            <option value="kr">South Korea</option>
                            <option value="ss">South Sudan</option>
                            <option value="es">Spain</option>
                            <option value="lk">Sri Lanka</option>
                            <option value="sd">Sudan</option>
                            <option value="sr">Suriname</option>
                            <option value="sj">Svalbard and Jan Mayen</option>
                            <option value="sz">Swaziland</option>
                            <option value="se">Sweden</option>
                            <option value="ch">Switzerland</option>
                            <option value="sy">Syria</option>
                            <option value="tw">Taiwan</option>
                            <option value="tj">Tajikistan</option>
                            <option value="tz">Tanzania</option>
                            <option value="th">Thailand</option>
                            <option value="tg">Togo</option>
                            <option value="tk">Tokelau</option>
                            <option value="to">Tonga</option>
                            <option value="tt">Trinidad and Tobago</option>
                            <option value="tn">Tunisia</option>
                            <option value="tr">Turkey</option>
                            <option value="tm">Turkmenistan</option>
                            <option value="tc">Turks and Caicos Islands</option>
                            <option value="tv">Tuvalu</option>
                            <option value="vi">U.S. Virgin Islands</option>
                            <option value="ug">Uganda</option>
                            <option value="ua">Ukraine</option>
                            <option value="ae">United Arab Emirates</option>
                            <option value="gb">United Kingdom</option>
                            <option value="uy">Uruguay</option>
                            <option value="uz">Uzbekistan</option>
                            <option value="vu">Vanuatu</option>
                            <option value="va">Vatican</option>
                            <option value="ve">Venezuela</option>
                            <option value="wf">Wallis and Futuna</option>
                            <option value="eh">Western Sahara</option>
                            <option value="ye">Yemen</option>
                            <option value="zm">Zambia</option>
                            <option value="zw">Zimbabwe</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 div-language" style="display: none">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                        <div class="card-toolbar">
                            <div class="div-button div-button-0">
                                <button type="button" class="btn btn-primary btn-sm me-2"
                                    onclick="_settings.on.click.saveLanguage(document.querySelector('.sl-current-language').value)"
                                    data-lang="button::Update">Cập nhật</button>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="_settings.on.click.deleteLanguage(document.querySelector('.sl-current-language').value)"
                                    data-lang="button::Delete">Xóa</button>
                            </div>
                            <div class="div-button div-button-1">
                                <button type="button" class="btn btn-primary btn-sm"
                                    onclick="_settings.on.click.saveLanguage(document.querySelector('.sl-new-language').value)"
                                    data-lang="button::Save as New">Lưu bản mới</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle gs-5 gy-1 table-language"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
