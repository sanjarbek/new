<?php

/**
 * This is the model class for table "registrations".
 *
 * The followings are the available columns in table 'registrations':
 * @property integer $id
 * @property integer $patient_id
 * @property integer $mrtscan_id
 * @property string $price
 * @property string $discont
 * @property string $price_with_discont
 * @property integer $status
 * @property integer $report_status
 * @property string $report_text
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 *
 * The followings are the available model relations:
 * @property Mrtscans $mrtscan
 * @property Patients $patient
 */
class Registration extends MasterModel
{
    const STATUS_NOT_YET_STARTED = 0;
    const STATUS_FINISHED = 1;
    const STATUS_CANCELED = 2;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registrations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, mrtscan_id, price, discont, price_with_discont, status, created_at, updated_at, created_user, updated_user', 'required'),
			array('patient_id, mrtscan_id, status, report_status, created_user, updated_user', 'numerical', 'integerOnly'=>true),
			array('price, discont, price_with_discont', 'length', 'max'=>10),
            array('patient_id', 
                'exist', 
                'allowEmpty' => false,
                'attributeName' => 'id',
                'className' => 'Patient',
                'message' => 'The specified patient does not exist.',
                'skipOnError'=>false,
            ),
            array('mrtscan_id', 
                'exist', 
                'allowEmpty' => false,
                'attributeName' => 'id',
                'className' => 'Mrtscan',
                'message' => 'The specified mrtscan does not exist.',
                'skipOnError'=>false,
            ),
            array('price', 'priceValidation'),
            array('status', 'in', 'range'=>array(
                self::STATUS_NOT_YET_STARTED,
                self::STATUS_FINISHED,
                self::STATUS_CANCELED,
            )),
			array('report_text', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, patient_id, mrtscan_id, price, discont, price_with_discont, status, report_status, report_text, created_at, updated_at, created_user, updated_user', 'safe', 'on'=>'search'),
		);
	}
    
    public function priceValidation($attribute)
    {
        $mrtscan = Mrtscan::model()->findByPk($this->mrtscan_id);
        if ($this->price !== $mrtscan->price)
          $this->addError($attribute, 'Don\'t change mrtscan\'s price!');
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'mrtscan' => array(self::BELONGS_TO, 'Mrtscan', 'mrtscan_id'),
			'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
            'creator' => array(self::BELONGS_TO, 'User', 'created_user'),
            'updater' => array(self::BELONGS_TO, 'User', 'updated_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'patient_id' => 'Patient',
			'mrtscan_id' => 'Mrtscan',
			'price' => 'Price',
			'discont' => 'Discont',
			'price_with_discont' => 'Final price',
			'status' => 'Status',
			'report_status' => 'Report Status',
			'report_text' => 'Report Text',
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
		$criteria->compare('t.patient_id',$this->patient_id);
		$criteria->compare('t.mrtscan_id',$this->mrtscan_id);
		$criteria->compare('t.price',$this->price,true);
		$criteria->compare('t.discont',$this->discont,true);
		$criteria->compare('t.price_with_discont',$this->price_with_discont,true);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.report_status',$this->report_status);
		$criteria->compare('t.report_text',$this->report_text,true);
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
	 * @return Registration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getMrtscansList()
    {
        return CHtml::listData(Mrtscan::model()->active()->findAll(), 'id', 'name');
    }
    
    public function getPatientsList()
    {
        return CHtml::listData(Patient::model()->findAll(), 'id', 'fullname');
    }
    
    public function getStatusOptions()
    {
        return array(
            self::STATUS_NOT_YET_STARTED => Yii::t('status', 'Not yet started'),
            self::STATUS_FINISHED => Yii::t('status', 'Finished'),
            self::STATUS_CANCELED => Yii::t('status', 'Canceled'),
        );
    }

    public function getStatusText()
    {
        $status_options = $this->getStatusOptions();
        return isset($status_options[$this->status])
            ? $status_options[$this->status]
            : (Yii::t('status', 'Unknown status ') . $this->status);
    }
}
