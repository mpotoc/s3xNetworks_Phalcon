{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selection">
        <div id="city">
            <div id="choose">
                Hello and welcome to <a href="www.{{ mainLogo }}.com">www.{{ mainLogo }}.com</a>, No. 1 escort directory in {{ icountry }}.
            </div>
            <div style="color: #00247D; font-weight: normal; text-decoration: none;">
                We provide listings of independent escorts in <a href="{{ url.getBaseUri() }}">{{ icountry }}</a> and escort agencies in
                <a href="{{ url.getBaseUri() }}">{{ icountry }}</a> - both <a href="{{ url.getBaseUri() }}">{{ icountry }}</a> incall
                escorts and <a href="{{ url.getBaseUri() }}">{{ icountry }}</a> outcall escorts - if you are an escort agency in
                <a href="{{ url.getBaseUri() }}">{{ icountry }}</a>, <a href="{{ url.getBaseUri() }}">{{ icountry }}</a> independent escort or
                <a href="{{ url.getBaseUri() }}">{{ icountry }}</a> massage parlour and want to be featured in our
                <a href="{{ url.getBaseUri() }}">{{ icountry }}</a> escorts directory simply click on the top-right
                signup link to register and upload your escort profile to <a href="{{ url.getBaseUri() }}">www.{{ mainLogo }}.com</a>.
                This page provides only <a href="{{ url.getBaseUri() }}">{{ icountry }}</a> escort girl and services.
            </div>
        </div>
    </div>
    <div id="selection" style="margin-top: -30px;">
        <div id="city">
            <div id="choose">Choose your city:</div>
            {% for r in res %}
                <div id="cityname">
                    <div id="cityi">
                        <img id="flagescort2" src="../../img/flags/{{ strToLower(r['iso']) }}.png" alt="Escort {{ r['country'] }}, Escort {{ r['city'] }}" title="Escort {{ r['country'] }}" />
                    </div>
                    <div id="citya">
                        &nbsp;<a href="city/{{ r['city'] }}" alt="Escort {{ r['country'] }}, Escort {{ r['city'] }}" title="Escort {{ r['country'] }}">{{ r['city'] }} ({{ r['num'] }})</a>
                    </div>
                </div>
            {% endfor %}
            <div id="count_online">{{ cnt['num'] }} Escorts online</div>
        </div>
    </div>
    <div id="wrapper_filter">
        <div id="filter" style="display: none;">
            <button id="filter1" type="button" class="btn-default" data-toggle="modal" data-target="#filterModal">
                <i class="glyphicon glyphicon-filter"></i> Filters
            </button>
        </div>
        <div id="search" style="padding-left: 275px;">
            <div class="inner-addon left-addon">
                {{ form('id': 'searchform') }}
                    <i class="glyphicon glyphicon-search"></i>
                    <input type="text" class="form-control" id="InputSearchI" placeholder="search by name" />
                    <input type="hidden" value="{{ publicUrl }}" id="publicUrl" />
                    <input type="hidden" value="" id="publicCity" />
                    <input type="hidden" value="" id="publicGender" />
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
            {% for ad in ads %}
                {% set today = date("Y-m-d H:i:s", time()) %}
                {% set today_new = date("Y-m-d H:i:s", time()-(86400*3)) %}
                {% set new_date = ad['created'] %}
                {% set end_date = ad['end_date'] %}
                {% set end_vip = ad['end_vip'] %}
                {% set f = ad['packages_id'] %}
                {% if f > 0 and f < 8 %}
                    {% if today < end_date %}
                        <div id="pid{{ ad['id'] }}" class="col-xs-4 babes-item">
                            <h4>{{ ad['showname'] }}</h4>
                            <a href="escort/{{ ad['showname'] }}-{{ ad['id'] }}">
                                <div class="imgcontainer">
                                    <img id="id{{ ad['id'] }}" src="files/id{{ ad['id'] }}/{{ ad['path'] }}" class="thumb" first="files/id{{ ad['id'] }}/{{ ad['path'] }}" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['showname'] }}">
                                    {% if f == 1 or f == 2 %}
                                    <img class="imgoverlay1" src="img/packages/diamond.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                    {% elseif f == 3 or f == 4 %}
                                    <img class="imgoverlay1" src="img/packages/gold.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                    {% elseif f == 5 or f == 6 %}
                                    <img class="imgoverlay1" src="img/packages/silver.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                    {% endif %}
                                    {% if ad['vip'] == 'Y' %}
                                        {% if today < end_vip %}
                                            <img class="imgoverlay2" src="img/packages/vip.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                        {% endif %}
                                    {% endif %}
                                    {% if ad['verified'] == 'Y' %}
                                        <img class="imgoverlay3" src="img/packages/verified.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}"
                                    {% endif %}
                                    {% if today_new < new_date %}
                                        <img class="imgoverlay4" src="img/packages/new.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                    {% endif %}
                                </div>
                            </a>
                            <div class="portfolio-caption">
                                <p class="text-muted">
                                    {% if ad['like'] > 0 %}
                                        <i class="glyphicon glyphicon-heart" title="likes" style="color: red;"></i>({{ ad['like'] }})
                                    {% endif %}
                                    &nbsp;&nbsp;Escort {{ ad['working_city1'] }}&nbsp;&nbsp;
                                    {% if ad['cnt'] > 0 %}
                                        <i class="glyphicon glyphicon-comment" title="comments" style="color: blue;"></i>({{ ad['cnt'] }})
                                    {% endif %}
                                </p>
                            </div>
                        </div>
                    {% endif %}
                {% endif %}
            {% endfor %}
        </div>
    </section>
</div>
<!-- END MASTER COLUMN -->