<!-- File: src/Template/Users/login.ctp -->
<?php
//  $this->Form->templates([
//      'inputContainer' => '{{content}}'
//  ]);
?>
	<section class="login-content">
		<!--div class="logo">
			<h1><?php //= __('Login') ?></h1>
		</div-->

		<div class="login-box">
			<?php //= $this->Form->create('users', ['class'=>"login-form", 'url'=>['prefix'=>'admin', 'controller'=>'Users', 'action'=>'login'] ]) ?>
			<?= $this->Form->create(null, ['class'=>"login-form"]) ?>
				<h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i><?= __('Sign In') ?></h3>
				<div class="form-group">
					<label for="username" class="control-label"><?= __('E-mail cím') ?></label>
					<!--input class="form-control" type="text" placeholder="Email" autofocus-->
					<?= $this->Form->control('username', ['type' => 'email', 'label'=>FALSE, 'class'=>'form-control', 'placeholder'=>__('E-mail'), 'data-error'=>__('Input valid email'), 'required'=>'required', 'autofocus'=>true]) ?>
				</div>
				<div class="form-group">
					<label class="control-label"><?= __('Password') ?></label>
					<?= $this->Form->control('password', ['label'=>FALSE, 'class'=>'form-control', 'placeholder'=>__('Input valid password'), 'data-error'=>__('Input valid email'), 'required'=>'required', 'autofocus'=>true]) ?>
					<!-- input class="form-control" type="password" placeholder="Password" -->
				</div>
				<div class="form-group">
					<div class="utility">
              <!--div class="animated-checkbox">
                <label>
                  <input type="checkbox"><span class="label-text">Stay Signed in</span>
                </label>
            </div-->
        </div>
    </div>
    <div class="form-group btn-container">
    	<button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i><?= __('Sign In') ?></button>
    </div>
<?php /* ##################
    <div class="form-group mt-3">
    	<p class="semibold-text mb-2">
    		<a href="#" style="float:left;" data-toggle="sign-up-flip"><?= __('Sign Up') ?></a>
    		<!--a href="#" style="float:right;" data-toggle="flip"><?= __('Forgot Password?') ?></a-->
    	</p>

    	<!--p class="semibold-text mb-2 text-right"><a href="#" data-toggle="flip">Forgot Password ?</a></p-->
    </div>
################## */ ?>
<?= $this->Form->end() ?>

<?php /* ##################
<?php //= $this->Form->create('users', ['class'=>"forget-form", 'url'=>['prefix'=>'admin', 'controller'=>'Users', 'action'=>'forgotPassword'] ]) ?>
<?= $this->Form->create(null, ['class'=>"login-form"]) ?>
	<h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i><?= __('Forgot password') ?></h3>
	<div class="form-group">
		<label class="control-label"><?= __('Email') ?></label>
		<input class="form-control" type="text" placeholder="Email">
	</div>
	<div class="form-group btn-container">
		<button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i><?= __('Reset password') ?></button>
	</div>
	<div class="form-group mt-3">
		<p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-arrow-left fa-fw"></i> <?= __('Back to Login') ?></a></p>
	</div>
<?= $this->Form->end() ?>
################## */ ?>

<?php /* */ ?>
<?php //= $this->Form->create('users', ['class'=>"sign-up-form", 'url'=>['prefix'=>'admin', 'controller'=>'Users', 'action'=>'signup'] ]) ?>
<?php /* ##################
<?= $this->Form->create(null, ['class'=>"login-form"]) ?>
	<h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i><?= __('Sign Up') ?></h3>
	<div class="form-group">
		<label class="control-label"><?= __('Name') ?></label>
		<?= $this->Form->control('name', ['label'=>FALSE, 'class'=>'form-control', 'placeholder'=>__('Fullname'), 'data-error'=>__('Input your fullname'), 'required'=>'required', 'autofocus'=>true]) ?>
		<!--input class="form-control" type="text" placeholder="Name" autofocus-->
	</div>
	<div class="form-group">
		<label class="control-label"><?= __('Email') ?></label>
		<?= $this->Form->control('email', ['label'=>FALSE, 'class'=>'form-control', 'placeholder'=>__('Input valid email'), 'data-error'=>__('Input valid email'), 'required'=>'required']) ?>
	</div>
	<div class="form-group">
		<label class="control-label"><?= __('Password') ?></label>
		<?= $this->Form->control('password', ['label'=>FALSE, 'class'=>'form-control', 'placeholder'=>__('Input valid password'), 'data-error'=>__('Input valid password'), 'required'=>'required']) ?>
	</div>
################## */ ?>
<?php /*
	<div class="form-group">
		<div class="utility">
			<div class="animated-checkbox">
				<label>
					<input type="checkbox"><span class="label-text"><?= __('Accept the Terms And Conditions') ?></span>
				</label>
			</div>
		</div>
		<!--p class="semibold-text mb-4"><a href="#" data-toggle="sign-up-flip">Sign In</a></p-->
	</div>
	<div class="form-group btn-container">
		<button class="btn btn-primary btn-block"><i class="fa fa-user-plus fa-lg fa-fw"></i><?= __('Sign Up') ?></button>
	</div>
	<div class="form-group mt-3">
		<p class="semibold-text mb-0"><a href="#" data-toggle="sign-up-flip"><i class="fa fa-arrow-left fa-fw"></i> <?= __('Back to Login') ?></a></p>
	</div>

<?= $this->Form->end() ?>
*/ ?>
<?php /* */ ?>
</div>
</section>
