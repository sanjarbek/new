<?php

/**
 * This is the model class for table "templates".
 *
 * The followings are the available columns in table 'templates':
 * @property integer $id
 * @property integer $owner_id
 * @property string $file
 * @property string $description
 */
class Template extends MasterModel
{
    
    
    public $template;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'templates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('template', 'length', 'max' => 255, 'tooLong' => '{attribute} слишком длинный (max {max} chars).', 'on' => 'upload'),
            array('template', 'file', 'types' => 'docx,xlsx', 'maxSize' => 1024 * 512, 'tooLarge' => 'Размер файлы должен быть меньше 512 КБ !!!', 'on'=>'upload'),
			array('owner_id, name, file, description', 'required'),
            array('name', 'length', 'max'=>250),
			array('owner_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, owner_id, path, description', 'safe', 'on'=>'search'),
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
            'owner'=>array(self::BELONGS_TO, 'User', 'owner_id'),
		);
	}
    
    public function scopes() 
    {
        return array(
            'my'=>array(
                'condition'=>'t.owner_id='.Yii::app()->user->id,
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
			'owner_id' => 'Владелец',
            'name' => 'Название',
			'file' => 'Файл',
			'description' => 'Описание файла',
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
		$criteria->compare('t.owner_id',$this->owner_id);
        $criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.file',$this->file,true);
		$criteria->compare('t.description',$this->description,true);
        
        $criteria->with = array('owner');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Template the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function getUploadFilePath()
    {
        return Yii::app()->basePath . DIRECTORY_SEPARATOR .'..'.
                    Yii::getPathOfAlias('uploads.templates').
                    DIRECTORY_SEPARATOR.Yii::app()->user->id;
    }
    
    public function getDownloadFilePath()
    {
        return Yii::getPathOfAlias('uploads.templates').DIRECTORY_SEPARATOR.$this->owner_id;
    }
}
