<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

/**
 * This is the model class for table "trial_balance".
 *
 * The followings are the available columns in table 'trial_balance':
 * @property integer $trial_balance_id
 * @property string $account_title
 * @property integer $account_code
 * @property string $debit_balance
 * @property string $credit_balance
 */
class TrialBalance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TrialBalance the static model class
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
		return 'trial_balance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_code', 'numerical', 'integerOnly'=>true),
			array('account_title, debit_balance, credit_balance', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('trial_balance_id, account_title, account_code, debit_balance, credit_balance', 'safe', 'on'=>'search'),
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
			'trial_balance_id' => 'Trial Balance',
			'account_title' => 'Account Title',
			'account_code' => 'Account Code',
			'debit_balance' => 'Debit Balance',
			'credit_balance' => 'Credit Balance',
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

		$criteria->compare('trial_balance_id',$this->trial_balance_id);
		$criteria->compare('account_title',$this->account_title,true);
		$criteria->compare('account_code',$this->account_code);
		$criteria->compare('debit_balance',$this->debit_balance,true);
		$criteria->compare('credit_balance',$this->credit_balance,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}