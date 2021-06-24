<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "parser_logs".
 *
 * @property int $id
 * @property string|null $request_method
 * @property string|null $request_url
 * @property string|null $response_code
 * @property string|null $response_body
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class ParserLogs extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    public static function tableName()
    {
        return 'parser_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['response_body'], 'string'],
            [['created_at', 'updated_at'], 'default', 'value' => null],
            [['created_at', 'updated_at'], 'integer'],
            [['request_method', 'request_url', 'response_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_method' => 'Request Method',
            'request_url' => 'Request Url',
            'response_code' => 'Response Code',
            'response_body' => 'Response Body',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
