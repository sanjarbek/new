<?php

/**
 * This is the model class for table "conclusions".
 *
 * The followings are the available columns in table 'conclusions':
 * @property integer $id
 * @property integer $registration_id
 * @property string $file
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 *
 * The followings are the available model relations:
 * @property Registration $registration
 */
class Conclusion extends MasterModel
{
    public $conclusion;
    public $patient;
    public $mrtscan;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'conclusions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('conclusion', 'length', 'max' => 255, 'tooLong' => '{attribute} слишком длинный (max {max} chars).', 'on' => 'upload'),
            array('conclusion', 'file', 'types' => 'docx,xlsx', 'maxSize' => 1024 * 512, 'tooLarge' => 'Размер файлы должен быть меньше 512 КБ !!!', 'on'=>'upload'),            
			array('registration_id, file, description, created_at, updated_at, created_user, updated_user', 'required'),
			array('registration_id, created_user, updated_user', 'numerical', 'integerOnly'=>true),
            array('registration_id', 'unique', 'message'=>'Для данного пациента для данной области исследования уже загружено заключение. Чтобы заменить удалите загруженное заключение.'),
			array('file, description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, registration_id, file, description, created_at, updated_at, created_user, updated_user', 'safe', 'on'=>'search'),
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
			'registration' => array(self::BELONGS_TO, 'Registration', 'registration_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'registration_id' => 'Номер регистрации',
			'file' => 'Файл',
			'description' => 'Описание',
			'created_at' => 'Дата создания',
			'updated_at' => 'Дата редактирования',
			'created_user' => 'Создал',
			'updated_user' => 'Редактировал',
            'conclusion' => 'Заключение',
            'patient' => 'Пациент',
            'mrtscan' => 'Область исследования',
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
		$criteria->compare('t.registration_id',$this->registration_id);
		$criteria->compare('t.file',$this->file,true);
		$criteria->compare('t.description',$this->description,true);
		$criteria->compare('t.created_at',$this->created_at,true);
		$criteria->compare('t.updated_at',$this->updated_at,true);
		$criteria->compare('t.created_user',$this->created_user);
		$criteria->compare('t.updated_user',$this->updated_user);
        
        $criteria->compare('t.registration.patient_id', $this->patient);
        $criteria->compare('t.registration.mrtscan_id', $this->mrtscan);
        
        $criteria->with = array('registration.mrtscan', 'registration.patient');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Conclusion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getMrtscansList($patientId)
    {
        $query = 'select m.id, m.name 
            from mrtscans m, registrations r            
            where m.id=r.mrtscan_id and 
                    r.patient_id=:patientId and 
                    r.mrtscan_id not in (select c.mrtscan_id 
                        from conclusions c where c.patient_id=:patientId)';
        $command = Yii::app()->db->createCommand($query);
        $command->bindValue(':patientId', $patientId);
        
        $patientMrtscans = $command->queryAll();
        
        $listData = array();
        foreach ($patientMrtscans as $mrtscan)
            $listData[$mrtscan['id']] = $mrtscan['name'];
        
        return $listData;
    }
    
    public function getUploadFilePath($patientId)
    {
        return Yii::app()->basePath . DIRECTORY_SEPARATOR .'..'.
                    Yii::getPathOfAlias('uploads.conclusions').
                    DIRECTORY_SEPARATOR.$patientId;
    }
    
    public function getDownloadFilePath()
    {
        return Yii::getPathOfAlias('uploads.conclusions').DIRECTORY_SEPARATOR.$this->registration->patient_id;
    }
}
