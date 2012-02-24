<?php

/**
 * This is the model class for table "talks".
 *
 * The followings are the available columns in table 'talks':
 * @property string $talk_id
 * @property integer $event_id
 * @property string $title
 * @property string $summary
 * @property string $speaker
 * @property string $slide_link
 * @property integer $total_comments
 * @property double $rating
 * @property integer $rate_count
 */
class Talks extends CActiveRecord
{
    public $rating_stars_on;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Talks the static model class
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
		return 'talks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, total_comments, rate_count', 'numerical', 'integerOnly'=>true),
			array('rating', 'numerical'),
			array('title, slide_link', 'length', 'max'=>200),
			array('speaker', 'length', 'max'=>50),
			array('summary, rating_stars_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('talk_id, event_id, title, summary, speaker, slide_link, total_comments, rating, rate_count', 'safe', 'on'=>'search'),
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
            'event' => array(self::BELONGS_TO, 'Events', 'event_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'talk_id' => 'Talk',
			'event_id' => 'Event',
			'title' => 'Title',
			'summary' => 'Summary',
			'speaker' => 'Speaker',
			'slide_link' => 'Slide Link',
			'total_comments' => 'Total Comments',
			'rating' => 'Rating',
			'rate_count' => 'Rate Count',
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

		$criteria->compare('talk_id',$this->talk_id,true);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('speaker',$this->speaker,true);
		$criteria->compare('slide_link',$this->slide_link,true);
		$criteria->compare('total_comments',$this->total_comments);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('rate_count',$this->rate_count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function rate($rating){
        $new_rate_count = (int)$this->rate_count + 1;
        $new_rating = ((double)($this->rating * $this->rate_count) + (double)$rating) / $new_rate_count;
        $new_rating = round($new_rating, 1);
        $this->rating = $new_rating;
        $this->rate_count = $new_rate_count;
        return $this->save();
    }
}