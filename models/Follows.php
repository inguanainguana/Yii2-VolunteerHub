<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "follows".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $followed_id
 *
 * @property User $followed
 * @property User $user
 */
class Follows extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'follows';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'followed_id'], 'integer'],
            [['followed_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['followed_id' => 'id']],
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
            'user_id' => 'User ID',
            'followed_id' => 'Followed ID',
        ];
    }

    /**
     * Gets query for [[Followed]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFollowed()
    {
        return $this->hasOne(User::class, ['id' => 'followed_id']);
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


}
