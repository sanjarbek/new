<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManagerForm
 *
 * @author Sanzharbek Amatov <asanjarbek@gmail.com>
 */
class RegistratorForm extends CFormModel
{
    public $registrator;
    public $range_date;
    public $start_date;
    public $end_date;
    
    public function rules()
    {
        return array(
            array('range_date, start_date, end_date', 'required'),
            array('start_date, end_date', 'date', 'format'=>'yyyy.mm.dd'),
            array('range_date', 'match', 'pattern'=>'/^\d{4}.\d{2}.\d{2}\s-\s\d{4}.\d{2}.\d{2}$/'),
        );
    }
    
    public function attributeLabels()
    {
        return array(
            'range_date'=>Yii::t('column', 'Интервал даты'),
            'start_date'=>Yii::t('column', 'Начало даты'),
            'end_date'=>Yii::t('column', 'Конец даты'),
            'registrator'=>  Yii::t('column', 'Регистратор'),
        );
    }
    
    public function getReport($command)
    {
        $rawData = $command->queryAll();
        
        $data = array();
        
        foreach($rawData as $rawRow)
        {
            if (!array_key_exists($rawRow['id'], $data))
            {
                $data[$rawRow['id']] = array(
                    'id'=>'',
                    'patient_name'=>'',
                    'patient_phone'=>'',
                    'hospital_name'=>'',
                    'doctor_name'=>'',
                    'doctor_phone'=>'',
                    'date'=>'',
                    'registration_count'=>'',
                    'total_price'=>'',
                    'total_discont'=>'',
                    'final_price'=>'',
                );
            }
            $data[$rawRow['id']]['patient_name'] = $rawRow['patient_name'];
            $data[$rawRow['id']]['patient_phone'] = $rawRow['patient_phone'];
            $data[$rawRow['id']]['hospital_name'] = $rawRow['hospital_name'];
            $data[$rawRow['id']]['doctor_name'] = $rawRow['doctor_name'];
            $data[$rawRow['id']]['doctor_phone'] = $rawRow['doctor_phone'];
            $data[$rawRow['id']]['date'] = $rawRow['date'];
            $data[$rawRow['id']]['registration_count'] = $rawRow['registration_count'];
            $data[$rawRow['id']]['total_price'] = $rawRow['total_price'];
            $data[$rawRow['id']]['total_discont'] = $rawRow['total_discont'];
            $data[$rawRow['id']]['final_price'] = $rawRow['final_price'];
            
        }
        
        return new CArrayDataProvider($data, array(
            'pagination'=>array(
                'pageSize'=>100,
            ),
            'keyField'=>'id',
        ));
    }
    

}

?>
