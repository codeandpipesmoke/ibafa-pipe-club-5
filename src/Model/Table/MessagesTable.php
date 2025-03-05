<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\Session;

/**
 * Messages Model
 *
 * @method \App\Model\Entity\Message newEmptyEntity()
 * @method \App\Model\Entity\Message newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Message> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Message get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Message findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Message patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Message> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Message|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Message saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Message>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Message>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Message>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Message> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Message>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Message>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Message>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Message> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MessagesTable extends Table
{
	public $captcha = '';

    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('messages');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->captcha = (new Session())->read('captcha');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('subject')
            ->maxLength('subject', 200)
            ->requirePresence('subject', 'create')
            ->notEmptyString('subject');

        $validator
            ->scalar('captcha')
            ->maxLength('captcha', 10)
            ->requirePresence('captcha', 'create')
            ->notEmptyString('captcha');

        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

        $validator
            ->boolean('readed')
            ->notEmptyString('readed');

		$validator
            ->add('captcha', 'validCaptcha', [
                'rule' => 'isValidCaptcha',
                'message' => __('You entered a wrong security code'),
                'provider' => 'table',
            ]);	


        return $validator;
    }
	
    public function isValidCaptcha($value, array $context): bool
    {
		$value = strtoupper($value);
		return $value === $this->captcha;
    }
	
	//public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
	public function beforeSave($options = array())
	{
		$data = $options->getData()['entity'];
		if($data->readed){
			return true;
		} else {
			$data['captcha'] = $data['captcha'] !== null ? strtoupper($data['captcha']) : "";
			return $data->captcha === $this->captcha;			
		}
	}	
	
}

