<?php

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property integer $event_id
 * @property integer $user_id
 * @property string $title
 * @property string $summary
 * @property string $logo
 * @property string $location
 * @property string $href
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_active
 * @property integer $total_attending
 * @property string $create_date
 */
class Events extends CActiveRecord {

	public function scopes() {
		return array(
			'active' => array(
				'condition' => 'is_active = 1',
			),
			'upcoming' => array(
				'condition' => "start_date >= '" . date('Y-m-d') . "'",
			),
			'ongoing' => array(
				'condition' => "start_date <= '" . date('Y-m-d') . "' AND end_date >= '" . date('Y-m-d') . "'",
			),
			'popular' => array(
				'order' => "total_attending DESC",
			),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Events the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, is_active, total_attending', 'numerical', 'integerOnly' => true),
			array('title, logo, href', 'length', 'max' => 200),
			array('location', 'length', 'max' => 100),
			array('summary, start_date, end_date, create_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('event_id, user_id, title, summary, logo, location, href, start_date, end_date, is_active, total_attending, create_date', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'event_id' => 'Event',
			'user_id' => 'User',
			'title' => 'Title',
			'summary' => 'Summary',
			'logo' => 'Logo',
			'location' => 'Location',
			'href' => 'URL',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'is_active' => 'Is Active',
			'total_attending' => 'Total Attending',
			'create_date' => 'Create Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('event_id', $this->event_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('summary', $this->summary, true);
		$criteria->compare('logo', $this->logo, true);
		$criteria->compare('location', $this->location, true);
		$criteria->compare('href', $this->href, true);
		$criteria->compare('start_date', $this->start_date, true);
		$criteria->compare('end_date', $this->end_date, true);
		$criteria->compare('is_active', $this->is_active);
		$criteria->compare('total_attending', $this->total_attending);
		$criteria->compare('create_date', $this->create_date, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

}