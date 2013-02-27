<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $fullname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $created_at
 * @property string $lastvisit_at
 * @property integer $superuser
 * @property integer $status
 * @property integer $type
 *
 * The followings are the available model relations:
 * @property Hospitals[] $hospitals
 */
class User extends MasterModel
{
    const USER_ADMIN = 0;
    const USER_MANAGER = 1;
    const USER_REGISTRATOR = 2;
    
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    
    const TYPE_SUPERUSER = 1;
    const TYPE_NOT_SUPERUSER = 0;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fullname, username, email, created_at', 'required'),
			array('superuser, status, type', 'numerical', 'integerOnly'=>true),
            array('password', 'required', 'on'=>'create'),
			array('fullname', 'length', 'max'=>50),
			array('username', 'length', 'max'=>20),
			array('password, email', 'length', 'max'=>128),
            array('type', 'in', 'range'=>array(
                self::USER_ADMIN,
                self::USER_MANAGER,
                self::USER_REGISTRATOR,
            )),
            array('status', 'in', 'range'=>array(
                self::STATUS_ENABLED,
                self::STATUS_DISABLED,
            )),
            array('superuser', 'in', 'range'=>array(
                self::TYPE_SUPERUSER,
                self::TYPE_NOT_SUPERUSER,
            )),
			array('lastvisit_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fullname, username, password, email, created_at, lastvisit_at, superuser, status, type', 'safe', 'on'=>'search'),
		);
	}
    
    public function scopes()
    {
        return array(
            'managers'=>array(
                'condition'=>'type=' . self::USER_MANAGER,
            ),
            'active'=>array(
                'condition'=>'status=' . self::STATUS_ENABLED,
            ),
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
			'hospitals' => array(self::HAS_MANY, 'Hospitals', 'manager_id'),
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
			'username' => 'Имя пользователя',
			'password' => 'Пароль',
			'email' => 'Электронный адрес',
			'created_at' => 'Дата создания',
			'lastvisit_at' => 'Последний визит',
			'superuser' => 'Супер-пользователь',
			'status' => 'Статус',
			'type' => 'Тип',
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
		$criteria->compare('t.username',$this->username,true);
		$criteria->compare('t.password',$this->password,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('t.created_at',$this->created_at,true);
		$criteria->compare('t.lastvisit_at',$this->lastvisit_at,true);
		$criteria->compare('t.superuser',$this->superuser);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    /**
    * apply a hash on the password before we store it in the database
    */
    protected function afterValidate()
    {
        parent::afterValidate();
        if(!$this->hasErrors())
            $this->password = $this->hashPassword($this->password);
    }

    /**
    * Generates the password hash.
    * @param string password
    * @return string hash
    */
    public function hashPassword($password)
    {
        return md5($password);
    }

    /**
    * Checks if the given password is correct.
    * @param string the password to be validated
    * @return boolean whether the password is valid
    */
    public function validatePassword($password)
    {
        return $this->hashPassword($password)===$this->password;
    }
    
    /**
     * @return status values as array
     */
    public function getStatusOptions()
    {
        return array(
            self::STATUS_DISABLED => Yii::t('status', 'Неактивный'),
            self::STATUS_ENABLED => Yii::t('status', 'Активный'),
        );
    }
    
    /**
     * 
     * @return status text presentation
     */
    public function getStatusText()
    {
        $statusOptions = $this->getStatusOptions();
        return (isset($statusOptions[$this->status]) ? 
                $statusOptions[$this->status] : 
            Yii::t('message', 'Unknown status: ') . $this->status);
    }
    
    /**
     * 
     * @return user types as array
     */
    public function getUserTypes()
    {
        return array(
            self::USER_ADMIN => Yii::t('status', 'Администратор'),
            self::USER_MANAGER => Yii::t('status', 'Менеджер'),
            self::USER_REGISTRATOR => Yii::t('status', 'Регистратор'),
        );
    }
    
    /**
     * 
     * @return user type text representation
     */
    public function getTypeText()
    {
        $typeOptions = $this->getUserTypes();
        return (isset($typeOptions[$this->type]) ? 
                $typeOptions[$this->type] : 
            Yii::t('message', 'Unknown type: ') . $this->type);
    }
    
    public function getUsersList($role)
    {
        $sql = "SELECT * FROM " . Yii::app()->getAuthManager()->assignmentTable . " WHERE itemname=:itemname";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':itemname', $role);
        
        $users_ids=array();
		foreach($command->queryAll($sql) as $row)
		{
            $users_ids[] = $row['userid'];
		}
        
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $users_ids);
        
        return CHtml::listData(User::model()->findAll($criteria), 'id', 'fullname');
    }
    

}
