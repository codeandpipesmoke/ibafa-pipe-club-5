<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\Locator\TableLocator;

require_once(APP . "Controller" . DS . "Component" . DS . "SimplePay" . DS . 'SimplePay.php');
use SimplePay\SimplePay;

/**
 * SimplePay component
 */
class SimplePayComponent extends Component
{
    /**
     * Simplepay object vars.
     *
     * @var object
     */
	protected $SP = null;
	
    /**
     * Simplepays model.
     *
     * @var object
     */
	protected $SimplePays = null;
	
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [];
	
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
	public function initialize(array $config): void
    {
		$this->SP = new SimplePay;
		$tableLocator = new TableLocator();
		$this->Simplepays = $tableLocator->get('Simplepays');
    }	
	
    /**
     * SimplaPay start pay method
     *
     * @return void
     */
	public function pay(array $params)
    {
		$startResponse = $this->SP->start($params);
		return $startResponse['returnData'];
	}	
	
    /**
     * SimplaPay start pay method
     *
     * @return void
     */
	public function ipn()
    {
		$startResponse = $this->SP->ipn();
		return $startResponse['returnData'];
	}	
	
}
