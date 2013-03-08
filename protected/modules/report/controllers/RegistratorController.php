<?php

class RegistratorController extends Controller
{
	public function actionIndex()
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
                
                $this->render('index', array(
                    'model'=>$model,
                    'command'=>$command,
                ));

                Yii::app()->end();
            }
        }
        
        $this->render('index', array(
            'model'=>$model,
        ));
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