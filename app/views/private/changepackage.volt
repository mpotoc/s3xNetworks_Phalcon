{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">
        {{ form('class': 'form-search', 'id': 'outside_form') }}

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
                    <h2>Assign package to another model</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My Package Details</div></div>

                {% for ad in ads %}
                    {% set mul = ad['ad_days'] %}
                    {% set a = datetosec(ad['ad_date'])+(86400*mul) %}
                    {% set t = time() %}
                    {% set ms = a - t %}
                    {% set d = fl(ms / (24*60*60)) %}
                    {% set h = fl((ms - (d*24*60*60)) / (60*60)) %}
                    {% set m = fl((ms - (d*24*60*60)-(h*60*60)) / 60) %}
                    {% set s = (ms - (d*24*60*60) - (h*60*60) - (m*60)) % 60 %}

                    {% if ad['vip'] == 'Y' %}
                        {% set av = datetosec(ad['end_vip']) %}
                        {% set msv = av - t %}
                        {% set dv = fl(msv / (24*60*60)) %}
                        {% set hv = fl((msv - (dv*24*60*60)) / (60*60)) %}
                        {% set mv = fl((msv - (dv*24*60*60)-(hv*60*60)) / 60) %}
                        {% set sv = (msv - (dv*24*60*60) - (hv*60*60) - (mv*60)) % 60 %}
                    {% endif %}

                    <div class="profile1">
                        <div class="profile8" style="font-size: 15px; text-align: center;">
                            {% if ad['packages_id'] == 1 or ad['packages_id'] == 2 %}
                                <img src="../../img/packages/diamond-s.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }} - {{ ad['showname'] }}" />
                            {% elseif ad['packages_id'] == 3 or ad['packages_id'] == 4 %}
                                <img src="../../img/packages/gold-s.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }} - {{ ad['showname'] }}" />
                            {% elseif ad['packages_id'] == 5 or ad['packages_id'] == 6 %}
                                <img src="../../img/packages/silver-s.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }} - {{ ad['showname'] }}" />
                            {% endif %}
                        </div>
                        <div class="profile9" style="font-size: 15px;">
                            <b style="color: #2d2d2d;">will expire in:</b>
                            <b style="color: #ff2211;">{{ d }} days {{ h }} H {{ m }} min {{ s }} sec </b>
                            <b style="color: #2d2d2d;">
                                <i class="glyphicon glyphicon-arrow-right" style="font-size: 12px;"></i>
                                Currently assigned to model {{ ad['showname'] }}-{{ ad['id'] }}
                            </b>
                        </div>
                    </div>
                    <br/><br/>
                    {% if ad['vip'] == 'Y' %}
                        {% if msv > 0 %}
                        <div class="profile1">
                            <div class="profile8" style="font-size: 15px; text-align: center;">
                                <img src="../../img/packages/vip.png" alt="Escort {{ ad['working_country'] }}, Escort {{ ad['working_city1'] }}" title="Escort {{ ad['working_country'] }} - {{ ad['showname'] }}" />
                            </div>
                            <div class="profile9" style="font-size: 15px;">
                                <b style="color: #2d2d2d;">will expire in:</b>
                                <b style="color: #ff2211;">{{ dv }} days {{ hv }} H {{ mv }} min {{ sv }} sec </b>
                                <b style="color: #2d2d2d;">
                                    <i class="glyphicon glyphicon-arrow-right" style="font-size: 12px;"></i>
                                    Currently assigned to model {{ ad['showname'] }}-{{ ad['id'] }}
                                </b>
                            </div>
                        </div>
                        {% endif %}
                    {% endif %}
                {% endfor %}

                <br />
                <br />
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                All input fields marked with '<b>*</b>' are mandatory. You have to choose a new model to which this chosen package will be
                assigned when you click on '<b>Change</b>' button.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">Choose Model</div></div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('adverts') }} *</div>
                    <div class="profile3">
                        {{ form.render('adverts', ['class': 'form-control', 'data-validetta': 'required']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profilesubmit">{{ form.render('Change') }}</div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->