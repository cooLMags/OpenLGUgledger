<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

/**
 * This is the model class for table "status_holder".
 *
 * The followings are the available columns in table 'status_holder':
 * @property integer $status_holder_id
 * @property integer $last_month_status
 * @property integer $today_month_status
 * @property integer $accept_status
 * @property string $date_holder
 */
class StatusHolder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StatusHolder the static model class
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
		return 'status_holder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('last_month_status, today_month_status, accept_status', 'numerical', 'integerOnly'=>true),
			array('date_holder', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('status_holder_id, last_month_status, today_month_status, accept_status, date_holder', 'safe', 'on'=>'search'),
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
			'status_holder_id' => 'Status Holder',
			'last_month_status' => 'Last Month Status',
			'today_month_status' => 'Today Month Status',
			'accept_status' => 'Accept Status',
			'date_holder' => 'Date Holder',
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

		$criteria->compare('status_holder_id',$this->status_holder_id);
		$criteria->compare('last_month_status',$this->last_month_status);
		$criteria->compare('today_month_status',$this->today_month_status);
		$criteria->compare('accept_status',$this->accept_status);
		$criteria->compare('date_holder',$this->date_holder,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}