
<aside class="shadow">
  <?php
echo \yii\bootstrap5\Nav::widget([
  'options'=>['class'=>'d-flex flex-column'],
    'items' => [
       
      
      [
        'label'=>'Dashborad',
         'url'=>['/user/create'],
      ],

//       [
//         'label'=>'View All Employees',
//          'url'=>['/employee/index'],
//       ],
       
//       [
//         'label'=>'Add User',
//         'url'=>['/user/create'],
//       ],
      [
        'label'=>'View All Users',
        'url'=>['/user/index'],
      ],
      [ 
        'label'=>'Add Project',
         'url'=>['/project/create'],

      ],
      [ 
        'label'=>'View Projects',
         'url'=>['/project/index'],

      ],
      [ 
        'label'=>'View Attendance',
         'url'=>['/attendance/index'],

      ],
 
      [ 
        'label'=>'Attendance',
         'url'=>['/attendance/create'],

      ],
 
//       [
//         'label'=>'Assign Tasks',
//          'url'=>['/assign_task/create'],
//       ],
    
  
//   [
//     'label' => 'Add Task',
//     'url' => ['/task/create'],
    
// ],
// [
//   'label' => 'View All Task',
//   'url' => ['/task/index'],
  
// ],
[
  'label' => 'Employee Section',
  'url' => ['/table_lists/create'],
  
],
[
'label' => 'View Task',
'url' => ['/table_lists/index'],

],
    ],
]);
?>

</aside>

