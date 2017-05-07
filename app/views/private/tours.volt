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
                    <div class="profile2"><label for="from">From (hour): *</label></div>
                    <div class="profile4">
                        <select name="fromH" class="form-control" data-validetta="required">
                            <option value="0">00:00</option>
                            <option value="1">01:00</option>
                            <option value="2">02:00</option>
                            <option value="3">03:00</option>
                            <option value="4">04:00</option>
                            <option value="5">05:00</option>
                            <option value="6">06:00</option>
                            <option value="7">07:00</option>
                            <option value="8">08:00</option>
                            <option value="9">09:00</option>
                            <option value="10">10:00</option>
                            <option value="11">11:00</option>
                            <option value="12">12:00</option>
                            <option value="13">13:00</option>
                            <option value="14">14:00</option>
                            <option value="15">15:00</option>
                            <option value="16">16:00</option>
                            <option value="17">17:00</option>
                            <option value="18">18:00</option>
                            <option value="19">19:00</option>
                            <option value="20">20:00</option>
                            <option value="21">21:00</option>
                            <option value="22">22:00</option>
                            <option value="23">23:00</option>
                        </select>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5"><label for="to">To (hour): *</label></div>
                    <div class="profile4">
                        <select name="toH" class="form-control" data-validetta="required">
                            <option value="0">00:00</option>
                            <option value="1">01:00</option>
                            <option value="2">02:00</option>
                            <option value="3">03:00</option>
                            <option value="4">04:00</option>
                            <option value="5">05:00</option>
                            <option value="6">06:00</option>
                            <option value="7">07:00</option>
                            <option value="8">08:00</option>
                            <option value="9">09:00</option>
                            <option value="10">10:00</option>
                            <option value="11">11:00</option>
                            <option value="12">12:00</option>
                            <option value="13">13:00</option>
                            <option value="14">14:00</option>
                            <option value="15">15:00</option>
                            <option value="16">16:00</option>
                            <option value="17">17:00</option>
                            <option value="18">18:00</option>
                            <option value="19">19:00</option>
                            <option value="20">20:00</option>
                            <option value="21">21:00</option>
                            <option value="22">22:00</option>
                            <option value="23">23:00</option>
                        </select>
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
                    <div id="t3">Start</div>
                    <div id="t3">End</div>
                    <div id="t2"></div>
                </div>
                {% endif %}
                <div id="tours">
                    <div id="t1">{{ tour.country }}</div>
                    <div id="t1">{{ tour.city }}</div>
                    <div id="t3">{{ date("d/m/Y", datetosec(tour.datestart)) }} {{ tour.fromHour }}</div>
                    <div id="t3">{{ date("d/m/Y", datetosec(tour.dateend)) }} {{ tour.toHour }}</div>
                    <div id="t2"><a href="../../private/delete/{{ tour.id }}-tours-{{ mname }}-{{ mid }}"><i class="glyphicon glyphicon-remove-circle" style="color: red;" title="Delete"></i></a></div>
                </div>
                {% endfor %}
            </div>

        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->