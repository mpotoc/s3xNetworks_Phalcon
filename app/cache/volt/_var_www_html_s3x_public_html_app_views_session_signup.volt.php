<?= $this->getContent() ?>

<?= $this->flash->output() ?>

<!-- START MASTER COLUMN -->
<div id="wrapper">
	<div id="selection">
		<div align="center">

			<?= $this->tag->form(['class' => 'form-search', 'id' => 'outside_form']) ?>

			<div class="signup">

				<div id="sgnup">
					<h2>Sign Up</h2>
				</div>

				<div id="sgnup2">
					<div class="onetwo">
						<div class="one"><?= $form->label('name') ?> *</div>
						<div class="two">
							<?= $form->render('name', ['class' => 'form-control', 'placeholder' => 'username', 'data-validetta' => 'required']) ?>
						</div>
					</div>
					<div class="onetwo">
						<div class="one"><?= $form->label('email') ?> *</div>
						<div class="two">
							<?= $form->render('email', ['class' => 'form-control', 'placeholder' => 'e-mail', 'data-validetta' => 'required,email']) ?>
						</div>
					</div>
					<div class="onetwo">
						<div class="one"><?= $form->label('password') ?> *</div>
						<div class="two">
							<?= $form->render('password', ['class' => 'form-control', 'placeholder' => 'password', 'data-validetta' => 'required,minLength[8]']) ?>
						</div>
					</div>
					<div class="onetwo">
						<div class="one"><?= $form->label('confirmPassword') ?> *</div>
						<div class="two">
							<?= $form->render('confirmPassword', ['class' => 'form-control', 'placeholder' => 'confirm password', 'data-validetta' => 'equalTo[password]']) ?>
						</div>
					</div>
					<div class="onetwo">
						<div class="one"><?= $form->label('code') ?></div>
						<div class="two">
							<?= $form->render('code', ['class' => 'form-control', 'placeholder' => 'affiliate code']) ?>
						</div>
					</div>
					<div class="threefour">
						<div class="three">
							<?= $form->render('termscond', ['class' => 'terms_a', 'data-validetta' => 'required']) ?> * <a href="../../terms">Accept terms and conditions</a>
						</div>
						<div class="four"><?= $form->render('Sign Up') ?></div>
					</div>
				</div>

			</div>

			</form>
		</div>
	</div>
</div>
<!-- END MASTER COLUMN -->