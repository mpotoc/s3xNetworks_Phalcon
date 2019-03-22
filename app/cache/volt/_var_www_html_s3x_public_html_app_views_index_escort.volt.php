<?= $this->getContent() ?>

<?= $this->flash->output() ?>

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selection">
        <div id="escortright">
            <!--<div id="mygallery">
                <div id="gal">
                    My Gallery
                </div>
                <?php if ($ads['verified'] == 'Y') { ?>
                <div id="verify">
                    100% VERIFIED
                </div>
                <?php } ?>
            </div>-->
            <div id="escortleft">
                <div class="customNavigation">
                    <a class="prev"> <</a>
                    <a class="next"> > </a>
                </div>
                <div id="owl-demo" class="owl-carousel owl-theme">
                <?php $i = 0; ?>
                <?php foreach ($gal as $g) { ?>
                    <div class="item"><img id="escortsimg" src="../../files/id<?= $g->ad_id ?>/<?= $g->path ?>" alt="Escort <?= $ads['working_country'] ?>, Escort <?= $ads['working_city1'] ?>" title="Escort <?= $ads['showname'] ?>"></div>
                    <?php $i = $i + 1; ?>
                <?php } ?>
                </div>
                <div class="escort_likes"><i class="glyphicon glyphicon-heart" title="likes"></i> (<?= $likes ?>)</div>
            </div>
            <div id="comments">
                <?php if (!(empty($logged_in))) { ?>
                <button id="testbtn" type="button" class="myButton2a" data-toggle="modal" data-id="<?= $ads['id'] ?>" data-name="<?= $ads['showname'] ?>" data-target="#commentModal" title="Write comment">
                    <i class="glyphicon glyphicon-comment"></i> Write Comment
                </button>
                <?php } else { ?>
                    <button id="testbtn" type="button" class="myButton2a" title="Write comment">
                        <i class="glyphicon glyphicon-comment"></i> Post Comment
                    </button>
                <?php } ?>
                <a href="../like/<?= $ads['showname'] ?>-<?= $ads['id'] ?>">
                    <button id="testbtn" type="button" class="myButton2b" title="Like">
                        <i class="glyphicon glyphicon-heart"></i> Like
                    </button>
                </a>
                <!--<button id="testbtn" type="button" class="myButton2" title="Report fake profile">
                    <i class="glyphicon glyphicon-flag"></i> Report Fake
                </button>-->
            </div>
            <div id="show-comments" class="phone_call2">Comments</div>
            <div id="show-comments-body">
            <?php if (!(empty($logged_in))) { ?>
                <?php foreach ($comments as $com) { ?>
                    <div class="div1">
                    <div id="show-comments-user">&nbsp;<?= $com['name'] ?> wrote:</div>
                    <div id="show-comments-text"><?= $com['comment'] ?></div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div id="show-comments-text">
                    You have to be logged in to read and post comments! Please <a href="../../login">login</a> or <a href="../../register">register</a>.
                </div>
            <?php } ?>
            </div>
            <button id="seeMoreRecords" type="button" class="myButton2a" title="More comments">
                More
            </button>
            <button id="seeLessRecords" type="button" class="myButton2" title="Hide comments">
                Hide
            </button>
        </div>

        <div id="escortinfo2">
            <!--<div id="bioright">
                <div id="biostart">
                    My Info
                </div>
            </div>-->

                <?php if ($ads['vip'] == 'Y') { ?>
                    <?php $today = date('Y-m-d H:i:s', time()); ?>
                    <?php $end_vip = $ads['end_vip']; ?>
                <?php } ?>
                <?php if ($ads['packages_id'] == 1 || $ads['packages_id'] == 2) { ?>
                    <?php $var_package = 'diamond'; ?>
                <?php } elseif ($ads['packages_id'] == 3 || $ads['packages_id'] == 4) { ?>
                    <?php $var_package = 'gold'; ?>
                <?php } elseif ($ads['packages_id'] == 5 || $ads['packages_id'] == 6) { ?>
                    <?php $var_package = 'silver'; ?>
                <?php } elseif ($ads['packages_id'] == 7) { ?>
                    <?php $var_package = 'FREE'; ?>
                <?php } ?>
                <?php if ($var_package == 'FREE') { ?>
                    <div id="showpackage1"><b style="color: #00247d !important;">FREE</b></div>
                <?php } else { ?>
                    <div id="showpackage1"><img src="../../../public/img/packages/<?= $var_package ?>-s.png" alt="Escort <?= $ads['working_country'] ?>, Escort <?= $ads['working_city1'] ?>" title="Escort <?= $ads['working_country'] ?>" /></div>
                <?php } ?>
                <?php if ($ads['vip'] == 'Y') { ?>
                    <?php if ($today < $end_vip) { ?>
                        <div id="showpackage"><img src="../../../public/img/packages/vip.png" alt="Escort <?= $ads['working_country'] ?>, Escort <?= $ads['working_city1'] ?>" title="Escort <?= $ads['working_country'] ?>" /></div>
                    <?php } ?>
                <?php } ?>

            <div id="escortinfo">
                <div id="showviews">Total views: <?= $counter ?></div>

                <div id="escort-div">
                    <p id="shownameid">
                        &nbsp;<?= $ads['showname'] ?>
                    </p>
                    <?php if ($ads['slogan']) { ?>
                        <div id="leftshow_top">Slogan:</div><div id="rightshow_top"><?= $ads['slogan'] ?></div>
                    <?php } else { ?>
                        <div id="leftshow_top">Slogan:</div> <div id="rightshow_top">N/A</div>
                    <?php } ?>
                    <?php if ($ads['gender'] == 'F') { ?>
                        <?php $var_gender = 'Female'; ?>
                    <?php } elseif ($ads['gender'] == 'M') { ?>
                        <?php $var_gender = 'Male'; ?>
                    <?php } elseif ($ads['gender'] == 'T') { ?>
                        <?php $var_gender = 'Transsexual'; ?>
                    <?php } ?>
                    <div id="leftshow_top">Gender:</div><div id="rightshow_top"><?= $var_gender ?></div>
                    <?php if ($ads['age']) { ?>
                        <div id="leftshow_top">Age:</div> <div id="rightshow_top"><?= $ads['age'] ?></div>
                    <?php } ?>
                    <?php if ($ads['ethnicity']) { ?>
                        <div id="leftshow_top">Ethnicity:</div> <div id="rightshow_top"><?= $ads['ethnicity'] ?></div>
                    <?php } else { ?>
                        <div id="leftshow_top">Ethnicity:</div> <div id="rightshow_top">N/A</div>
                    <?php } ?>
                    <?php if ($ads['nationality']) { ?>
                        <div id="leftshow_top">Nationality:</div> <div id="rightshow_top"><?= $ads['nationality'] ?></div>
                    <?php } else { ?>
                        <div id="leftshow_top">Nationality:</div> <div id="rightshow_top">N/A</div>
                    <?php } ?>
                    <?php if ($ads['home_country']) { ?>
                        <div id="leftshow_top">From:</div> <div id="rightshow_top"><?= $ads['home_country'] ?></div>
                    <?php } else { ?>
                        <div id="leftshow_top">From:</div> <div id="rightshow_top">N/A</div>
                    <?php } ?>
                    <?php if ($ads['hairstyle']) { ?>
                        <div id="leftshow_top">Hair:</div> <div id="rightshow_top"><?= $ads['hairstyle'] ?></div>
                    <?php } else { ?>
                        <div id="leftshow_top">Hair:</div> <div id="rightshow_top">N/A</div>
                    <?php } ?>
                    <?php if ($ads['eyes']) { ?>
                        <div id="leftshow_top">Eyes:</div> <div id="rightshow_top"><?= $ads['eyes'] ?></div>
                    <?php } else { ?>
                        <div id="leftshow_top">Eyes:</div> <div id="rightshow_top">N/A</div>
                    <?php } ?>
                    <?php if ($ads['measurement']) { ?>
                        <div id="leftshow_top">Measurements:</div> <div id="rightshow_top"><?= $ads['measurement'] ?></div>
                    <?php } else { ?>
                        <div id="leftshow_top">Measurements:</div> <div id="rightshow_top">N/A</div>
                    <?php } ?>
                    <div id="leftshow_top">Orientation:</div>
                    <?php if ($ads['orientation'] == 'B') { ?>
                        <div id="rightshow_top">Bisexual</div>
                    <?php } elseif ($ads['orientation'] == 'S') { ?>
                        <div id="rightshow_top">Heterosexual</div>
                    <?php } elseif ($ads['orientation'] == 'H') { ?>
                        <div id="rightshow_top">Homosexual</div>
                    <?php } else { ?>
                        <div id="rightshow_top">N/A</div>
                    <?php } ?>
                </div>
                <div id="escort-div">
                    <?php if ($ads['phone']) { ?>
                        <div id="show_phone" class="phone_call"><?= $ads['phone'] ?></div>
                    <?php } ?>
                </div>
                <div id="escort-div">
                    <?php if ($ads['about_me']) { ?>
                        <div id="rightshow2"><?= $ads['about_me'] ?></div>
                    <?php } ?>
                    <?php if ($ads['services']) { ?>
                        <div id="rightshow4"><?= $ads['services'] ?></div>
                    <?php } ?>
                    <?php if ($ads['languages']) { ?>
                        <div id="rightshow2"><?= $ads['languages'] ?></div>
                    <?php } ?>
                    <div id="leftshow_price">30 minutes:</div><div id="rightshow_price">1 hour:</div>
                    <div id="leftshow_price" class="phone_call1"><?= $ads['price1'] ?></div>
                    <div id="rightshow_price" class="phone_call1"><?= $ads['price2'] ?></div>
                    <div id="leftshow_price">2 hours:</div><div id="rightshow_price">Night:</div>
                    <?php if ($ads['price3']) { ?>
                        <div id="leftshow_price" class="phone_call1"><?= $ads['price3'] ?></div>
                    <?php } else { ?>
                        <div id="leftshow_price" class="phone_call1">N/A</div>
                    <?php } ?>
                    <?php if ($ads['price4']) { ?>
                        <div id="rightshow_price" class="phone_call1"><?= $ads['price4'] ?></div>
                    <?php } else { ?>
                        <div id="rightshow_price" class="phone_call1">N/A</div>
                    <?php } ?>
                </div>
                <div id="escort-div">
                    <div id="leftshow">Working time:</div>
                    <?php if ($ads['working_time']) { ?>
                        <div id="rightshow" class="phone_call2"><?= $ads['working_time'] ?></div>
                    <?php } else { ?>
                        <div id="rightshow" class="phone_call2">N/A</div>
                    <?php } ?>
                    <div id="leftshow">Current country:</div>
                    <?php if ($ads['working_country']) { ?>
                        <div id="rightshow" class="phone_call2"><?= $ads['working_country'] ?></div>
                    <?php } ?>
                    <div id="leftshow">Available in cities:</div>
                    <?php if ($ads['working_city1']) { ?>
                        <div id="rightshow" class="phone_call2"><?= $ads['working_city1'] ?></div>
                    <?php } ?>
                    <div id="leftshow">&nbsp;</div>
                    <?php if ($ads['working_city2']) { ?>
                        <div id="rightshow" class="phone_call2"><?= $ads['working_city2'] ?></div>
                    <?php } else { ?>
                        <div id="rightshow" class="phone_call2">N/A</div>
                    <?php } ?>
                    <div id="leftshow">&nbsp;</div>
                    <?php if ($ads['working_city3']) { ?>
                        <div id="rightshow" class="phone_call2"><?= $ads['working_city3'] ?></div>
                    <?php } else { ?>
                        <div id="rightshow" class="phone_call2">N/A</div>
                    <?php } ?>
                    <div id="leftshow">&nbsp;</div>
                    <?php if ($ads['working_city4']) { ?>
                        <div id="rightshow" class="phone_call2"><?= $ads['working_city4'] ?></div>
                    <?php } else { ?>
                        <div id="rightshow" class="phone_call2">N/A</div>
                    <?php } ?>
                </div>
                <div id="escort-div">
                    <div id="show_phone" class="phone_call3">My Tours</div>
                    <?php if ($ct > 0) { ?>
                        <?php foreach ($tours as $t) { ?>
                            <div id="rightshow3">
                                <table>
                                    <tr>
                                        <td id="leftshow_top">Tour start: </td>
                                        <td> <?= date('d/m/Y', strtotime($t->datestart)) ?> <?= $t->fromHour ?></td>
                                    </tr>
                                    <tr>
                                        <td id="leftshow_top">Tour end: </td>
                                        <td> <?= date('d/m/Y', strtotime($t->dateend)) ?> <?= $t->toHour ?></td>
                                    </tr>
                                    <tr>
                                        <td id="leftshow_top">Tour place: </td>
                                        <td> <?= $t->country ?> - <?= $t->city ?></td>
                                    </tr>
                                    <tr>
                                        <td id="leftshow_top">Tour phone: </td>
                                        <td> <?= $ads['phone'] ?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div id="rightshow3">No tours selected</div>
                    <?php } ?>
                </div>
                <div id="escort-div">
                    <div id="leftshow">Phone number:</div>
                    <?php if ($ads['phone']) { ?>
                        <div id="rightshow"><?= $ads['phone'] ?></div>
                    <?php } ?>
                    <div id="leftshow">&nbsp;</div>
                    <?php if ($ads['contact_me'] == 'C') { ?>
                        <div id="rightshow">SMS and Call</div>
                    <?php } elseif ($ads['contact_me'] == 'S') { ?>
                        <div id="rightshow">SMS Only</div>
                    <?php } ?>
                    <?php if ($ads['no_witheld'] == 'Y') { ?>
                        <div id="leftshow">&nbsp;</div> <div id="rightshow">No witheld numbers</div>
                    <?php } ?>
                    <div id="leftshow">My website:</div>
                    <?php if ($ads['website']) { ?>
                        <div id="rightshow"><?= $ads['website'] ?></div>
                    <?php } else { ?>
                        <div id="rightshow">N/A</div>
                    <?php } ?>
                    <div id="leftshow">E-mail:</div>
                    <?php if ($ads['email']) { ?>
                        <div id="rightshow"><a href="mailto:<?= $ads['email'] ?>"><?= $ads['email'] ?></a></div>
                    <?php } else { ?>
                        <div id="rightshow">N/A</div>
                    <?php } ?>
                    <div id="leftshow">Applications:</div>
                    <?php if ($ads['whatsapp'] || $ads['viber'] || $ads['line'] || $ads['wechat'] || $ads['skype']) { ?>
                        <div id="rightshow">
                        <?php if ($ads['whatsapp'] == 'Y') { ?>
                            &nbsp;<img id="socialimg" src="../../img/social/whatsapp.png" alt="Escort <?= $ads['working_country'] ?>, Escort <?= $ads['working_city1'] ?>" title="WhatsApp">
                        <?php } ?>
                        <?php if ($ads['viber'] == 'Y') { ?>
                            &nbsp;<img id="socialimg" src="../../img/social/viber.png" alt="Escort <?= $ads['working_country'] ?>, Escort <?= $ads['working_city1'] ?>" title="Viber">
                        <?php } ?>
                        <?php if ($ads['line'] == 'Y') { ?>
                            &nbsp;<img id="socialimg" src="../../img/social/line.png" alt="Escort <?= $ads['working_country'] ?>, Escort <?= $ads['working_city1'] ?>" title="Line">
                        <?php } ?>
                        <?php if ($ads['wechat'] == 'Y') { ?>
                            &nbsp;<img id="socialimg" src="../../img/social/wechat.png" alt="Escort <?= $ads['working_country'] ?>, Escort <?= $ads['working_city1'] ?>" title="WeCHAT">
                        <?php } ?>
                        <?php if ($ads['skype']) { ?>
                            &nbsp;<img id="socialimg" src="../../img/social/skype.png" alt="Escort <?= $ads['working_country'] ?>, Escort <?= $ads['working_city1'] ?>" title="<?= $ads['skype'] ?>">
                        <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div id="rightshow">N/A</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>