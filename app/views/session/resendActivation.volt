{{ content() }}

{{ flash.output() }}

<!-- START MASTER COLUMN -->
<div id="wrapper">
    <div id="selection">
        <div align="center">

            <div class="signin">

                {{ form('class': 'form-search', 'id': 'outside_form') }}

                <div id="sgnup">
                    <h2>Resend Activation Link</h2>
                </div>

                <div id="sgnup3">
                    <div class="five">
                        <div class="six">{{ form.label('email') }} *</div>
                        <div class="seven">
                            {{ form.render('email', ['class': 'form-control', 'placeholder': 'e-mail', 'data-validetta': 'required,email']) }}
                        </div>
                    </div>

                    <div class="eight">
                        <div class="forgot1">
                            Please write your login e-mail and click 'Resend', so we can send your activation link again to your e-mail.
                        </div>
                        <div class="ten">{{ form.render('Resend') }}</div>
                    </div>
                </div>

            </div>

            </form>

        </div>
    </div>
</div>
<!-- END MASTER COLUMN -->