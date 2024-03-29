<?php

class ManagerController extends Controller
{
	public function actionIndex()
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
        
                        $this->render('index', array(
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
                        $this->render('index', array(
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
                    
                    $this->render('index', array(
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
                        
                        $this->render('index', array(
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
                        
                        $this->render('index', array(
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

                    $this->render('index', array(
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
                    
                    $this->render('index', array(
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
                    
                    $this->render('index', array(
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
                
                $this->render('index', array(
                    'model'=>$model,
                    'command'=>$command,
                    'view'=>2,
                ));
                
                Yii::app()->end();
            }
            
        }
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}