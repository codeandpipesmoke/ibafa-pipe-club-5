<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($param = null)
    {
		$posts 		= null;
		$recently 	= null;
		$news 		= null;

		if($param == 'blog'){
			// Posts
			try {
				$conditions	= ['visible' => true];
				$order = ['pos' => 'asc', 'created' => 'desc'];
				$query = $this->Posts->find()->where($conditions)->order($order);
			} catch (NotFoundException $e) {
				// Do something here like redirecting to first or last page.
				// $e->getPrevious()->getAttributes('pagingParams') will give you required info.
			}

			try {
				$this->paginate['limit'] = 5;
				$posts = $this->paginate($query);
			} catch (NotFoundException $e) {
				// Do something here like redirecting to first or last page.
				// $e->getPrevious()->getAttributes('pagingParams') will give you required info.
			}

			$breadcrumbs['title'] = __("Blog");
			//$breadcrumbs['breadcrumb'][] = ['title' => $page->pagecategory->name, "controller" => "Pages", "action" => "index", $this->lang->slug, "param" => [$page->pagecategory->slug]];
			$breadcrumbs['breadcrumb']['title'] = __("Blog");
		}

		if($param == 'news'){
			// News on Home
			try {
				$conditions	= ['show_in_main_page' => true, 'visible' => true];
				$order = ['pos' => 'asc', 'created' => 'desc'];
				$query = $this->Posts->find()->where($conditions)->order($order)->limit(3);
			} catch (NotFoundException $e) {
				// Do something here like redirecting to first or last page.
				// $e->getPrevious()->getAttributes('pagingParams') will give you required info.
			}

			try {
				$this->paginate['limit'] = 5;
				$posts = $this->paginate($query);
			} catch (NotFoundException $e) {
				// Do something here like redirecting to first or last page.
				// $e->getPrevious()->getAttributes('pagingParams') will give you required info.
			}

			$breadcrumbs['title'] = __("Home");
			//$breadcrumbs['breadcrumb'][] = ['title' => $page->pagecategory->name, "controller" => "Pages", "action" => "index", $this->lang->slug, "param" => [$page->pagecategory->slug]];
			$breadcrumbs['breadcrumb']['title'] = __("News");
		}


		// Recently on sidebar
		try {
			$query = $this->Posts->find()->where($conditions)->order($order)->limit(5);
		} catch (NotFoundException $e) {
			// Do something here like redirecting to first or last page.
			// $e->getPrevious()->getAttributes('pagingParams') will give you required info.
		}

		try {
			$recently = $this->paginate($query);
		} catch (NotFoundException $e) {
			// Do something here like redirecting to first or last page.
			// $e->getPrevious()->getAttributes('pagingParams') will give you required info.
		}

		// SET
        $this->set(compact('posts', 'recently', 'news', 'breadcrumbs'));
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $post = $this->Posts->find()->where(['slug' => $slug])->first();
		if($post == null){
			$this->redirect('/');
		}
        $this->set(compact('post'));
    }

}
