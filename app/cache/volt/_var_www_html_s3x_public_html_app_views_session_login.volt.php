<?= $this->getContent() ?>

<?= $this->flash->output() ?>

<!-- START MASTER COLUMN -->
<div id="wrapper">
	<div id="selection">
		<div align="center">

			<?= $this->tag->form(['class' => 'form-search', 'id' => 'outside_form']) ?>

			<div class="signin">

				<div id="sgnup">
					<h2>Log In</h2>
				</div>

				<div id="sgnup3">
					<div class="five">
						<div class="six"><?= $form->label('email') ?> *</div>
						<div class="seven">
							<?= $form->render('email', ['class' => 'form-control', 'placeholder' => 'e-mail', 'data-validetta' => 'required,email']) ?>
						</div>
					</div>
					<div class="five">
						<div class="six"><?= $form->label('password') ?> *</div>
						<div class="seven">
							<?= $form->render('password', ['class' => 'form-control', 'placeholder' => 'password', 'data-validetta' => 'required']) ?>
						</div>
					</div>

					<div class="eight">
						<div class="forgot">
							<?= $this->tag->linkTo(['forgotPassword', 'Forgot my password?']) ?>
							<br />
							<?= $this->tag->linkTo(['resendActivation', 'Resend activation link?']) ?>
						</div>
						<div class="nine">
							<?= $form->render('remember') ?>
							<?= $form->label('remember') ?>
						</div>
						<div class="ten"><?= $form->render('Log In') ?></div>
					</div>
				</div>

			</div>

			</form>

		</div>
	</div>
</div>
<!-- END MASTER COLUMN -->