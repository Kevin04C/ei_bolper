<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Proveedores Model
 *
 * @method \App\Model\Entity\Proveedore newEmptyEntity()
 * @method \App\Model\Entity\Proveedore newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Proveedore[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Proveedore get($primaryKey, $options = [])
 * @method \App\Model\Entity\Proveedore findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Proveedore patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Proveedore[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Proveedore|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Proveedore saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Proveedore[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Proveedore[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Proveedore[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Proveedore[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProveedoresTable extends Table
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

        $this->setTable('proveedores');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->hasOne('Usuario', [
            'bindingKey' => 'usuario_id',
            'foreignKey' => 'id_usuario',
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
            ->allowEmptyString('usuario_id');

        $validator
            ->scalar('ruc')
            ->maxLength('ruc', 11)
            ->allowEmptyString('ruc');
            
        $validator
            ->scalar('razon_social')
            ->maxLength('razon_social', 255)
            ->allowEmptyString('razon_social');

        $validator
            ->scalar('nombre_comercial')
            ->maxLength('nombre_comercial', 255)
            ->allowEmptyString('nombre_comercial');

        $validator
            ->scalar('descripcion')
            ->allowEmptyString('descripcion');

        $validator
            ->scalar('telefono')
            ->maxLength('telefono', 16)
            ->allowEmptyString('telefono');

        $validator
            ->scalar('correo')
            ->maxLength('correo', 128)
            ->allowEmptyString('correo');

        return $validator;
    }
}
