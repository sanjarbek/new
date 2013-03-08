<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReportController
 *
 * @author Sanzharbek Amatov <asanjarbek@gmail.com>
 */
class ReportController extends Controller
{
    public $layout='//layouts/column1';
    
    public function filters()
	{
		return CMap::mergeArray(parent::filters(), array(
            array( 
                'application.filters.GridViewHandler',
            ),
		));
	}
    
    public function actionManager()
    {
        $model = new ManagerForm();
        
        if (isset($_POST['ManagerForm']))
        {
            $model->manager = isset($_POST['ManagerForm']['manager'])?$_POST['ManagerForm']['manager']: 0;
            $model->hospital = isset($_POST['ManagerForm']['hospital'])?$_POST['ManagerForm']['hospital']: 0;
            $model->doctor = isset($_POST['ManagerForm']['doctor'])?$_POST['ManagerForm']['doctor']: 0;
            $model->year = isset($_POST['ManagerForm']['year'])?$_POST['ManagerForm']['year']: 0;
            $model->month = isset($_POST['ManagerForm']['month'])?$_POST['ManagerForm']['month']: 0;
        }
        else
        {
            $model->manager = 0;
            $model->hospital = 0;
            $model->doctor = 0;
            $model->year = 0;
            $model->month = 0;
        }
        
        // Если выбран один из больниц
        if ((int)$model->hospital != 0)
        {
            // Если выбран один из докторов
            if ((int)$model->doctor != 0)
            {
                if ($model->year!=0)
                {
                    if ($model->month!=0)
                    {
                        $sql = 'SELECT h.shortname as hospital, 
                        d.id as doctorId, 
                        d.fullname as doctor, 
                        day(p.created_at) as day, 
                        count(p.doctor_id) as count 
                        FROM hospitals h  JOIN doctors d on (h.id=d.hospital_id) 
                        LEFT JOIN (select * from patients where month(patients.created_at)=:month and year(patients.created_at)=:year) p ON d.id=p.doctor_id
WHERE h.manager_id=:manager and h.id=:hospital and d.id=:doctor
GROUP BY h.shortname, d.id, d.fullname, day(p.created_at)';
                        $days_count_month = cal_days_in_month(CAL_GREGORIAN, $model->month, $model->year);
                        
                        $command = Yii::app()->db->createCommand($sql);
                        $command->bindValue(':month', $model->month);
                        $command->bindValue(':year', $model->year);
                        $command->bindValue(':manager', $model->manager);
                        $command->bindValue(':hospital', $model->hospital);
                        $command->bindValue(':doctor', $model->doctor);
        
                        $this->render('manager/index', array(
                            'model'=>$model,
                            'command'=>$command,
                            'days_count'=>$days_count_month,
                            'view' => 3,
                        ));
                        Yii::app()->end();
                    }
                    else // Выбрана опция Все для месяца
                    {
                        $sql = 'SELECT h.shortname as hospital, 
                        d.id as doctorId, 
                        d.fullname as doctor, 
                        month(p.created_at) as month, 
                        count(p.doctor_id) as count 
                        FROM hospitals h  JOIN doctors d on (h.id=d.hospital_id) 
                        LEFT JOIN (select * from patients where year(patients.created_at)=:year) p ON d.id=p.doctor_id
WHERE h.manager_id=:manager and h.id=:hospital and d.id=:doctor
GROUP BY h.shortname, d.id, d.fullname, month(p.created_at)';
                        $command = Yii::app()->db->createCommand($sql);;
                        $command->bindValue(':year', $model->year);
                        $command->bindValue(':manager', $model->manager);
                        $command->bindValue(':hospital', $model->hospital);
                        $command->bindValue(':doctor', $model->doctor);
                        $this->render('manager/index', array(
                            'model'=>$model,
                            'command'=>$command,
                            'view' => 4,
                        ));
                        Yii::app()->end();
                    }
                }
                else // Если выбрана опция Все для годов
                {
                    $sql = 'SELECT h.shortname as hospital, 
                    d.id as doctorId, 
                    d.fullname as doctor, 
                    month(p.created_at) as month, 
                    count(p.doctor_id) as count 
                    FROM hospitals h  JOIN doctors d on (h.id=d.hospital_id) 
                    LEFT JOIN (select * from patients) p ON d.id=p.doctor_id
WHERE h.manager_id=:manager and h.id=:hospital and d.id=:doctor
GROUP BY h.shortname, d.id, d.fullname, month(p.created_at)';
                    $command = Yii::app()->db->createCommand($sql);
                    $command->bindValue(':manager', $model->manager);
                    $command->bindValue(':hospital', $model->hospital);
                    $command->bindValue(':doctor', $model->doctor);
                    
                    $this->render('manager/index', array(
                        'model'=>$model,
                        'command'=>$command,
                        'view' => 4,
                    ));
                    Yii::app()->end();
                }
                    
            } 
            else // Если выбрана опция Все для докторов
            {
                if ($model->year!=0)
                {
                    if ($model->month!=0)
                    {
                        $sql = 'SELECT h.shortname as hospital, 
                            d.id as doctorId, 
                            d.fullname as doctor, 
                            day(p.created_at) as day, 
                            count(p.doctor_id) as count 
                            FROM hospitals h  JOIN doctors d on (h.id=d.hospital_id) 
                            LEFT JOIN (select * from patients where month(patients.created_at)=:month and year(patients.created_at)=:year) p ON d.id=p.doctor_id
    WHERE h.manager_id=:manager and h.id=:hospital
    GROUP BY h.shortname, d.id, d.fullname, day(p.created_at)';
                        $days_count_month = cal_days_in_month(CAL_GREGORIAN, $model->month, $model->year);
                        $command = Yii::app()->db->createCommand($sql);
                        $command->bindValue(':month', $model->month);
                        $command->bindValue(':year', $model->year);
                        $command->bindValue(':manager', $model->manager);
                        $command->bindValue(':hospital', $model->hospital);
                        
                        $this->render('manager/index', array(
                            'model'=>$model,
                            'command'=>$command,
                            'days_count'=>$days_count_month,
                            'view' => 3,
                        ));
                        Yii::app()->end();
                    }
                    else
                    {
                        $sql = 'SELECT h.shortname as hospital, 
                            d.id as doctorId, 
                            d.fullname as doctor, 
                            month(p.created_at) as month, 
                            count(p.doctor_id) as count 
                            FROM hospitals h  JOIN doctors d on (h.id=d.hospital_id) 
                            LEFT JOIN (select * from patients where year(patients.created_at)=:year) p ON d.id=p.doctor_id
    WHERE h.manager_id=:manager and h.id=:hospital
    GROUP BY h.shortname, d.id, d.fullname, month(p.created_at)';
                        
                        $command = Yii::app()->db->createCommand($sql);
                        
                        $command->bindValue(':year', $model->year);
                        $command->bindValue(':manager', $model->manager);
                        $command->bindValue(':hospital', $model->hospital);
                        
                        $this->render('manager/index', array(
                            'model'=>$model,
                            'command'=>$command,
                            'view' => 4,
                        ));
                        Yii::app()->end();
                    }
                }
                else
                {
                    $sql = 'SELECT h.shortname as hospital, 
                        d.id as doctorId, 
                        d.fullname as doctor, 
                        month(p.created_at) as month, 
                        count(p.doctor_id) as count 
                        FROM hospitals h  JOIN doctors d on (h.id=d.hospital_id) 
                        LEFT JOIN (select * from patients ) p ON d.id=p.doctor_id
WHERE h.manager_id=:manager and h.id=:hospital
GROUP BY h.shortname, d.id, d.fullname, month(p.created_at)';
                    
                    $command = Yii::app()->db->createCommand($sql);
                    $command->bindValue(':manager', $model->manager);
                    $command->bindValue(':hospital', $model->hospital);

                    $this->render('manager/index', array(
                        'model'=>$model,
                        'command'=>$command,
                        'view' => 4,
                    ));
                    Yii::app()->end();
                }
                
            }
        }
        else // Если выбрана опция Все для больниц
        {
            // Если выбран один из годов
            if ((int)$model->year != 0)
            {
                if ((int)$model->month!=0)
                {
                    $sql = 'SELECT h.id as hospitalId,
                        h.shortname as hospital, 
                        day(p.created_at) as day, 
                        count(p.doctor_id) as count 
                        FROM hospitals h LEFT JOIN doctors d 
                            on (h.id=d.hospital_id) 
                            LEFT JOIN (SELECT * FROM patients 
                            WHERE year(patients.created_at)=:year and month(patients.created_at)=:month)  p 
                            ON d.id=p.doctor_id
                        WHERE h.manager_id=:manager
                        GROUP BY h.id, h.shortname,  day(p.created_at)
                            ';  
                    $days_count_month = cal_days_in_month(CAL_GREGORIAN, $model->month, $model->year);
                    
                    $command = Yii::app()->db->createCommand($sql);
                    $command->bindValue(':month', $model->month);
                    $command->bindValue(':year', $model->year);
                    $command->bindValue(':manager', $model->manager);
                    
                    $this->render('manager/index', array(
                        'model'=>$model,
                        'command'=>$command,
                        'days_count'=>$days_count_month,
                        'view' => 1,
                    ));
                    Yii::app()->end();
                }
                else
                {
                    $sql = 'SELECT 
                        h.id as hospitalId,
                        h.shortname as hospital, 
                        MONTHNAME(p.created_at) as month, 
                        count(p.doctor_id) as count 
                        FROM hospitals h LEFT JOIN doctors d 
                            on (h.id=d.hospital_id) 
                            LEFT JOIN (SELECT * FROM patients 
                            WHERE year(patients.created_at)=:year)  p 
                            ON d.id=p.doctor_id
                        WHERE h.manager_id=:manager
                        GROUP BY h.id, h.shortname,  MONTHNAME(p.created_at)
                            ';  
                    $command = Yii::app()->db->createCommand($sql);
                    $command->bindValue(':manager', $model->manager);
                    $command->bindValue(':year', $model->year);
                    
                    $this->render('manager/index', array(
                        'model'=>$model,
                        'command'=>$command,
                        'view' => 2,
                    ));
                    Yii::app()->end();
                }
                
            }
            else // Если выбрана опция Все для годов
            {
                $sql = 'SELECT 
                    h.id as hospitalId,
                    h.shortname as hospital, 
                    MONTHNAME(p.created_at) as month, 
                    count(p.doctor_id) as count 
                    FROM hospitals h LEFT JOIN doctors d 
                        on (h.id=d.hospital_id) 
                        LEFT JOIN patients p 
                        ON d.id=p.doctor_id
                    WHERE h.manager_id=:manager
                    GROUP BY h.id, h.shortname,  MONTHNAME(p.created_at)
                        ';
                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(':manager', $model->manager);
                
                $this->render('manager/index', array(
                    'model'=>$model,
                    'command'=>$command,
                    'view'=>2,
                ));
                
                Yii::app()->end();
            }
            
        }
    }
    
    public function actionRegistrator()
    {
        $model = new RegistratorForm();
        
        if (isset($_POST['RegistratorForm']))
        {
            $model->range_date = isset($_POST['RegistratorForm']['range_date']) ? $_POST['RegistratorForm']['range_date'] : 0;
            $model->registrator = isset($_POST['RegistratorForm']['registrator']) ? $_POST['RegistratorForm']['registrator'] : 0;
            
            
            if($model->validate(array('range_date')))
            {
                $items = explode('-', $model->range_date);
                $model->start_date = trim($items[0]);
                $model->end_date = trim($items[1]);
                
                $sql = '';
                if (!Yii::app()->user->isSuperUser && Yii::app()->user->checkAccess('Registrator'))
                {
                    $model->registrator = Yii::app ()->user->id;
                    
                    $sql = "SELECT
                                p.id,
                                p.fullname AS  'patient_name',
                                p.phone AS 'patient_phone',
                                h.shortname AS 'hospital_name',
                                d.fullname AS 'doctor_name',
                                d.phone AS 'doctor_phone',
                                date(p.created_at) AS 'date',
                                count(r.id) AS 'registration_count',
                                sum(r.price) AS 'total_price',
                                sum(r.discont) AS 'total_discont',
                                sum(r.price_with_discont) AS 'final_price'
                            FROM
                                patients p
                            LEFT JOIN registrations r ON (p.id = r.patient_id)
                            LEFT JOIN doctors d ON (p.doctor_id = d.id)
                            LEFT JOIN hospitals h ON (d.hospital_id = h.id)
                            WHERE
                                p.created_user=:registrator AND
                                date(p.created_at) between :start_date 
                                AND  :end_date
                            GROUP BY
                                p.fullname,
                                p.created_at";

                    $command = Yii::app()->db->createCommand($sql);
                    $command->bindValue(':start_date', $model->start_date);
                    $command->bindValue(':end_date', $model->end_date);
                    $command->bindValue(':registrator', $model->registrator);
                }
                else
                {
                    if ($model->registrator == 0)
                    {
                        $sql = "SELECT
                                    p.id,
                                    p.fullname AS  'patient_name',
                                    p.phone AS 'patient_phone',
                                    h.shortname AS 'hospital_name',
                                    d.fullname AS 'doctor_name',
                                    d.phone AS 'doctor_phone',
                                    date(p.created_at) AS 'date',
                                    count(r.id) AS 'registration_count',
                                    sum(r.price) AS 'total_price',
                                    sum(r.discont) AS 'total_discont',
                                    sum(r.price_with_discont) AS 'final_price'
                                FROM
                                    patients p
                                LEFT JOIN registrations r ON (p.id = r.patient_id)
                                LEFT JOIN doctors d ON (p.doctor_id = d.id)
                                LEFT JOIN hospitals h ON (d.hospital_id = h.id)
                                WHERE
                                    date(p.created_at) between :start_date 
                                    AND  :end_date
                                GROUP BY
                                    p.fullname,
                                    p.created_at";

                        $command = Yii::app()->db->createCommand($sql);
                        $command->bindValue(':start_date', $model->start_date);
                        $command->bindValue(':end_date', $model->end_date);
                    }
                    else
                    {
                        $sql = "SELECT
                                    p.id,
                                    p.fullname AS  'patient_name',
                                    p.phone AS 'patient_phone',
                                    h.shortname AS 'hospital_name',
                                    d.fullname AS 'doctor_name',
                                    d.phone AS 'doctor_phone',
                                    date(p.created_at) AS 'date',
                                    count(r.id) AS 'registration_count',
                                    sum(r.price) AS 'total_price',
                                    sum(r.discont) AS 'total_discont',
                                    sum(r.price_with_discont) AS 'final_price'
                                FROM
                                    patients p
                                LEFT JOIN registrations r ON (p.id = r.patient_id)
                                LEFT JOIN doctors d ON (p.doctor_id = d.id)
                                LEFT JOIN hospitals h ON (d.hospital_id = h.id)
                                WHERE
                                    p.created_user=:registrator AND
                                    date(p.created_at) between :start_date 
                                    AND  :end_date
                                GROUP BY
                                    p.fullname,
                                    p.created_at";

                        $command = Yii::app()->db->createCommand($sql);
                        $command->bindValue(':start_date', $model->start_date);
                        $command->bindValue(':end_date', $model->end_date);
                        $command->bindValue(':registrator', $model->registrator);
                    }
                }
                
                $this->render('registrator/index', array(
                    'model'=>$model,
                    'command'=>$command,
                ));

                Yii::app()->end();
            }
        }
        
        $this->render('registrator/index', array(
            'model'=>$model,
        ));
    }
}

?>
