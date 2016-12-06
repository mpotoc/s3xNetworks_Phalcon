{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">

        <div class="inside-forms">

            <div id="sgnup1">
                <div id="sgnupb">
                    <a href="../member">
                        <button type="button" class="myButton4" title="Private Area">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </button>
                    </a>
                </div>
                <div id="sgnupa">
                    <h2>Private messages</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                Here you can write private messages to paid models.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My messages</div></div>

                {% for product in page %}
                    {% if loop.first %}
                        <div id="support">
                            <div id="supp1">TO/FROM</div>
                            <div id="supp2">MESSAGE</div>
                            <div id="supp1">DATE</div>
                        </div>
                    {% endif %}
                    <div id="supportm">
                        <div id="support1">
                            <div id="supp3">{{ product['showname'] }}</div>
                            <div id="supp4">{{ product['message'] }}</div>
                            <div id="supp3r">{{ product['date'] }}</div>
                        </div>
                    </div>
                    {% if loop.last %}
                        <!--<div id="support">
                    <div id="supp5">
                        {{ link_to("products/search", '<i class="icon-fast-backward"></i> First', "class": "sbtn") }}
                        {{ link_to("products/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "sbtn") }}
                        {{ link_to("products/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "sbtn") }}
                        {{ link_to("products/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "sbtn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                    </div>
                </div>-->
                    {% endif %}
                {% else %}
                    <div id="support">
                        <div id="supp5">No messages</div>
                    </div>
                {% endfor %}
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 130px;"><div id="shownameid2">Send private message</div></div>

                <div class="escorts2">

                    {{ form('class': 'form-search') }}

                    <div class="signin">

                        <div class="five">
                            <div class="six" style="font-weight: bold;">{{ form.label('ad') }}</div>
                            <div class="seven">
                                {{ form.render('ad', ['class': 'form-control']) }}
                            </div>
                        </div>
                        <div class="five">
                            <div class="six" style="font-weight: bold;">{{ form.label('message') }}</div>
                            <div class="seven">
                                {{ form.render('message', ['class': 'form-control', 'rows': '5']) }}
                            </div>
                        </div>

                        <div class="eight" style="padding-left: 330px;">
                            <div class="ten">{{ form.render('Submit') }}</div>
                        </div>

                    </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->