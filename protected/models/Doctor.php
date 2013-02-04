<?php

/**
 * This is the model class for table "doctors".
 *
 * The followings are the available columns in table 'doctors':
 * @property integer $id
 * @property string $fullname
 * @property string $phone
 * @property string $type
 * @property integer $hospital_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 *
 * The followings are the available model relations:
 * @property Hospitals $hospital
 * @property Patients[] $patients
 */
class Doctor extends MasterModel
{
    const STATUS_ENABLED = 0;
    const STATUS_DISABLED = 1;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'doctors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fullname, phone, type, hospital_id, status, created_at, updated_at, created_user, updated_user', 'required'),
			array('hospital_id, status, created_user, updated_user', 'numerical', 'integerOnly'=>true),
			array('fullname, phone, type', 'length', 'max'=>45),
            array('hospital_id', 
                'exist', 
                'allowEmpty' => false,
                'attributeName' => 'id',
                'className' => 'Hospital',
                'message' => 'The specified hospital does not exist.',
                'skipOnError'=>false,
            ),
            array('status', 'in', 'range'=>array(
                self::STATUS_ENABLED,
                self::STATUS_DISABLED,
            )),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fullname, phone, type, hospital_id, status, created_at, updated_at, created_user, updated_user', 'safe', 'on'=>'search'),
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
			'hospital' => array(self::BELONGS_TO, 'Hospital', 'hospital_id'),
			'patients' => array(self::HAS_MANY, 'Patient', 'doctor_id'),
            'creator'=>array(self::BELONGS_TO, 'User', 'created_user'),
            'updater'=>array(self::BELONGS_TO, 'User', 'updated_user'),
		);
	}
    
    public function scopes() 
    {
        return array(
            'active'=>array(
                'condition'=>'t.status='.self::STATUS_ENABLED,
            )
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fullname' => 'Fullname',
			'phone' => 'Phone',
			'type' => 'Type',
			'hospital_id' => 'Hospital',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'created_user' => 'Created User',
			'updated_user' => 'Updated User',
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
		$criteria->compare('t.type',$this->type,true);
		$criteria->compare('t.hospital_id',$this->hospital_id);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.created_at',$this->created_at,true);
		$criteria->compare('t.updated_at',$this->updated_at,true);
		$criteria->compare('t.created_user',$this->created_user);
		$criteria->compare('t.updated_user',$this->updated_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Doctor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getStatusOptions()
    {
        return array(
            self::STATUS_DISABLED => Yii::t('status', 'Inactive'),
            self::STATUS_ENABLED => Yii::t('status', 'Active'),
        );
    }
    
    public function getStatusText()
    {
        $statusOptions = $this->getStatusOptions();
        return (isset($statusOptions[$this->status]) ? 
                $statusOptions[$this->status] : 
            Yii::t('message', 'Unknown status: ') . $this->status);
    }
    
    public function getHospitalsList()
    {
        return CHtml::listData(Hospital::model()->active()->findAll(), 'id', 'name');
    }
    
    public function getTypeOptions()
    {
        $rawData = Doctor::model()->findAll(array('select'=>'type', 'distinct'=>true));
        $typeOptions = array();
        foreach($rawData as $model)
            $typeOptions[] = $model->type;
        return $typeOptions;
    }
}
