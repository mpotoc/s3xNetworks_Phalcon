<?= $this->getContent() ?>

<?= $this->flash->output() ?>

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">

        <div class="inside-forms">

            <div id="sgnup1">
                <div id="sgnupb">
                    <a href="../../private/managemodels">
                        <button type="button" class="myButton4" title="Private Area">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </button>
                    </a>
                </div>
                <div id="sgnupa">
                    <h2>Gallery | <span id="modelgal">Model - <?= $ads->showname ?></span></h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                Please upload at least one photo to activate your model profile. Without photos you can not set your advertisement and before
                you do not upload at least one photo your 180 days FREE package will not be activated and list your new model profile online.
                <br /><br />
                Please upload photo in <b>jpg/jpeg, gif, png or bmp format</b>. The photos must be minimum <b>600x400</b> px. Landscape photos
                are not allowed, only portrait photos. When you are done with gallery click on button '<b>FINISH</b>'.
                Main photo is the first uploaded photo.<br /><br />
                If you have difficulties uploading photos from your Android/IPhone/WindowsPhone device, this is because your device is making all
                photos in landscape format, instead of portrait. Please either set your device to do portrait photos or crop your photos on the
                device to be portrait oriented. And then you can upload them with no problems. Max file size is 20MB.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Upload photos</div></div>

                <div id="uploads" style="padding-bottom: 20px !important;">
                    <form action='<?= $ads->showname ?>-<?= $ads->id ?>' method='post' enctype='multipart/form-data'>
                        <div class="profile1">
                            <div class="profile6">Photo 1:</div>
                            <div class="profile7">
                                <input class="form-control1" type='file' name='files[]'>
                            </div>
                        </div>

                        <div class="profile1">
                            <div class="profile6">Photo 2:</div>
                            <div class="profile7">
                                <input class="form-control1" type='file' name='files[]'>
                            </div>
                        </div>

                        <div class="profile1">
                            <div class="profile6">Photo 3:</div>
                            <div class="profile7">
                                <input class="form-control1" type='file' name='files[]'>
                            </div>
                        </div>

                        <div class="profile1">
                            <div class="profile6">Photo 4:</div>
                            <div class="profile7">
                                <input class="form-control1" type='file' name='files[]'>
                            </div>
                        </div>

                        <div class="profile1">
                            <div class="profilesubmit" style="text-align: left !important;">
                                <input value="Upload" class="myButton3" type="submit">&nbsp;&nbsp;
                                <a href="../../private/managemodels">
                                    <button type="button" class="myButton3" title="Finish">
                                        Finish
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My Gallery</div></div>
                <div id="escorts2">
                <?php foreach ($ads->gallery as $g) { ?>
                    <div id="gallerybox">
                        <div id="pid<?= $g->ad_id ?>">
                            <div>
                                <img id="id<?= $g->ad_id ?>" src="../../files/id<?= $g->ad_id ?>/<?= $g->path ?>" alt="Escort <?= $ads->working_country ?>, Escort <?= $ads->working_city1 ?>" title="Escort <?= $ads->working_country ?> - <?= $ads->showname ?>" class="thumbd">
                            </div>
                        </div>
                        <div id="galbuttons">
                            <a href="../deletegallery/<?= $g->path ?>-<?= $g->id ?>-<?= $g->ad_id ?>-<?= $ads->showname ?>">
                                <?php if ($c > 1) { ?>
                                <button type="button" class="myButton4" title="Delete">
                                    Delete
                                </button>
                                <?php } ?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->