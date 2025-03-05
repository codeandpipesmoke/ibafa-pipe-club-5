<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;

use CakeDC\Users\Model\Table\UsersTable;

/**
 * Users Model
 *
 * @property \App\Model\Table\SocialAccountsTable&\Cake\ORM\Association\HasMany $SocialAccounts
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\User> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\User> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MyUsersTable extends UsersTable
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        //$this->setAlias('MyUsers');
		
        $this->setTable('users');
		$this->setDisplayField(['last_name', 'first_name']);
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
		
		$this->addBehavior('JeffAdmin5.Datepicker');

        $this->addBehavior('CakeDC/Users.Register');
        $this->addBehavior('CakeDC/Users.Password');
        //$this->addBehavior('CakeDC/Users.Social');
        //$this->addBehavior('CakeDC/Users.LinkSocial');
        $this->addBehavior('CakeDC/Users.AuthFinder');
        //$this->hasMany('SocialAccounts', [
        //    'foreignKey' => 'user_id',
        //    'className' => 'CakeDC/Users.SocialAccounts',
        //]);
		//
        //$this->hasMany('SocialAccounts', [
        //    'foreignKey' => 'user_id',
        //]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
/*
        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->notEmptyString('username');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->allowEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->allowEmptyString('last_name');

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->allowEmptyString('token');

        $validator
            ->dateTime('token_expires')
            ->allowEmptyDateTime('token_expires');

        $validator
            ->scalar('api_token')
            ->maxLength('api_token', 255)
            ->allowEmptyString('api_token');

        $validator
            ->dateTime('activation_date')
            ->allowEmptyDateTime('activation_date');

        $validator
            ->scalar('secret')
            ->maxLength('secret', 32)
            ->allowEmptyString('secret');

        $validator
            ->boolean('secret_verified')
            ->allowEmptyString('secret_verified');

        $validator
            ->dateTime('tos_date')
            ->allowEmptyDateTime('tos_date');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        $validator
            ->boolean('is_superuser')
            ->notEmptyString('is_superuser');

        $validator
            ->scalar('role')
            ->maxLength('role', 255)
            ->allowEmptyString('role');

        $validator
            ->scalar('additional_data')
            ->allowEmptyString('additional_data');

        $validator
            ->dateTime('last_login')
            ->allowEmptyDateTime('last_login');
*/
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        //$rules->add($rules->isUnique(['username']), ['errorField' => '0']);
        //$rules->add($rules->isUnique(['email']), ['errorField' => '1']);
		
        if ($this->isValidateEmail) {
			$rules->add($rules->isUnique(['email']), [
				'errorField' => 'email',
				'message' => __d('CakeDC/Users', 'Email already exists')
			]);		
        }

        return $rules;
    }
}
