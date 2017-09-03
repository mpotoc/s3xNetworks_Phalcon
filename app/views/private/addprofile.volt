{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selectionadd">
        {{ form('class': 'form-search', 'id': 'outside_form') }}

        <div class="inside-forms">

            <div id="sgnup1">
                <div id="sgnupb">
                    <a href="../private">
                        <button type="button" class="myButton4" title="Private Area">
                            <i class="glyphicon glyphicon-arrow-left"></i> Back
                        </button>
                    </a>
                </div>
                <div id="sgnupa">
                    <h2>Add new model profile</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                All input fields marked with '<b>*</b>' are mandatory. The more information you will put in your advertisement more people will notice
                your ad and you will get more feedback. When you are finished with inputting information about yourself please click
                '<b>Save</b>' button to advance to your gallery upload. As soon as your model profile gets saved, you get 180 days of FREE package, which
                will be activated as soon as you ad at least one photo to your model profile.
            </div>

            <input type="hidden" name="hidden_sel" id="hidden_sel" value="1">

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My Biography</div></div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('showname') }} *</div>
                    <div class="profile4">
                        {{ form.render('showname', ['class': 'form-control', 'placeholder': 'e.g., Mandy', 'data-validetta': 'required,maxLength[20]']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('slogan') }}</div>
                    <div class="profile4">
                        {{ form.render('slogan', ['class': 'form-control', 'placeholder': 'e.g., GFE']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('gender') }} *</div>
                    <div class="profile4">
                        <label>Female: {{ form.render('gender', ['value': 'F', 'data-validetta': 'minChecked[1]']) }}</label>
                        <label>&nbsp;&nbsp;Male: {{ form.render('gender', ['value': 'M', 'data-validetta': 'minChecked[1]']) }}</label>
                        <label>&nbsp;&nbsp;Transsexual: {{ form.render('gender', ['value': 'T', 'data-validetta': 'minChecked[1]']) }}</label>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('age') }} *</div>
                    <div class="profile4">
                        {{ form.render('age', ['class': 'form-control', 'placeholder': 'e.g., 20', 'data-validetta': 'required,positive,age']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('ethnicity') }} *</div>
                    <div class="profile4">
                        {{ form.render('ethnicity', ['class': 'form-control', 'data-validetta': 'required']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('nationality') }}</div>
                    <div class="profile4">
                        {{ form.render('nationality', ['class': 'form-control']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('home_country') }}</div>
                    <div class="profile4">
                        {{ form.render('home_country', ['class': 'form-control']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('hairstyle') }}</div>
                    <div class="profile4">
                        {{ form.render('hairstyle', ['class': 'form-control', 'placeholder': 'e.g., long blonde']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('eyes') }}</div>
                    <div class="profile4">
                        {{ form.render('eyes', ['class': 'form-control', 'placeholder': 'e.g., blue']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('measurement') }}</div>
                    <div class="profile4">
                        {{ form.render('measurement', ['class': 'form-control', 'placeholder': 'e.g., 90-60-90']) }}
                    </div>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">About Me</div></div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('about_me') }} *</div>
                    <div class="profile3">
                        {{ form.render('about_me', ['class': 'form-control', 'rows': '6', 'placeholder': 'e.g., Description about yourself (introduction)', 'data-validetta': 'required']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('services') }} *</div>
                    <div class="profile3">
                        {{ form.render('services', ['class': 'form-control', 'rows': '4', 'placeholder': 'e.g., Description about your services (GFE, 69, ...)', 'data-validetta': 'required']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('languages') }} *</div>
                    <div class="profile3">
                        {{ form.render('languages', ['class': 'form-control', 'placeholder': 'e.g., English, Russian, French, Italian, ...', 'data-validetta': 'required']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('orientation') }}</div>
                    <div class="profile3">
                        <label>Bisexual: {{ form.render('orientation', ['value': 'B']) }}</label>
                        <label>&nbsp;&nbsp;Heterosexual: {{ form.render('orientation', ['value': 'S']) }}</label>
                        <label>&nbsp;&nbsp;Homosexual: {{ form.render('orientation', ['value': 'H']) }}</label>
                    </div>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My compensation</div></div>

                <div class="profile1">
                    Your compensation for 30 minutes and 1 hour is mandatory, for 2 hours and night is optional. But is preferred
                    to enter all, because clients like to know your full compensations. If you enter 0 or leave it as 0 after edit
                    for 2h and night it will not be visible on your ad page. If you have the need to enter more detailed compensation
                    list, you can write them in either "About me" or "Services".
                </div>

                <br/>

                <div class="profile1">
                    <div class="profile2">{{ form.label('price1') }}</div>
                    <div class="profile4">
                        {{ form.render('price1', ['class': 'form-control', 'data-validetta': 'price']) }} <!-- required,positive -->
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('price2') }}</div>
                    <div class="profile4">
                        {{ form.render('price2', ['class': 'form-control', 'data-validetta': 'price']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('price3') }}</div>
                    <div class="profile4">
                        {{ form.render('price3', ['class': 'form-control', 'data-validetta': 'price']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('price4') }}</div>
                    <div class="profile4">
                        {{ form.render('price4', ['class': 'form-control', 'data-validetta': 'price']) }}
                    </div>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My Work Place</div></div>

                <div class="profile1">
                    When you change a "Working country:" selection the "Select cities:" selection change as well to populate the select
                    box with cities from new country you selected. If you want to make a "Working cities:" selection please
                    find appropriate city from "Select cities:" and double click on the city name. Doing that you will see
                    this city appear in "Working cities:". You have to choose at least one city. If you already have
                    cities in "Working cities:" and change country in dropdown "Working country:", then your current
                    selected cities are removed. You have to add new cities. You can add MAX of 4 cities. If you want to remove a selection
                    in "Working cities:" please double click on the city you want to remove.
                    Your ad will be seen in all 4 cities. The first city in "Working cities:" is the main city for your add.
                </div>

                <br/>

                <div class="profile1">
                    <div class="profile2">{{ form.label('working_country') }} *</div>
                    <div class="profile4">
                        {{ form.render('working_country', ['class': 'form-control', 'data-validetta': 'required']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('working_time') }}</div>
                    <div class="profile4">
                        {{ form.render('working_time', ['class': 'form-control', 'placeholder': 'e.g., 24h, from 9 to 21']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('working_city') }} <br/>(Double click to add cities to "Working cities:")</div>
                    <div class="profile4">
                        {{ form.render('working_city', ['class': 'form-control', 'size': 10]) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('working_city_sel') }} * <br/>(Double click to remove cities)</div>
                    <div class="profile4">
                        {{ form.render('working_city_sel', ['name': 'working_city_sel[]', 'class': 'form-control', 'multiple': 'multiple', 'size': 10, 'data-validetta': 'required,minSelected[1],maxSelected[4]']) }}
                    </div>
                </div>
            </div>

            <div id="sgnup4">
                <div id="showid" style="padding-left: 10px;"><div id="shownameid2">My Contact</div></div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('phone') }} *</div>
                    <div class="profile4">
                        {{ form.render('phone', ['class': 'form-control', 'placeholder': 'format: +12345678999', 'data-validetta': 'required,phone']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('website') }}</div>
                    <div class="profile4">
                        {{ form.render('website', ['class': 'form-control', 'placeholder': 'e.g., http://www.mysite.com']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('contact_me') }}</div>
                    <div class="profile3">
                        <label>SMS and Call: {{ form.render('contact_me', ['value': 'C', 'data-validetta': 'minChecked[1]']) }}</label>
                        <label>&nbsp;&nbsp;SMS Only: {{ form.render('contact_me', ['value': 'S', 'data-validetta': 'minChecked[1]']) }}</label>
                        <label>{{ form.label('no_witheld') }} {{ form.render('no_witheld', ['value': 'Y']) }}</label>
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('skype') }}</div>
                    <div class="profile4">
                        {{ form.render('skype', ['class': 'form-control', 'placeholder': 'e.g., skype name']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile5">{{ form.label('email') }}</div>
                    <div class="profile4">
                        {{ form.render('email', ['class': 'form-control', 'placeholder': 'e.g., e-mail', 'data-validetta': 'email']) }}
                    </div>
                </div>

                <div class="profile1">
                    <div class="profile2">{{ form.label('social') }}</div>
                    <div class="profile3">
                        <label>{{ form.label('chekWhatsapp') }} {{ form.render('chekWhatsapp', ['value': 'Y']) }}</label>
                        <label>{{ form.label('chekViber') }} {{ form.render('chekViber', ['value': 'Y']) }}</label>
                        <label>{{ form.label('chekLine') }} {{ form.render('chekLine', ['value': 'Y']) }}</label>
                        <label>{{ form.label('chekWechat') }} {{ form.render('chekWechat', ['value': 'Y']) }}</label>
                    </div>
                </div>

                <br />

                <div class="profile1">
                    <div class="profilesubmit">{{ form.render('Save', ['onclick': 'selectCities();']) }}</div>
                </div>
            </div>

        </form>
        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->