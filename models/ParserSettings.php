<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parser_settings".
 *
 * @property int $id
 * @property string|null $start_parsing_time
 */
class ParserSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parser_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_parsing_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_parsing_time' => 'Start Parsing Time',
        ];
    }
}
