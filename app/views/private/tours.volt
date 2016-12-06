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
                    <h2>Set tours</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                Here you can select next tours for you, so the clients will know when you will be coming to their country/city.
                You will have to change your ads "Working Country" and/or "Working City" in "Edit" profile section so that your
                ad will appear in that country/city when you want. When you are finished please click "Set tour" to save your tour.
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">New tour</div></div>

                <input type="hidden" name="hidden_sel" id="hidden_sel" value="2">

                <div class="profile1">
                    <div class="profile2"><label for="from">Start date: *</label></div>
                    <div class="profile4">
                        <input type="text" id="from" name="from" class="form-control" data-validetta="required">
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><label for="to">End date: *</label></div>
                    <div class="profile4">
                        <input type="text" id="to" name="to" class="form-control" data-validetta="required">
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('working_country') }} *</div>
                    <div class="profile3">
                        {{ form.render('working_country', ['class': 'form-control', 'data-validetta': 'required']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('working_city') }} <br/>(Double click to add city to "Next tour:")</div>
                    <div class="profile4">
                        {{ form.render('working_city', ['class': 'form-control', 'size': 10]) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('working_city_sel1') }} * <br/>(Double click to remove city)</div>
                    <div class="profile4">
                        {{ form.render('working_city_sel1', ['name': 'working_city_sel1[]', 'class': 'form-control', 'multiple': 'multiple', 'size': 10, 'data-validetta': 'required,minSelected[1],maxSelected[1]']) }}
                    </div>
                </div>

                <br />

                <div class="profile1">
                    <div class="profilesubmit">{{ form.render('Set tour', ['onclick': 'selectCities();']) }}</div>
                </div>
            </div>

            </form>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My tours</div></div>

                {% for tour in t %}
                {% if loop.first %}
                <div id="tours">
                    <div id="t1">Country</div>
                    <div id="t1">City</div>
                    <div id="t3">Start date</div>
                    <div id="t3">End date</div>
                    <div id="t2"></div>
                </div>
                {% endif %}
                <div id="tours">
                    <div id="t1">{{ tour.country }}</div>
                    <div id="t1">{{ tour.city }}</div>
                    <div id="t3">{{ date("d/m/Y", datetosec(tour.datestart)) }}</div>
                    <div id="t3">{{ date("d/m/Y", datetosec(tour.dateend)) }}</div>
                    <div id="t2"><a href="../../private/delete/{{ tour.id }}-tours-{{ mname }}-{{ mid }}"><i class="glyphicon glyphicon-remove-circle" style="color: red;" title="Delete"></i></a></div>
                </div>
                {% endfor %}
            </div>

        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->