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
                    <h2>Support</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                Here you can write support tickets if something is not working or you have some questions to our team.
                We will respond to your ticket ASAP from 8 to 18 CET, not in work time and on weekends we will respond in max 12h.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My tickets</div></div>

                {% for product in page.items %}
                    {% if loop.first %}
                        <div id="support">
                            <div id="supp1">SUBJECT</div>
                            <div id="supp2">MESSAGE</div>
                            <div id="supp1">DATE</div>
                            <div id="supp1a"></div>
                        </div>
                    {% endif %}
                    <div id="supportm">
                        <div id="support1">
                            <div id="supp3">{{ product.subject }}</div>
                            <div id="supp4">{{ product.message }}</div>
                            <div id="supp3r">{{ product.date }}</div>
                            <div id="supp3a"><a href="../../member/delete/{{ product.id }}-support"><i class="glyphicon glyphicon-remove-circle" style="color: red;" title="Delete"></i></a></div>
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
                        <div id="supp5">No support tickets are recorded</div>
                    </div>
                {% endfor %}
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 130px;"><div id="shownameid2">Send support ticket</div></div>

                <div class="escorts2">

                    {{ form('class': 'form-search', 'id': 'outside_form') }}

                    <div class="signin">

                        <div class="five">
                            <div class="six" style="font-weight: bold;">{{ form.label('subject') }} *</div>
                            <div class="seven">
                                {{ form.render('subject', ['class': 'form-control', 'data-validetta': 'required']) }}
                            </div>
                        </div>
                        <div class="five">
                            <div class="six" style="font-weight: bold;">{{ form.label('message') }} *</div>
                            <div class="seven">
                                {{ form.render('message', ['class': 'form-control', 'rows': '5', 'data-validetta': 'required']) }}
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