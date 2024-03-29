<?php

namespace frontend\modules\v1\controllers;



use yii\rest\ActiveController;

use Yii;

use common\models\Attendance;
use common\models\User; 


/**
 * Default controller for the `v1` module
 */
class AttendanceController extends ActiveController
{

    public $modelClass = 'common\models\Attendance';

    public function actionCheckin()
    {
        $model = new Attendance();
        $username = "nayab"; 
        
        $user = User::findOne(['username' => $username]); 
        
        if ($user) {
            $userId = $user->id; 
           
            if ($model->checkedOut($userId)) {
                return ['error' => 'You have already checked out today and cannot check in again'];
            } else {
              
                if ($model->hasCheckedInToday($userId)) {
             
                    return ['error' => 'You have already checked in today'];
                } else {
                    
                    $model->user_id = $userId;
                    $model->name = $user->username; 
                    $model->checkin = date('Y-m-d H:i:s');
                    $model->attendance_date = date('Y-m-d');
                    
                    if ($model->save()) {
                        return ['success' => 'Successfully checked in', 'data' => $model];
                    } else {
                        return ['error' => 'Failed to check in'];
                    }
                }
            }
        } else {
            return ['error' => 'User not found'];
        }
    }
    

  
    

    public function actionCheckout()
    {
        $username = "nayab"; 
        $model = new Attendance();
        
        $user = User::findOne(['username' => $username]); 
        
        if ($user) {
            $userId = $user->id; 
            
            if ($model->checkedOut($userId)) {
                return ['error' => 'You have already checked out today Cannot check out again'];
            } else {
                $checkinRecord = $model->findLatestCheckin($userId);
                
                if ($checkinRecord !== null) {
                    $checkoutTime = date('Y-m-d H:i:s');
                    $checkinRecord->checkout = $checkoutTime;
        
                    if ($checkinRecord->save()) {
                        return ['success' => 'You have successfully checked out'];
                    } else {
                        return ['error' => 'Failed to save the checkout time'];
                    }
                } else {
                    return ['error' => 'No check-in record found for today'];
                }
            }
        } else {
            return ['error' => 'User not found'];
        }
    }
    


    public function actionLunchBreak()
    {
        $username = "nayab"; 
        $model = new Attendance();
    
        $user = User::findOne(['username' => $username]); 
    
        if ($user) {
            $userId = $user->id; 
    
         
            $checkedOut = $model->hasCheckedOutToday($userId);
            if ($checkedOut) {
                return ['error' => 'You have already checked out today and cannot take a lunch break'];
            }
    
          
            $attendanceRecord = $model->CheckinRecord($userId);
            if ($attendanceRecord === null) {
                return ['error' => 'No check-in record found for today'];
            } else {
               
                if (!$attendanceRecord->lunchBreakIn) {
                    $attendanceRecord->lunchBreakIn = date('Y-m-d H:i:s');
                    if ($attendanceRecord->save()) {
                        return ['success' => 'Lunch break time saved'];
                    } else {
                        return ['error' => 'Failed to save lunch break time'];
                    }
                } else {
                    return ['error' => 'You have already taken a lunch break'];
                }
            }
        } else {
            return ['error' => 'User not found'];
        }
    }

    public function actionBreakOut()
    {
        $username = "nayab"; 
        $model = new Attendance();
    
        $user = User::findOne(['username' => $username]);
    
        if ($user) {
            $userId = $user->id; 
    
            $checkedOut = $model->hasCheckedOutToday($userId);
            if ($checkedOut) {
                return ['error' => 'You have already checked out today and cannot take a lunch break'];
            }
    
       
            $attendanceRecord = $model->CheckinRecord($userId);
            if (!$attendanceRecord) {
                return ['error' => 'No check-in record found for today'];
            } elseif (!$attendanceRecord->lunchBreakIn) {
                return ['error' => 'You have not taken a lunch break'];
            } elseif ($attendanceRecord->lunchBreakOut) {
                return ['error' => 'You have already taken a lunch break out'];
            } else {
                $attendanceRecord->lunchBreakOut = date('Y-m-d H:i:s');
                if ($attendanceRecord->save()) {
                    return ['success' => 'Lunch break out time saved'];
                } else {
                    return ['error' => 'Failed to save lunch break out'];
                }
            }
        } else {
            return ['error' => 'User not found'];
        }
    }
    


    }
    