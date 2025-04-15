<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Abouts Controller
 *
 * @property \App\Model\Table\AboutsTable $Abouts
 */
class AboutsController extends AppController
{
	public $Members		= null;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
		
		$this->Members = $this->fetchTable('Members');
	}

    /**
     * View method
     *
     * @param string|null $id About id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$breadcrumbs['title'] = __("About us");
		//$breadcrumbs['breadcrumb'][] = ['title' => $page->pagecategory->name, "controller" => "Pages", "action" => "index", $this->lang->slug, "param" => [$page->pagecategory->slug]];
		$breadcrumbs['breadcrumb']['title'] = __("About us");

        //$about = $this->Abouts->get($id, contain: []);
        $about = $this->about;

		$members = $this->Members->find()->where(['visible' => true])->order(['pos' => 'asc', 'name' => 'asc']);

        $this->set(compact('about', 'members', 'breadcrumbs'));
    }

}
