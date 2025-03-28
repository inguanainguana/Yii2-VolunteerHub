<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $patronymic
 * @property string|null $username
 * @property string|null $email
 * @property string|null $phone_number
 * @property string|null $password
 * @property int|null $is_admin
 *
 * @property EventRegistrations[] $eventRegistrations
 * @property Event[] $events
 * @property Follows[] $follows
 * @property Follows[] $follows0
 * @property Reviews[] $reviews
 * /
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public $authKey;
    public $accessToken;

    private static $users = [

    ];


    public static function tableName()
    {
        return 'user';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return User::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function HashPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function getEventRegistrations()
    {
        return $this->hasMany(EventRegistrations::class, ['user_id' => 'id']);
    }

    public function getEvents()
    {
        return $this->hasMany(Event::class, ['user_id' => 'id']);
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getFollows()
    {
        return $this->hasMany(Follows::class, ['followed_id' => 'id']);
    }

    public function getFollows0()
    {
        return $this->hasMany(Follows::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['user_id' => 'id']);
    }


    public function getFriendsEvents()
    {

        $friendIds = Follows::find()
            ->select('followed_id')
            ->where(['user_id' => $this->id])
            ->column();

        return EventRegistrations::find()
            ->joinWith('event')
            ->where(['event_registrations.user_id' => $friendIds])
            ->all();
    }




}
