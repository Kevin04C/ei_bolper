<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Configuraciones Model
 *
 * @method \App\Model\Entity\Configuracione newEmptyEntity()
 * @method \App\Model\Entity\Configuracione newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Configuracione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Configuracione get($primaryKey, $options = [])
 * @method \App\Model\Entity\Configuracione findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Configuracione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Configuracione[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Configuracione|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Configuracione saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Configuracione[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Configuracione[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Configuracione[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Configuracione[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ConfiguracionesTable extends Table
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

        $this->setTable('configuraciones');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('varname')
            ->maxLength('varname', 255)
            ->allowEmptyString('varname');

        $validator
            ->scalar('varvalue')
            ->maxLength('varvalue', 255)
            ->allowEmptyString('varvalue');

        return $validator;
    }
}
