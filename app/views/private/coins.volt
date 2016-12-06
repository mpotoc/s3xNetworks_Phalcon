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
                    <h2>Buy s3xcoins</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                All input fields marked with '<b>*</b>' are mandatory. You have to choose coin package and click on
                '<b>Buy</b>' button to advance to payment screen, where you will be able to pay for selected coin package
                with different payment options.
            </div>

            <div id="sgnup4">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Select s3xcoin package</div></div>

                <div id="coinstext1">
                    s3xcoins are used to pay for different packages, VIP or boosts on our <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>
                    escort directory. You can purchase different s3xcoin packages for which you will get different amount of s3xcoins. The more you buy
                    at once the more s3xcoins you will be credited with. After successful payment your s3xcoins will be added to your account
                    immediately. Thank you for using our <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a> escort directory.<br/><br/>
                    First select s3xcoin package where it says how many s3xcoins your account will be credited when you complete payment on our
                    <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a> escort directory. On the right side where it says 'Price' you will see
                    how many EUR this s3xcoins will cost. Then press '<b>Buy</b>' button to advance to payment selection screen where you will complete
                    the payment for selected s3xcoins.
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('packages') }} *</div>
                    <div class="profile4">
                        {{ form.render('packages', ['class': 'form-control', 'data-validetta': 'required']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><b>Price:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="price_coins" id="price_coins" disabled />
                    </div>
                </div>

                <br />

                <div class="profile1">
                    <div class="profilesubmit">{{ form.render('Buy') }}</div>
                </div>
            </div>

        </form>
        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->