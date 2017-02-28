{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">

        <div class="inside-forms">

            <div id="sgnup1">
                <div id="sgnupb">
                    <a href="../../private/payment">
                        <button type="button" class="myButton4" title="Private Area">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </button>
                    </a>
                </div>
                <div id="sgnupa">
                    <h2>Pay for selected package</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                Here you can choose the most convenient payment option that you would like to use when you pay for your selected
                package. Feel free to use any of the payment options you feel comfortable.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Payment options</div></div>

                <div id="coinstext1">
                    You have to pay <b style="color: #8a2a21;">{{ price }}</b> EUR for ordered packages. <br><br>
                    Please select one of the payment options below and complete the payment. If you select one of the first three options,
                    package will be active instantly. If you select one of next three options your package will be active once we receive
                    your money.
                </div>

                <div class="profile1">
                    <div class="profile2" style="color: #00247D;">LIQPAY: </div>
                    <div class="profile3">
                        <button id="paybutton" type="button" class="liqpaybutton" data-id="{{ signature }}" data-name="{{ data }}" title="Pay with LiqPay"></button>
                        <div id="liqpay_checkout" style="display: none;"></div>
                    </div>
                </div>

                <!--<div class="profile1">
                    <div class="profile2" style="color: #00247D;">PAYPAL: </div>
                    <div class="profile3">
                        <button id="paybutton" type="button" class="paypalbutton" title="Pay with PayPal"></button>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2" style="color: #00247D;">SKRILL: </div>
                    <div class="profile3">
                        <button id="paybutton" type="button" class="skrillbutton" title="Pay with Skrill"></button>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2" style="color: #00247D;">BANK TRANSFER: </div>
                    <div class="profile3">
                        <button id="paybutton" type="button" class="pbbutton" title="Pay with Bank transfer"></button>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2" style="color: #00247D;">WESTERN UNION: </div>
                    <div class="profile3">
                        <button id="paybutton" type="button" class="wubutton" title="Pay with Western Union"></button>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2" style="color: #00247D;">MONEYGRAM: </div>
                    <div class="profile3">
                        <button id="paybutton" type="button" class="moneygrambutton" title="Pay with Moneygram"></button>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->