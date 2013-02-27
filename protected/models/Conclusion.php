<?php

/**
 * This is the model class for table "conclusions".
 *
 * The followings are the available columns in table 'conclusions':
 * @property integer $id
 * @property integer $patient_id
 * @property integer $mrtscan_id
 * @property integer $owner_id
 * @property string $file
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 *
 * The followings are the available model relations:
 * @property Users $owner
 * @property Patients $patient
 * @property Mrtscans $mrtscan
 */
class Conclusion extends CActiveRecord
{
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
			array('patient_id, mrtscan_id, owner_id, file, description, created_at, updated_at, created_user, updated_user', 'required'),
			array('patient_id, mrtscan_id, owner_id, created_user, updated_user', 'numerical', 'integerOnly'=>true),
			array('file, description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, patient_id, mrtscan_id, owner_id, file, description, created_at, updated_at, created_user, updated_user', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'Users', 'owner_id'),
			'patient' => array(self::BELONGS_TO, 'Patients', 'patient_id'),
			'mrtscan' => array(self::BELONGS_TO, 'Mrtscans', 'mrtscan_id'),
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
			'owner_id' => 'Owner',
			'file' => 'File',
			'description' => 'Description',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('mrtscan_id',$this->mrtscan_id);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_user',$this->created_user);
		$criteria->compare('updated_user',$this->updated_user);

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
}
