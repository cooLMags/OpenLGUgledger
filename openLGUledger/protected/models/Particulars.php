<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

/**
 * This is the model class for table "particulars".
 *
 * The followings are the available columns in table 'particulars':
 * @property integer $particular_id
 * @property integer $journal_id
 * @property string $date
 * @property integer $journal_page
 * @property integer $ledger_page
 * @property string $account_title
 * @property integer $account_code
 * @property string $pr
 * @property string $debit
 * @property string $credit
 */
class Particulars extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Particulars the static model class
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
		return 'particulars';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ledger_page, account_title, account_code, debit, credit', 'required'),
			array('journal_id, journal_page, ledger_page, account_code', 'numerical', 'integerOnly'=>true),
			array('date, pr', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('particular_id, journal_id, date, journal_page, ledger_page, account_title, account_code, pr, debit, credit', 'safe', 'on'=>'search'),
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
			'particular_id' => 'Particular',
			'journal_id' => 'Journal',
			'date' => 'Date',
			'journal_page' => 'Journal Page',
			'ledger_page' => 'Ledger Page',
			'account_title' => 'Account Title',
			'account_code' => 'Account Code',
			'pr' => 'Pr',
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

		$criteria->compare('particular_id',$this->particular_id);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('journal_page',$this->journal_page);
		$criteria->compare('ledger_page',$this->ledger_page);
		$criteria->compare('account_title',$this->account_title,true);
		$criteria->compare('account_code',$this->account_code);
		$criteria->compare('pr',$this->pr,true);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('credit',$this->credit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}