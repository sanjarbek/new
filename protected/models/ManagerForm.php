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
class ManagerForm extends CFormModel
{
    public $manager;
    public $hospital;
    public $doctor;
    public $year;
    public $month;
    
    public function attributeLabels()
    {
        return array(
            'manager'=>Yii::t('column', 'Менеджер'),
            'hospital'=>Yii::t('column', 'Больница'),
            'doctor'=>Yii::t('column', 'Доктор'),
            'year'=>Yii::t('column', 'Год'),
            'month'=>Yii::t('column', 'Месяц'),
        );
    }
    
    public function getYearsList()
    {
        $content = array();
        $content[0] = 'Все';
        for ($year = 2012; $year<2015; $year++)
            $content[$year] = $year;
        
        return $content;
    }
    
    public function getMonthsList()
    {
        $content = array();
        $content[0] = 'Все';
        $content[1] = 'Январь';
        $content[2] = 'Февраль';
        $content[3] = 'Март';
        $content[4] = 'Апрель';
        $content[5] = 'Май';
        $content[6] = 'Июнь';
        $content[7] = 'Июль';
        $content[8] = 'Август';
        $content[9] = 'Сентябрь';
        $content[10] = 'Октябрь';
        $content[11] = 'Ноябрь';
        $content[12] = 'Декабрь';
        
        return $content;
    }
    
    public function getDoctorsPerMonth($command)
    {
        $rawData = $command->queryAll();
        
        $data = array();
        
        $months = array_fill(1, 12, 0);

        foreach($rawData as $rawRow)
        {
            if (!array_key_exists($rawRow['doctorId'], $data))
            {
                $data[$rawRow['doctorId']] = $months + array(
                    'hospital'=>'',
                    'doctor'=>'',
                    'sum'=>0,
                );
            }
            $data[$rawRow['doctorId']]['hospital'] = $rawRow['hospital'];
            $data[$rawRow['doctorId']]['doctor'] = $rawRow['doctor'];
            $data[$rawRow['doctorId']][$rawRow['month']] = $rawRow['count'];
            $data[$rawRow['doctorId']]['sum'] += (int)$rawRow['count'];
        }
        
        return new CArrayDataProvider($data, array(
            'pagination'=>array(
                'pageSize'=>20,
            ),
            'keyField'=>'doctor',
        ));
    }
    public function getDoctorsPerMonthDay($days_count, $command)
    {
        $rawData = $command->queryAll();
        
        $data = array();
        $days_months = array_fill(1, $days_count, 0);
        
        foreach($rawData as $rawRow)
        {
            if (!array_key_exists($rawRow['doctorId'], $data))
            {
                $data[$rawRow['doctorId']] = $days_months + array(
                    'hospital'=>'',
                    'doctor'=>'',
                    'sum'=>0,
                );
            }
            $data[$rawRow['doctorId']]['hospital'] = $rawRow['hospital'];
            $data[$rawRow['doctorId']]['doctor'] = $rawRow['doctor'];
            $data[$rawRow['doctorId']][$rawRow['day']] = $rawRow['count'];
            $data[$rawRow['doctorId']]['sum'] += (int)$rawRow['count'];
        }
        
        return new CArrayDataProvider($data, array(
            'pagination'=>array(
                'pageSize'=>20,
            ),
            'keyField'=>'doctor',
        ));
    }
    
    public function getHospitalsPerMonth($command)
    {
        $rawData = $command->queryAll();
        
        $data = array();

        foreach($rawData as $rawRow)
        {
            if (!array_key_exists($rawRow['hospitalId'], $data))
            {
                $data[$rawRow['hospitalId']] = array(
                    'hospital'=>'',
                    'January'=>0,
                    'February'=>0,
                    'March'=>0,
                    'April'=>0,
                    'May'=>0,
                    'June'=>0,
                    'July'=>0,
                    'August'=>0,
                    'September'=>0,
                    'October'=>0,
                    'November'=>0,
                    'December'=>0,
                    'sum'=>0,
                );
            }
            $data[$rawRow['hospitalId']]['hospital'] = $rawRow['hospital'];
            $data[$rawRow['hospitalId']][$rawRow['month']] = $rawRow['count'];
            $data[$rawRow['hospitalId']]['sum'] += (int)$rawRow['count'];
        }
        
        return new CArrayDataProvider($data, array(
            'pagination'=>array(
                'pageSize'=>20,
            ),
            'keyField'=>'hospital',
        ));
    }
    public function getHospitalsPerMonthDay($days_count, $command)
    {
        $rawData = $command->queryAll();
        
        $data = array();
        
        $days_months = array_fill(1, $days_count, 0);
        
        foreach($rawData as $rawRow)
        {
            if (!array_key_exists($rawRow['hospitalId'], $data))
            {
                $data[$rawRow['hospitalId']] = $days_months + array(
                    'hospital'=>'',
                    'sum'=>0,
                );
            }
            $data[$rawRow['hospitalId']]['hospital'] = $rawRow['hospital'];
            $data[$rawRow['hospitalId']][$rawRow['day']] = $rawRow['count'];
            $data[$rawRow['hospitalId']]['sum'] += (int)$rawRow['count'];
        }
        
        return new CArrayDataProvider($data, array(
            'pagination'=>array(
                'pageSize'=>20,
            ),
            'keyField'=>'hospital',
        ));
    }

}

?>
