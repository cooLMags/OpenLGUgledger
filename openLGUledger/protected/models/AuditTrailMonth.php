<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

/**
 * This is the model class for table "audit_trail".
 *
 * The followings are the available columns in table 'audit_trail':
 * @property integer $audit_trail_id
 * @property string $date
 * @property string $amount_involved
 * @property string $activity
 * @property string $user
 */
class AuditTrailMonth extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AuditTrailMonth the static model class
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
		return 'audit_trail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, activity, user', 'required'),
			array('amount_involved', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('audit_trail_id, date, amount_involved, activity, user', 'safe', 'on'=>'search'),
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
			'audit_trail_id' => 'Audit Trail',
			'date' => 'Date',
			'amount_involved' => 'Amount Involved',
			'activity' => 'Activity',
			'user' => 'User',
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

		$criteria->compare('audit_trail_id',$this->audit_trail_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('amount_involved',$this->amount_involved,true);
		$criteria->compare('activity',$this->activity,true);
		$criteria->compare('user',$this->user,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}