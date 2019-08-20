<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Поле должно быть заполнено'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой пользователь уже существует.'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'message' => 'Имя пользователя должно быть не менее 2 символов'],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Поле должно быть заполнено.'],
            ['email', 'email', 'message' => 'Введённое значение не является почтой.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Данная почта уже зарегистрирована в системе.'],

            ['password', 'required', 'message' => 'Такой пользователь уже существует.'],
            ['password', 'string', 'min' => 6, 'message' => 'Пароль должен сожержать не менее 6 и не более 15 символов'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        //$user->generateEmailVerificationToken();
        return $user->save() ? $user : null;
		//return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    /*protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }*/
}
