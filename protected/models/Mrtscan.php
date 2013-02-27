<?php

/**
 * This is the model class for table "mrtscans".
 *
 * The followings are the available columns in table 'mrtscans':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_user
 * @property integer $updated_user
 *
 * The followings are the available model relations:
 * @property Registrations[] $registrations
 */
class Mrtscan extends MasterModel
{
    const STATUS_ENABLED = 0;
    const STATUS_DISABLED = 1;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mrtscans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, price, status, created_at, updated_at, created_user, updated_user', 'required'),
			array('status, created_user, updated_user', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('description', 'length', 'max'=>255),
			array('price', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, price, status, created_at, updated_at, created_user, updated_user', 'safe', 'on'=>'search'),
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
			'registrations' => array(self::HAS_MANY, 'Registration', 'mrtscan_id'),
            'creator'=>array(self::BELONGS_TO, 'User', 'created_user'),
            'updater'=>array(self::BELONGS_TO, 'User', 'updated_user'),
		);
	}
    
    public function scopes() 
    {
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ENABLED,
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
			'name' => 'Название',
			'description' => 'Описание',
			'price' => 'Цена',
			'status' => 'Статус',
			'created_at' => 'Дата создания',
			'updated_at' => 'Дата редактирования',
			'created_user' => 'Создавщий пользователь',
			'updated_user' => 'Редактировавщий пользователь',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('status',$this->status);
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
	 * @return Mrtscan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getStatusOptions()
    {
        return array(
            self::STATUS_DISABLED => Yii::t('status', 'Неактивный'),
            self::STATUS_ENABLED => Yii::t('status', 'Активный'),
        );
    }
    
    public function getStatusText()
    {
        $statusOptions = $this->getStatusOptions();
        return (isset($statusOptions[$this->status]) ? 
                $statusOptions[$this->status] : 
            Yii::t('message', 'Unknown status: ') . $this->status);
    }
}
