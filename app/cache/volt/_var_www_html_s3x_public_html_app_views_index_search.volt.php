<?= $this->getContent() ?>

<?= $this->flash->output() ?>

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <?php if ($view_var == 0) { ?>
        <div id="selection">
            <div id="city">
                <div id="choose">Choose your city:</div>
                <?php if ($c_ads == 0) { ?>
                <b style="color: black !important; text-shadow: none;">No results found.</b>
                <?php } else { ?>
                <?php foreach ($res as $r) { ?>
                    <div id="cityname">
                        <div id="cityi">
                            <img id="flagescort2" src="../../img/flags/<?= strtolower($r['iso']) ?>.png" alt="Escort <?= $r['country'] ?>, Escort <?= $r['city'] ?>" title="Escort <?= $r['country'] ?>" />
                        </div>
                        <div id="citya">
                            &nbsp;<a href="../city/<?= $r['city'] ?>" alt="Escort <?= $r['country'] ?>, Escort <?= $r['city'] ?>" title="Escort <?= $r['country'] ?>"><?= $r['city'] ?> (<?= $r['num'] ?>)</a>
                        </div>
                    </div>
                <?php } ?>
                    <div id="count_online"><?= $cnt['num'] ?> Escorts online</div>
                <?php } ?>
            </div>
        </div>
    <?php } elseif ($view_var == 1) { ?>
        <div id="selection">
            <div id="city1">
                <div id="choose2">
                    <a href="<?= $this->url->getBaseUri() ?>">Home</a> &nbsp;<i class="glyphicon glyphicon-arrow-right"></i>&nbsp; Escorts in <?= $city ?>
                </div>
            </div>
        </div>
        <div id="citysection">
            <?= $city ?> escorts
        </div>
    <?php } elseif ($view_var == 2) { ?>
        <div id="selection">
            <div id="city1">
                <div id="choose2">
                    <a href="<?= $this->url->getBaseUri() ?>">Home</a> &nbsp;<i class="glyphicon glyphicon-arrow-right"></i>&nbsp;
                    <?php if ($gg === 'new') { ?>
                        New escorts in <?= $city ?>
                    <?php } else { ?>
                        Escort <?= $gg ?> in <?= $city ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div id="citysection">
            <?php if ($gg === 'new') { ?>
                New escorts in <?= $city ?>
            <?php } else { ?>
                <?= $city ?> escort <?= $gg ?>
            <?php } ?>
        </div>
    <?php } ?>
    <div id="wrapper_filter">
        <div id="filter" style="display: none;">
            <button id="filter1" type="button" class="btn-default" data-toggle="modal" data-target="#filterModal">
                <i class="glyphicon glyphicon-filter"></i> Filters
            </button>
        </div>
        <div id="search" style="padding-left: 275px;">
            <div class="inner-addon left-addon">
                <?= $this->tag->form(['id' => 'searchform']) ?>
                    <i class="glyphicon glyphicon-search"></i>
                    <input type="text" class="form-control" id="InputSearchI" placeholder="search by name" />
                    <input type="hidden" value="<?= $publicUrl ?>" id="publicUrl" />
                    <input type="hidden" value="<?= $city ?>" id="publicCity" />
                    <input type="hidden" value="<?= $gg ?>" id="publicGender" />
                </form>
            </div>
        </div>
        <div id="filters" style="float: right !important;">
            <button id="testbtn" type="button" class="myButton2" title="XS"><i class="glyphicon glyphicon-th"></i></button>
            <button id="testbtn2" type="button" class="myButton2" title="XL"><i class="glyphicon glyphicon-th-large"></i></button>
        </div>
    </div>
    <section id="escorts">
        <div class="row">
            <?php if ($c_ads == 0) { ?>
                <b style="color: black !important; text-shadow: none;">No escorts found.</b>
            <?php } else { ?>
                <?php foreach ($ads as $ad) { ?>
                    <?php $today = date('Y-m-d H:i:s', time()); ?>
                    <?php $today_new = date('Y-m-d H:i:s', time() - (86400 * 3)); ?>
                    <?php $new_date = $ad['created']; ?>
                    <?php $end_date = $ad['end_date']; ?>
                    <?php $end_vip = $ad['end_vip']; ?>
                    <?php $f = $ad['packages_id']; ?>
                    <?php if ($f > 0 && $f < 8) { ?>
                        <?php if ($today < $end_date) { ?>
                            <div id="pid<?= $ad['id'] ?>" class="col-xs-4 babes-item">
                                <h4><?= $ad['showname'] ?></h4>
                                <a href="../escort/<?= $ad['showname'] ?>-<?= $ad['id'] ?>">
                                    <div class="imgcontainer">
                                        <img id="id<?= $ad['id'] ?>" src="../../files/id<?= $ad['id'] ?>/<?= $ad['path'] ?>" class="thumb2" first="files/id<?= $ad['id'] ?>/<?= $ad['path'] ?>" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['showname'] ?>">
                                        <?php if ($f == 1 || $f == 2) { ?>
                                            <img class="imgoverlay1" src="../../img/packages/diamond.png" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>">
                                        <?php } elseif ($f == 3 || $f == 4) { ?>
                                            <img class="imgoverlay1" src="../../img/packages/gold.png" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>">
                                        <?php } elseif ($f == 5 || $f == 6) { ?>
                                            <img class="imgoverlay1" src="../../img/packages/silver.png" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>">
                                        <?php } ?>
                                        <?php if ($ad['vip'] == 'Y') { ?>
                                            <?php if ($today < $end_vip) { ?>
                                                <img class="imgoverlay2" src="../../img/packages/vip.png" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>">
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($ad['verified'] == 'Y') { ?>
                                            <img class="imgoverlay3" src="../../img/packages/verified.png" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>">
                                        <?php } ?>
                                        <?php if ($today_new < $new_date) { ?>
                                            <img class="imgoverlay4" src="../../img/packages/new.png" alt="Escort <?= $ad['working_country'] ?>, Escort <?= $ad['working_city1'] ?>" title="Escort <?= $ad['working_country'] ?>">
                                        <?php } ?>
                                    </div>
                                </a>
                                <div class="portfolio-caption">
                                    <p class="text-muted">
                                        <?php if ($ad['like'] > 0) { ?>
                                            <i class="glyphicon glyphicon-heart" title="likes" style="color: red;"></i>(<?= $ad['like'] ?>)
                                        <?php } ?>
                                        &nbsp;&nbsp;Escort <?= $ad['working_city1'] ?>&nbsp;&nbsp;
                                        <?php if ($ad['cnt'] > 0) { ?>
                                            <i class="glyphicon glyphicon-comment" title="comments" style="color: blue;"></i>(<?= $ad['cnt'] ?>)
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </section>
</div>
<!-- END MASTER COLUMN -->