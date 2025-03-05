<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 */
class MessagesController extends AppController
{

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($clearFilter = null)
    {
		Configure::write('Theme.admin.config.header_buttons_in_action.index', 
			array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.index'), 
				['back' => false, 'add' => false, 'edit' => false, 'save' => false, 'view' => false, 'delete' => false]
			)
		);

		$this->set('title', __('Browse the') . ': ' . __('Messages'));

		$queryParams = $this->request->getQuery();
		$page 		 	 = '1';
		$sort 		 	 = 'readed';
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

		$this->paginate['Messages']['order'] = [$sort => $direction];
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

		// ############################# QUERY #############################################
		if($search !== ''){
			$showSearchBar	 = true;
			$query = $this->Messages->find()
				->where([
					'OR' => [
						'name LIKE' => '%' . $search .  '%',
						//'title LIKE' => '%' . $search .  '%',
						//'value' => (integer) $search,			// Must be convert to integer
					]
				]);
		}else{
			$query = $this->Messages->find();
		}
		// ############################# /.QUERY ###########################################


		// ############################# PAGINATE ############################################
		try {
			$this->paginate['Messages']['limit'] = $this->config['paginate_limit'];
			$messages = $this->paginate($query);
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
		
		$this->set(compact('messages'));		
    }

    /**
     * View method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		Configure::write('Theme.admin.config.header_buttons_in_action.view', 
			array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.view'), 
				['back' => true, 'add' => false, 'edit' => false, 'save' => false, 'view' => false, 'delete' => true]
			)
		);

		$this->set('title', __('View the') . ': ' . __('message') . ' ' . __('record'));
        $message = $this->Messages->get($id, contain: []);
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		$name = $message->name;
		
		$message = $this->Messages->patchEntity($message, ['readed' => 1]);	// true volt, de a tárhelyen nem mentődött. Így hát 1-es lett.
		$this->Messages->save($message);
		
        $this->set(compact('message', 'id', 'name'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		Configure::write('Theme.admin.config.header_buttons_in_action.index', 
			array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.index'), 
				['back' => false, 'add' => false, 'edit' => false, 'save' => false, 'view' => false, 'delete' => false]
			)
		);

		//$this->Flash->success(__('The message has been saved.'), ['plugin' => 'JeffAdmin5']);
		return $this->redirect(['action' => 'index']);

		$this->set('title', __('Add new') . ': ' . __('message') . ' ' . __('record'));
        $message = $this->Messages->newEmptyEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'), ['plugin' => 'JeffAdmin5']);
				$this->session->write('Layout.' . $this->controller . '.LastId', $message->id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
        }
        $this->set(compact('message'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		Configure::write('Theme.admin.config.header_buttons_in_action.index', 
			array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.index'), 
				['back' => false, 'add' => false, 'edit' => false, 'save' => false, 'view' => false, 'delete' => false]
			)
		);

		$this->set('title', __('Edit the') . ': ' . __('message') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		
        $message = $this->Messages->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $message = $this->Messages->patchEntity($message, $this->request->getData());
            if ($this->Messages->save($message)) {
                $this->Flash->success(__('The message has been saved.'), ['plugin' => 'JeffAdmin5']);

                //return $this->redirect(['action' => 'index']);
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $message->id
				]);

            }
            $this->Flash->error(__('The message could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
        }
		$name = $message->name;
        $this->set(compact('message', 'id', 'name'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		//$this->Flash->error(__('Forbidden function!'), ['plugin' => 'JeffAdmin5']);
		//return $this->redirect(['action' => 'index']);
		
        $this->request->allowMethod(['post', 'delete']);
        $message = $this->Messages->get($id);
        if ($this->Messages->delete($message)) {
			$this->session->delete('Layout.' . $this->controller . '.LastId');
            $this->Flash->success(__('The message has been deleted.'), ['plugin' => 'JeffAdmin5']);
        } else {
            $this->Flash->error(__('The message could not be deleted. Please, try again.'), ['plugin' => 'JeffAdmin5']);
        }

        return $this->redirect(['action' => 'index']);
    }
}
