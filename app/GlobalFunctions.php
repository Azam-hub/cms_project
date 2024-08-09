<?php

// Messages FUnctions

use App\Models\User;

function success_msg($msg) {
    $text = '<div class="alert alert-success d-flex align-items-center column-gap-2" role="alert">
                <ion-icon class="icon fs-4" name="checkmark-circle-outline"></ion-icon>
                <div>'.$msg.'</div>
            </div>';
    return $text;
}
function danger_msg($msg) {
    $text = '<div class="alert alert-danger d-flex align-items-center column-gap-2" role="alert">
                <ion-icon class="icon fs-4" name="alert-circle-outline"></ion-icon>
                <div>'.$msg.'</div>
            </div>';
    return $text;
}
function primary_msg($msg) {
    $text = '<div class="alert alert-primary d-flex align-items-center column-gap-2" role="alert">
                <ion-icon class="icon fs-4" name="checkmark-circle-outline"></ion-icon>
                <div>'.$msg.'</div>
            </div>';
    return $text;
}