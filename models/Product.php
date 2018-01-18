<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property resource $image
 * @property string $stock
 *
 * @property Tag $modelTag
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'image', 'stock'], 'required'],
            [['description', 'image'], 'string'],
            [['title'], 'string', 'max' => 60],
            [['stock'], 'integer'],
            [['tag'], 'integer'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'4000000'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'stock' => 'Stock',
            'tag' => 'Tag'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag']);
    }

    public function beforeSave($insert) {
        if ($file = UploadedFile::getInstance($this, 'image')) {
            $this->image = file_get_contents($file->tempName);
        }
        return parent::beforeSave($insert);
    }
}
