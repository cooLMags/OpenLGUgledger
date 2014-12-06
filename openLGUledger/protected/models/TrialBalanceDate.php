<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

/**
 * This is the model class for table "trial_balance_date".
 *
 * The followings are the available columns in table 'trial_balance_date':
 * @property integer $trial_balance_date_id
 * @property string $asof
 */
class TrialBalanceDate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TrialBalanceDate the static model class
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
		return 'trial_balance_date';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asof', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('trial_balance_date_id, asof', 'safe', 'on'=>'search'),
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
			'trial_balance_date_id' => 'Trial Balance Date',
			'asof' => 'Asof',
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

		$criteria->compare('trial_balance_date_id',$this->trial_balance_date_id);
		$criteria->compare('asof',$this->asof,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}