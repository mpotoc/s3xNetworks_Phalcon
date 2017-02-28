<!-- START TOP MENU -->
<div id="container">
  <section id="menubar">
    <a href="{{ url.getBaseUri() }}"><img id="logo-main" src="../../img/{{ mainLogo }}.png" alt="Escort {{ wcountry }}"  title="{{ mainTitle }}" /></a>
    <!--<a href="https://www.facebook.com/s3xnetworks" target="_blank"><img id="fb1" src="../../img/social/fb.png" title="Facebook" /></a>
    <img id="tw1" src="../../img/social/twitter.png" title="Twitter" />-->
    <a href="https://vk.com/s3xnetworks" target="_blank"><img id="vk1" src="../../img/social/vk.png" title="https://vk.com/s3xnetworks" /></a>
    {% if not(logged_in is empty) %}
    <a href="{{ url.getBaseUri() }}logout">
      <div class="btn btn-right" data-toggle="tooltip" data-placement="bottom" title="Log Out">
        <i class="icon-signout"></i>
      </div>
    </a>
    <a href="{{ url.getBaseUri() }}{{ profileName }}">
      <div class="btn btn-right" data-toggle="tooltip" data-placement="bottom" title="Private Area">
        <i class="icon-edit"></i>
      </div>
    </a>
    {% else %}
    <div class="btn btn-right" data-html="true" data-container="body" data-toggle="popover" data-placement="bottom" title="Log In">
      <div id="tooltiplogin" data-toggle="tooltip" data-placement="bottom" title="Log In">
        <i class="icon-signin"></i>
      </div>
    </div>
    <a href="{{ url.getBaseUri() }}register">
      <div class="btn btn-right" data-toggle="tooltip" data-placement="bottom" title="Sign Up NOW!">
        <i class="icon-user"></i>
      </div>
    </a>
    {% endif %}
  </section>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div>
        <ul class="nav navbar-nav">
          <li><a class="first" href="../../escorts/new">New Escorts</a></li>
          <!--<li><a href="#">Tours</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">VIP <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Female</a></li>
              <li><a href="#">Trans</a></li>
              <li><a href="#">Male</a></li>
            </ul>
          </li>-->
          <li><a href="../../escorts/girls">Girls</a></li>
          <li><a href="../../escorts/trans">Trans</a></li>
          <li><a href="../../escorts/boys">Boys</a></li>
          <li><a href="../../sites">Our Escort Directories</a></li>
          <!--<li><a href="#">Search</a></li>
            <li><a href="#">Classified Ads</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Latest <span class="caret"></span></a>
              <ul class="dropdown-menu wider">
                <li><a href="#">Reviews</a></li>
                <li><a href="#">Comments</a></li>
                <li><a href="#">Actions</a></li>
              </ul>
            </li>
            <li><a class="last" href="#">TOP 10</a></li>-->
        </ul>
      </div>
    </div>
  </nav>
</div>
<!-- END TOP MENU -->
<!-- START CONTENT -->
<div id="about">

  {{ content() }}

  <!-- START RIGHT COLUMN -->
  <div id="right-col">
    <!--<div id="rigth-row">
      <a href="../../signup"><img src="../../img/signup.png" /></a>
    </div>
    <br />
    <div id="right-row">
      <a href="../../bonus"><img src="../../img/bonus.png" alt="Escort {{ wcountry }}"  title="Escort {{ wcountry }}" /></a>
    </div>
    <br />-->
    <a href="../../register"><img src="../../img/freepackage.png" alt="Escort {{ wcountry }}"  title="Escort {{ wcountry }}" /></a>
    <br />
    <div id="right-row2">
      <a href="http://www.girlsfromparadise.com" target="_blank">
        <img src="../../img/gfp_468.jpeg" width="288" alt="Escort {{ wcountry }}"  title="Escort {{ wcountry }}" />
      </a>
    </div>
    <!– Begin Kelly London Escort code –>
    <div id="right-row2">
        <a href="http://www.kellylondonescort.com/" target="_blank">
          <img src="../../img/kelly_london_escort_468_60.jpg"  alt="Escort {{ wcountry }}"  title="Escort {{ wcountry }}" width="288">
        </a>
      </p>
    </div>
    <!– End Kelly London Escort code –>
    {% for s in sites %}
      <div id="right-row2">
        <a href="{{ s['www'] }}" target="_blank"><img src="{{ s['image'] }}" height="30" alt="Escort {{ wcountry }}" /></a>
      </div>
    {% endfor %}
  </div>
  <!-- END RIGHT COLUMN -->

</div>
<!-- END CONTENT -->

<!-- START FOOTER -->
<div id="footer">
  <div id="wrapperf">
    <a class="first" href="../../escorts/new">New Escorts</a> | <a href="../../escorts/girls">Girls</a> | <a href="../../escorts/trans">Trans</a> | <a href="../../escorts/boys">Boys</a> | <a href="../../faq">FAQ</a> | <a href="../../terms">Terms and Conditions</a> | <a href="../../contact">Contact</a><br />
    <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a> &copy; 2016<br /> All escorts were 18 or older at the time of depiction.
  </div>
  <div id="right-colf"></div>
</div>
<!-- END FOOTER -->