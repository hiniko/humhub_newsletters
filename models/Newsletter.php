<?php

/**
 *
 *
 */

namespace humhub\modules\newsletters\models;

use Yii;
use humhub\components\ActiveRecord;
use humhub\modules\newsletters\models\Subscription;

/**
 * This is the model class for table "newsletters"
 *
 * @property integer $id
 * @property integer $space_id
 * @property string $guid
 * @property string $name
 * @property integer $frequency
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */

class Newsletter extends ActiveRecord
{

    public function rules()
    {
        return [ 
            [['name', 'frequency', 'description'], 'required'],
            ['name', 'string'],
            ['frequency', 'string'],
            ['description', 'string']
        ];
    }

    public function behaviors(){
        return [
             \humhub\components\behaviors\GUID::className(), 
        ];
    }

    public function getFrequencyLabel()
    {
        return self::frequencies()[$this->frequency];
    }

    public function getSubscriberCount()
    {
        return count(
            Subscription::find(['newsletter_id' => $this->guid])->all()
        );
    }

    public static function getNewsletters($ids = [])
    {
        if(count($ids) > 0){
            return Newsletter::findAll([$ids]);
        }else{
            return [];
        }
    }
   
    public static function tableName()
    {
        return 'newsletters_newsletters';
    }

    public static function frequencies()
    {
        return  [
            0 => 'Weekly',
            1 => 'Fortnightly',
            2 => 'Monthly',
            3 => 'Occasionally'
        ];
    }
    
}

?>
