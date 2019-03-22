<?= $this->getContent() ?>

<?= $this->flash->output() ?>

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selection">
        <div id="indexmain">
            <div id="indextop">
                <div id="indexheader">
                    FAQ
                </div>
            </div>
            <div id="indexcontent">
                <b style="color: #f24437 !important;">1. Our advanced bonus system</b>
                <br />
                We offer a range of bonuses for all registered members. <b>Everyone</b> is eligible to get a bonus on her/his deposit. Bonuses
                range from <b>25%</b> to <b>200%</b> of the deposited sum. That means you can get 1.25 times to 3 times more then you deposited to buy
                ad space on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>. <br /><br />

                <b style="color: #f24437 !important;">2. Bonuses in numbers</b>
                <br />
                When you want to buy packages <b>(diamond, gold, silver, vip)</b> on
                <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a> you must first buy s3xcoin package and
                then with this s3xcoins <b>(1 s3xcoin = 1 eur)</b> you buy a desired package for desired length.<br /><br /> Available s3xcoin packages are:
                <b>20 EUR / 25% bonus;</b> <b>50 EUR / 50% bonus;</b> <b>100 EUR / 100% bonus;</b> <b>150 EUR / 125% bonus;</b>
                <b>200 EUR / 150% bonus;</b> <b>250 EUR / 200% bonus;</b> <br /><br />
                Which means that if you for instance buy <b>s3xcoin package</b> for <b>100 EUR</b> you get <b>175 s3xcoins</b> to your account or if you buy
                the biggest package for <b>250 EUR</b> you get <b>750 s3xcoins</b> credited to your account. <br /><br/>
                <b>1 EUR = 1 s3xcoin on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>.</b><br/><br/>

                <b style="color: #f24437 !important;">3. Packages</b>
                <br />
                We offer 4 different main packages on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>: <br /><br/>
                <b>Diamond package</b> -> this is the package for top positions on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>. You
                can choose for how long you want to buy this package. Options are 1,3,5,10,15,30 or 90 days. Your ad will be among top listings
                on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>. The price for this package varies depending on the days you select. From
                10 s3xcoins (10 EUR) for 1 day to 140 s3xcoins (140 EUR) for 90 days.<br/>
                If you buy this package you will get 20% returned as s3xcoins and credited them back to your s3xcoins account.<br/><br/>

                <b>Gold package</b> -> this is the package after <b>Diamond</b> positions on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>.
                You can choose for how long you want to buy this package. Options are 3,10,15,30 or 90. Your ad will be listed after <b>Diamond</b>
                listings on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>. The price for this package varies depending on the days you
                select. From 10 s3xcoins (10 EUR) for 3 days to 100 s3xcoins (100 EUR) for 90 days.<br/>
                If you buy this package you will get 10% returned as s3xcoins and credited them back to your s3xcoins account.<br/><br/>

                <b>Silver package</b> -> this is the package after <b>Gold</b> positions on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>.
                You can choose for how long you want to buy this package. Options are 10,30 or 90 days. Your ad will be listed after <b>Gold</b> listings on
                <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>. The price for this package varies depending on the days you
                select. From 20 s3xcoins (20 EUR) for 10 days to 80 s3xcoins (80 EUR) for 90 days.<br/>
                If you buy this package you will get 5% returned as s3xcoins and credited them back to your s3xcoins account.<br/><br/>

                <b>FREE package</b> -> this is the package after <b>Silver</b> positions on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>.
                You can get this package for 7 days. After 6 days you can extend this package for further 7 days. You can extend this package for as long
                as you want. Your ad will be listed after <b>Silver</b> listings on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>. The price
                for this package is FREE.<br/><br/>

                Each package can be <b>extended</b> on the <b>last valid day</b> of the package, including FREE package. So please pay close attention on when
                your package will end, to be able to extend it, so that your ad will be visible at all times. You can extend each package with it's predefined
                options.<br/><br/>

                Further we offer additional packages that must be placed on top of one of the main packages on
                <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>: <br/><br/>
                <b>VIP</b> -> this package will put your listing to the top of the <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>
                if your listing had <b>Diamond</b> package, otherwise it will put you to the top of the listings of your package on
                <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>. <b>VIP</b> costs <b>5 s3xcoins (5 EUR)</b> per day.<br/><br/>

                <!--<b>Boosts</b> -> this package will boost your listing to the top of your paid package listings on
                <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>, either 1x, 2x or 3x that day you buy it. Your listing will be on top
                of your paid package listings as long as others do not do the same after you. The price for this package is <b>5 s3xcoins (5 EUR)</b>
                for one time boost on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>.<br/><br/>

                <b>Girl of the day</b> -> this package will give your listing special status and it will be put on top of all listings on
                <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a>. This package is available only for <b>3 days</b> per purchase of this
                package. The cost of this package is <b>50 s3xcoins (50 EUR)</b> and it is not important what type of package you have bought for your
                listing on <a href="<?= $this->url->getBaseUri() ?>">www.<?= $mainLogo ?>.com</a><br/><br/>-->
            </div>
            <br />
        </div>
    </div>
</div>