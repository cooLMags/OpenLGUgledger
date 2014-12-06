<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

/**
 * This is the model class for table "posted_journal_entry".
 *
 * The followings are the available columns in table 'posted_journal_entry':
 * @property integer $posted_entry
 * @property integer $journal_page
 * @property integer $transaction_number
 * @property string $date
 * @property integer $year
 * @property string $month
 * @property integer $day
 * @property string $responsibility_center
 * @property string $total_debit
 * @property string $total_credit
 * @property string $comment
 * @property string $entry_type
 */
class PostedJournalEntry extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PostedJournalEntry the static model class
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
		return 'posted_journal_entry';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('journal_page, transaction_number, year, day', 'numerical', 'integerOnly'=>true),
			array('date, month, responsibility_center, total_debit, total_credit, comment, entry_type', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('posted_entry, journal_page, transaction_number, date, year, month, day, responsibility_center, total_debit, total_credit, comment, entry_type', 'safe', 'on'=>'search'),
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
			'posted_entry' => 'Posted Entry',
			'journal_page' => 'Journal Page',
			'transaction_number' => 'Transaction Number',
			'date' => 'Date',
			'year' => 'Year',
			'month' => 'Month',
			'day' => 'Day',
			'responsibility_center' => 'Responsibility Center',
			'total_debit' => 'Total Debit',
			'total_credit' => 'Total Credit',
			'comment' => 'Comment',
			'entry_type' => 'Entry Type',
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

		$criteria->compare('posted_entry',$this->posted_entry);
		$criteria->compare('journal_page',$this->journal_page);
		$criteria->compare('transaction_number',$this->transaction_number);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('day',$this->day);
		$criteria->compare('responsibility_center',$this->responsibility_center,true);
		$criteria->compare('total_debit',$this->total_debit,true);
		$criteria->compare('total_credit',$this->total_credit,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('entry_type',$this->entry_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}