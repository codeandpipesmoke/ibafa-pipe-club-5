<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $Abouts = null;
    public $about = null;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
		

		//$role = $this->Authentication->getIdentity()->get('role');
		//debug($role);

		$plugin = $this->request->getParam('plugin');
		$controller = $this->request->getParam('controller');
		$action = $this->request->getParam('action');
		
        $this->Abouts = $this->fetchTable('Abouts');
        $this->about = $this->Abouts->get(1);
        $this->set('about', $this->about);

		//debug($plugin);
		//debug($controller);
		//dd($action);

		$actions = ['login', 'register', 'changePassword', 'requestResetPassword', 'verify'];

		if ($plugin === 'CakeDC/Users' && $controller === 'Users' && in_array($action, $actions)) {
			$this->viewBuilder()->setLayout('jeffAdmin5.login');
		}
		if ($plugin === 'CakeDC/Users' && $controller === 'Users' && !in_array($action, $actions)) {
			$this->viewBuilder()->setLayout('jeffAdmin5.default');
		}
		
    }
}
