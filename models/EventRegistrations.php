<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event_registrations".
 *
 * @property int $id
 * @property int|null $event_id
 * @property int|null $user_id
 * @property string|null $registration_date
 * @property string|null $status
 *
 * @property Event $event
 * @property User $user
 */
class EventRegistrations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_registrations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'user_id'], 'integer'],
            [['registration_date'], 'safe'],
            [['status'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::class, 'targetAttribute' => ['event_id' => 'id']],
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
            'event_id' => 'Мероприятие',
            'user_id' => 'Пользователь',
            'registration_date' => 'Дата регистрации',
            'status' => 'Статус',
        ];
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
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

    public function getStatus():string
    {
        switch ($this->status) {
            case 0:
                return '<span class="badge rounded-pill text-bg-danger">Закрыто</span>';
            case 1:
                return '<span class="badge rounded-pill text-bg-primary">На рассмотрении</span>';
            case 2:
                return '<span class="badge rounded-pill text-bg-primary">Принято</span>';
            case 3:
                return '<span class="badge rounded-pill text-bg-warning">Отклонено</span>';
            default:
                return '<span class="badge rounded-pill text-bg-danger">Ошибка в статусах:' . $this->status . '</span>';
        }
    }

    public function getStatusForReport():string
    {
        switch ($this->status) {
            case 0:
                return 'Закрыто';
            case 1:
                return 'На рассмотрении';
            case 2:
                return 'Принято';
            case 3:
                return 'Отклонено';
            default:
                return 'Ошибка в статусах' . $this->status;
        }
    }

    public function getStatusForReports(): array
    {
        return [
            0 => 'Закрыто',
            1 => 'На рассмотрении',
            2 => 'Принято',
            3 => 'Отклонено',
        ];
    }
}
