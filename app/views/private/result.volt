{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">

        <div class="inside-forms">
            <div id="sgnup1">
                <div id="sgnupb">
                    <a href="../../private">
                        <button type="button" class="myButton4" title="Private Area">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </button>
                    </a>
                </div>
                <div id="sgnupa">
                    <h2>Payment result</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                {% if status == 'success' %}
                    Thank you for buying ad package for {{ price }} EUR. Your payment was successful.
                {% elseif status == 'failure' or status == 'error' %}
                    Something went wrong with your payment. Please try again, check your balance or try with a different card or different payment
                    option.
                {% elseif status == 'sandbox' %}
                    Thank you for buying ad package for {{ price }} EUR. Your payment was successful.
                {% elseif status == 'free' %}
                    Thank you for applying FREE 90 days to your ad.
                {% else %}
                    You have declined the payment! If you want to buy you have to go back to "Buy package" and complete payments with one of the
                    payments processors.
                {% endif %}
            </div>
        </div>

    </div>
</div>
<!-- END MASTER COLUMN -->