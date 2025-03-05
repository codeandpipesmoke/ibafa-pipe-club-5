<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Texts Model
 *
 * @method \App\Model\Entity\Text newEmptyEntity()
 * @method \App\Model\Entity\Text newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Text> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Text get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Text findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Text patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Text> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Text|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Text saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Text>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Text>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Text>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Text> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Text>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Text>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Text>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Text> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TextsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('texts');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('lang')
            ->maxLength('lang', 5)
            ->notEmptyString('lang');

        $validator
            ->scalar('name')
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 250)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('title')
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('body')
            ->maxLength('body', 4294967295)
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->notEmptyString('pos');

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
        $rules->add($rules->isUnique(['slug']), ['errorField' => 'slug']);

        return $rules;
    }
}
