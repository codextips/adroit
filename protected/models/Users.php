<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $user_id
 * @property string $email
 * @property string $name
 * @property string $create_date
 * @property string $api_key
 * @property string $password
 */
class Users extends CActiveRecord
{
	public $new_password, $confirm_password;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

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
			array('email, create_date', 'required'),
			array('email', 'length', 'max'=>50),
			array('new_password,confirm_password', 'length', 'min'=>6,'max'=>50),
			array('confirm_password', 'compare', 'compareAttribute'=>'new_password'),
			array('api_key,password,new_password,confirm_password', 'safe'),
			array('name', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, email, name, create_date, api_key,password,new_password,confirm_password', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'email' => 'Email',
			'name' => 'Name',
			'create_date' => 'Create Date',
			'api_key'=>'API Key',
			'password'=>'Password',
			'new_password'=>'New Password',
			'confirm_password'=>'Confirm Password',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getGravatar($size = 32, $withImgTag = false, $class='thumbnail')
	{
        $email_hash = md5( strtolower( trim( $this->email) ) );
		if($withImgTag)
		{
			return "<img class='$class' src='http://www.gravatar.com/avatar/$email_hash?s=$size' />";
		}
        return "http://www.gravatar.com/avatar/$email_hash?s=$size";
    }
	
	public function beforeSave()
	{
		if(!empty ($this->new_password))
		{
			$this->password = md5($this->new_password);
		}
		return parent::beforeSave();
	}
}