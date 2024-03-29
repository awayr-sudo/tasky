<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $checkin
 * @property string|null $checkout
 * @property string|null $worktime
 * @property string|null $attendance_date
 *
 * @property User $user
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['checkin', 'checkout', 'worktime', 'attendance_date', 'lunchBreakIn', 'lunchBreakOut'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['checkin'], 'validateCheckIn'],
            // [['checkOutTime'],'validateCheckOut'],


        ];
    }


    public function validateCheckIn($attribute)
    {
           $attendance = $this->detectAttendance();
        if ($attendance !== null) {

            $this->addError($attribute, 'you have already checked-in for today');
        }
    }



public function detectAttendance()
{
    $userId = Yii::$app->user->id; 

    $attendanceRecord = Attendance::find()
        ->andWhere(['user_id' => $userId]) 
        ->andWhere(['not', ['checkin' => null]])
        ->andWhere(['checkout' => null])
        ->orderBy(['id' => SORT_DESC])
        ->one();

    return $attendanceRecord;
}


    
    public function calculateWorkTime($checkInTime, $checkoutTime)
    {
        $checkInTimestamp = strtotime($checkInTime);
        $checkOutTimestamp = strtotime($checkoutTime);
        $workTimeSeconds = $checkOutTimestamp - $checkInTimestamp;
        $workHours = floor($workTimeSeconds / 3600);
        $workMinutes = floor(($workTimeSeconds % 3600) / 60);
        return sprintf('%02d:%02d', $workHours, $workMinutes);
    }

 
   
 
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'checkin' => 'Checkin',
            'checkout' => 'Checkout',
            'worktime' => 'Worktime',
            'attendance_date' => 'Attendance Date',
            'lunchBreakIn' => 'Lunch Break In',
            'lunchBreakOut' => 'Lunch Break Out',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\AttendanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AttendanceQuery(get_called_class());
    }
}
