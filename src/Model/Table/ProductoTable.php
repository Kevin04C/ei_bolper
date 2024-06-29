<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Producto Model
 *
 * @property \App\Model\Table\DetallePedidoTable&\Cake\ORM\Association\HasMany $DetallePedido
 * @property \App\Model\Table\PedidoTable&\Cake\ORM\Association\HasMany $Pedido
 * @property \App\Model\Table\ReseñaTable&\Cake\ORM\Association\HasMany $Reseña
 *
 * @method \App\Model\Entity\Producto newEmptyEntity()
 * @method \App\Model\Entity\Producto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Producto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Producto get($primaryKey, $options = [])
 * @method \App\Model\Entity\Producto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Producto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Producto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Producto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Producto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Producto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Producto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Producto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Producto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProductoTable extends Table
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

        $this->setTable('producto');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Categoria', [
            'foreignKey' => 'categoria_id',
        ]);
      
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'fecha_creacion' => 'new',
                    'fecha_actualizacion' => 'always'
                ]
            ]
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
            ->integer('categoria_id')
            ->requirePresence('categoria_id', 'create')
            ->notEmptyString('categoria_id');


        $validator
            ->scalar('nom_producto')
            ->maxLength('nom_producto', 60)
            ->requirePresence('nom_producto', 'create')
            ->notEmptyString('nom_producto');

        $validator
            ->scalar('marca_producto')
            ->maxLength('marca_producto', 65)
            ->requirePresence('marca_producto', 'create')
            ->notEmptyString('marca_producto');

        $validator
            ->decimal('precio_producto')
            ->requirePresence('precio_producto', 'create')
            ->notEmptyString('precio_producto');

        $validator
            ->decimal('desc_producto')
            ->requirePresence('desc_producto', 'create')
            ->notEmptyString('desc_producto');

        $validator
            ->scalar('principal')
            ->requirePresence('principal', 'create')
            ->notEmptyString('principal');

        $validator
            ->scalar('general')
            ->requirePresence('general', 'create')
            ->notEmptyString('general');

        $validator
            ->scalar('imagen1')
            ->maxLength('imagen1', 150)
            ->requirePresence('imagen1', 'create')
            ->notEmptyString('imagen1');

        /*
        $validator
            ->scalar('imagen2')
            ->maxLength('imagen2', 150)
            ->requirePresence('imagen2', 'create')
            ->notEmptyFile('imagen2');

        $validator
            ->scalar('imagen3')
            ->maxLength('imagen3', 150)
            ->requirePresence('imagen3', 'create')
            ->notEmptyFile('imagen3');
        */
        // $validator
        //     ->scalar('Estado')
        //     ->maxLength('Estado', 70)
        //     ->requirePresence('Estado', 'create')
        //     ->notEmptyString('Estado');

        return $validator;
    }
}
