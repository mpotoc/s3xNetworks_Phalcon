{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">
        <input type="hidden" name="userId" id="userId" value="{{ userId }}">
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
                    <h2>My Bonus Downlines</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                Here you can see members that registered under your bonus code. You can also see your earnings your members accumulated
                for you. You have two different earnings, one that can be directly withdrawn to your selected account (Bank account, Credit Card,
                Western Union, MoneyGram) and the second earnings which can be only spent on your models.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My Downline Earnings</div></div>

                <div id="coinstext1">
                    You have earned from your members {{ sum }} EUR, which you can withdraw or spend for your models. <br><br>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My 1/5 Bonus Scheme</div></div>
                <div id="mainContainer" class="clearfix"></div>
            </div>

        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->