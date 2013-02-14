<?php

/**
 * This is the model class for table "patients".
 *
 * The followings are the available columns in table 'patients':
 * @property integer $id
 * @property string $fullname
 * @property string $phone
 * @property string $birthday
 * @property integer $sex
 * @property integer $status
 * @property integer $doctor_id
 * @property integer $report
 * @property integer $desc_doctor_id
 * @property integer $payment Description
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 *
 * The followings are the available model relations:
 * @property Doctors $doctor
 * @property Registrations[] $registrations
 */
class Patient extends MasterModel
{
    const STATUS_NOT_FINISHED = 0;
    const STATUS_FINISHED = 1;
    const STATUS_CANCELED = 2;
    
    const SEX_MALE = 0;
    const SEX_FEMALE = 1;
    
    const REPORT_NOT_FINISHED = 0;
    const REPORT_FINISHED = 1;
    
    const PAYMENT_IS_NOT_MADE = 0;
    const PAYMENT_IS_MADE = 1;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'patients';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fullname, phone, birthday, sex, status, doctor_id, created_at, updated_at, created_user, updated_user', 'required'),
			array('sex, status, doctor_id, created_user, updated_user', 'numerical', 'integerOnly'=>true),
			array('fullname', 'length', 'max'=>30),
			array('phone', 'length', 'max'=>20),
            array('birthday', 'date', 'format'=>'yyyy-mm-dd'),
            array('doctor_id', 
                'exist', 
                'allowEmpty' => false,
                'attributeName' => 'id',
                'className' => 'Doctor',
                'message' => 'The specified doctor does not exist.',
                'skipOnError'=>false,
            ),
            array('status', 'in', 'range'=>array(
                self::STATUS_NOT_FINISHED,
                self::STATUS_FINISHED,
                self::STATUS_CANCELED,
            )),
            array('sex', 'in', 'range'=>array(
                self::SEX_MALE,
                self::SEX_FEMALE,
            )),
            array('report', 'in', 'range'=>array(
                self::REPORT_NOT_FINISHED,
                self::REPORT_FINISHED,
            )),
            array('payment', 'in', 'range'=>array(
                self::PAYMENT_IS_NOT_MADE,
                self::PAYMENT_IS_MADE,
            )),
//            array('desc_doctor_id',
//                'exist',
//                'allowEmpty' => false,
//                'attributeName' => 'id', 
//                'className' => 'User',
//                'message' => Yii::t('message', 'The selected doctor does not exist'),
//                'skipOnError'=>false,
//            ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fullname, phone, birthday, sex, status, doctor_id, created_at, updated_at, created_user, updated_user', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'doctor' => array(self::BELONGS_TO, 'Doctor', 'doctor_id', 'alias'=>'d'),
			'registrations' => array(self::HAS_MANY, 'Registration', 'patient_id', 'alias'=>'reg'),
            'creator'=>array(self::BELONGS_TO, 'User', 'created_user'),
            'updater'=>array(self::BELONGS_TO, 'User', 'updated_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fullname' => 'ФИО',
			'phone' => 'Телефон',
			'birthday' => 'Дата рождения',
			'sex' => 'Пол',
			'status' => 'Статус',
			'doctor_id' => 'Доктор',
            'report' => 'Заключение',
            'desc_doctor_id' => 'Описавщий доктор',
            'payment' => 'Оплата',
			'created_at' => 'Регистрация',
			'updated_at' => 'Дата редактирования',
			'created_user' => 'Регистрировал',
			'updated_user' => 'Редактировал',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.fullname',$this->fullname,true);
		$criteria->compare('t.phone',$this->phone,true);
		$criteria->compare('t.birthday',$this->birthday,true);
		$criteria->compare('t.sex',$this->sex);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.doctor_id',$this->doctor_id);
        $criteria->compare('t.report', $this->report);
        $criteria->compare('t.desc_doctor_id', $this->desc_doctor_id);
		$criteria->compare('t.created_at',$this->created_at,true);
		$criteria->compare('t.updated_at',$this->updated_at,true);
		$criteria->compare('t.created_user',$this->created_user);
		$criteria->compare('t.updated_user',$this->updated_user);

        Yii::log('WWW : ' . $this->created_at, CLogger::LEVEL_INFO);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'t.created_at desc',
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Patient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getStatusOptions()
    {
        return array(
            self::STATUS_NOT_FINISHED => Yii::t('status', 'Не закончено'),
            self::STATUS_FINISHED => Yii::t('status', 'Закончено'),
            self::STATUS_CANCELED => Yii::t('status', 'Отменено'),
        );
    }

    public function getStatusText()
    {
        $status_options = $this->getStatusOptions();
        return isset($status_options[$this->status])
            ? $status_options[$this->status]
            : (Yii::t('status', 'Unknown status ') . $this->status);
    }
    
    public function getReportStatusOptions()
    {
        return array(
            self::REPORT_NOT_FINISHED=>  Yii::t('status', 'Еще не закончено'),
            self::REPORT_FINISHED=> Yii::t('status', 'Закончено'),
        );
    }
    
    public function getReportStatusText()
    {
        $report_options = $this->getReportStatusOptions();
        return isset($report_options[$this->report])
            ? $report_options[$this->report]
            : (Yii::t('status', 'Неизвестный статус ')) . $this->report;
    }    
    
    public function getPaymentOptions()
    {
        return array(
            self::PAYMENT_IS_NOT_MADE => Yii::t('status', 'Не оплатил'),
            self::PAYMENT_IS_MADE => Yii::t('status', 'Оплатил'),
        );
    }

    public function getPaymentText()
    {
        $payment_options = $this->getPaymentOptions();
        return isset($payment_options[$this->payment])
            ? $payment_options[$this->payment]
            : (Yii::t('status', 'Неизвестный статус ')) . $this->payment;
    }
    
    public function getSexOptions()
    {
        return array(
            self::SEX_MALE => Yii::t('status', 'Мужчина'),
            self::SEX_FEMALE => Yii::t('status', 'Женщина'),
        );
    }

    public function getSexText()
    {
        $sex_options = $this->getSexOptions();
        return isset($sex_options[$this->sex])
            ? $sex_options[$this->sex]
            : (Yii::t('value', 'Неизвестный статус ') . $this->sex);
    }
    
    public function getDoctorsList()
    {
        return CHtml::listData(Doctor::model()->active()->with('hospital')->findAll(), 'id', 'fullname', 'hospital.name');
    }
}
