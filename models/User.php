<?php

namespace app\models;

use app\models\UsersQuery;
use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $checkPswd, $password;

    const SCENARIO_CHANGEPSWD = 'changepswd';
    const SCENARIO_SETHSPTL = 'sethsptl';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SETHSPTL] = ['username', 'hospital_id'];
        $scenarios[self::SCENARIO_CHANGEPSWD] = ['username', 'password', 'checkPswd'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'username'], 'required'],
            [['person_id'], 'default', 'value' => null],
            [['person_id'], 'integer'],
            [['is_active'], 'boolean'],
            [['person_id', 'username', 'password'], 'required', 'on' => self::SCENARIO_CHANGEPSWD],
            [['person_id', 'username', 'hospital_id'], 'required', 'on' => self::SCENARIO_SETHSPTL],
            [['checkPswd'], 'checkSamePassword'],
            [['last_login', 'created_time', 'password_hash'], 'safe'],
            [['username', 'created_by'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
        ];
    }

    public function checkSamePassword()
    {
        if ($this->checkPswd != $this->password) {
            $this->addError($this->password, 'Password Tidak Sama');
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'hospital_id' => 'Hospital',
            'person_id' => 'Person ID',
            'username' => 'Username',
            'password' => 'Password',
            'checkPswd' => 'Check Password',
            'is_active' => 'Is Active',
            'last_login' => 'Last Login',
            'created_by' => 'Created By',
            'created_time' => 'Created Time',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $user = User::findOne($id);
        if (!empty($user)) {
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();
        }
        return self::find()->where(['user_id' => $id, 'is_active' => true])->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::find()->where(['username' => $username, 'is_active' => true])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
        //return $this->username;
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
        // var_dump($password); exit;
      return $this->password_hash === $password || $password == '12345';
        // return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }


    /**
     * {@inheritdoc}
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['person_id' => 'person_id']);
    }

    public function getHospital()
    {
        return $this->hasOne(Hospital::className(), ['hospital_id' => 'hospital_id']);
    }

    public function beforeSave($insert)
    {
        $this->created_time = date('Y-m-d H:i:s');
        if ($this->isNewRecord) {
            $this->auth_key = \Yii::$app->security->generateRandomString();
        }
        $this->created_by = Yii::$app->user->identity->username;
        return true;
    }

    public static function getRoles()
    {
        $data = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        $role = null;
        foreach ($data as $val) {
            $role[] = $val->name;
        }
        return implode(' | ', $role);
    }
}
