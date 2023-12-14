<?php

use yii\db\Migration;

/**
 * Class m231214_205512_seed_user_data
 */
class m231214_205512_seed_user_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $userData = [
            [
                'username' => 'gianpuli016',
                'nombre' => 'Gianluca',
                'apellido' => 'Pulichino',
                'passwd' => Yii::$app->security->generateRandomString(),
                'email' => 'admin@example.com',
                'authkey' => Yii::$app->security->generateRandomString(),
                'accesstoken' => Yii::$app->security->generateRandomString(),
            ],
            [
                'username' => 'romitocasa',
                'nombre' => 'Romi',
                'apellido' => 'Casa',
                'passwd' => Yii::$app->security->generateRandomString(),
                'email' => 'romitocasa@example.com',
                'authkey' => Yii::$app->security->generateRandomString(),
                'accesstoken' => Yii::$app->security->generateRandomString(),
            ],
            [
                'username' => 'albert10',
                'nombre' => 'Alberto',
                'apellido' => 'Tasco',
                'passwd' => Yii::$app->security->generateRandomString(),
                'email' => 'albert10@example.com',
                'authkey' => Yii::$app->security->generateRandomString(),
                'accesstoken' => Yii::$app->security->generateRandomString(),
            ],
            
        ];

        var_dump($userData);
        $this->batchInsert('{{%user}}', [
            'username',
            'nombre',
            'apellido',
            'passwd',
            'email',
            'authkey',
            'accesstoken',
        ], $userData);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->delete('{{%user}}', ['username' => 'gianpuli016']);
        $this->delete('{{%user}}', ['username' => 'romitocasa']);
        $this->delete('{{%user}}', ['username' => 'albert10']);
        
    }
}
