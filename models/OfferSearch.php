<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class OfferSearch extends Offer
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['offer_name', 'email'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Offer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC],
                'attributes' => ['id', 'offer_name'],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Фильтры
        $query->andFilterWhere(['like', 'offer_name', $this->offer_name])
              ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
