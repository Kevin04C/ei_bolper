<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Resena Model
 *
 * @property \App\Model\Table\ProductoTable&\Cake\ORM\Association\BelongsTo $Producto
 *
 * @method \App\Model\Entity\Resena newEmptyEntity()
 * @method \App\Model\Entity\Resena newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Resena[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Resena get($primaryKey, $options = [])
 * @method \App\Model\Entity\Resena findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Resena patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Resena[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Resena|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Resena saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Resena[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Resena[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Resena[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Resena[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ResenaTable extends Table
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

        $this->setTable('resena');
        $this->setDisplayField('id_resena');
        $this->setPrimaryKey('id_resena');

        $this->belongsTo('Producto', [
            'foreignKey' => 'producto_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
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
        // $validator
        //     ->integer('producto_id')
        //     ->notEmptyString('producto_id');

        // $validator
        //     ->scalar('nombre')
        //     ->maxLength('nombre', 64)
        //     ->requirePresence('calidad', 'create')
        //     ->notEmptyString('calidad');

        // $validator
        //     ->integer('valor')
        //     ->requirePresence('valor', 'create')
        //     ->notEmptyString('valor');

        // $validator
        //     ->scalar('nombre')
        //     ->maxLength('nombre', 100)
        //     ->requirePresence('nombre', 'create')
        //     ->notEmptyString('nombre');

        // $validator
        //     ->scalar('resumen')
        //     ->maxLength('resumen', 100)
        //     ->requirePresence('resumen', 'create')
        //     ->notEmptyString('resumen');

        // $validator
        //     ->scalar('revision')
        //     ->maxLength('revision', 4294967295)
        //     ->requirePresence('revision', 'create')
        //     ->notEmptyString('revision');

        // $validator
        //     ->dateTime('fecha_revision')
        //     ->notEmptyDateTime('fecha_revision');

        return $validator;
    }

}
