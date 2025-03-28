<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Expression;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $event_id
 * @property string|null $description
 * @property string|null $rating
 * @property string|null $created_at
 * @property int|null $is_active
 *
 * @property Event $event
 * @property User $user
 */
class ReviewsForm extends Model
{
    public $description;
    public $user_id;
    public $event_id;
    public $rating;
    public $created_at;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'event_id', 'description', 'rating'], 'required'],
            [['user_id', 'event_id',], 'integer'],
            [['description'], 'string'],
            [['rating'], 'string', 'max' => 1],
            [['created_at'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'event_id' => 'Event ID',
            'description' => 'Описание',
            'rating' => 'Рейтинг',
            'created_at' => 'Created At',
            'is_active' => 'Is Active',
        ];
    }

    public function save()
    {
        $this->user_id = Yii::$app->user->id;

        if ($this->validate()) {
            $reviews = new Reviews();
            $reviews->description = $this->description;
            $reviews->rating = $this->rating;
            $reviews->user_id = $this->user_id;
            $reviews->event_id = $this->event_id;
            $reviews->created_at = new Expression('NOW()');

            if ($reviews->save()) {
                return true;
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при сохранении отзыва: ' . implode(', ', $reviews->getFirstErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка валидации: ' . implode(', ', $this->getFirstErrors()));
        }
        return false;
    }



}

