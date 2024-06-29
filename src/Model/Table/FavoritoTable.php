<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Favorito Model
 *
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsTo $Usuario
 * @property \App\Model\Table\ProductoTable&\Cake\ORM\Association\BelongsTo $Producto
 *
 * @method \App\Model\Entity\Favorito newEmptyEntity()
 * @method \App\Model\Entity\Favorito newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Favorito[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Favorito get($primaryKey, $options = [])
 * @method \App\Model\Entity\Favorito findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Favorito patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Favorito[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Favorito|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Favorito saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Favorito[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Favorito[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Favorito[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Favorito[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FavoritoTable extends Table
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

        $this->setTable('favorito');
        $this->setDisplayField('id_favorito');
        $this->setPrimaryKey('id_favorito');

        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Producto', [
            'foreignKey' => 'producto_id',
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
        $validator
            ->integer('usuario_id')
            ->notEmptyString('usuario_id');

        $validator
            ->integer('producto_id')
            ->notEmptyString('producto_id');

        $validator
            ->dateTime('fecha_publicacion')
            ->notEmptyDateTime('fecha_publicacion');

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
        $rules->add($rules->existsIn('usuario_id', 'Usuario'), ['errorField' => 'usuario_id']);
        $rules->add($rules->existsIn('producto_id', 'Producto'), ['errorField' => 'producto_id']);

        return $rules;
    }
}
