<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

/**
 * This is the model class for table "ledger_entries".
 *
 * The followings are the available columns in table 'ledger_entries':
 * @property integer $ledger_entry_id
 * @property integer $particular_id
 * @property string $date
 * @property string $account_title
 * @property integer $account_code
 * @property integer $journal_page
 * @property integer $ledger_page
 * @property string $debit
 * @property string $credit
 */
class LedgerEntries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LedgerEntries the static model class
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
		return 'ledger_entries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('particular_id, date, account_title, account_code, journal_page, ledger_page', 'required'),
			array('particular_id, account_code, journal_page, ledger_page', 'numerical', 'integerOnly'=>true),
			array('debit, credit', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ledger_entry_id, particular_id, date, account_title, account_code, journal_page, ledger_page, debit, credit', 'safe', 'on'=>'search'),
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
			'ledger_entry_id' => 'Ledger Entry',
			'particular_id' => 'Particular',
			'date' => 'Date',
			'account_title' => 'Account Title',
			'account_code' => 'Account Code',
			'journal_page' => 'Journal Page',
			'ledger_page' => 'Ledger Page',
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

		$criteria->compare('ledger_entry_id',$this->ledger_entry_id);
		$criteria->compare('particular_id',$this->particular_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('account_title',$this->account_title,true);
		$criteria->compare('account_code',$this->account_code);
		$criteria->compare('journal_page',$this->journal_page);
		$criteria->compare('ledger_page',$this->ledger_page);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('credit',$this->credit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}