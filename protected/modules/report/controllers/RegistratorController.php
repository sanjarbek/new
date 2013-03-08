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
            $model->export_type = isset($_POST['RegistratorForm']['export_type']) ? $_POST['RegistratorForm']['export_type'] : 1;
            
            
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
                
                if ($model->export_type == RegistratorForm::EXPORT_EXCEL)
                {
                    $this->exportToExcel($command);
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
    
    public function exportToExcel($command)
    {
        $array_data_provider = RegistratorForm::getReport($command);
        
        $this->widget('ext.EExcelView',array(
            'dataProvider'=>$array_data_provider,
            'grid_mode'=>'export',
            'exportType'=> 'Excel2007',
//            'exportType'=> 'CSV',
            'columns'=>array(
                array(
                    'name'=>'patient_name',
                    'header'=>'ФИО',
                ),
                array(
                    'name'=>'patient_phone',
                    'header'=>'Тел. пациента',
                ),
                array(
                    'name'=>'hospital_name',
                    'header'=>'Название больницы',
                ),
                array(
                    'name'=>'doctor_name',
                    'header'=>'ФИО доктора',
                ),
                array(
                    'name'=>'doctor_phone',
                    'header'=>'Тел. доктора',
                ),
                array(
                    'name'=>'date',
                    'header'=>'Дата регистрации',
                ),
                array(
                    'name'=>'registration_count',
                    'header'=>'Количество',
                ),
                array(
                    'name'=>'total_price',
                    'header'=>'Сумма',
                ),
                array(
                    'name'=>'total_discont',
                    'header'=>'Скидка',
                ),
                array(
                    'name'=>'final_price',
                    'header'=>'Конечная сумма',
                ),
            ),
        ));
        
        Yii::app()->end();
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