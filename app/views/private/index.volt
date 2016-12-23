{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selection">

        <div class="inside-forms">

            <div id="sgnup1" style="margin-bottom: 10px; margin-top: 0px;">
                <div id="sgnupa">
                    <h2 id="addprofile" style="text-transform: uppercase;">Welcome {{ user.name }} to your private area</h2>
                </div>
            </div>

            <!-- this text needs to be changed whenever new modules come -->
            <div id="sgnup4" style="margin-bottom: 30px;">
                This is the main private area of your account, here you can add/edit/manage escort profiles that you set up. You can remove or
                add new photos to their galleries. You can buy new packages, or prolong existing ones, for your active escort profiles.
                We offer a variety of advertising packages.
            </div>

            <!--<div id="sgnup4" style="margin-bottom: 30px; padding-bottom: 0px !important;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My s3xcoins</div></div>

                <div id="coinstext1">
                    Here you can anytime buy more s3xcoins, for the future use, or if you lack s3xcoins to buy some of our packages or VIP on
                    our <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a> escort directory.
                </div>

                <div class="profile1">
                    <div class="profile2"><b>s3xcoins:</b> {{ coins }}</div>
                    <div class="profile3">
                        <a href="{{ url.getBaseUri() }}private/coins" class="myButton3">
                            <i class="icon-shopping-cart"></i> Buy s3xcoins
                        </a>
                    </div>
                    <br />
                    <br />
                    <br />
                </div>
            </div>-->

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Main menu</div></div>
                <br />
                <div class="profile1">
                    <a href="{{ url.getBaseUri() }}private/addprofile" class="myButton6">
                        <i class="icon-folder-open"></i> Add Escort Profile
                    </a>&nbsp;&nbsp;
                    <a href="{{ url.getBaseUri() }}private/managemodels" class="myButton6">
                        <i class="icon-picture"></i> Manage Models
                    </a>&nbsp;&nbsp;
                    <a href="{{ url.getBaseUri() }}private/payment" class="myButton6">
                        <i class="icon-shopping-cart"></i> Buy Package
                    </a>&nbsp;&nbsp;
                    <!--<a href="{{ url.getBaseUri() }}private/vip" class="myButton6">
                        <i class="icon-shopping-cart"></i> Buy VIP
                    </a>&nbsp;&nbsp;-->
                    <a href="{{ url.getBaseUri() }}private/bonus" class="myButton6">
                        <i class="icon-trophy"></i> s3xScheme
                    </a>&nbsp;&nbsp;
                    <!--<a href="{{ url.getBaseUri() }}private/coins">
                        <div id="private2">
                            <i class="icon-trophy privateb"></i><br>s3xcoins
                        </div>
                    </a>
                    <a href="{{ url.getBaseUri() }}private/tours">
                        <div id="private2">
                            <i class="icon-calendar privateb"></i><br>Tours
                        </div>
                    </a>
                    <a href="{{ url.getBaseUri() }}private/verification">
                        <div id="private2">
                            <i class="icon-camera-retro privateb"></i><br>100% Verified
                        </div>
                    </a>
                    <a href="{{ url.getBaseUri() }}private/pm" class="myButton6">
                        <i class="icon-key"></i> Private messages
                    </a>&nbsp;&nbsp;-->
                    <a href="{{ url.getBaseUri() }}private/settings" class="myButton6">
                        <i class="icon-key"></i> Settings
                    </a>&nbsp;&nbsp;
                    <a href="{{ url.getBaseUri() }}private/support" class="myButton6">
                        <i class="icon-headphones"></i> Support
                    </a>&nbsp;&nbsp;
                    <!--<a href="{{ url.getBaseUri() }}private/video">
                        <div id="private2">
                            <i class="icon-facetime-video privateb"></i><br>Video
                        </div>
                    </a>
                    <a href="{{ url.getBaseUri() }}private/pm">
                        <div id="private2">
                            <i class="icon-inbox privateb"></i><br>Private Messages
                        </div>
                    </a>
                    <a href="{{ url.getBaseUri() }}private/comments">
                        <div id="private2">
                            <i class="icon-comments privateb"></i><br>Reviews and Comments
                        </div>
                    </a>
                    <a href="{{ url.getBaseUri() }}private/boostprofile">
                        <div id="private2">
                            <i class="icon-plus-sign privateb"></i><br>Boost My Profile
                        </div>
                    </a>
                    <a href="{{ url.getBaseUri() }}private/blacklist">
                        <div id="private2">
                            <i class="icon-minus-sign privateb"></i><br>Blacklist
                        </div>
                    </a>
                    <a href="{{ url.getBaseUri() }}logout" class="myButton1">
                        <i class="icon-off"></i> Log Out
                    </a>-->
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                Your signup bonus code: {{ user.code }}<br><br>

                Everyone that will be signed under your code will be placed right into your s3xScheme. You will accumulate revenue throughout the whole
                month from yourself and your downlines. For this you have to give to as many people your signup bonus code, or wait for automatic order
                of the s3xScheme system to place someone under your s3xScheme.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Useful Information</div></div>

                <div class="profile1">
                    If you click on one of the packages below you will see explanation about this package.
                    <br /><br />

                    <div id="dropdown-1" class="dropdown dropdown-processed" style="margin-bottom: 5px;">
                        <div class="dropdown-link"><b style="color: #79bbff;">Diamond Package</b></div>
                        <div class="dropdown-container" style="display: none;">
                            <p>
                                This is the package for top positions on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>. You
                                can choose length for this package either 15 or 30 days. Your ad will be among top
                                listings on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>. The price for this package varies depending on
                                the days you select. 15 days Diamond package costs 150 EUR and 30 days Diamond package costs 200 EUR.
                            </p>
                        </div>
                    </div>

                    <div id="dropdown-2" class="dropdown dropdown-processed" style="margin-bottom: 5px;">
                        <div class="dropdown-link"><b style="color: goldenrod;">Gold Package</b></div>
                        <div class="dropdown-container" style="display: none;">
                            <p>
                                This is the package after <b>Diamond</b> positions on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>.
                                You can choose length for this package either 15 or 30 days. Your ad will be listed after
                                <b>Diamond</b> listings on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>. The price for this package
                                varies depending on the days you select. 15 days Gold package costs 130 EUR and 30 days Gold package costs 170 EUR.
                            </p>
                        </div>
                    </div>

                    <div id="dropdown-3" class="dropdown dropdown-processed" style="margin-bottom: 5px;">
                        <div class="dropdown-link"><b style="color: #c0c0c0;">Silver Package</b></div>
                        <div class="dropdown-container" style="display: none;">
                            <p>
                                This is the package after <b>Gold</b> positions on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>.
                                You can choose length for this package either 15 or 30 days. Your ad will be listed after
                                <b>Gold</b> listings on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>. The price for this package varies
                                depending on the days you select. 15 days Silver package costs 110 EUR and 30 days Silver package costs 140 EUR.
                            </p>
                        </div>
                    </div>

                    <div id="dropdown-4" class="dropdown dropdown-processed" style="margin-bottom: 5px;">
                        <div class="dropdown-link"><b style="color: #00247d;">FREE Package</b></div>
                        <div class="dropdown-container" style="display: none;">
                            <p>
                                This is the package after <b>Silver</b> positions on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>.
                                You can get this package for 7 days. After 6 days you can extend this package for further 7 days. You can extend this
                                package for as long as you want. Your ad will be listed after <b>Silver</b> listings on
                                <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>. The price for this package is FREE.
                            </p>
                        </div>
                    </div>

                    <br />
                    You can pay for your chosen packages with your credit card, bank transfer, Western Union or Moneygram.
                    <br /><br />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->