<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
use Cake\Core\Configure;

$prefix = strtolower( $this->request->getParam('prefix') ?? '' );
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

$global_config = (array) Configure::read('Theme.' . $prefix . '.config.template.view');
$local_config = [
	// #################################### More config params in: \JeffAdmin5\config\config.php ####################################
	//'show_related_tables'	=> false,
	//'show_id' 			=> false,	// for view form
	//'show_pos' 	 		=> false,	// for view form
	//'show_counters' 		=> false,	// for view form
	//'index_show_id' 		=> false,	// for related tables
	//'index_show_visible' 	=> false,	// for related tables
	//'index_show_counters'	=> false,	// for related tables
];
$config = array_merge($global_config, $local_config);
?>
				<div class="view row">
					<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
						<div class="card mb-3">

							<div class="card-header">
								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-eye fa-spin"></i> <?= __('View') ?>: <?= __('User') ?></h3>
									<?= __('The data marked with <span class="fw-bold text-danger">*</span> must be provided!') ?>
								</div>
								<div class="float-end ms-5">
									<?= $this->Html->link('<span class="btn btn-outline-secondary mt-1 me-1"><i class="fa fa-times"></i></span>',
										["controller" => "Users", "action" => "index", "_full" => true],
										["escape" => false, "role" => "button"]
									) ?>
								</div>

								<div class="form-tab float-end">
									<ul class="nav nav-tabs mt-1" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active" id="tab-first" data-bs-toggle="tab" data-bs-target="#tabPanelMain" type="button" role="tab" aria-controls="tabPanelMain" aria-selected="true"><?= __('Basic data') ?></button>
										</li>


<?php /*
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tab-more" data-bs-toggle="tab" data-bs-target="#tab-panel-more" type="button" role="tab" aria-controls="tab-panel-more" aria-selected="false"><?= __('More') ?></button>
										</li>
*/ ?>

										<li class="nav-item dropdown">
											<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?= __('Related tables') ?></a>
											<ul class="dropdown-menu">
<?php if (!empty($user->social_accounts)) : ?>
												<li><?= $this->Html->link(__('Social Accounts') . '...', ['controller' => 'Social Accounts', 'action' => 'index', 'parent', 'user', $user->id], ['class' => 'dropdown-item']) ?></li>
<?php endif ?>
											</ul>
										</li>

									</ul>
								</div>

							</div><!-- /card header -->
							
							<div class="card-body">
								<form>
									<div class="tab-content" id="tabContent"><!-- T.1. -->
										
										<div class="tab-pane fade show active" id="tabPanelMain" role="tabpanel" aria-labelledby="tab-first" tabindex="0">
<?php if($config['show_id']){ ?>
											<div class="row"><!-- 3. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end">#<?= __('id') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $user->id ?><!-- 0.a -->
												</div>
											</div>
<?php } ?>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Id') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($user->id) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Username') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($user->username) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Email') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($user->email) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('First Name') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($user->first_name) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Last Name') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($user->last_name) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Role') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($user->role) ?>

												</div>
											</div>
											<div class="row"><!-- 4. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Activation Date') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($user->activation_date) ?>

												</div>
											</div>
											<div class="row"><!-- 4. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Tos Date') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($user->tos_date) ?>

												</div>
											</div>
											<div class="row"><!-- 4. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Last Login') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($user->last_login) ?>

												</div>
											</div>
											<div class="row"><!-- 5. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Secret Verified') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $user->secret_verified ? '<i class="fa fa-check-square boolean-yes" aria-hidden="true"></i>' : '<i class="fa fa-square boolean-no" aria-hidden="false"></i>' ?>

												</div>
											</div>
											<div class="row"><!-- 5. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Active') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $user->active ? '<i class="fa fa-check-square boolean-yes" aria-hidden="true"></i>' : '<i class="fa fa-square boolean-no" aria-hidden="false"></i>' ?>

												</div>
											</div>
											<div class="row"><!-- 5. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Is Superuser') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $user->is_superuser ? '<i class="fa fa-check-square boolean-yes" aria-hidden="true"></i>' : '<i class="fa fa-square boolean-no" aria-hidden="false"></i>' ?>

												</div>
											</div>

										</div><!-- /.1.TAB -->
										

<?php /*
											
										<div class="tab-pane fade" id="tab-panel-more" role="tabpanel" aria-labelledby="tab-more" tabindex="0">
											<div class="row"><!-- T.3. -->
												<div class="col-sm-12">
													<h3>Tab 3 content</h3>
													
												</div>
											</div>
										</div><!-- /.3.TAB -->
*/ ?>

									</div><!-- /.TAB PANEL -->

								</form>
							</div><!-- /card body -->
									
						    <div class="card-footer">
								<!--button type="submit" class="btn btn-outline-secondary">&larr;&nbsp;Vissza a listához</button-->
							</div><!-- /card footer -->

						</div><!-- end card-->
                    </div>

				</div>

<?php /*
	############################################################################################################################################################
	#################################################################                  #########################################################################
	#################################################################  Related tebles  #########################################################################
	#################################################################                  #########################################################################
	############################################################################################################################################################
*/ ?>
<?php if($config['show_related_tables']): ?>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card mb-3">

							<div class="card-header">
							
								<div class="float-start">
									<h3><i class="fa fa-table"></i> <?= __('Related tables') ?></h3>
									<?= __('Here you can see the latest records related to the above item.') ?>
								</div>

								<div class="form-tab float-end">
									<nav>
										<div class="nav nav-tabs mt-1" id="nav-tab" role="tablist">
<?php if (!empty($user->social_accounts)): ?>
											<button class="nav-link active" id="nav-social_accounts-tab" data-bs-toggle="tab" data-bs-target="#nav-social_accounts" type="button" role="tab" aria-controls="nav-social_accounts" aria-selected="true">
												<?= __('Social Accounts') ?>
											</button>
<?php endif ?>
										</div>
									</nav>
								</div>

							</div><!-- /card header -->
								
							<div class="card-body p-1 pb-0">

								<div class="tab-content" id="nav-tabContent">

<?php if (!empty($user->social_accounts)): ?>

									<div class="tab-pane fade show active p-0" id="nav-social_accounts" role="tabpanel" aria-labelledby="nav-social_accounts-tab" tabindex="0">

										<table class="table table-responsive-xl table-hover table-striped" style="">
											<thead class="thead-info">
												<tr>
<?php if($config['index_show_id']){ ?>
													<th class="number id"><?= __('Id') ?></th>
<?php } ?>
													<th class="please-change-type user-id"><?= __('User Id') ?></th>
													<th class="please-change-type provider"><?= __('Provider') ?></th>
													<th class="please-change-type username"><?= __('Username') ?></th>
													<th class="please-change-type reference"><?= __('Reference') ?></th>
													<th class="please-change-type avatar"><?= __('Avatar') ?></th>
													<th class="please-change-type description"><?= __('Description') ?></th>
													<th class="please-change-type link"><?= __('Link') ?></th>
													<th class="please-change-type token"><?= __('Token') ?></th>
													<th class="please-change-type token-secret"><?= __('Token Secret') ?></th>
													<th class="please-change-type token-expires"><?= __('Token Expires') ?></th>
													<th class="please-change-type active"><?= __('Active') ?></th>
													<th class="please-change-type data"><?= __('Data') ?></th>
<?php if($config['index_show_created']){ ?>
													<th class="datetime created"><?= __('Created') ?></th>
<?php } ?>
<?php if($config['index_show_modified']){ ?>
													<th class="datetime modified"><?= __('Modified') ?></th>
<?php } ?>
													<th class="actions"><?= __('Actions') ?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($user->social_accounts as $socialAccounts) : ?>

												<tr>
<?php if($config['index_show_id']){ ?>
													<td class="number id" value="<?= $socialAccounts->id ?>"><?= h($socialAccounts->id) ?></td>
<?php } ?>
													<td class="please-change-type user-id" value="<?= $socialAccounts->user_id ?>"><?= h($socialAccounts->user_id) ?></td>
													<td class="please-change-type provider" value="<?= $socialAccounts->provider ?>"><?= h($socialAccounts->provider) ?></td>
													<td class="please-change-type username" value="<?= $socialAccounts->username ?>"><?= h($socialAccounts->username) ?></td>
													<td class="please-change-type reference" value="<?= $socialAccounts->reference ?>"><?= h($socialAccounts->reference) ?></td>
													<td class="please-change-type avatar" value="<?= $socialAccounts->avatar ?>"><?= h($socialAccounts->avatar) ?></td>
													<td class="please-change-type description" value="<?= $socialAccounts->description ?>"><?= h($socialAccounts->description) ?></td>
													<td class="please-change-type link" value="<?= $socialAccounts->link ?>"><?= h($socialAccounts->link) ?></td>
													<td class="please-change-type token" value="<?= $socialAccounts->token ?>"><?= h($socialAccounts->token) ?></td>
													<td class="please-change-type token-secret" value="<?= $socialAccounts->token_secret ?>"><?= h($socialAccounts->token_secret) ?></td>
													<td class="please-change-type token-expires" value="<?= $socialAccounts->token_expires ?>"><?= h($socialAccounts->token_expires) ?></td>
													<td class="please-change-type active" value="<?= $socialAccounts->active ?>"><?= h($socialAccounts->active) ?></td>
													<td class="please-change-type data" value="<?= $socialAccounts->data ?>"><?= h($socialAccounts->data) ?></td>
<?php if($config['index_show_created']){ ?>
													<td class="datetime created" value="<?= $socialAccounts->created ?>"><?= h($socialAccounts->created) ?></td>
<?php } ?>
<?php if($config['index_show_modified']){ ?>
													<td class="datetime modified" value="<?= $socialAccounts->modified ?>"><?= h($socialAccounts->modified) ?></td>
<?php } ?>
													<td class="actions">
														<?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'SocialAccounts', 'action' => 'view', $socialAccounts->id], ["escape" => false, "role" => "button",  "class" => "btn btn-warning btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('View this item'), "data-original-title" => ""]) ?><!-- view button -->
														<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'SocialAccounts', 'action' => 'edit', $socialAccounts->id], ["escape" => false, "role" => "button", "class" => "btn btn-primary btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('Edit this item'), "data-original-title" => ""]) ?><!-- edit button -->
														<?= $this->Form->postLink('<i class="fa fa-times"></i>', ['controller' => 'SocialAccounts', 'action' => 'delete', $socialAccounts->id], ["escape" => false, "role" => "button", "class" => "btn btn-danger btn-sm", "data-toggle" =>"tooltip", "data-placement" => "top", "title" => __('Delete this item'), "data-original-title" => "", "confirm" => __("Are you sure you want to delete # {0}?", $socialAccounts->id)]) ?><!-- delete button -->
													</td>
												</tr>
												<?php endforeach ?>

											</tbody>
										</table>

									</div><!-- /tab pane -->
<?php endif ?>

								</div><!-- /tab content -->

							</div><!-- /card body -->

						    <div class="card-footer">
								<!-- Bottom text! -->
							</div><!-- /card footer -->
							
						</div><!-- end card -->
                    </div><!-- end col -->
				</div><!-- end row -->
<?php endif // $config['show_related_tables'] ?>

<?php
	$this->Html->css(
		[
			//// 'JeffAdmin5./assets/plugins/',
		],
		['block' => true]
	);

	$this->Html->script(
		[
			//// 'JeffAdmin5./assets/plugins/',
		],
		['block' => 'scriptBottom']
	);
?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']) ?>

<?php $this->Html->scriptEnd() ?>
