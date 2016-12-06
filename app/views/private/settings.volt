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
                    <h2>Change settings</h2>
                </div>
            </div>

            <div id="sgnup4" style="margin-bottom: 30px;">
                All input fields marked with '<b>*</b>' are mandatory. You are able to set a new password for your account. When you put into
                form the correct values you have to click on '<b>Change</b>' button to save your new credentials.
            </div>

            <div id="sgnup4">
                <div class="profile1">
                    <div class="profile2">{{ form.label('name') }}</div>
                    <div class="profile4">
                        {{ form.render('name', ['class': 'form-control', 'disabled': true, 'value': u.name]) }}
                    </div>
                </div>
                <div class="profile1">
                    <div class="profile5">{{ form.label('email') }}</div>
                    <div class="profile4">
                        {{ form.render('email', ['class': 'form-control', 'disabled': true, 'value': u.email]) }}
                    </div>
                </div>
                <div class="profile1">
                    <div class="profile2">{{ form.label('opassword') }} *</div>
                    <div class="profile3">
                        {{ form.render('opassword', ['class': 'form-control', 'placeholder': 'current password', 'data-validetta': 'required,minLength[8]']) }}
                    </div>
                </div>
                <div class="profile1">
                    <div class="profile2">{{ form.label('password') }} *</div>
                    <div class="profile3">
                        {{ form.render('password', ['class': 'form-control', 'placeholder': 'password', 'data-validetta': 'required,minLength[8],different[opassword]']) }}
                    </div>
                </div>
                <div class="profile1">
                    <div class="profile2">{{ form.label('confirmPassword') }} *</div>
                    <div class="profile3">
                        {{ form.render('confirmPassword', ['class': 'form-control', 'placeholder': 'confirm password', 'data-validetta': 'equalTo[password]']) }}
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
<!-- END MASTER COLUMN -->