{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">
        {{ form('class': 'form-search', 'id': 'outside_form') }}

        <div class="inside-forms">

            <div id="sgnup1">
                <div id="sgnupb">
                    <a href="../member">
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
                '<b>Buy</b>' button to advance to payment choose screen, where you will be able to pay for selected coin package
                wit different payment options.
            </div>

            <div id="sgnup4">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Choose s3xcoin package</div></div>

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