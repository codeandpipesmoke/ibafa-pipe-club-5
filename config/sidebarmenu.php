<?php
return [
	'Theme' => [
		'admin' => [
			'sidebar' => [
				'title' => 'JeffAdmin5',
				
			],
			'sidebarMenu' => [
				'Admin' => [
					//[
					//	'type' 		=> 'menu',
					//	'icon' 		=> 'fa fa-fw fa-bars',
					//	'title'		=> __('Messages'),
					//	'controller'=> 'Messages',
					//	'action' 	=> 'index',
					//],
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Posts'),
						'controller'=> 'Posts',
						'action' 	=> 'index',
					],
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Members'),
						'controller'=> 'Members',
						'action' 	=> 'index',
					],
					//[
					//	'type' 		=> 'menu',
					//	'icon' 		=> 'fa fa-fw fa-bars',
					//	'title'		=> __('Galleries'),
					//	'controller'=> 'Galleries',
					//	'action' 	=> 'index',
					//],
					//[
					//	'type' 		=> 'menu',
					//	'icon' 		=> 'fa fa-fw fa-bars',
					//	'title'		=> __('Photos'),
					//	'controller'=> 'Photos',
					//	'action' 	=> 'index',
					//],
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-bars',
						'title'		=> __('Texts'),
						'controller'=> 'Texts',
						'action' 	=> 'index',
					],
					[
						'type' 		=> 'menu',
						'icon' 		=> 'fa fa-fw fa-user',
						'title'		=> __('Users'),
						'controller'=> 'MyUsers',
						'action' 	=> 'index',
					],
					//[
					//	'type' 		=> 'submenu',
					//	'title'		=> __('Tables'),
					//	'icon'		=> 'fa fa-fw fa-table',
					//	'items'		=> [
					//		[
					//			'title' 		=> __('Posts'),
					//			'controller' 	=> 'Posts',
					//			'action' 		=> 'index',								
					//		],
					//		[
					//			'title' 		=> __('Categories'),
					//			'controller' 	=> 'Categories',
					//			'action' 		=> 'index',								
					//		],
					//	]
					//],
				],				
			]		
		]	
	],

];

?>
