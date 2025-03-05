<?php
/*
Superuser added:
Id: eab26308-3ba1-4fe6-b91a-25d53153288e
Username: superadmin
Email: superadmin@example.com
Role: admin
Password: 0145c6bba98940bf830c1618673d9712
*/

return [
    'Users.Social.login' => false,
	'Auth.Identifiers.Password.fields.username' => 'email',
	'Auth.Authenticators.Form.fields.username' => 'email',	

    'Users' => [
        'table' => 'CakeDC/Users.Users',
		//'controller' => 'MyUsers',
		
        'Tos' => [
            'required' => false,
        ],
        'Registration' => [
            'active' => false,
		],
	],

	// https://discourse.cakephp.org/t/configure-logoutredirect-in-authentication-plugin-with-cakedc-users-in-cakephp-5-x/11766/7
	// https://github.com/CakeDC/users/issues/362
	
    'Auth' => [
        'AuthenticationComponent' => [
            'loginRedirect' => '/admin',
            'logoutRedirect' => '/',
        ],
		
    ],
	
];
?>