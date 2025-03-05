<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Texts Controller
 *
 * @property \App\Model\Table\TextsTable $Texts
 */
class TextsController extends AppController
{
    /**
     * View method
     *
     * @param string|null $id Text id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        //$text = $this->Texts->get($id, contain: []);
        $text = $this->Texts->find()->where(['slug' => $slug])->first();
		
		if($text === null){
			$this->Flash->error(__('Wrong address!'));
			return $this->redirect("/");
		}		

		$breadcrumbs['title'] = $text->name;
		//$breadcrumbs['breadcrumb'][] = ['title' => $page->pagecategory->name, "controller" => "Pages", "action" => "index", $this->lang->slug, "param" => [$page->pagecategory->slug]];
		$breadcrumbs['breadcrumb']['title'] = $text->name;

        $this->set(compact('text'));
    }


/*
    public function viewById($id)
    {
        $text = $this->Texts->get($id, contain: []);
		
		if($text === null){
			$this->Flash->error(__('Wrong address!'));
			return $this->redirect("/hu");
		}		

		$breadcrumbs['title'] = $text->name;
		//$breadcrumbs['breadcrumb'][] = ['title' => $page->pagecategory->name, "controller" => "Pages", "action" => "index", $this->lang->slug, "param" => [$page->pagecategory->slug]];
		$breadcrumbs['breadcrumb']['title'] = $text->name;

        $this->set(compact('text'));
    }

    public function ajax($lang = 'hu', $slug = null, $secret = null)
    {
		if($secret !== null){
			die('Error: 1');
		}
		if($slug === null){
			die('Error: 2');
		}
		if ($this->request->is('ajax')) {
			$this->viewBuilder()->setClassName('Ajax');

			$text = $this->Texts->find()->select(['title', 'body'])->where(['lang' => $lang, 'slug' => $slug])->first();
			if($text !== null){
				echo json_encode($text);				
			}else{
				die('<!-- Error: missing text -->');
			}
		}
		die('');
    }
*/

}
