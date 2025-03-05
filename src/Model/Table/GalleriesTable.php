<?php
declare(strict_types=1);

namespace App\Model\Table;


use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;


/**
 * Galleries Model
 *
 * @property \App\Model\Table\PhotosTable&\Cake\ORM\Association\HasMany $Photos
 *
 * @method \App\Model\Entity\Gallery newEmptyEntity()
 * @method \App\Model\Entity\Gallery newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Gallery> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Gallery get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Gallery findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Gallery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Gallery> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Gallery|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Gallery saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Gallery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Gallery>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Gallery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Gallery> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Gallery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Gallery>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Gallery>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Gallery> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GalleriesTable extends Table
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

        $this->setTable('galleries');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Photos', [
            'foreignKey' => 'gallery_id',
        ]);
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
            ->maxLength('name', 250)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible')
            ->add('visible', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['visible']), ['errorField' => '0']);

        return $rules;
    }
}
