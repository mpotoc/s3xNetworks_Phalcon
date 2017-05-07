{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selection">
        <div id="escortright">
            <!--<div id="mygallery">
                <div id="gal">
                    My Gallery
                </div>
                {% if ads['verified'] == 'Y' %}
                <div id="verify">
                    100% VERIFIED
                </div>
                {% endif %}
            </div>-->
            <div id="escortleft">
                <div class="customNavigation">
                    <a class="prev"> <</a>
                    <a class="next"> > </a>
                </div>
                <div id="owl-demo" class="owl-carousel owl-theme">
                {% set i = 0 %}
                {% for g in gal %}
                    <div class="item"><img id="escortsimg" src="../../files/id{{ g.ad_id }}/{{ g.path }}" alt="Escort {{ ads['working_country'] }}, Escort {{ ads['working_city1'] }}" title="Escort {{ ads['showname'] }}"></div>
                    {% set i = i + 1 %}
                {% endfor %}
                </div>
                <div class="escort_likes"><i class="glyphicon glyphicon-heart" title="likes"></i> ({{ likes }})</div>
            </div>
            <div id="comments">
                {% if not(logged_in is empty) %}
                <button id="testbtn" type="button" class="myButton2a" data-toggle="modal" data-id="{{ ads['id'] }}" data-name="{{ ads['showname'] }}" data-target="#commentModal" title="Write comment">
                    <i class="glyphicon glyphicon-comment"></i> Write Comment
                </button>
                {% else %}
                    <button id="testbtn" type="button" class="myButton2a" title="Write comment">
                        <i class="glyphicon glyphicon-comment"></i> Post Comment
                    </button>
                {% endif %}
                <a href="../like/{{ ads['showname'] }}-{{ ads['id'] }}">
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
            {% if not(logged_in is empty) %}
                {% for com in comments %}
                    <div class="div1">
                    <div id="show-comments-user">&nbsp;{{ com['name'] }} wrote:</div>
                    <div id="show-comments-text">{{ com['comment'] }}</div>
                    </div>
                {% endfor %}
            {% else %}
                <div id="show-comments-text">
                    You have to be logged in to read and post comments! Please <a href="../../login">login</a> or <a href="../../register">register</a>.
                </div>
            {% endif %}
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

                {% if ads['vip'] == 'Y' %}
                    {% set today = date("Y-m-d H:i:s", time()) %}
                    {% set end_vip = ads['end_vip'] %}
                {% endif %}
                {% if ads['packages_id'] == 1 or ads['packages_id'] == 2 %}
                    {% set var_package = 'diamond' %}
                {% elseif ads['packages_id'] == 3 or ads['packages_id'] == 4 %}
                    {% set var_package = 'gold' %}
                {% elseif ads['packages_id'] == 5 or ads['packages_id'] == 6 %}
                    {% set var_package = 'silver' %}
                {% elseif ads['packages_id'] == 7 %}
                    {% set var_package = 'FREE' %}
                {% endif %}
                {% if var_package == 'FREE' %}
                    <div id="showpackage1"><b style="color: #00247d !important;">FREE</b></div>
                {% else %}
                    <div id="showpackage1"><img src="../../../public/img/packages/{{ var_package }}-s.png" alt="Escort {{ ads['working_country'] }}, Escort {{ ads['working_city1'] }}" title="Escort {{ ads['working_country'] }}" /></div>
                {% endif %}
                {% if ads['vip'] == 'Y' %}
                    {% if today < end_vip %}
                        <div id="showpackage"><img src="../../../public/img/packages/vip.png" alt="Escort {{ ads['working_country'] }}, Escort {{ ads['working_city1'] }}" title="Escort {{ ads['working_country'] }}" /></div>
                    {% endif %}
                {% endif %}

            <div id="escortinfo">
                <div id="showviews">Total views: {{ counter }}</div>

                <div id="escort-div">
                    <p id="shownameid">
                        &nbsp;{{ ads['showname'] }}
                    </p>
                    {% if ads['slogan'] %}
                        <div id="leftshow_top">Slogan:</div><div id="rightshow_top">{{ ads['slogan'] }}</div>
                    {% else %}
                        <div id="leftshow_top">Slogan:</div> <div id="rightshow_top">N/A</div>
                    {% endif %}
                    {% if ads['gender'] == "F" %}
                        {% set var_gender = 'Female' %}
                    {% elseif ads['gender'] == "M" %}
                        {% set var_gender = 'Male' %}
                    {% elseif ads['gender'] == "T" %}
                        {% set var_gender = 'Transsexual' %}
                    {% endif %}
                    <div id="leftshow_top">Gender:</div><div id="rightshow_top">{{ var_gender }}</div>
                    {% if ads['age'] %}
                        <div id="leftshow_top">Age:</div> <div id="rightshow_top">{{ ads['age'] }}</div>
                    {% endif %}
                    {% if ads['ethnicity'] %}
                        <div id="leftshow_top">Ethnicity:</div> <div id="rightshow_top">{{ ads['ethnicity'] }}</div>
                    {% else %}
                        <div id="leftshow_top">Ethnicity:</div> <div id="rightshow_top">N/A</div>
                    {% endif %}
                    {% if ads['nationality'] %}
                        <div id="leftshow_top">Nationality:</div> <div id="rightshow_top">{{ ads['nationality'] }}</div>
                    {% else %}
                        <div id="leftshow_top">Nationality:</div> <div id="rightshow_top">N/A</div>
                    {% endif %}
                    {% if ads['home_country'] %}
                        <div id="leftshow_top">From:</div> <div id="rightshow_top">{{ ads['home_country'] }}</div>
                    {% else %}
                        <div id="leftshow_top">From:</div> <div id="rightshow_top">N/A</div>
                    {% endif %}
                    {% if ads['hairstyle'] %}
                        <div id="leftshow_top">Hair:</div> <div id="rightshow_top">{{ ads['hairstyle'] }}</div>
                    {% else %}
                        <div id="leftshow_top">Hair:</div> <div id="rightshow_top">N/A</div>
                    {% endif %}
                    {% if ads['eyes'] %}
                        <div id="leftshow_top">Eyes:</div> <div id="rightshow_top">{{ ads['eyes'] }}</div>
                    {% else %}
                        <div id="leftshow_top">Eyes:</div> <div id="rightshow_top">N/A</div>
                    {% endif %}
                    {% if ads['measurement'] %}
                        <div id="leftshow_top">Measurements:</div> <div id="rightshow_top">{{ ads['measurement'] }}</div>
                    {% else %}
                        <div id="leftshow_top">Measurements:</div> <div id="rightshow_top">N/A</div>
                    {% endif %}
                    <div id="leftshow_top">Orientation:</div>
                    {% if ads['orientation'] == "B" %}
                        <div id="rightshow_top">Bisexual</div>
                    {% elseif ads['orientation'] == "S" %}
                        <div id="rightshow_top">Heterosexual</div>
                    {% elseif ads['orientation'] == "H" %}
                        <div id="rightshow_top">Homosexual</div>
                    {% else %}
                        <div id="rightshow_top">N/A</div>
                    {% endif %}
                </div>
                <div id="escort-div">
                    {% if ads['phone'] %}
                        <div id="show_phone" class="phone_call">{{ ads['phone'] }}</div>
                    {% endif %}
                </div>
                <div id="escort-div">
                    {% if ads['about_me'] %}
                        <div id="rightshow2">{{ ads['about_me'] }}</div>
                    {% endif %}
                    {% if ads['services'] %}
                        <div id="rightshow4">{{ ads['services'] }}</div>
                    {% endif %}
                    {% if ads['languages'] %}
                        <div id="rightshow2">{{ ads['languages'] }}</div>
                    {% endif %}
                    <div id="leftshow_price">30 minutes:</div><div id="rightshow_price">1 hour:</div>
                    <div id="leftshow_price" class="phone_call1">{{ ads['price1'] }}</div>
                    <div id="rightshow_price" class="phone_call1">{{ ads['price2'] }}</div>
                    <div id="leftshow_price">2 hours:</div><div id="rightshow_price">Night:</div>
                    {% if ads['price3'] %}
                        <div id="leftshow_price" class="phone_call1">{{ ads['price3'] }}</div>
                    {% else %}
                        <div id="leftshow_price" class="phone_call1">N/A</div>
                    {% endif %}
                    {% if ads['price4'] %}
                        <div id="rightshow_price" class="phone_call1">{{ ads['price4'] }}</div>
                    {% else %}
                        <div id="rightshow_price" class="phone_call1">N/A</div>
                    {% endif %}
                </div>
                <div id="escort-div">
                    <div id="leftshow">Working time:</div>
                    {% if ads['working_time'] %}
                        <div id="rightshow" class="phone_call2">{{ ads['working_time'] }}</div>
                    {% else %}
                        <div id="rightshow" class="phone_call2">N/A</div>
                    {% endif %}
                    <div id="leftshow">Current country:</div>
                    {% if ads['working_country'] %}
                        <div id="rightshow" class="phone_call2">{{ ads['working_country'] }}</div>
                    {% endif %}
                    <div id="leftshow">Available in cities:</div>
                    {% if ads['working_city1'] %}
                        <div id="rightshow" class="phone_call2">{{ ads['working_city1'] }}</div>
                    {% endif %}
                    <div id="leftshow">&nbsp;</div>
                    {% if ads['working_city2'] %}
                        <div id="rightshow" class="phone_call2">{{ ads['working_city2'] }}</div>
                    {% else %}
                        <div id="rightshow" class="phone_call2">N/A</div>
                    {% endif %}
                    <div id="leftshow">&nbsp;</div>
                    {% if ads['working_city3'] %}
                        <div id="rightshow" class="phone_call2">{{ ads['working_city3'] }}</div>
                    {% else %}
                        <div id="rightshow" class="phone_call2">N/A</div>
                    {% endif %}
                    <div id="leftshow">&nbsp;</div>
                    {% if ads['working_city4'] %}
                        <div id="rightshow" class="phone_call2">{{ ads['working_city4'] }}</div>
                    {% else %}
                        <div id="rightshow" class="phone_call2">N/A</div>
                    {% endif %}
                </div>
                <div id="escort-div">
                    <div id="show_phone" class="phone_call3">My Tours</div>
                    {% if ct > 0 %}
                        {% for t in tours %}
                            <div id="rightshow3">
                                <table>
                                    <tr>
                                        <td id="leftshow_top">Tour start: </td>
                                        <td> {{ date("d/m/Y", datetosec(t.datestart)) }} {{ t.fromHour }}</td>
                                    </tr>
                                    <tr>
                                        <td id="leftshow_top">Tour end: </td>
                                        <td> {{ date("d/m/Y", datetosec(t.dateend)) }} {{ t.toHour }}</td>
                                    </tr>
                                    <tr>
                                        <td id="leftshow_top">Tour place: </td>
                                        <td> {{ t.country }} - {{ t.city }}</td>
                                    </tr>
                                    <tr>
                                        <td id="leftshow_top">Tour phone: </td>
                                        <td> {{ ads['phone'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        {% endfor %}
                    {% else %}
                        <div id="rightshow3">No tours selected</div>
                    {% endif %}
                </div>
                <div id="escort-div">
                    <div id="leftshow">Phone number:</div>
                    {% if ads['phone'] %}
                        <div id="rightshow">{{ ads['phone'] }}</div>
                    {% endif %}
                    <div id="leftshow">&nbsp;</div>
                    {% if ads['contact_me'] == "C" %}
                        <div id="rightshow">SMS and Call</div>
                    {% elseif ads['contact_me'] == "S" %}
                        <div id="rightshow">SMS Only</div>
                    {% endif %}
                    {% if ads['no_witheld'] == "Y" %}
                        <div id="leftshow">&nbsp;</div> <div id="rightshow">No witheld numbers</div>
                    {% endif %}
                    <div id="leftshow">My website:</div>
                    {% if ads['website'] %}
                        <div id="rightshow">{{ ads['website'] }}</div>
                    {% else %}
                        <div id="rightshow">N/A</div>
                    {% endif %}
                    <div id="leftshow">E-mail:</div>
                    {% if ads['email'] %}
                        <div id="rightshow"><a href="mailto:{{ ads['email'] }}">{{ ads['email'] }}</a></div>
                    {% else %}
                        <div id="rightshow">N/A</div>
                    {% endif %}
                    <div id="leftshow">Applications:</div>
                    {% if ads['whatsapp'] or ads['viber'] or ads['line'] or ads['wechat'] or ads['skype'] %}
                        <div id="rightshow">
                        {% if ads['whatsapp'] == "Y" %}
                            &nbsp;<img id="socialimg" src="../../img/social/whatsapp.png" alt="Escort {{ ads['working_country'] }}, Escort {{ ads['working_city1'] }}" title="WhatsApp">
                        {% endif %}
                        {% if ads['viber'] == "Y" %}
                            &nbsp;<img id="socialimg" src="../../img/social/viber.png" alt="Escort {{ ads['working_country'] }}, Escort {{ ads['working_city1'] }}" title="Viber">
                        {% endif %}
                        {% if ads['line'] == "Y" %}
                            &nbsp;<img id="socialimg" src="../../img/social/line.png" alt="Escort {{ ads['working_country'] }}, Escort {{ ads['working_city1'] }}" title="Line">
                        {% endif %}
                        {% if ads['wechat'] == "Y" %}
                            &nbsp;<img id="socialimg" src="../../img/social/wechat.png" alt="Escort {{ ads['working_country'] }}, Escort {{ ads['working_city1'] }}" title="WeCHAT">
                        {% endif %}
                        {% if ads['skype'] %}
                            &nbsp;<img id="socialimg" src="../../img/social/skype.png" alt="Escort {{ ads['working_country'] }}, Escort {{ ads['working_city1'] }}" title="{{ ads['skype'] }}">
                        {% endif %}
                        </div>
                    {% else %}
                        <div id="rightshow">N/A</div>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
</div>