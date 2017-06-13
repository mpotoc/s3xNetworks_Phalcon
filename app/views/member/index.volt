{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selection">

        <div class="inside-forms">

            <div id="sgnup1" style="margin-bottom: 10px; margin-top: 0px;">
                <div id="sgnupa">
                    <h2 id="addprofile" style="text-transform: uppercase;">Welcome {{ user.name }} to your member area <!--{{ sess['name'] }}--></h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                This is the main member area of your account, here you can change your settings,  or write to support. You can leave comments
                on each girls site. You must be logged in to comment girls you have visited. Every ad has option to comment it. This site will be
                updated with with different useful things for members (favorites, reviews, personal messages, VIP zone and many more stuff).
            </div>

            <!-- <div id="sgnup4" style="margin-bottom: 30px; padding-bottom: 0px !important;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My s3xcoins</div></div>

                <div class="profile1">
                    <div class="profile2"><b>s3xcoins:</b> {{ coins }}</div>
                    <div class="profile3">
                        <a href="{{ url.getBaseUri() }}member/coins" class="myButton3">
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
                    <!--<a href="{{ url.getBaseUri() }}private/addprofile" class="myButton6">
                        <i class="icon-folder-open"></i> Add Escort Profile
                    </a>&nbsp;&nbsp;
                    <a href="{{ url.getBaseUri() }}private/managemodels" class="myButton6">
                        <i class="icon-picture"></i> Manage Models
                    </a>&nbsp;&nbsp;
                    <a href="{{ url.getBaseUri() }}member/pm" class="myButton6">
                        <i class="icon-shopping-cart"></i> Private messages
                    </a>&nbsp;&nbsp;-->
                    <!--<a href="{{ url.getBaseUri() }}private/coins">
                        <div id="private2">
                            <i class="icon-trophy privateb"></i><br>Coins
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
                    </a>-->
                    <a href="{{ url.getBaseUri() }}member/forum" class="myButton6">
                        <i class="icon-folder-open"></i> Forum
                    </a>&nbsp;&nbsp;
                    <a href="{{ url.getBaseUri() }}member/settings" class="myButton6">
                        <i class="icon-key"></i> Settings
                    </a>&nbsp;&nbsp;
                    <a href="{{ url.getBaseUri() }}member/support" class="myButton6">
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

                <!--Everyone that will be signed under your code will be placed right into your s3xScheme. You will accumulate revenue throughout the whole
                month from yourself and your downlines. For this you have to give to as many people your signup bonus code, or wait for automatic order
                of the s3xScheme system to place someone under your s3xScheme.-->
            </div>

        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->