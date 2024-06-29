<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categoria Model
 *
 * @method \App\Model\Entity\Categorium newEmptyEntity()
 * @method \App\Model\Entity\Categorium newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Categorium[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Categorium get($primaryKey, $options = [])
 * @method \App\Model\Entity\Categorium findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Categorium patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Categorium[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Categorium|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Categorium saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Categorium[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Categorium[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Categorium[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Categorium[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CategoriaTable extends Table
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

        $this->setTable('categoria');
        $this->setDisplayField('id_categoria');
        $this->setPrimaryKey('id_categoria');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'fecha_creacion' => 'new',
                    'fecha_actualizacion' => 'always'
                ]
            ]
        ]);
        $this->hasMany('Producto',[
            'foreignKey' => 'categoria_id',
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
            ->scalar('nom_categoria')
            ->maxLength('nom_categoria', 60)
            ->requirePresence('nom_categoria', 'create')
            ->notEmptyString('nom_categoria');

        $validator
            ->scalar('desc_categoria')
            ->maxLength('desc_categoria', 4294967295)
            ->requirePresence('desc_categoria', 'create')
            ->notEmptyString('desc_categoria');

        return $validator;
    }
}
