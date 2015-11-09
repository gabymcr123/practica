<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sample".
 *
 * @property integer $id
 * @property string $thought
 * @property integer $goodness
 * @property integer $rank
 * @property string $censorship
 * @property string $occurred
 */
class Sample extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sample';
    }

   public $captcha;
     
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
      [['thought'], 'string', 'max' => 255],
      ['thought', 'match', 'pattern' => '/^[a-z][A-Za-z,;\"\\s]+[!?.]$/i','message'=>Yii::t('app','Your thoughts should form a complete sentence of alphabetic characters.')],
      [['email'], 'email'],
       ['censorship', 'in', 'range' => ['yes','no','Yes','No'],'message'=>Yii::t('app','The censors demand a yes or no answer.')],
      [['url'], 'url'],
      [['captcha'], 'captcha'],
      [['rank'], 'integer'],
      ['rank', 'compare', 'compareValue' => 0, 'operator' => '>'],
      ['rank', 'compare', 'compareValue' => 100, 'operator' => '<='],
    ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'thought' => Yii::t('app', 'Thought'),
            'goodness' => Yii::t('app', 'Goodness'),
            'rank' => Yii::t('app', 'Rank'),
            'censorship' => Yii::t('app', 'Censorship'),
            'occurred' => Yii::t('app', 'Occurred'),
        ];
    }
}
