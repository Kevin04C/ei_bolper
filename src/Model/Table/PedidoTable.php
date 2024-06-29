<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pedido Model
 *
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsTo $Usuario
 * @property \App\Model\Table\ProductoTable&\Cake\ORM\Association\BelongsTo $Producto
 * @property \App\Model\Table\DetallePedidoTable&\Cake\ORM\Association\HasMany $DetallePedido
 *
 * @method \App\Model\Entity\Pedido newEmptyEntity()
 * @method \App\Model\Entity\Pedido newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Pedido[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pedido get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pedido findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Pedido patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pedido[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pedido|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pedido saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PedidoTable extends Table
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

        $this->setTable('pedido');
        $this->setDisplayField('id_pedido');
        $this->setPrimaryKey('id_pedido');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
        // $this->belongsTo('Producto', [
        //     'foreignKey' => 'producto_id',
        //     'joinType' => 'INNER',
        // ]);
        $this->hasMany('DetallePedido', [
            'foreignKey' => 'pedido_id',
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
        //     ->integer('usuario_id')
        //     ->notEmptyString('usuario_id');

        // $validator
        //     ->integer('producto_id')
        //     ->notEmptyString('producto_id');

        // $validator
        //     ->integer('cantidad')
        //     ->requirePresence('cantidad', 'create')
        //     ->notEmptyString('cantidad');

        // $validator
        //     ->dateTime('fecha_orden')
        //     ->notEmptyDateTime('fecha_orden');

        // $validator
        //     ->scalar('metodo_pago')
        //     ->maxLength('metodo_pago', 60)
        //     ->requirePresence('metodo_pago', 'create')
        //     ->notEmptyString('metodo_pago');

        // $validator
        //     ->scalar('estado_orden')
        //     ->maxLength('estado_orden', 60)
        //     ->requirePresence('estado_orden', 'create')
        //     ->notEmptyString('estado_orden');

        return $validator;
    }
}
