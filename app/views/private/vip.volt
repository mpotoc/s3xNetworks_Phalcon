{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">
        {{ form('class': 'form-search', 'id': 'outside_form') }}

        <div class="inside-forms">

            <div id="sgnup1">
                <div id="sgnupb">
                    <a href="../private">
                        <button type="button" class="myButton4" title="Private Area">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </button>
                    </a>
                </div>
                <div id="sgnupa">
                    <h2>Buy VIP</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                All input fields marked with '<b>*</b>' are mandatory. You have to select a model which already have active one of the existing packages.
                Then you have to input for how many days you want to buy VIP package with s3xcoins. If you want to buy VIP package and do not have enough
                s3xcoins, please buy s3xcoins at the '<b>My s3xcoins</b>' section below.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">VIP package</div></div>

                <div id="coinstext1">
                    Please have in mind that VIP package can be put only onto model with active package (<b style="color: #79bbff; text-shadow: none;">
                    Diamond</b>, <b style="color: goldenrod; text-shadow: none;">Gold</b>, <b style="color: #c0c0c0; text-shadow: none;">Silver</b> or
                    <b style="color: #00247d; text-shadow: none;">FREE</b>) and that VIP package can not be extended on our
                    <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a> escort directory. Also have in mind that if you buy VIP package for more
                    days then your ad have left, please do not forget to extend your ongoing package or buy new one as soon as this one ends, so that
                    you will use your VIP fully.<br/><br/><b>VIP costs 5 s3xcoins (5 EUR) per day.</b>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('adverts') }}</div>
                    <div class="profile3">
                        {{ form.render('adverts', ['class': 'form-control', 'data-validetta': 'required']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('vipDays') }} *</div>
                    <div class="profile4">
                        {{ form.render('vipDays', ['class': 'form-control', 'placeholder': 'e.g., number of days (1,2,5,15,30,120,...)', 'data-validetta': 'required,positive']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><b>Price:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="price_vip" id="price_vip" disabled />
                    </div>
                </div>

                <br />

                <div class="profile1">
                    <div class="profilesubmit">{{ form.render('Buy VIP') }}</div>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px; padding-bottom: 0px !important;">
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
            </div>
            </form>

        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->