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
                add new photos to their galleries. You can buy coin packages or acquire new model packages directly for your active escort profiles.
                We offer a variety of advertising packages. Each package comes with it's own predefined <a href="../bonus">bonuses</a>.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                Your signup bonus code: {{ user.code }}<br><br>
                Everyone that will be signed under your code will get a great signup bonus from us and you will be entitled to 50% of every
                purchase he makes. You will accumulate money in the bonus section and when u want you can put in different payment methods
                to which the money will be automatically sent from us. For this you have to give to as many people your signup bonus code.
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
                        <i class="icon-file"></i> My Members/Earnings
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
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Useful Information</div></div>

                <div class="profile1">
                    If you click on one of the packages below you will see explanation about this package.
                    <br /><br />

                    <div id="dropdown-1" class="dropdown dropdown-processed" style="margin-bottom: 5px;">
                        <div class="dropdown-link"><b style="color: #79bbff;">Diamond Package</b></div>
                        <div class="dropdown-container" style="display: none;">
                            <p>
                                This is the package for top positions on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>. You
                                can choose for how long you want to buy this package. Options are 1,3,5,10,15,30 or 90 days. Your ad will be among top
                                listings on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>. The price for this package varies depending on
                                the days you select. From 10 s3xcoins (10 EUR) for 1 day to 140 s3xcoins (140 EUR) for 90 days.
                                If you buy this package you will get 20% returned as s3xcoins and credited them back to your s3xcoins account.
                            </p>
                        </div>
                    </div>

                    <div id="dropdown-2" class="dropdown dropdown-processed" style="margin-bottom: 5px;">
                        <div class="dropdown-link"><b style="color: goldenrod;">Gold Package</b></div>
                        <div class="dropdown-container" style="display: none;">
                            <p>
                                This is the package after <b>Diamond</b> positions on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>.
                                You can choose for how long you want to buy this package. Options are 3,10,15,30 or 90. Your ad will be listed after
                                <b>Diamond</b> listings on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>. The price for this package
                                varies depending on the days you select. From 10 s3xcoins (10 EUR) for 3 days to 100 s3xcoins (100 EUR) for 90 days.
                                If you buy this package you will get 10% returned as s3xcoins and credited them back to your s3xcoins account.
                            </p>
                        </div>
                    </div>

                    <div id="dropdown-3" class="dropdown dropdown-processed" style="margin-bottom: 5px;">
                        <div class="dropdown-link"><b style="color: #c0c0c0;">Silver Package</b></div>
                        <div class="dropdown-container" style="display: none;">
                            <p>
                                This is the package after <b>Gold</b> positions on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>.
                                You can choose for how long you want to buy this package. Options are 10,30 or 90 days. Your ad will be listed after
                                <b>Gold</b> listings on <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>. The price for this package varies
                                depending on the days you select. From 20 s3xcoins (20 EUR) for 10 days to 80 s3xcoins (80 EUR) for 90 days.
                                If you buy this package you will get 5% returned as s3xcoins and credited them back to your s3xcoins account.
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
                    You have to buy s3xcoins before you can acquire a package. You can buy s3xcoins with for your account with credit card, bank transfer,
                    Western Union or Moneygram. 1 s3xcoin is nominal value of 1 EUR. Check <a href="../bonus">bonuses</a>.
                    <br /><br />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->