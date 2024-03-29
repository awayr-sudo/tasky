<?php

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="row">
    <div class="col-md-3">
            <div class="card mb-4" style="background-color: #0077b6;">
                <div class="card-body" style="color:white;">
                    <h6 class="card-title">Total Users</h6>
                    <class="card-text" style="font-size: 24px"><?= $totalUsers?></p>
                </div>
            </div>
        </div>
    <div class="col-md-3">
            <div class="card mb-4 " style="background-color: #0077b6;">
                <div class="card-body" style="color:white;">
                    <h6 class="card-title">Total Projects</h6>
                    <class="card-text" style="font-size: 24px"><?= $totalProjects ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card mb-4"style="background-color: #0077b6;" >
                <div class="card-body" style="color:white;">
                    <h6 class="card-title">Total List</h6>
                    <p class="card-text" style="font-size: 24px"><?= $totalLists?></p>
                </div>
            </div>
        </div>

            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-md-6">
        <div id="columnchart_material" style="width: 100%; height: 200px;"></div>
    </div>
</div>


</div>
