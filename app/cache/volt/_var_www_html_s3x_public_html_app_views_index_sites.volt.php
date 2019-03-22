<?= $this->getContent() ?>

<?= $this->flash->output() ?>

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selection">
        <div id="indexmain">
            <div id="indextop">
                <div id="indexheader">
                    OUR ESCORT DIRECTORIES
                </div>
            </div>
            <?php foreach ($oursites as $o) { ?>
            <div id="indexcontentsites">
                <a href="<?= $o['www'] ?>" target="_blank"><img src="<?= $o['image'] ?>" alt="Escort <?= $wcountry ?>" /></a>
            </div>
            <?php } ?>
            <br />
        </div>
    </div>
</div>