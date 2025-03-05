<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;
use Cake\Filesystem\File;
use Cake\Utility\Text;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{
	public $path 			= "";
	public $imageWidth		= 0;
	public $thumbnailWidth 	= 0;
	
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		//$this->config['paginate_limit'] = 1000;
		
		$this->path = WWW_ROOT . 'img' . DS . 'blog' . DS;
		if (!is_dir($this->path)) {
			mkdir($this->path, 0755, true);
		}

		$this->imageWidth = 1024;
		$this->thumbnailWidth = 80;
	}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($clearFilter = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.index', 
		//	array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.index'), 
		//		['back' => false, 'add' => true, 'edit' => false, 'save' => false, 'view' => false, 'delete' => false]
		//	)
		//);

		$this->set('title', __('Browse the') . ': ' . __('Posts'));
		
		//$this->config['paginate_limit'] = 1000;
		$queryParams = $this->request->getQuery();
		$conditions 	 = [];		// Default conditions
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

		// ############################# SORT ORDER & PAGE ###############################
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

		if($page === null){
			return $this->redirect(['controller' => $this->controller, 'action' => 'index', '?' => array_merge(['page' => 1], $queryParams) ]);
		}

		$this->paginate['Posts']['page'] 	= $page;
		
		if($sort !== null && $direction !== null){
			$this->paginate['Posts']['order'] 	= [$sort => $direction];
		}else{
			$this->paginate['Posts']['order'] 	= [$this->defaultOrder];
		}
		
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
		// ############################# /.SEARCH ############################################		

		// ############################# QUERY #############################################
		if($search !== ''){
			$showSearchBar	 = true;
			$query = $this->Posts->find()
				->contain(['MyUsers'])
				->where([
					//$conditions,
					'OR' => [
						'name LIKE' => '%' . $search .  '%',
						//'title LIKE' => '%' . $search .  '%',
						//'value' => (integer) $search,			// Must be convert to integer
					]
				]);
		}else{
			$query = $this->Posts->find()->contain(['MyUsers'])->where($conditions);
		}
		// ############################# /.QUERY ###########################################


		// ############################# PAGINATE ############################################
		try {
			$this->paginate['Posts']['limit'] = $this->config['paginate_limit'];
			$this->paginate['Posts']['maxLimit'] = $this->config['paginate_limit'];
			$posts = $this->paginate($query);
		} catch (NotFoundException $e) {
			// Do something here like redirecting to first or last page.
			// $e->getPrevious()->getAttributes('pagingParams') will give you required info.
			$this->Flash->warning(__($e->getMessage()), ['plugin' => 'JeffAdmin5']);
			$paging = $e->getPrevious()->getAttributes('pagingParams')['pagingParams'];
			$requestedPage = $paging['requestedPage'];

			// HU: Ha érvénytelen oldalra akar lapozni az URL-ben, akkor az 1. oldalra irányít át.
			// EN: If you want to page to an invalid page in the URL, it redirects to page 1.
			if ($paging['pageCount'] < $paging['requestedPage']){
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'?' => [
						'page'		=> $paging['pageCount'],
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

		if(empty($posts->toArray())){
			return $this->redirect(['action' => 'add']);
		}
		
		$this->set(compact('posts'));
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.view', 
		//	array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.view'), 
		//		['back' => true, 'add' => true, 'edit' => true, 'save' => false, 'view' => false, 'delete' => true]
		//	)
		//);

		try {
			$post = $this->Posts->get((int) $id, contain: ['MyUsers']);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title', __('View the') . ': ' . __('post') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
		$name = $post->name;
		$this->set(compact('post', 'id', 'name'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.add', 
		//	array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.add'), 
		//		['back' => true, 'add' => false, 'edit' => false, 'save' => true, 'view' => false, 'delete' => false]
		//	)
		//);
		
		$this->set('title', __('Add new') . ': ' . __('post') . ' ' . __('record'));
        $post = $this->Posts->newEmptyEntity();
        if ($this->request->is('post')) {
			$data = $this->request->getData();
			//debug($data);
            $post = $this->Posts->patchEntity($post, $data);
			$file = $this->request->getData('image');
			//debug($post);
			//die();
			$post->user_id = $this->request->getAttribute('identity')->get('id');

			if(!($file && !$file->getError())) {
				$post->setError('image', __('Please select an image file!'));
			}

            if (!$post->hasErrors() && $this->Posts->save($post)) {
				// Ellenőrizzük, hogy történt-e fájl feltöltés
				if ($file && !$file->getError()) {
					$tmpFileName = $post->id . '_tmp.jpg';

					//$post->ext 		= strtolower(pathinfo((string) $file->getClientFilename(), PATHINFO_EXTENSION));
					//$post->filename = (string) $post->id . '_' . strtolower(Text::slug(pathinfo((string) $file->getClientFilename(), PATHINFO_FILENAME), '_')) . '.' . $post->ext;
					//$fileNameWithPath = $this->path . $post->filename;
					//$thumbnailFileName = (string) $post->id . '_' . strtolower(Text::slug(pathinfo((string) $file->getClientFilename(), PATHINFO_FILENAME), '_')) . '_thumbnail.' . $post->ext;

					$post->ext 		= strtolower(pathinfo((string) $file->getClientFilename(), PATHINFO_EXTENSION));
					$post->filename = (string) $post->id . '_' . strtolower(Text::slug($post->name, '_')) . '.' . $post->ext;
					$fileNameWithPath = $this->path . $post->filename;
					$thumbnailFileName = (string) $post->id . '_' . strtolower(Text::slug($post->name, '_')) . '_thumbnail.' . $post->ext;

					$this->Posts->updateAll(['filename' => $post->filename, 'thumbnail' => $thumbnailFileName, 'ext' => $post->ext], ['id' => $post->id]);

					$thumbnailFileNameWithPath = $this->path . $thumbnailFileName;
					
					// Fájl mentési helye
					if(file_exists($tmpFileName)){
						unlink($tmpFileName);
					}
					$file->moveTo($tmpFileName);

					// Átméretezés kicsire
					$source = imagecreatefromjpeg($tmpFileName);
					list($width, $height) = getimagesize($tmpFileName);
					$newHeight 	= (int) (($height / $width) * $this->imageWidth);
					$img = imagecreatetruecolor($this->imageWidth, $newHeight);
					imagecopyresized($img, $source, 0, 0, 0, 0, $this->imageWidth, $newHeight, $width, $height);
					imagejpeg($img, $fileNameWithPath, 40);

					$newHeight 	= (int) (($height / $width) * $this->thumbnailWidth);
					$thumb = imagecreatetruecolor($this->thumbnailWidth, $newHeight);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $this->thumbnailWidth, $newHeight, $width, $height);
					imagejpeg($thumb, $thumbnailFileNameWithPath, 20);
					// /.Átméretezés kicsire

					if(file_exists($tmpFileName)){ 
						unlink($tmpFileName);
					}
				
					//$this->Flash->success(__('The post has been saved.'), ['plugin' => 'JeffAdmin5']);
					$this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);
					$this->session->write('Layout.' . $this->controller . '.LastId', $post->id);

					//return $this->redirect(['action' => 'add']);
					return $this->redirect([
						'controller' => $this->controller,
						'action' => 'index',
						'#' => $post->id
					]);				
				}

/*
                //$this->Flash->success(__('The post has been saved.'), ['plugin' => 'JeffAdmin5']);
                $this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);
				$this->session->write('Layout.' . $this->controller . '.LastId', $post->id);

                //return $this->redirect(['action' => 'add']);
                return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $post->id
				]);
*/

            }
            //$this->Flash->error(__('The post could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
            $this->Flash->error(__('The save has been not. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }
        $myUsers = $this->Posts->MyUsers->find('list', conditions: ['visible' => true], limit: 200, order: ['pos' => 'asc', 'first_name' => 'asc', 'last_name' => 'asc'])->all();
		
		//dd($myUsers->toArray());
		
        $this->set(compact('post', 'myUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		//Configure::write('Theme.admin.config.header_buttons_in_action.edit', 
		//	array_merge(Configure::read('Theme.admin.config.header_buttons_in_action.edit'), 
		//		['back' => true, 'add' => true, 'edit' => false, 'save' => true, 'view' => true, 'delete' => true]
		//	)
		//);

		try {
			$post = $this->Posts->get((int) $id, contain: ['MyUsers']);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}
		$oldName = $post->name;

		$this->set('title', __('Edit the') . ': ' . __('post') . ' ' . __('record'));
		$this->session->write('Layout.' . $this->controller . '.LastId', $id);
			
		if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->getData();
			//debug($data);
			$post = $this->Posts->patchEntity($post, $data);
			$file = $this->request->getData('image');
			//dd($file);
			//debug($post);
			//die();
			$post->user_id = $this->request->getAttribute('identity')->get('id');

			$isDirtyName = false;
			if($post->isDirty('name')){
				$isDirtyName = true;
			}

			//if(!($file && !$file->getError())) {
			//	$post->setError('image', __('Please select an image file!'));
			//}

            if (!$post->hasErrors() && $this->Posts->save($post)) {
				
				if ($isDirtyName) {
					$ext 		= 'jpg';	//strtolower(pathinfo((string) $file->getClientFilename(), PATHINFO_EXTENSION));
					
					$oldFilename 	= (string) $post->id . '_' . strtolower(Text::slug($oldName, '_')) . '.' . $ext;
					$oldFileNameWithPath = $this->path . $oldFilename;
					$filename 	= (string) $post->id . '_' . strtolower(Text::slug($post->name, '_')) . '.' . $ext;
					$fileNameWithPath = $this->path . $filename;					
					try {
						rename($oldFileNameWithPath, $fileNameWithPath);
					} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
						$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
						return $this->redirect(['action' => 'index']);
					}

					$oldThumbnailFileName = (string) $post->id . '_' . strtolower(Text::slug($oldName, '_')) . '_thumbnail.' . $ext;
					$oldThumbnailFileNameWithPath = $this->path . $oldThumbnailFileName;
					$thumbnailFileName = (string) $post->id . '_' . strtolower(Text::slug($post->name, '_')) . '_thumbnail.' . $ext;
					$thumbnailFileNameWithPath = $this->path . $thumbnailFileName;
					try {
						rename($oldThumbnailFileNameWithPath, $thumbnailFileNameWithPath);
					} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
						$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
						return $this->redirect(['action' => 'index']);
					}
					//debug($oldThumbnailFileNameWithPath);
					//dd($thumbnailFileNameWithPath);
				}				
				
				// Ellenőrizzük, hogy történt-e fájl feltöltés
				if ($file && !$file->getError()) {
					$fileNameWithPath = (string) $this->path . $post->id . '_' . str_replace("-", "_", $post->slug) . '.' . $post->ext;
					$thumbnailFileName = (string) $this->path . $post->id . '_' . str_replace("-", "_", $post->slug) . '_thumbnail.' . $post->ext;
					if(file_exists($fileNameWithPath)){
						unlink($fileNameWithPath);
					}
					if(file_exists($thumbnailFileName)){
						unlink($thumbnailFileName);
					}
					
					$tmpFileName = $post->id . '_tmp.jpg';

					//$post->ext 		= strtolower(pathinfo((string) $file->getClientFilename(), PATHINFO_EXTENSION));
					//$post->filename = (string) $post->id . '_' . strtolower(Text::slug(pathinfo((string) $file->getClientFilename(), PATHINFO_FILENAME), '_')) . '.' . $post->ext;
					//$fileNameWithPath = $this->path . $post->filename;
					//$thumbnailFileName = (string) $post->id . '_' . strtolower(Text::slug(pathinfo((string) $file->getClientFilename(), PATHINFO_FILENAME), '_')) . '_thumbnail.' . $post->ext;

					$post->ext 		= strtolower(pathinfo((string) $file->getClientFilename(), PATHINFO_EXTENSION));
					$post->filename = (string) $post->id . '_' . strtolower(Text::slug($post->name, '_')) . '.' . $post->ext;
					$fileNameWithPath = $this->path . $post->filename;
					$thumbnailFileName = (string) $post->id . '_' . strtolower(Text::slug($post->name, '_')) . '_thumbnail.' . $post->ext;

					$this->Posts->updateAll(['filename' => $post->filename, 'thumbnail' => $thumbnailFileName, 'ext' => $post->ext], ['id' => $post->id]);

					$thumbnailFileNameWithPath = $this->path . $thumbnailFileName;
					
					// Fájl mentési helye
					if(file_exists($tmpFileName)){
						unlink($tmpFileName);
					}
					$file->moveTo($tmpFileName);

					// Átméretezés kicsire
					$source = imagecreatefromjpeg($tmpFileName);
					list($width, $height) = getimagesize($tmpFileName);
					$newHeight 	= (int) (($height / $width) * $this->imageWidth);
					$img = imagecreatetruecolor($this->imageWidth, $newHeight);
					imagecopyresized($img, $source, 0, 0, 0, 0, $this->imageWidth, $newHeight, $width, $height);
					imagejpeg($img, $fileNameWithPath, 40);

					$newHeight 	= (int) (($height / $width) * $this->thumbnailWidth);
					$thumb = imagecreatetruecolor($this->thumbnailWidth, $newHeight);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $this->thumbnailWidth, $newHeight, $width, $height);
					imagejpeg($thumb, $thumbnailFileNameWithPath, 20);
					// /.Átméretezés kicsire

					if(file_exists($tmpFileName)){ 
						unlink($tmpFileName);
					}
				
					//$this->Flash->success(__('The post has been saved.'), ['plugin' => 'JeffAdmin5']);
					$this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);
					$this->session->write('Layout.' . $this->controller . '.LastId', $post->id);

					//return $this->redirect(['action' => 'add']);
					return $this->redirect([
						'controller' => $this->controller,
						'action' => 'index',
						'#' => $post->id
					]);				
				}
			}

/*
			//debug($post);
			//die();
			if ($this->Posts->save($post)) {
				//$this->Flash->success(__('The post has been saved.'), ['plugin' => 'JeffAdmin5']);
				$this->Flash->success(__('The save has been: OK'), ['plugin' => 'JeffAdmin5']);

				//return $this->redirect(['action' => 'index']);
				return $this->redirect([
					'controller' => $this->controller,
					'action' => 'index',
					'#' => $post->id
				]);

			}
*/

			//$this->Flash->error(__('The post could not be saved. Please, try again.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->error(__('The save has been not. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
        }
        $myUsers = $this->Posts->MyUsers->find('list', conditions: ['visible' => true], limit: 200, order: ['pos' => 'asc', 'first_name' => 'asc', 'last_name' => 'asc'])->all();
		$name = $post->name;
        $this->set(compact('post', 'myUsers', 'id', 'name'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$this->request->allowMethod(['post', 'delete']);

		try {
			$post = $this->Posts->get((int) $id);
		} catch (\Cake\Datasource\Exception\RecordNotFoundException $exeption) {
			$this->Flash->warning(__($exeption->getMessage()), ['plugin' => 'JeffAdmin5']);
			return $this->redirect(['action' => 'index']);
		}
		$fileNameWithPath = (string) $this->path . $post->id . '_' . str_replace("-", "_", $post->slug) . '.' . $post->ext;
		$thumbnailFileName = (string) $this->path . $post->id . '_' . str_replace("-", "_", $post->slug) . '_thumbnail.' . $post->ext;
		
		//debug($fileNameWithPath);
		//dd($thumbnailFileName);

		if ($this->Posts->delete($post)) {
			if(file_exists($fileNameWithPath)){
				unlink($fileNameWithPath);
			}
			if(file_exists($thumbnailFileName)){
				unlink($thumbnailFileName);
			}
			$this->session->delete('Layout.' . $this->controller . '.LastId');
			//$this->Flash->success(__('The post has been deleted.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->success(__('The has been deleted.'), ['plugin' => 'JeffAdmin5']);
		} else {
			//$this->Flash->error(__('The post could not be deleted. Please, try again.'), ['plugin' => 'JeffAdmin5']);
			$this->Flash->error(__('The has been deleted. Please check the datas and try again.'), ['plugin' => 'JeffAdmin5']);
		}

        return $this->redirect(['action' => 'index']);
    }
}
