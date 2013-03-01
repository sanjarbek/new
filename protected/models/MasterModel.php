<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterModel
 *
 * @author sanzhar
 */
abstract class MasterModel extends CActiveRecord{
    //put your code here
    protected function beforeValidate()
    {
        if ($this->isNewRecord) // only if adding new record
        {
            if ($this->hasAttribute('created_at')) // if model have created_at field
                $this->created_at = new CDbExpression('NOW()'); // set created_at value
            if ($this->hasAttribute('created_user'))
                $this->created_user = Yii::app()->user->id;
            if ($this->hasAttribute('user_id'))
                $this->user_id = Yii::app()->user->id;
        }
        if ($this->hasAttribute('updated_at')) // if model have updated_at field
            $this->updated_at = new CDbExpression('NOW()'); // set updated_at value
        if ($this->hasAttribute('updated_user'))
            $this->updated_user = Yii::app()->user->id;

        return parent::beforeValidate();
    }
}

?>
