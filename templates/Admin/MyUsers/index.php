<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $my_users
 */
use Cake\Core\Configure;

$session = $this->getRequest()->getSession();
$prefix = strtolower( $this->request->getParam('prefix') ?? '' );
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

$layoutUsersLastId = -1;
if($session->check('Layout.MyUsers.LastId')){
	$layoutMyUsersLastId = $session->read('Layout.MyUsers.LastId');
}

$global_config = (array) Configure::read('Theme.' . $prefix . '.config.template.index');
$local_config = [
	'show_id' 			=> false,
	'show_pos' 			=> false,
	'show_counters'		=> false,
	'action_db_click'	=> 'edit',	// none, edit or view
	// ... more config params in: \JeffAdmin5\config\config.php
];
$config = array_merge($global_config, $local_config);
?>
				<div class="users index row">
						
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card">
							<div class="card-header">
							
								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-table fa-spin"></i> <?= __('Table') ?>: <?= __('Users') ?></h3>
									<div><?php
										if($config['action_db_click'] == 'edit'){
																		echo __('Double clik to edit row');
										}
										if($config['action_db_click'] == 'view'){
																		echo __('Double clik to view row');
										}
									?></div>
								</div>
								
								<div class="float-end">
									<!-- Paginator page links -->
									<?= $this->element('JeffAdmin5.paginator') ?>
									<!-- /.Pginator page links -->
								</div>
								
							</div>

<?php ####################################################################################################################################################### ?>
<?php ###################### CARD BODY ###################################################################################################################### ?>
<?php ####################################################################################################################################################### ?>

							<div class="card-body p-0 p-1">
								
								<table class="table table-responsive-xl table-hover table-striped mb-0" style="">
									<thead class="thead-info">
										<tr>
											<th class="row-id-anchor"></th>
<?php if($config['show_id']){ ?>
											<th class="number id"><?= $this->Paginator->sort('id') ?></th>
<?php } ?>
<?php /*
											<th class="string username"><?= $this->Paginator->sort('username') ?></th><!-- H.1. -->
*/ ?>
											<th class="string role"><?= $this->Paginator->sort('role') ?></th><!-- H.1. -->
											<th class="string first-name">
												<?= $this->Paginator->sort('first_name') ?> <?= $this->Paginator->sort('last_name') ?><br>
												<?= $this->Paginator->sort('email') ?>
											</th><!-- H.1. -->
<?php /*
											<th class="datetime activation-date"><?= $this->Paginator->sort('activation_date') ?></th><!-- H.1. -->
											<th class="boolean secret-verified"><?= $this->Paginator->sort('secret_verified') ?></th><!-- H.1. -->
											<th class="datetime tos-date"><?= $this->Paginator->sort('tos_date') ?></th><!-- H.1. -->
*/ ?>
											<th class="boolean active"><?= $this->Paginator->sort('active') ?></th><!-- H.1. -->
<?php /*
											<th class="boolean is-superuser"><?= $this->Paginator->sort('is_superuser') ?></th><!-- H.1. -->
*/ ?>
											<th class="datetime last-login"><?= $this->Paginator->sort('last_login') ?></th><!-- H.1. -->
<?php if($config['show_created'] || $config['show_modified']){ ?>

											<th class="datetime created modified">
												<?php 
													if($config['show_created']){ 
														echo $this->Paginator->sort('created');
													}
													if($config['show_created'] && $config['show_modified']){
														echo "&nbsp;/&nbsp;";
													}
													if($config['show_modified']){
														echo $this->Paginator->sort('modified');
													} ?>

											</th>
<?php } ?>
<?php if($config['show_button_view'] || $config['show_button_edit'] || $config['show_button_delete'] ){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($myUsers as $user): ?>
<?php
	//$classLastVisited = ' class="last-visited"';	// later...
	//$classLastVisited = '';
?>

										<tr row-id="<?= $user->id ?>"<?php if($user->id == $layoutUsersLastId){ echo 'class="table-tr-last-id"'; } ?>" prefix="<?= $prefix ?>" controller="<?= $controller ?>" action="<?= $action ?>" aria-expanded="true">
											<td class="row-id-anchor" value="<?= $user->id ?>"><a name="<?= $user->id ?>" class="anchor"></a></td>
<?php if($config['show_id']){ ?>
											<td class="number id" value="<?= $user->id ?>"><?= h($user->id) ?><a name="<?= $user->id ?>"></a></td>
<?php } ?>
<?php /*
											<td class="string username" value="<?= $user->username ?>"><?= h($user->username) ?></td>
*/ ?>
											<td class="string role text-center" style="width: 120px;" value="<?= $user->role ?>">
												<strong><?= h($role[$user->role]) ?></strong>
											</td>
											<td class="string name" value="<?= $user->first_name ?> <?= $user->last_name ?>">
												<strong><?= h($user->first_name) ?> <?= h($user->last_name) ?></strong><br>
												<?= h($user->email) ?>
											</td>
<?php /*
											<td class="datetime activation-date" value="<?= $user->activation_date ?>"><?= h($user->activation_date) ?></td>
											<td class="boolean secret-verified" value="<?= $user->secret_verified ?>"><?= h($user->secret_verified) ?></td>
											<td class="datetime tos-date" value="<?= $user->tos_date ?>"><?= h($user->tos_date) ?></td>
*/ ?>
											<td class="boolean active" value="<?= $user->active ?>"><?= h($user->active) ?></td>
<?php /*
											<td class="boolean is-superuser" value="<?= $user->is_superuser ?>"><?= h($user->is_superuser) ?></td>
*/ ?>
											<td class="datetime last-login" value="<?= $user->last_login ?>"><?= h($user->last_login) ?></td>
<?php if($config['show_created'] || $config['show_modified']){ ?>
											<td class="datetime">
<?php if($config['show_created']){ ?>
												<span class="fw-bold"><?= h($user->created) ?></span>
<?php } ?>
<?php if($config['show_created'] && $config['show_modified']){ ?>
												<br>
<?php } ?>
<?php if($config['show_modified']){ ?>
												<span class="fw-normal"><?= h($user->modified) ?></span>
<?php } ?>
											</td>
<?php } ?>
<?php if($config['show_button_view'] || $config['show_button_edit'] || $config['show_button_delete'] ){ ?>

											<td class="actions">
<?php if($config['show_button_view']){ ?>
												<?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $user->id], ['escape' => false, 'role' => 'button', 'class' => 'btn btn-warning btn-sm', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => __('View this item'), 'data-original-title' => __('View this item')]) ?>
<?php } ?>

<?php if($config['show_button_edit']){ ?>
												<?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $user->id], ['escape' => false, 'role' => 'button', 'class' => 'btn btn-primary btn-sm', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => __('Edit this item'), 'data-original-title' => __('Edit this item')]) ?>
<?php } ?>

<?php if($config['show_button_delete']){ ?>
												<?= $this->Form->postLink('', ['action' => 'delete', $user->id], ['class'=>'hide-postlink index-delete-button-class']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($user->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="fa fa-minus"></i></a>

<?php } ?>

											</td>
<?php } ?>
										</tr>
										<?php endforeach; ?>

									</tbody>
								</table>

							</div>
							<div class="card-footer text-center">
								<div class="float-start">
									<?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
								</div>								
								<div class="float-end mb-1">							
									<?= $this->element('jeffAdmin5.paginator') ?>
									
								</div>								
							</div>
						</div><!-- end card-->					
					</div>

				</div>			

	<?php
	if(isset($config['index_show_actions']) && $config['index_show_actions'] && isset($config['index_enable_delete']) && $config['index_enable_delete']){ 
		$this->Html->script(
			[
				'JeffAdmin5./assets/plugins/sweetalert2/dist/sweetalert2.all.min',
			],
			['block' => 'scriptBottom']
		);
	}	
	?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']); ?>

	$(document).ready( function(){
		$('tr').dblclick( function(){
			let id = $(this).attr("row-id")
			window.location.href = '<?= $this->Url->build(['controller' => $controller, 'action' => $config['action_db_click']]) ?>/' + id;
		})
		
	})
<?php $this->Html->scriptEnd(); ?>



