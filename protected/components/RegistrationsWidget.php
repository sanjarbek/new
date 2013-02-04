<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PatientMrtscanRegistrationsWidget
 *
 * @author Sanzharbek Amatov <asanjarbek@gmail.com>
 */
class RegistrationsWidget extends CWidget
{
    public $patient_id;
    
    public function run() 
    {
        $dataProvider=new CActiveDataProvider('Registration', array(
            'criteria'=>array(
                'condition'=>'patient_id=' . $this->patient_id,
                'with'=>array('mrtscan'),
            ),
            'pagination'=>array(
                'route'=>Yii::app()->createUrl('/registration/patientregistrations', array('pid'=>$this->patient_id)),
            ),
            'sort'=>array(
                'route'=>Yii::app()->createUrl('/registration/patientregistrations', array('pid'=>$this->patient_id)),
            ),
        ));
		$this->render('_registrationsgv',array(
			'dataProvider'=>$dataProvider,
            'pid'=>$this->patient_id,
		));
    }
}

?>
