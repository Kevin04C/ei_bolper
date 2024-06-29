<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuario Model
 *
 * @property \App\Model\Table\PedidoTable&\Cake\ORM\Association\HasMany $Pedido
 *
 * @method \App\Model\Entity\Usuario newEmptyEntity()
 * @method \App\Model\Entity\Usuario newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuario findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsuarioTable extends Table
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

        $this->setTable('usuario');
        $this->setDisplayField('id_usuario');
        $this->setPrimaryKey('id_usuario');

        // establecemos un comportamiento para las fechas
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'fecha_creacion' => 'new',
                    'fecha_actualizacion' => 'always'
                ]
            ]
        ]);
        $this->hasMany('Pedido', [
            'foreignKey' => 'usuario_id',
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
        //     ->scalar('nom_usuario')
        //     ->maxLength('nom_usuario', 60)
        //     ->requirePresence('nom_usuario', 'create')
        //     ->notEmptyString('nom_usuario');

        // $validator
        //     ->scalar('correo_usuario')
        //     ->maxLength('correo_usuario', 60)
        //     ->requirePresence('correo_usuario', 'create')
        //     ->notEmptyString('correo_usuario');

        // $validator
        //     ->requirePresence('telef_usuario', 'create')
        //     ->notEmptyString('telef_usuario');

        // $validator
        //     ->scalar('contrasena')
        //     ->maxLength('contrasena', 20)
        //     ->requirePresence('contrasena', 'create')
        //     ->notEmptyString('contrasena');

        // $validator
        //     ->scalar('direccion')
        //     ->maxLength('direccion', 4294967295)
        //     ->requirePresence('direccion', 'create')
        //     ->notEmptyString('direccion');

        // $validator
        //     ->scalar('departamento')
        //     ->maxLength('departamento', 60)
        //     ->requirePresence('departamento', 'create')
        //     ->notEmptyString('departamento');

        // $validator
        //     ->integer('codigo_postal')
        //     ->requirePresence('codigo_postal', 'create')
        //     ->notEmptyString('codigo_postal');

        // $validator
        //     ->scalar('tipo')
        //     ->maxLength('tipo', 16)
        //     ->notEmptyString('tipo');

        return $validator;
    }

}
