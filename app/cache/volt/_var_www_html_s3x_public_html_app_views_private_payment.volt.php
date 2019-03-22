<?= $this->getContent() ?>

<?= $this->flash->output() ?>

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">
        <?= $this->tag->form(['class' => 'form-search', 'id' => 'outside_form']) ?>

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
                    If you select <b style="color: #79bbff; text-shadow: none;">Diamond package</b>
                    your ad will be amongst top listings on our <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a> escort directory and will
                    be visible to clients before any other package. FREE package will be at the bottom of the listings.
                </div>

                <div class="profile1">
                    <div class="profile2"><?= $form->label('adverts') ?> *</div>
                    <div class="profile3">
                        <?= $form->render('adverts', ['class' => 'form-control', 'data-validetta' => 'required']) ?>
                    </div>
                </div>

                <div class="profile1">
                    <div class="packageradio"><?= $form->render('payment', ['value' => '1', 'data-validetta' => 'required']) ?>
                        <b style="color: #79bbff; text-shadow: none;">Diamond Package</b>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">
                        Length:
                    </div>
                    <div class="profile4">
                        <select id="packagesd" name="packages" class="form-control" data-validetta="packages" disabled>
                            <option value="0">Please select ...</option>
                            <option value="2">15 days</option>
                            <option value="1">30 days</option>
                        </select>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><b>Price:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="price_packd" id="price_packd" disabled />
                        <input type="hidden" name="price" id="priced" value="">
                    </div>
                </div>

                <div class="profile1">
                    <div class="packageradio"><?= $form->render('payment', ['value' => '3', 'data-validetta' => 'required']) ?>
                        <b style="color: goldenrod; text-shadow: none;">Gold Package</b>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">
                        Length:
                    </div>
                    <div class="profile4">
                        <select id="packagesg" name="packages" class="form-control" data-validetta="packages" disabled>
                            <option value="0">Please select ...</option>
                            <option value="4">15 days</option>
                            <option value="3">30 days</option>
                        </select>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><b>Price:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="price_packg" id="price_packg" disabled />
                        <input type="hidden" name="price" id="priceg" value="">
                    </div>
                </div>

                <div class="profile1">
                    <div class="packageradio"><?= $form->render('payment', ['value' => '5', 'data-validetta' => 'required']) ?>
                        <b style="color: #c0c0c0; text-shadow: none;">Silver Package</b>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">
                        Length:
                    </div>
                    <div class="profile4">
                        <select id="packagess" name="packages" class="form-control" data-validetta="packages" disabled>
                            <option value="0">Please select ...</option>
                            <option value="6">15 days</option>
                            <option value="5">30 days</option>
                        </select>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><b>Price:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="price_packs" id="price_packs" disabled />
                        <input type="hidden" name="price" id="prices" value="">
                    </div>
                </div>

                <!--<div class="profile1">
                    <div class="packageradio"><?= $form->render('payment', ['value' => '7', 'data-validetta' => 'required']) ?>
                        <b style="color: #00247d; text-shadow: none;">FREE Package</b>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">
                        Length:
                    </div>
                    <div class="profile4">
                        <select id="packagesf" name="packages" class="form-control" data-validetta="packages" disabled>
                            <option value="0">Please select ...</option>
                            <option value="7">90 days</option>
                        </select>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><b>Price:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="price_packf" id="price_packf" disabled />
                        <input type="hidden" name="price" id="pricef" value="">
                    </div>
                </div>-->

                <br />

                <div class="profile1">
                    <div class="profilesubmit"><?= $form->render('Buy package') ?></div>
                </div>
            </div>
        </form>

        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->