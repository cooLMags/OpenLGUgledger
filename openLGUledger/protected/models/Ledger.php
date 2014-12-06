<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

/**
 * This is the model class for table "ledger".
 *
 * The followings are the available columns in table 'ledger':
 * @property integer $account_code
 * @property string $account_title
 * @property integer $ledger_page
 * @property string $major_account_title
 * @property string $normal_balance
 * @property string $debit
 * @property string $credit
 */
class Ledger extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ledger the static model class
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
		return 'ledger';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_code, account_title, ledger_page', 'required'),
			array('account_code, ledger_page', 'numerical', 'integerOnly'=>true),
			array('major_account_title, normal_balance, debit, credit', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('account_code, account_title, ledger_page, major_account_title, normal_balance, debit, credit', 'safe', 'on'=>'search'),
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
			'account_code' => 'Account Code',
			'account_title' => 'Account Title',
			'ledger_page' => 'Ledger Page',
			'major_account_title' => 'Major Account Title',
			'normal_balance' => 'Normal Balance',
			'debit' => 'Debit',
			'credit' => 'Credit',
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

		$criteria->compare('account_code',$this->account_code);
		$criteria->compare('account_title',$this->account_title,true);
		$criteria->compare('ledger_page',$this->ledger_page);
		$criteria->compare('major_account_title',$this->major_account_title,true);
		$criteria->compare('normal_balance',$this->normal_balance,true);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('credit',$this->credit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}