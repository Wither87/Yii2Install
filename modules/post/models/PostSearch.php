<?php

namespace app\modules\post\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\post\models\Post;

/**
 * PostSearch represents the model behind the search form of `app\modules\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','author', 'status'], 'integer'],
            [['head', 'body', 'dateCreate' ], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'author', $this->author,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'head', $this->head])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'dateCreate', $this->dateCreate]);

        return $dataProvider;
    }

    public function searchPublished($params){
        $dataProvider = $this->search($params);
        $dataProvider->query->andFilterWhere(['in', 'status', [Post::STATUS_PUB]]);
        return $dataProvider;
    }

    public function searchUserPosts($user_id, $params){
        $dataProvider = $this->search($params);
        $dataProvider->query->andFilterWhere(['author' => $user_id]);
        $dataProvider->query->andFilterWhere(['in', 'status', [Post::STATUS_PUB, Post::STATUS_MOD, Post::STATUS_UNPUB]]);
        return $dataProvider;
    }
}
