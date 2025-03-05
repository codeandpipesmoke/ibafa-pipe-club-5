<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Abouts Model
 *
 * @method \App\Model\Entity\About newEmptyEntity()
 * @method \App\Model\Entity\About newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\About> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\About get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\About findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\About patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\About> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\About|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\About saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\About>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\About>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\About>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\About> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\About>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\About>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\About>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\About> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AboutsTable extends Table
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

        $this->setTable('abouts');
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
            ->scalar('title')
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('subtitle')
            ->requirePresence('subtitle', 'create')
            ->notEmptyString('subtitle');

        $validator
            ->scalar('title_1')
            ->maxLength('title_1', 250)
            ->requirePresence('title_1', 'create')
            ->notEmptyString('title_1');

        $validator
            ->scalar('text_1')
            ->maxLength('text_1', 255)
            ->requirePresence('text_1', 'create')
            ->notEmptyString('text_1');

        $validator
            ->scalar('title_2')
            ->maxLength('title_2', 250)
            ->requirePresence('title_2', 'create')
            ->notEmptyString('title_2');

        $validator
            ->scalar('text_2')
            ->maxLength('text_2', 255)
            ->requirePresence('text_2', 'create')
            ->notEmptyString('text_2');

        $validator
            ->scalar('title_3')
            ->maxLength('title_3', 250)
            ->requirePresence('title_3', 'create')
            ->notEmptyString('title_3');

        $validator
            ->scalar('text_3')
            ->maxLength('text_3', 255)
            ->requirePresence('text_3', 'create')
            ->notEmptyString('text_3');

        $validator
            ->scalar('title_4')
            ->maxLength('title_4', 250)
            ->requirePresence('title_4', 'create')
            ->notEmptyString('title_4');

        $validator
            ->scalar('text_4')
            ->maxLength('text_4', 255)
            ->requirePresence('text_4', 'create')
            ->notEmptyString('text_4');

        $validator
            ->nonNegativeInteger('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->requirePresence('pos', 'create')
            ->notEmptyString('pos');

        return $validator;
    }
}
