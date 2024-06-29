<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subcategoria Model
 *
 * @method \App\Model\Entity\Subcategorium newEmptyEntity()
 * @method \App\Model\Entity\Subcategorium newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Subcategorium[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subcategorium get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subcategorium findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Subcategorium patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subcategorium[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subcategorium|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subcategorium saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subcategorium[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subcategorium[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subcategorium[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subcategorium[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SubcategoriaTable extends Table
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

        $this->setTable('subcategoria');
        $this->setDisplayField('id_subcategoria');
        $this->setPrimaryKey('id_subcategoria');
        $this->belongsTo('Categoria', [
            'foreignKey' => 'id_categoria',
            'bindingKey' => 'id_categoria',
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
            ->integer('id_categoria')
            ->requirePresence('id_categoria', 'create')
            ->notEmptyString('id_categoria');

        $validator
            ->scalar('nom_subcategoria')
            ->maxLength('nom_subcategoria', 60)
            ->requirePresence('nom_subcategoria', 'create')
            ->notEmptyString('nom_subcategoria');

        return $validator;
    }
}
