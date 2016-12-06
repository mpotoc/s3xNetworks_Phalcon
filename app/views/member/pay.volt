{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">

        <div class="inside-forms">

            <div id="sgnup1">
                <div id="sgnupb">
                    <a href="../../member">
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
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Pay via</div></div>

                <div class="profile1">
                    <div class="profile2" style="color: #00247D;">LIQPAY: </div>
                    <div class="profile3">
                        <form method="POST" accept-charset="utf-8" action="https://www.liqpay.com/api/3/checkout">
                            <input type="hidden" name="data" value="{{ data }}" />
                            <input type="hidden" name="signature" value="{{ signature }}" />
                            <input type="image" src="//static.liqpay.com/buttons/p1en.radius.png" name="btn_text" />
                        </form>
                    </div>
                </div>

                <!--<div class="profile1">
                    <div class="profile2" style="color: #00247D;">PAYPAL: </div>
                    <div class="profile3">
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->