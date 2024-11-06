<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offers".
 *
 * @property int $id
 * @property string $offer_name
 * @property string $email
 * @property string|null $phone
 * @property string|null $created_at
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['offer_name', 'email'], 'required'],
            [['created_at'], 'safe'],
            [['offer_name', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            ['email', 'email'],
            ['phone', 'string', 'max'=> 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'offer_name' => 'Offer Name',
            'email' => 'Email',
            'phone' => 'Phone',
        ];
    }
}
