<?php
App::uses('ModelBehavior', 'Model');
class DeleteableBehavior extends ModelBehavior
{

    /**
     * Configuration of model
     *
     * @param Model $Model
     * @param array $settings
     * @return void
     */
    public function setup(Model $Model, $settings = array())
    {
        if (!isset($this->settings[$Model->alias])) {
            $this->settings[$Model->alias] = array(
                'field' => 'delete',
                'boolean' => false
            );
        }
        $this->settings[$Model->alias] = array_merge(
            $this->settings[$Model->alias],
            (array)$settings
        );
    }

    public function isDeleteable($Model) {
        $boolean = $this->settings[$Model->alias]['boolean'];
        $field = $this->settings[$Model->alias]['field'];

        $find = $Model->findById($Model->id);

        if ($find[$Model->alias][$field] == $boolean) {
            return false;
        }

        return true;
    }


    public function beforeDelete(Model $Model, $cascade = false)
    {
        return $this->isDeleteable($Model);
    }
}
