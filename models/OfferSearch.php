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
            [['name', 'email', 'phone'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Offer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id])
              ->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
