{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selection">
        <div id="city1">
            <div id="choose2">
                <a href="{{ url.getBaseUri() }}">Home</a> &nbsp;<i class="glyphicon glyphicon-arrow-right"></i>&nbsp; Escorts in {{ city }}
            </div>
        </div>
    </div>
    <div id="citysection">
        {{ city }} escorts
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
                    <input type="hidden" value="{{ city }}" id="publicCity" />
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
                {% if f == 1 or f == 4 or f == 7 or f == 21 %}
                    {% if today < end_date %}
                        <div id="pid{{ ad['id'] }}" class="col-xs-4 babes-item">
                            <h4>{{ ad['showname'] }}</h4>
                            <a href="../escort/{{ ad['showname'] }}-{{ ad['id'] }}">
                                <div class="imgcontainer">
                                    <img id="id{{ ad['id'] }}" src="../../files/id{{ ad['id'] }}/{{ ad['path'] }}" class="thumb2" first="files/id{{ ad['id'] }}/{{ ad['path'] }}" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['showname'] }}">
                                    {% if f == 1 %}
                                        <img class="imgoverlay1" src="../../img/packages/diamond.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                    {% elseif f == 4 %}
                                        <img class="imgoverlay1" src="../../img/packages/gold.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                    {% elseif f == 7 %}
                                        <img class="imgoverlay1" src="../../img/packages/silver.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                    {% endif %}
                                    {% if ad['vip'] == 'Y' %}
                                        {% if today < end_vip %}
                                            <img class="imgoverlay2" src="../../img/packages/vip.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                        {% endif %}
                                    {% endif %}
                                    {% if ad['verified'] == 'Y' %}
                                        <img class="imgoverlay3" src="../../img/packages/verified.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                    {% endif %}
                                    {% if today_new < new_date %}
                                        <img class="imgoverlay4" src="../../img/packages/new.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }}">
                                    {% endif %}
                                </div>
                            </a>
                            <div class="portfolio-caption">
                                <p class="text-muted">
                                    Escort {{ ad['working_city1'] }}&nbsp;&nbsp;
                                    {% if ad['cnt'] > 0 %}
                                        <i class="glyphicon glyphicon-comment"></i>({{ ad['cnt'] }})
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