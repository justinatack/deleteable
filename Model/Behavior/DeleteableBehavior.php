<?php
/**
 * Copyright 2015 Justin Atack (http://www.justinatack.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2015 Justin Atack (http://www.justinatack.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Deleteable Plugin
 *
 * Deleteable Behavior
 *
 * @package Deleteable
 * @subpackage deletable.models.behaviors
 */
class DeleteableBehavior extends ModelBehavior
{

    /**
     * Configuration of model
     *
     * @param Model $model
     * @param array $settings
     * @return void
     */
    public function setup(Model $model, $settings = array())
    {
        if (!isset($this->settings[$model->alias])) {
            $this->settings[$model->alias] = array(
                'field' => 'delete',
                'boolean' => false
            );
        }
        $this->settings[$model->alias] = array_merge(
            $this->settings[$model->alias],
            (array)$settings
        );
    }

    /**
     * isDeleteable
     * @param Model  $model
     * @return boolean
     */
    public function isDeleteable($model)
    {
        $field = $this->settings[$model->alias]['field'];
        $boolean = $this->settings[$model->alias]['boolean'];

        $find = $model->find('first', ['conditions' => [$model->primaryKey => $model->id]]);

        if (isset($find[$model->alias][$field])) {
            return $find[$model->alias][$field] != $boolean;
        }

        return true;
    }

    /**
     * beforeDelete
     * @param  Model   $model
     * @param  boolean $cascade
     * @return boolean
     */
    public function beforeDelete(Model $model, $cascade = true)
    {
        return $this->isDeleteable($model);
    }
}
