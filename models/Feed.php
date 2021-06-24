<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "feed".
 *
 * @property int $id
 * @property string|null $feed_guid
 * @property string|null $title
 * @property string|null $link
 * @property string|null $short_description
 * @property string|null $date_published
 * @property string|null $author
 * @property string|null $image_url
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Feed extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    public static function tableName()
    {
        return 'feed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short_description'], 'string'],
            [['date_published'], 'safe'],
            [['created_at', 'updated_at'], 'default', 'value' => null],
            [['created_at', 'updated_at'], 'integer'],
            [['feed_guid', 'title', 'link', 'author', 'image_url'], 'string', 'max' => 255],
            [['feed_guid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'feed_guid' => 'Feed Guid',
            'title' => 'Title',
            'link' => 'Link',
            'short_description' => 'Short Description',
            'date_published' => 'Date Published',
            'author' => 'Author',
            'image_url' => 'Image Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
