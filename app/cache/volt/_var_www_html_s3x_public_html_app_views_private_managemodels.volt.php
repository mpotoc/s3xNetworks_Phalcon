<?= $this->getContent() ?>

<?= $this->flash->output() ?>

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">

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
                    <h2>Manage models</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                Here you can manage your escort profiles. You are able to edit profile, edit gallery, deactivate and delete each of your escort profile
                anytime you want. You can also see which of the profile is currently active and for how long the package is payed. You can also easily
                move paid package from one profile to another.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid3">Active Models</div></div>

                <div class="escorts2">
                <!-- Needs to make counter real time for how long you have to end of your ad or not ??? check -->
                <?php foreach ($ads as $ad) { ?>
                    <?php $mul = $ad['ad_days']; ?>
                    <?php $a = strtotime($ad['ad_date']) + (86400 * $mul); ?>
                    <?php $end_date = $ad['end_date']; ?>
                    <?php $t = time(); ?>
                    <?php $ms = $a - $t; ?>
                    <?php $d = floor($ms / (24 * 60 * 60)); ?>
                    <?php $h = floor(($ms - ($d * 24 * 60 * 60)) / (60 * 60)); ?>
                    <?php $m = floor(($ms - ($d * 24 * 60 * 60) - ($h * 60 * 60)) / 60); ?>
                    <?php $s = ($ms - ($d * 24 * 60 * 60) - ($h * 60 * 60) - ($m * 60)) % 60; ?>

                    <?php if ($ad['vip'] == 'Y') { ?>
                        <?php $av = strtotime($ad['end_vip']); ?>
                        <?php $msv = $av - $t; ?>
                        <?php $dv = floor($msv / (24 * 60 * 60)); ?>
                        <?php $hv = floor(($msv - ($dv * 24 * 60 * 60)) / (60 * 60)); ?>
                        <?php $mv = floor(($msv - ($dv * 24 * 60 * 60) - ($hv * 60 * 60)) / 60); ?>
                        <?php $sv = ($msv - ($dv * 24 * 60 * 60) - ($hv * 60 * 60) - ($mv * 60)) % 60; ?>
                    <?php } ?>

                    <?php if ($ms > 0) { ?>
                        <div id="pid<?= $ad['id'] ?>" class="b-items" style="margin-bottom: 20px; margin-left: 10px;">
                            <h4 style="padding-left: 8px; font-size: 14px; text-align: left; color: #ff2211; text-shadow: none; font-weight: bold;"><img id="flagescort" src="../../img/flags/<?= strtolower($ad['country_iso_code']) ?>.png" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>" /> <?= $ad['showname'] ?></h4>
                            <div id="managelr">
                                <div class="imgcontainer1">
                                    <div class="imgcontainer2">
                                        <img id="id<?= $ad['id'] ?>" src="../files/id<?= $ad['id'] ?>/<?= $ad['path'] ?>" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?> - <?= $ad['showname'] ?>" class="thumbdp">
                                        <?php if ($ad['vip'] == 'Y') { ?>
                                            <?php if ($msv > 0) { ?>
                                                <div class="vipmodels"><img src="../../../public/img/packages/vip.png" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="<?= $dv ?> days <?= $hv ?> H <?= $mv ?> min <?= $sv ?> sec" /></div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="portfolio-caption1">
                                    <a href="editprofile/<?= $ad['showname'] ?>-<?= $ad['id'] ?>">
                                        <button type="button" class="myButton5" title="Edit Profile">
                                            Edit
                                        </button>
                                    </a>
                                    <a href="gallery/<?= $ad['showname'] ?>-<?= $ad['id'] ?>">
                                        <button type="button" class="myButton5" title="Edit Gallery">
                                            Gallery
                                        </button>
                                    </a>
                                    <a href="tours/<?= $ad['showname'] ?>-<?= $ad['id'] ?>">
                                        <button type="button" class="myButton5" title="Set tours">
                                            Tours
                                        </button>
                                    </a>
                                    <a href="changepackage/<?= $ad['id'] ?>">
                                        <button type="button" class="myButton5" title="Change model">
                                            Change
                                        </button>
                                    </a>
                                    <?php if ($ms < 172800) { ?>
                                    <a href="extend/<?= $ad['id'] ?>">
                                        <button type="button" class="myButton5" title="Extend package">
                                            Extend
                                        </button>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div style="text-align: center;">
                                <?php if ($ad['packages_id'] == 1 || $ad['packages_id'] == 2) { ?>
                                    <img src="../../img/packages/diamond-s.png" height="15" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" /> <b style="color: goldenrod; text-shadow: none; font-size: 10px;"><?= $d ?> days <?= $h ?> H <?= $m ?> min <?= $s ?> sec</b>
                                <?php } elseif ($ad['packages_id'] == 3 || $ad['packages_id'] == 4) { ?>
                                    <img src="../../img/packages/gold-s.png" height="15" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" /> <b style="color: goldenrod; text-shadow: none; font-size: 10px;"><?= $d ?> days <?= $h ?> H <?= $m ?> min <?= $s ?> sec</b>
                                <?php } elseif ($ad['packages_id'] == 5 || $ad['packages_id'] == 6) { ?>
                                    <img src="../../img/packages/silver-s.png" height="15" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" /> <b style="color: goldenrod; text-shadow: none; font-size: 10px;"><?= $d ?> days <?= $h ?> H <?= $m ?> min <?= $s ?> sec</b>
                                <?php } elseif ($ad['packages_id'] == 7) { ?>
                                    FREE <b style="color: goldenrod; text-shadow: none; font-size: 10px;"><?= $d ?> days <?= $h ?> H <?= $m ?> min <?= $s ?> sec</b>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div id="pid<?= $ad['id'] ?>" class="b-items1" style="margin-bottom: 20px; margin-left: 10px;">
                            <h4 style="padding-left: 8px; font-size: 14px; text-align: left; color: #ff2211; text-shadow: none; font-weight: bold;"><img id="flagescort" src="../../img/flags/<?= strtolower($ad['country_iso_code']) ?>.png" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>" /> <?= $ad['showname'] ?></h4>
                            <div id="managelr">
                                <div class="imgcontainer1">
                                    <img id="id<?= $ad['id'] ?>" src="../files/id<?= $ad['id'] ?>/<?= $ad['path'] ?>" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?> - <?= $ad['showname'] ?>" class="thumbda">
                                </div>
                                <div class="portfolio-caption1">
                                    <a href="editprofile/<?= $ad['showname'] ?>-<?= $ad['id'] ?>">
                                        <button type="button" class="myButton5" title="Edit Profile">
                                            Edit
                                        </button>
                                    </a>
                                    <a href="gallery/<?= $ad['showname'] ?>-<?= $ad['id'] ?>">
                                        <button type="button" class="myButton5" title="Edit Gallery">
                                            Gallery
                                        </button>
                                    </a>
                                    <a href="deactivatemodel/<?= $ad['showname'] ?>-<?= $ad['id'] ?>">
                                        <button type="button" class="myButton5" title="Deactivate">
                                            Deactivate
                                        </button>
                                    </a>
                                    <a href="deletemodel/<?= $ad['showname'] ?>-<?= $ad['id'] ?>">
                                        <button type="button" class="myButton5" title="Delete">
                                            Delete
                                        </button>
                                    </a>
                                    <a href="payment">
                                        <button type="button" class="myButton5" title="Buy package">
                                            Buy
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div style="padding-bottom: 1px;">
                                &nbsp;
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>


                    <?php foreach ($aads as $aad) { ?>
                        <div id="pid<?= $aad['id'] ?>" class="b-items1" style="margin-bottom: 20px; margin-left: 10px;">
                            <h4 style="padding-left: 8px; font-size: 14px; text-align: left; color: #ff2211; text-shadow: none; font-weight: bold;"><img id="flagescort" src="../../img/flags/<?= strtolower($aad['country_iso_code']) ?>.png" alt="Escort <?= $aad['working_country'] ?>, Escort <?= $aad['working_city1'] ?>" title="Escort <?= $aad['working_country'] ?>" /> <?= $aad['showname'] ?></h4>
                            <div id="managelr">
                                <div class="imgcontainer1">
                                    <img id="id<?= $aad['id'] ?>" src="../files/id<?= $aad['id'] ?>/<?= $aad['path'] ?>" alt="Escort <?= $aad['working_country'] ?>, Escort <?= $aad['working_city1'] ?>" title="Escort <?= $aad['working_country'] ?> - <?= $aad['showname'] ?>" class="thumbda">
                                </div>
                                <div class="portfolio-caption1">
                                    <a href="editprofile/<?= $aad['showname'] ?>-<?= $aad['id'] ?>">
                                        <button type="button" class="myButton5" title="Edit Profile">
                                            Edit
                                        </button>
                                    </a>
                                    <a href="gallery/<?= $aad['showname'] ?>-<?= $aad['id'] ?>">
                                        <button type="button" class="myButton5" title="Edit Gallery">
                                            Gallery
                                        </button>
                                    </a>
                                    <a href="deactivatemodel/<?= $aad['showname'] ?>-<?= $aad['id'] ?>">
                                        <button type="button" class="myButton5" title="Deactivate">
                                            Deactivate
                                        </button>
                                    </a>
                                    <a href="deletemodel/<?= $aad['showname'] ?>-<?= $aad['id'] ?>">
                                        <button type="button" class="myButton5" title="Delete">
                                            Delete
                                        </button>
                                    </a>
                                    <a href="payment">
                                        <button type="button" class="myButton5" title="Buy package">
                                            Buy
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div style="padding-bottom: 1px;">
                                &nbsp;
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Inactive Models</div></div>

                <div class="escorts2">

                    <?php foreach ($iads as $iad) { ?>
                        <div id="pid<?= $iad['id'] ?>" class="b-items2" style="margin-bottom: 20px; margin-left: 10px;">
                            <h4 style="padding-left: 8px; font-size: 14px; text-align: left; color: #ff2211; text-shadow: none; font-weight: bold;"><img id="flagescort" src="../../img/flags/<?= strtolower($iad['country_iso_code']) ?>.png" alt="Escort <?= $iad['working_country'] ?>, Escort <?= $iad['working_city1'] ?>" title="Escort <?= $iad['working_country'] ?>" /> <?= $iad['showname'] ?></h4>
                            <div id="managelr">
                                <div class="imgcontainer1">
                                    <img id="id<?= $iad['id'] ?>" src="../files/id<?= $iad['id'] ?>/<?= $iad['path'] ?>" alt="Escort <?= $iad['working_country'] ?>, Escort <?= $iad['working_city1'] ?>" title="Escort <?= $iad['working_country'] ?> - <?= $iad['showname'] ?>" class="thumbdi">
                                </div>
                                <div class="portfolio-caption1">
                                    <a href="editprofile/<?= $iad['showname'] ?>-<?= $iad['id'] ?>">
                                        <button type="button" class="myButton5" title="Edit Profile">
                                            Edit
                                        </button>
                                    </a>
                                    <br />
                                    <a href="gallery/<?= $iad['showname'] ?>-<?= $iad['id'] ?>">
                                        <button type="button" class="myButton5" title="Edit Gallery">
                                            Gallery
                                        </button>
                                    </a>
                                    <a href="activatemodel/<?= $iad['showname'] ?>-<?= $iad['id'] ?>">
                                        <button type="button" class="myButton5" title="Activate">
                                            Activate
                                        </button>
                                    </a>
                                    <a href="deletemodel/<?= $iad['showname'] ?>-<?= $iad['id'] ?>">
                                        <button type="button" class="myButton5" title="Delete">
                                            Delete
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div style="padding-bottom: 1px;">
                                &nbsp;
                            </div>
                        </div>
                    <?php } ?>

                    <?php foreach ($iadsn as $iadn) { ?>
                        <div id="pid<?= $iadn['id'] ?>" class="b-items2" style="margin-bottom: 20px; margin-left: 10px;">
                            <h4 style="padding-left: 8px; font-size: 14px; text-align: left; color: #ff2211; text-shadow: none; font-weight: bold;"><img id="flagescort" src="../../img/flags/<?= strtolower($iadn['country_iso_code']) ?>.png" alt="Escort <?= $iadn['working_country'] ?>, Escort <?= $iadn['working_city1'] ?>" title="Escort <?= $iadn['working_country'] ?>" /> <?= $iadn['showname'] ?></h4>
                            <div id="managelr">
                                <div class="imgcontainer1">
                                    <img id="id<?= $iadn['id'] ?>" src="../files/noimage.jpg" alt="Escort <?= $iadn['working_country'] ?>, Escort <?= $iadn['working_city1'] ?>" title="Escort <?= $iadn['working_country'] ?> - <?= $iadn['showname'] ?>" class="thumbdi">
                                </div>
                                <div class="portfolio-caption1">
                                    <a href="gallery/<?= $iadn['showname'] ?>-<?= $iadn['id'] ?>">
                                        <button type="button" class="myButton5" title="Edit Gallery">
                                            Gallery
                                        </button>
                                    </a>
                                    <a href="deletemodel/<?= $iadn['showname'] ?>-<?= $iadn['id'] ?>">
                                        <button type="button" class="myButton5" title="Delete">
                                            Delete
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div style="padding-bottom: 1px;">
                                &nbsp;
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->