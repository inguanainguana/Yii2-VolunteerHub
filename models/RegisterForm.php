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
class RegisterForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $username;
    public $email;
    public $phone_number;
    public $password;
    public $password_repeat;
    public $rememberMe = true;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'surname', 'patronymic', 'username', 'phone_number', 'email', 'password'], 'required'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Такая почта уже занята'],
            ['email', 'email'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Такой логин уже занят'],
            ['phone_number', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Такой номер уже занят'],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[А-Яа-яЁё\s]+$/u', 'message' => 'Только кириллица!'],
            [['phone_number'], 'match', 'pattern' => '/^[+0-9\s\-\(\)]+$/u', 'message' => 'Неправильный формат телефона!'],
            // rememberMe must be a boolean value
            ['password', 'string', 'min' => 7],
            ['password_repeat', 'string', 'min' => 7],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->name = $this->name;
            $user->surname = $this->surname;
            $user->patronymic = $this->patronymic;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->HashPassword($this->password);
            $user->phone_number = $this->phone_number;

            return $user->save() ? $user : null;
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'username' => 'Логин',
            'email' => 'Почта',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
            'phone_number' => 'Номер телефона ',
            'rememberMe' => 'Запомните меня',
        ];
    }
}
