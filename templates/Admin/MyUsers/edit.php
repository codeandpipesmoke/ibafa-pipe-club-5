<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $myUsers
 */
?>
<?php
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;

$this->Form->setTemplates(Configure::read('Templates.form'));
$this->assign('title', __('Edit') . ' ' . __('User'));
?>
				<div id="form-row" class="users row">
					<div class="col-xs-12 col-xl-10">
						<div class="card mb-3">
							<div class="card-header">

								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-edit fa-spin"></i> <?= __('Edit') ?>: <?= __('User') ?></h3>
									<?= __('The data marked with <span class="fw-bold text-danger">*</span> must be provided!') ?>
								</div>

								<div class="float-end ms-5">
									<?= $this->Html->link('<span class="btn btn-outline-secondary mt-1 me-1"><i class="fa fa-times"></i></span>',
										["controller" => "myUsers", "action" => "index", "_full" => true],
										["escape" => false, "role" => "button"]
									); ?>

								</div>

								<div class="form-tab float-end">
									<ul class="nav nav-tabs mt-1" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active" id="tabMain" data-bs-toggle="tab" data-bs-target="#tabPanelMain" type="button" role="tab" aria-controls="tabPanelMain" aria-selected="true"><?= __('Basic data') ?></button>
										</li>

<?php /*
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tabSecond" data-bs-toggle="tab" data-bs-target="#tabPanelSecond" type="button" role="tab" aria-controls="tabPanelSecond" aria-selected="false"><?= __('Memo') ?></button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tabMore" data-bs-toggle="tab" data-bs-target="#tabPanelMore" type="button" role="tab" aria-controls="tabPanelMore" aria-selected="false"><?= __('More') ?></button>
										</li>
*/ ?>

									</ul>
								</div>

							</div>

							<?= $this->Form->create($myUser, ['id' => 'main-form']) ?>
							
								<?php //= $this->Form->control('_csrfToken', ['name' => '_csrfToken', 'type' => 'hidden', 'value' => $this->request->getAttribute('csrfToken')] ) ?>

								<div class="card-body">
								
									<div class="tab-content" id="tabContent">
										
										<div class="tab-pane fade show active" id="tabPanelMain" role="tabpanel" aria-labelledby="tabMain" tabindex="0">
<?php /*
											<!-- 2. STRING: username: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="username"><?= __('Username') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('username', ['label' => __('Username'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>
*/ ?>

											<!-- 1. SELECT: role: integer  required -->
											<div class="mb-3 form-group row select required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="role"><?= __('Role') ?>:</label>
												<div class="col-md-4">
													<?= $this->Form->control('role', ['options' => $role, 'class' => 'form-control select2', 'data-live-search' => false, 'data-container' => 'body', 'data-size' => '6', 'empty' => false]);	?>

												</div>
											</div>

											<!-- 2. STRING: email: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="email"><?= __('Email') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('email', ['label' => __('Email'), 'class' => 'form-control', 'empty' => true, 'readonly' => true, 'disabled' => true]); ?>

												</div>
											</div>

<?php /*
											<!-- 2. STRING: password: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="password"><?= __('Password') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('password', ['label' => __('Password'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>
*/ ?>

											<!-- 2. STRING: first_name: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="first-name"><?= __('First Name') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('first_name', ['label' => __('First Name'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: last_name: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="last-name"><?= __('Last Name') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('last_name', ['label' => __('Last Name'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

<?php /*
											<!-- 2. STRING: token: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="token"><?= __('Token') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('token', ['label' => __('Token'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 4. DATETIME: token_expires: datetime  -->
											<div class="mb-3 row required">
												<label class="pt-2 col-form-label col-md-2 pt-1 text-start text-md-end" for="token-expires"><?= __('Token Expires') ?>:</label>
												<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 col-xxl-4">
													<div class="form-group datetime">
														<div class="input-group token-expires" id="token-expires" data-target-input="nearest">
															<?= $this->Form->control('token_expires', ['type' => 'text', 'class' => 'form-control', 'empty' => true]); ?>

															<div class="input-group-append" data-target="#token-expires" data-toggle="token-expires">
																<div class="input-group-text"><i class="fa fa-calendar"></i></div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- 2. STRING: api_token: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="api-token"><?= __('Api Token') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('api_token', ['label' => __('Api Token'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 4. DATETIME: activation_date: datetime  -->
											<div class="mb-3 row required">
												<label class="pt-2 col-form-label col-md-2 pt-1 text-start text-md-end" for="activation-date"><?= __('Activation Date') ?>:</label>
												<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 col-xxl-4">
													<div class="form-group datetime">
														<div class="input-group activation-date" id="activation-date" data-target-input="nearest">
															<?= $this->Form->control('activation_date', ['type' => 'text', 'class' => 'form-control', 'empty' => true]); ?>

															<div class="input-group-append" data-target="#activation-date" data-toggle="activation-date">
																<div class="input-group-text"><i class="fa fa-calendar"></i></div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- 2. STRING: secret: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="secret"><?= __('Secret') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('secret', ['label' => __('Secret'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 7. BOOLEAN: secret_verified: boolean  -->
											<div class="mb-3 form-group row checkbox">
												<div class="col-sm-2 col-form-label"></div>
												<div class="col-sm-10">
													<?= $this->Form->control('secret_verified', ['empty' => true]); ?>

												</div>
											</div>

											<!-- 4. DATETIME: tos_date: datetime  -->
											<div class="mb-3 row required">
												<label class="pt-2 col-form-label col-md-2 pt-1 text-start text-md-end" for="tos-date"><?= __('Tos Date') ?>:</label>
												<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 col-xxl-4">
													<div class="form-group datetime">
														<div class="input-group tos-date" id="tos-date" data-target-input="nearest">
															<?= $this->Form->control('tos_date', ['type' => 'text', 'class' => 'form-control', 'empty' => true]); ?>

															<div class="input-group-append" data-target="#tos-date" data-toggle="tos-date">
																<div class="input-group-text"><i class="fa fa-calendar"></i></div>
															</div>
														</div>
													</div>
												</div>
											</div>
*/ ?>

											<!-- 7. BOOLEAN: active: boolean  required -->
											<div class="mb-3 form-group row checkbox">
												<div class="col-sm-2 col-form-label required"></div>
												<div class="col-sm-10">
													<?= $this->Form->control('active', ['empty' => false]); ?>

												</div>
											</div>

<?php /*
											<!-- 7. BOOLEAN: is_superuser: boolean  required -->
											<div class="mb-3 form-group row checkbox">
												<div class="col-sm-2 col-form-label required"></div>
												<div class="col-sm-10">
													<?= $this->Form->control('is_superuser', ['empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: role: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="role"><?= __('Role') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('role', ['label' => __('Role'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 8. ELSE: additional_data: json  not in ['string', 'integer', 'datetime', 'date', 'time', 'boolean'] -->
											<?php //$this->Form->control('additional_data', ['class' => 'form-control']); ?>
											<!-- 4. DATETIME: last_login: datetime  -->
											<div class="mb-3 row required">
												<label class="pt-2 col-form-label col-md-2 pt-1 text-start text-md-end" for="last-login"><?= __('Last Login') ?>:</label>
												<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 col-xxl-4">
													<div class="form-group datetime">
														<div class="input-group last-login" id="last-login" data-target-input="nearest">
															<?= $this->Form->control('last_login', ['type' => 'text', 'class' => 'form-control', 'empty' => true]); ?>

															<div class="input-group-append" data-target="#last-login" data-toggle="last-login">
																<div class="input-group-text"><i class="fa fa-calendar"></i></div>
															</div>
														</div>
													</div>
												</div>
											</div>
*/ ?>

										</div><!-- /.tabPanelMain -->
										
										
<?php /*											
										<div class="tab-pane fade" id="tabPanelMore" role="tabpanel" aria-labelledby="tabMore" tabindex="0">
											<h3>More content come here...</h3>

										</div><!-- /.N.TAB -->
*/ ?>

									</div><!-- /.TAB PANEL -->
										
								</div>

								<div class="card-footer text-center">
									<?= $this->Form->button('<span class="btn-label"><i class="fa fa-save"></i></span>' . __('Save'), ["escapeTitle" => false, "type" => "submit", "class" => "btn btn-success me-4"]) ?>
									
									<?= $this->Html->link('<span class="btn-label"><i class="fa fa-arrow-up"></i></span>' . __("Cancel"),
										["controller" => "myUsers", "action" => "index", "_full" => true],
										["escape" => false, "role" => "button", "class" => "btn btn-outline-secondary"]
									); ?>
									
								</div>

							<?= $this->Form->end() ?>

						</div><!-- end card-->
                    </div>


				</div>			


<?php
	$this->Html->css(
		[
			"jeffAdmin5./assets/plugins/tempus-dominus-6.0.0/dist/css/tempus-dominus.min",
			"jeffAdmin5./assets/plugins/summernote-0.8.18-dist/summernote-lite.min",
			"jeffAdmin5./assets/plugins/bootstrap-select-main/docs/docs/dist/css/bootstrap-select.min",
			"jeffAdmin5./assets/plugins/icheck-1.0.3/skins/all",

			// "jeffAdmin5./assets/plugins/select2-4.1.0-rc.0/dist/css/select2.min",	// If you want to use Select 2, but it's not finish!!!
			// "jeffAdmin5./assets/css/select2-bootstrap-5-theme.min",					// If you want to use Select 2, but it's not finish!!!
		],
		['block' => true]);


	$this->Html->script(
		[
			"jeffAdmin5./assets/js/popper",
			"jeffAdmin5./assets/plugins/tempus-dominus-6.0.0/dist/js/tempus-dominus.min",	// Must be loaded the popper.js !!
			//"jeffAdmin5./assets/plugins/bootstrap-input-spinner-bs-5/src/bootstrap-input-spinner",
			//"jeffAdmin5./assets/plugins/summernote-0.8.18-dist/summernote-lite.min",
			//"jeffAdmin5./assets/plugins/summernote-0.8.18-dist/lang/summernote-hu-HU",
			//'jeffAdmin5./assets/plugins/jReadMore-master/dist/read-more.min',
			"jeffAdmin5./assets/plugins/bootstrap-select-main/docs/docs/dist/js/bootstrap-select.min",
			"jeffAdmin5./assets/plugins/bootstrap-select-main/docs/docs/dist/js/i18n/defaults-hu_HU.min",
			"jeffAdmin5./assets/plugins/icheck-1.0.3/icheck.min",
			
			//'jeffAdmin5./assets/plugins/select2-4.1.0-rc.0/dist/js/select2.full.min',	// If you want to use Select 2, but it's not finish!!!
			//'jeffAdmin5./assets/plugins/select2-4.1.0-rc.0/dist/js/i18n/hu',			// If you want to use Select 2, but it's not finish!!!
		],
		['block' => 'scriptBottom']
	); ?>
		
<?php
	// SELECT: https://developer.snapappointments.com/bootstrap-select/examples/
?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']); ?>

	jeffAdminInitSelectPicker()
<?php /*
	//jeffAdminInitDateTimePicker('token_expires'<?= $myUser->token_expires !== null ? ", '" . $myUser->token_expires->format('Y-m-d H:i:s') . "'" : "" ?>)
	//jeffAdminInitDateTimePicker('activation_date'<?= $myUser->activation_date !== null ? ", '" . $myUser->activation_date->format('Y-m-d H:i:s') . "'" : "" ?>)
	//jeffAdminInitDateTimePicker('tos_date'<?= $myUser->tos_date !== null ? ", '" . $myUser->tos_date->format('Y-m-d H:i:s') . "'" : "" ?>)
	//jeffAdminInitDateTimePicker('last_login'<?= $myUser->last_login !== null ? ", '" . $myUser->last_login->format('Y-m-d H:i:s') . "'" : "" ?>)
*/ ?>
	jeffAdminInitICheck('icheckbox_flat-blue');

	$('#button-submit').click( function(){
		$('#main-form').submit();
	});			


<?php $this->Html->scriptEnd(['block' => 'javaScriptBottom']); ?>
