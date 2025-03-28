<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $location
 * @property string|null $image
 * @property int|null $user_id
 *
 * @property EventRegistrations[] $eventRegistrations
 * @property User $user
 * @property Reviews[] $reviews
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['user_id'], 'integer'],
            [['title', 'location', 'image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'start_date' => 'Дата и время мероприятия',
            'end_date' => 'Окончания мероприятия',
            'image' => 'Изображение',
            'location' => 'Место проведения',
            'user_id' => 'Пользователь',
        ];
    }

    /**
     * Gets query for [[EventRegistrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventRegistrations()
    {
        return $this->hasMany(EventRegistrations::class, ['event_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['event_id' => 'id']);
    }

    public static function getTotalEventsCount()
    {
        return self::find()->count();
    }




}
