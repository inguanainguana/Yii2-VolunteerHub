<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class EventForm extends Model
{
    public $title;
    public $description;
    public $start_date;
    public $end_date;
    public $location;
    public $image;
    public $user_id;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'start_date'], 'required'],
            [['title', 'location'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['start_date', 'end_date'], 'datetime', 'format' => 'dd.MM.yyyy HH:mm'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'skipOnEmpty' => false],

        ];
    }

    public function save($event = null)
    {
        if ($this->validate()) {
            if ($event === null) {
                $event = new Event();
                $event->user_id = Yii::$app->user->id;
            }

            $event->title = $this->title;
            $event->description = $this->description;
            $event->start_date = \DateTime::createFromFormat('d.m.Y H:i', $this->start_date)->format('Y-m-d H:i:s');
            $event->end_date = \DateTime::createFromFormat('d.m.Y H:i', $this->end_date)->format('Y-m-d H:i:s');
            $event->location = $this->location;


            if ($this->image) {
                $imagePath = 'uploads/' . $this->image->baseName . '.' . $this->image->extension;


                if ($event->image && file_exists($event->image)) {
                    unlink($event->image);
                }

                if ($this->image->saveAs($imagePath)) {
                    $event->image = $imagePath;
                } else {
                    Yii::error('Ошибка при сохранении изображения');
                    return false;
                }
            }

            if ($event->save()) {
                return true;
            } else {
                Yii::error('Ошибка при сохранении события: ' . json_encode($event->getErrors()));
                return false;
            }
        }

        Yii::error('Ошибки валидации: ' . json_encode($this->getErrors()));
        return false;
    }


    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'start_date' => 'Дата и время мероприятия',
            'end_date' => 'Окончания мероприятия',
            'image' => 'Изображение',
            'location' => 'Место проведения',
        ];
    }
}
