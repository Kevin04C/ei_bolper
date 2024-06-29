<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DetallePedido Model
 *
 * @method \App\Model\Entity\DetallePedido newEmptyEntity()
 * @method \App\Model\Entity\DetallePedido newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DetallePedido[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DetallePedido get($primaryKey, $options = [])
 * @method \App\Model\Entity\DetallePedido findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DetallePedido patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DetallePedido[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DetallePedido|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetallePedido saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetallePedido[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DetallePedido[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DetallePedido[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DetallePedido[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DetallePedidoTable extends Table
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

        $this->setTable('detalle_pedido');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->belongsTo('Producto', [
            'foreignKey' => 'producto_id'
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
        //     ->nonNegativeInteger('pedido_id')
        //     ->allowEmptyString('pedido_id');

        // $validator
        //     ->nonNegativeInteger('producto_id')
        //     ->allowEmptyString('producto_id');

        // $validator
        //     ->numeric('pedido_cantidad')
        //     ->greaterThanOrEqual('pedido_cantidad', 0)
        //     ->allowEmptyString('pedido_cantidad');

        // $validator
        //     ->scalar('producto_nombre')
        //     ->maxLength('producto_nombre', 45)
        //     ->allowEmptyString('producto_nombre');

        // $validator
        //     ->numeric('producto_punitarioincigv')
        //     ->allowEmptyString('producto_punitarioincigv');

        // $validator
        //     ->numeric('producto_subtotal')
        //     ->allowEmptyString('producto_subtotal');

        // $validator
        //     ->numeric('pedido_igv')
        //     ->allowEmptyString('pedido_igv');

        // $validator
        //     ->numeric('producto_total')
        //     ->allowEmptyString('producto_total');

        return $validator;
    }
}
