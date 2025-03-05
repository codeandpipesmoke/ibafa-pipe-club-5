<?php
	use Cake\Utility\Text;

	$breadcrumb = $breadcrumb ?? "";
	$this->Breadcrumbs->setTemplates([
			'wrapper' => '<ol>{{content}}</ol>',
			'item' => '<li><a href="{{url}}">{{title}}</a></li>',
			//'itemWithoutLink' => '<li{{attrs}}><span{{innerAttrs}}>{{title}}</span></li>{{separator}}',
			//'separator' => '<li{{attrs}}><span{{innerAttrs}}>{{separator}}</span></li>'
		]);
?>
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center align-middle">
          <h2 class="m-0"><?= $this->Text->truncate(
								$breadcrumbs['title'] ?? __("Home"),
								65,
								[
									'ellipsis' => '...',
									'exact' => false
								]
							) ?></h2>

<?php
				$this->Breadcrumbs->add(__('Home'), ['controller' => 'Posts', 'action' => 'index', 'news']);
				
				if(isset($breadcrumbs['breadcrumb'])){
					foreach($breadcrumbs['breadcrumb'] as $breadcrumb){
						//debug($breadcrumb);
						if(isset($breadcrumb['controller']) && isset($breadcrumb['action'])){
							$this->Breadcrumbs->add($breadcrumb['title'], ['controller' => $breadcrumb['controller'], 'action' => $breadcrumb['action'], $lang->slug, ...$breadcrumb['param'] ?? null]);
						}else{
							$this->Breadcrumbs->add(
								$this->Text->truncate(
									$breadcrumbs['breadcrumb']['title'],
									30,
									[
										'ellipsis' => '...',
										'exact' => false
									]
								)							
							);
						}
					}
				}
			
				//if($breadcrumb !== '') {
				//	$this->Breadcrumbs->add($breadcrumb);
				//}

?>
			<?= $this->Breadcrumbs->render(); ?>
			
        </div>
      </div>
    </section><!-- End Breadcrumbs -->
