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
                    <h2>s3xScheme</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                Here you can see your 5 levels deep s3xScheme, where members that registered with your bonus code plus auto placed members under your
                s3xScheme are visible. You can also see your earnings that your members accumulated for you. You get 10% of all revenue each person under
                your s3xScheme did last month, including your own revenue. The period for accumulating revenue is from first day of the month to last day of
                the month. You can make Withdraw request any day after fourth day of the month (we have a 72H pending period for withdrawals). Click button
                "Earnings" to read more about it.<br><br>
                <button type="button" class="myButton6" data-toggle="modal" data-target="#earningsModal">
                    Earnings
                </button>

            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">s3xScheme Info</div></div>

                <div id="coinstext1">
                    <table>
                        <tr>
                            <td>Name:</td>
                            <td style="padding-left: 10px;">{{ name }}</td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td style="padding-left: 10px;">{{ status }}</td>
                        </tr>
                        <tr>
                            <td>My deposits:</td>
                            <td style="padding-left: 10px;">{{ myTotal }} EUR</td>
                        </tr>
                        <tr>
                            <td>Total scheme revenue:</td>
                            <td style="padding-left: 10px;">{{ totRevenue }} EUR</td>
                        </tr>
                        <tr>
                            <td>My Earnings:</td>
                            <td style="padding-left: 10px;">{{ myEarnings }} EUR</td>
                        </tr>
                        <tr>
                            <td>Earnings left:</td>
                            <td style="padding-left: 10px;">{{ myLeftEarnings }} EUR</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        {% if withdraw == 'Y' %}
                        <tr>
                            <td colspan="2">
                                <button type="button" class="myButton6" data-toggle="modal" data-target="#withdrawModal">
                                    Withdraw
                                </button>
                            </td>
                        </tr>
                        {% else %}
                            <tr>
                                <td colspan="2" style="color: red;">
                                    Please upload your documents to have withdrawals enabled. (button will appear)
                                </td>
                            </tr>
                        {% endif %}
                        {% if withdraw == 'N' %}
                            {% if documents < 2 %}
                                <tr>
                                    <td colspan="2">
                                        <button type="button" class="myButton6" data-toggle="modal" data-target="#docsModal">
                                            Upload documents
                                        </button>
                                    </td>
                                </tr>
                            {% else %}
                                <tr>
                                    <td colspan="2" style="color: #985f0d;">
                                        Your documents are being examined. We will approve or deny them in 48 hours.
                                    </td>
                                </tr>
                            {% endif %}
                        {% else %}
                            <tr>
                                <td colspan="2" style="color: blue;">
                                    Congratulations! Your documents for withdrawals are approved.
                                </td>
                            </tr>
                        {% endif %}
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Total withdrawal requests:</td>
                            <td style="padding-left: 10px;">{{ wdTotal }} EUR</td>
                        </tr>
                        <tr>
                            <td>Last withdrawal request:</td>
                            <td style="padding-left: 10px;">{{ wdCurrent }} EUR</td>
                        </tr>
                        <tr>
                            <td>Withdrawal status:</td>
                            <td style="padding-left: 10px;">{{ wdStatus }}</td>
                        </tr>
                        <tr>
                            <td>Total withdrawn:</td>
                            <td style="padding-left: 10px;">{{ wdAll }} EUR</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">s3xScheme Overview</div></div>
                <div id="mainContainer" class="clearfix"></div>
            </div>

        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->