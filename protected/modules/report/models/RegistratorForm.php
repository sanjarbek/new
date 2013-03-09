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
    const EXPORT_HTML = 1;
    const EXPORT_EXCEL = 2;

    public $registrator;
    public $range_date;
    public $start_date;
    public $end_date;
    public $export_type;
    
    public function rules()
    {
        return array(
            array('registrator, range_date, start_date, end_date', 'required'),
            array('start_date, end_date', 'date', 'format'=>'yyyy.mm.dd'),
            array('range_date', 'match', 'pattern'=>'/^\d{4}.\d{2}.\d{2}\s-\s\d{4}.\d{2}.\d{2}$/'),
            array('export_type', 'in', 'range'=>array(
                self::EXPORT_HTML,
                self::EXPORT_EXCEL,
            )),
        );
    }
    
    public function attributeLabels()
    {
        return array(
            'range_date'=>Yii::t('column', 'Интервал даты'),
            'start_date'=>Yii::t('column', 'Начало даты'),
            'end_date'=>Yii::t('column', 'Конец даты'),
            'registrator'=>  Yii::t('column', 'Регистратор'),
            'export_type' => Yii::t('column', 'Тип показа'),
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
            
            $data[$rawRow['id']]['id'] = $rawRow['id'];
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
        
        $data = array_merge(array(), $data);
        
        return new CArrayDataProvider($data, array(
            'pagination'=>array(
                'pageSize'=>1000000,
            ),
            'keyField'=>'id',
        ));
    }
    
    public function getExportOptions()
    {
        return array(
            self::EXPORT_HTML => 'HTML',
            self::EXPORT_EXCEL => 'Excel',
        );
    }

}

?>
