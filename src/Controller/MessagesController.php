<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Cake\Core\Configure;

//use Cake\Utility\Text;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 */
class MessagesController extends AppController
{
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
		$this->loadComponent('Captcha');

	}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		//$about = $this->fetchTable('Abouts')->find('all', conditions: ['id' => 1])->first();
        $message = $this->Messages->newEmptyEntity();
		//dd($message);

        if ($this->request->is('post')) {
			$error = false;
			$data = $this->request->getData();
			
            $message = $this->Messages->patchEntity($message, $data);
			if(!$error){
				if ($this->Messages->save($message)) {

					// Send confirmation Email...
					//$lang = $this->lang;
					//if(!isset($this->lang) || null === $this->lang){
					//	$lang = 'hu';			
					//}
					$template = $this->fetchTable('Emailtemplates')->find('all', conditions: ['lang' => $lang, 'slug' => 'message-confirmation'])->first();
					
					
					// -------------- Visszaigazolás a feladónak ----------------------
					$confirmation_mailer = new Mailer('default');
					
					$confirmation_mailer->setFrom([$about->email => $about->name])
						->setEmailFormat('html')
						->setTo($message->email)
						->setSubject($template->title);
						

					try {
						if($confirmation_mailer->deliver($template->body)){
							//$this->Flash->success(__('The message has been sent.'));
						}else{
							//$this->Flash->error(__('The message could not be sent. Please, try again.'));
						}
					} catch (\Exception $e) {
						$this->Flash->error($e->getMessage());						
					}					
					

					// ------------ a cégnek ---------------
					$mailer = new Mailer('default');
					$mailer->setFrom([$message->email => $message->name])
						->setEmailFormat('html')
						->setTo($about->email)
						->setSubject('Üzenet a weboldalról');

					$body  = "<h4><span style='font-weight: bold;'>Tárgy:</span> <span style='font-weight: normal;'>" . $message->subject . "</span></h4>";
					$body .= "<span style='font-weight: bold;'>Üzenet:</span><br>\n<span style='font-weight: bold;'>" . str_replace("\n", "<br>", $message->body) . "</span><br>\n";;
					
					try {
						if($mailer->deliver($body)){
							$this->Flash->success(__('The message has been sent.'));
						}else{
							$this->Flash->error(__('The message could not be sent. Please, try again.'));
						}
					} catch (\Exception $e) {
						$this->Flash->error($e->getMessage());						
					}					

					
					return $this->redirect(['action' => 'add', $lang]);

				}
				$this->Flash->error(__('The message could not be sent. Please, try again.'));
			}
        }
		$captcha = $this->Captcha->generateCaptcha(3);

		$breadcrumbs['title'] = __("Contact");
		//$breadcrumbs['breadcrumb'][] = ['title' => $page->pagecategory->name, "controller" => "Pages", "action" => "index", $this->lang->slug, "param" => [$page->pagecategory->slug]];
		$breadcrumbs['breadcrumb']['title'] = __("Contact");

        $this->set(compact('message', 'captcha', 'breadcrumbs'));
    }


}
