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
                    <h2>Buy VIP</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                All input fields marked with '<b>*</b>' are mandatory. You have to select a model which already have active one of the existing packages.
                Then you have to click on "Buy VIP" button to complete transaction.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">VIP package</div></div>

                <div id="coinstext1">
                    Please have in mind that VIP package can be put only onto model with active package (<b style="color: #79bbff; text-shadow: none;">
                    Diamond</b>, <b style="color: goldenrod; text-shadow: none;">Gold</b>, <b style="color: #c0c0c0; text-shadow: none;">Silver</b> or
                    <b style="color: #00247d; text-shadow: none;">FREE</b>) and that VIP package can not be extended on our
                    <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a> escort directory. Also have in mind that if you buy VIP package for more
                    days then your ad have left, please do not forget to extend your ongoing package or buy new one as soon as this one ends, so that
                    you will use your VIP fully.<br/><br/><b>VIP costs 30 EUR for 5 days.</b>
                </div>

                <div class="profile1">
                    <div class="profile2"><?= $form->label('adverts') ?></div>
                    <div class="profile3">
                        <?= $form->render('adverts', ['class' => 'form-control', 'data-validetta' => 'required']) ?>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2"><b>VIP days:</b></div>
                    <div class="profile4">
                        <input type="text" class="form-control" name="vipDays" id="vipDays" value="5" disabled />
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
                    <div class="profilesubmit"><?= $form->render('Buy VIP') ?></div>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->