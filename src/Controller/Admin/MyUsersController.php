<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;
use App\Model\Table\MyUsersTable;
use Cake\Event\Event;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;

/**
 * MyUsers Controller
 *
 * @property \App\Model\Table\MyUsersTable $MyUsers
 */
class MyUsersController extends AppController
{
	use LoginTrait;
	use RegisterTrait;

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('CakeDC/Users.Setup');
        if ($this->components()->has('Security')) {
            $this->Security->setConfig(
                'unlockedActions',
                [
                    'login',
                    'webauthn2faRegister',
                    'webauthn2faRegisterOptions',
                    'webauthn2faAuthenticate',
                    'webauthn2faAuthenticateOptions',
                ]
            );
        }
		
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($clearFilter = null)
    {
		$identity = $this->getRequest()->getAttribute('identity');
		$identity = $identity->getOriginalData();
		
		//if($identity->role !== 'admin'){
		//	$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
		//	return $this->redirect(['controller' => 'Messages', 'action' => 'index']);
		//}
		
		if($identity->is_superuser !== true){
			$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['controller' => 'Messages', 'action' => 'index']);
		}

		//debug($identity->role);
		//debug($identity->is_superuser);
		//die();

		$this->set('title', __('Browse the') . ': ' . __('MyUsers'));

		$queryParams = $this->request->getQuery();
		$page 		 	 = '1';
		$sort 		 	 = 'id';
		$direction 	 	 = 'asc';
		$showSearchBar	 = false;
		$searchInSession = '';
		$search 	 	 = '';		

		if ($clearFilter == 'clear-filter'){
			if($this->session->check('Layout.' . $this->controller . '.search')){
				$this->session->delete('Layout.' . $this->controller . '.search');
			}
			$showSearchBar	 = true;
		}

		
		// ############ Ha nem lenne megadva az URL-ben a page QUERY paraméter, akkor beállítja ##########################		
		$page = $this->request->getQuery('page');
		if($page === null){
			return $this->redirect(['controller' => $this->controller, 'action' => 'index', '?' => array_merge(['page' => 1], $queryParams) ]);
		}
		$this->session->write('Layout.' . $this->controller . '.page', $page);
		// ########## /.Ha nem lenne megadva az URL-ben a page QUERY paraméter, akkor beállítja ##########################


		// ############################# /.SORT ORDER & PAGE ###############################
		if($this->session->check('Layout.' . $this->controller . '.queryparams')){
			$this->queryParamsInSession = json_decode($this->session->read('Layout.' . $this->controller . '.queryparams'));
		}
		
		if(isset($this->queryParamsInSession->page)){
			$page = $this->queryParamsInSession->page;
		}
		
		if(isset($this->queryParamsInSession->sort)){
			$sort = $this->queryParamsInSession->sort;
		}
		
		if(isset($this->queryParamsInSession->direction)){
			$direction = $this->queryParamsInSession->direction;
		}

		if(isset($queryParams['page'])){
			$this->queryParamsInSession->page = $queryParams['page'];
			$page = $this->queryParamsInSession->page;
		}

		if(isset($queryParams['sort'])){
			$this->queryParamsInSession->sort = $queryParams['sort'];
			$sort = $this->queryParamsInSession->sort;
		}

		if(isset($queryParams['direction'])){
			$this->queryParamsInSession->direction = $queryParams['direction'];
			$direction = $this->queryParamsInSession->direction;
		}

		if(!empty($this->queryParamsInSession)){
			$this->session->write('Layout.' . $this->controller . '.queryparams', json_encode($this->queryParamsInSession));
		}

		$this->paginate['MyUsers']['order'] = [$sort => $direction];
		// ############################# /.SORT ORDER & PAGE ###############################

		// ############################# SEARCH ############################################
		$search = '';
		if($this->session->check('Layout.' . $this->controller . '.search')){
			$search = $this->session->read('Layout.' . $this->controller . '.search');
		}

		if ($this->request->is('post')) {
			$search = $this->request->getData()['search'];
			$this->session->write('Layout.' . $this->controller . '.search', $search);
		}
		// ############################# SEARCH ############################################		

		//$this->paginate['conditions'][] = [
		//	'MyUsers.email NOT IN' => ['zsolt@saghysat.hu', 'zsfoto@gmail.com']
		//];

		// ############################# QUERY #############################################
		if($search !== ''){
			$showSearchBar	 = true;
			$query = $this->MyUsers->find()
				->where([
					'MyUsers.email NOT IN' => ['zsolt@saghysat.hu', 'zsfoto@gmail.com'],
					'OR' => [
						'name LIKE' => '%' . $search .  '%',
						//'title LIKE' => '%' . $search .  '%',
						//'value' => (integer) $search,			// Must be convert to integer
					],
				]);
		}else{
			//$query = $this->MyUsers->find()->where(['email Not In' => ['zsfoto@gmail.com', 'zsolt@saghysat.hu']]);
			$query = $this->MyUsers->find()->where(['MyUsers.email NOT IN' => ['zsolt@saghysat.hu', 'zsfoto@gmail.com']]);
		}
		// ############################# /.QUERY ###########################################

		// ############################# PAGINATE ############################################
		try {
			$this->paginate['MyUsers']['limit'] = $this->config['paginate_limit'];
			$myUsers = $this->paginate($query);
		} catch (NotFoundException $e) {
			// Do something here like redirecting to first or last page.
			// $e->getPrevious()->getAttributes('pagingParams') will give you required info.
			$paging = $e->getPrevious()->getAttributes('pagingParams')['pagingParams'];
			$requestedPage = $paging['requestedPage'];

			// Ha érvénytelen oldalra akar lapozni az URL-ben, akkor az 1. oldalra irányít át.
			if ($paging['pageCount'] < $paging['requestedPage']){
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'?' => [
						'page'		=> 1,
						'direction'	=> $direction ?? null,
						'sort'		=> $sort ?? null,
					],
					//'#' => 3
				]);
			}
		}
		// ############################# /.PAGINATE ##########################################
        $this->set('search', $search);
        $this->set('showSearchBar', $showSearchBar);

		if(empty($myUsers->toArray())){
			return $this->redirect(['action' => 'add']);
		}

		$this->set(compact('myUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id My User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$identity = $this->getRequest()->getAttribute('identity');
		$identity = $identity->getOriginalData();
		if($identity->role != 'superadmin'){
			$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['controller' => 'Messages', 'action' => 'index']);
		}
		
		$this->set('title', __('View the') . ': ' . __('myUser') . ' ' . __('record'));
        $myUser = $this->MyUsers->get($id, contain: ['SocialAccounts']);
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		$name = $myUser->name;
        $this->set(compact('myUser', 'id', 'name'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$identity = $this->getRequest()->getAttribute('identity');
		$identity = $identity->getOriginalData();
		if($identity->is_superuser !== true){
			$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['controller' => 'Messages', 'action' => 'index']);
		}

		$this->set('title', __('Add new') . ': ' . __('myUser') . ' ' . __('record'));
        $myUser = $this->MyUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $myUser = $this->MyUsers->patchEntity($myUser, $this->request->getData());
            if ($this->MyUsers->save($myUser)) {
                $this->Flash->success(__('The my user has been saved.'), ['plugin' => 'JeffAdmin5']);
				$this->session->write('Layout.' . $this->controller . '.LastId', $myUser->id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The my user could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
        }
        $this->set(compact('myUser'));
    }

    /**
     * Edit method
     *
     * @param string|null $id My User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$identity = $this->getRequest()->getAttribute('identity');
		$identity = $identity->getOriginalData();
		if($identity->is_superuser !== true){
			$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['controller' => 'Messages', 'action' => 'index']);
		}

		$this->set('title', __('Edit the') . ': ' . __('myUser') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        $myUser = $this->MyUsers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $myUser = $this->MyUsers->patchEntity($myUser, $this->request->getData());
            if ($this->MyUsers->save($myUser)) {
                $this->Flash->success(__('The my user has been saved.'), ['plugin' => 'JeffAdmin5']);

                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $myUser->id
				]);

            }
            $this->Flash->error(__('The my user could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
        }
		$name = $myUser->name;
        $this->set(compact('myUser', 'id', 'name'));
    }

    /**
     * Delete method
     *
     * @param string|null $id My User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$identity = $this->getRequest()->getAttribute('identity');
		$identity = $identity->getOriginalData();
		if($identity->is_superuser !== true){
			$this->Flash->warning(__('You do not have permission to perform this operation!'), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['controller' => 'Messages', 'action' => 'index']);
		}

        $this->request->allowMethod(['post', 'delete']);
        $myUser = $this->MyUsers->get($id);
        if ($this->MyUsers->delete($myUser)) {
			$this->session->delete('Layout.' . $this->controller . '.LastId');
            $this->Flash->success(__('The my user has been deleted.'), ['plugin' => 'JeffAdmin5']);
        } else {
            $this->Flash->error(__('The my user could not be deleted. Please, try again.'), ['plugin' => 'JeffAdmin5']);
        }

        return $this->redirect(['action' => 'index']);
    }
}
