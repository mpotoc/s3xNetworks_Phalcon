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
                    <h2>Buy package</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                All input fields marked with '<b>*</b>' are mandatory. You have to select a model, then select a package you want to buy for this
                model. After that you have to select the '<b>Length</b>' of the selected package and click '<b>Buy package</b>' button.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Packages</div></div>

                <div id="coinstext1">
                    Remember each package have also it's own bonuses. If you select <b style="color: #79bbff; text-shadow: none;">Diamond package</b>
                    your ad will be amongst top listings on our <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a> escort directory and will
                    be visible to clients before any other package. FREE package will be at the bottom of the listings.
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('adverts') }} *</div>
                    <div class="profile3">
                        {{ form.render('adverts', ['class': 'form-control', 'data-validetta': 'required']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="packageradio">{{ form.render('payment', ['value': '1', 'data-validetta': 'required']) }}
                        <b style="color: #79bbff; text-shadow: none;">Diamond Package</b>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">
                        Length:
                    </div>
                    <div class="profile4">
                        <select id="packagesd" name="packagesd" class="form-control" data-validetta="packages" disabled>
                            <option value="0">Please select ...</option>
                            <option value="15">15 days</option>
                            <option value="30">30 days</option>
                        </select>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><b>Price:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="price_packd" id="price_packd" disabled />
                        <input type="hidden" name="priced" id="priced" value="">
                    </div>
                </div>

                <div class="profile1">
                    <div class="packageradio">{{ form.render('payment', ['value': '4', 'data-validetta': 'required']) }}
                        <b style="color: goldenrod; text-shadow: none;">Gold Package</b>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">
                        Length:
                    </div>
                    <div class="profile4">
                        <select id="packagesg" name="packagesg" class="form-control" data-validetta="packages" disabled>
                            <option value="0">Please select ...</option>
                            <option value="15">15 days</option>
                            <option value="30">30 days</option>
                        </select>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><b>Price:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="price_packg" id="price_packg" disabled />
                        <input type="hidden" name="priceg" id="priceg" value="">
                    </div>
                </div>

                <div class="profile1">
                    <div class="packageradio">{{ form.render('payment', ['value': '7', 'data-validetta': 'required']) }}
                        <b style="color: #c0c0c0; text-shadow: none;">Silver Package</b>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">
                        Length:
                    </div>
                    <div class="profile4">
                        <select id="packagess" name="packagess" class="form-control" data-validetta="packages" disabled>
                            <option value="0">Please select ...</option>
                            <option value="15">15 days</option>
                            <option value="30">30 days</option>
                        </select>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><b>Price:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="price_packs" id="price_packs" disabled />
                        <input type="hidden" name="prices" id="prices" value="">
                    </div>
                </div>

                <div class="profile1">
                    <div class="packageradio">{{ form.render('payment', ['value': '21', 'data-validetta': 'required']) }}
                        <b style="color: #00247d; text-shadow: none;">FREE Package</b>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">
                        Length:
                    </div>
                    <div class="profile4">
                        <select id="packagesf" name="packagesf" class="form-control" data-validetta="packages"   disabled>
                            <option value="0">Please select ...</option>
                            <option value="7">7 days</option>
                        </select>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><b>Price:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="price_packf" id="price_packf" disabled />
                        <input type="hidden" name="pricef" id="pricef" value="">
                    </div>
                </div>

                <br />

                <div class="profile1">
                    <div class="profilesubmit">{{ form.render('Buy package') }}</div>
                </div>
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
        </form>

        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->