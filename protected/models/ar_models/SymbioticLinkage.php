<?php

/**
 * This is the model class for table "SymbioticLinkage".
 *
 * The followings are the available columns in table 'SymbioticLinkage':
 * @property integer $ISCase_id
 * @property string $MaterialClass_number
 * @property string $SourceClass_number
 * @property string $EndClass_number
 * @property string $type
 * @property string $qty
 * @property string $implementation
 * @property string $benefit_source
 * @property string $benefit_end
 * @property string $remarks
 *
 * The followings are the available model relations:
 * @property ISBC $iSCase
 * @property ClassCode $sourceClassNumber
 * @property ClassCode $materialClassNumber
 * @property ClassCode $endClassNumber
 */
class SymbioticLinkage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SymbioticLinkage the static model class
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
		return 'SymbioticLinkage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ISCase_id, MaterialClass_number, SourceClass_number, EndClass_number', 'required'),
			array('ISCase_id', 'numerical', 'integerOnly'=>true),
			array('MaterialClass_number, SourceClass_number, EndClass_number, qty', 'length', 'max'=>250),
			array('type', 'length', 'max'=>7),
			array('implementation, benefit_source, benefit_end, remarks', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ISCase_id, MaterialClass_number, SourceClass_number, EndClass_number, type, qty, implementation, benefit_source, benefit_end, remarks', 'safe', 'on'=>'search'),
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
			'iSCase' => array(self::BELONGS_TO, 'ISBC', 'ISCase_id'),
			'sourceClassNumber' => array(self::BELONGS_TO, 'ClassCode', 'SourceClass_number'),
			'materialClassNumber' => array(self::BELONGS_TO, 'ClassCode', 'MaterialClass_number'),
			'endClassNumber' => array(self::BELONGS_TO, 'ClassCode', 'EndClass_number'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ISCase_id' => 'Iscase',
			'MaterialClass_number' => 'Material Class Number',
			'SourceClass_number' => 'Source Class Number',
			'EndClass_number' => 'End Class Number',
			'type' => 'Type',
			'qty' => 'Qty',
			'implementation' => 'Implementation',
			'benefit_source' => 'Benefit Source',
			'benefit_end' => 'Benefit End',
			'remarks' => 'Remarks',
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

		$criteria->compare('ISCase_id',$this->ISCase_id);
		$criteria->compare('MaterialClass_number',$this->MaterialClass_number,true);
		$criteria->compare('SourceClass_number',$this->SourceClass_number,true);
		$criteria->compare('EndClass_number',$this->EndClass_number,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('implementation',$this->implementation,true);
		$criteria->compare('benefit_source',$this->benefit_source,true);
		$criteria->compare('benefit_end',$this->benefit_end,true);
		$criteria->compare('remarks',$this->remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}