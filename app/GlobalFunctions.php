<?php

// Messages FUnctions


function success_msg($msg) {
    $text = '<div class="alert alert-success d-flex align-items-center column-gap-2" role="alert">
                <i class="fa-regular fa-circle-check icon fs-5"></i>
                <div>'.$msg.'</div>
            </div>';
    return $text;
}
function danger_msg($msg) {
    $text = '<div class="alert alert-danger d-flex align-items-center column-gap-2" role="alert">
                <i class="fa-solid fa-circle-exclamation icon fs-5"></i>
                <div>'.$msg.'</div>
            </div>';
    return $text;
}
function primary_msg($msg) {
    $text = '<div class="alert alert-primary d-flex align-items-center column-gap-2" role="alert">
                <i class="fa-regular fa-circle-check icon fs-5"></i>
                <div>'.$msg.'</div>
            </div>';
    return $text;
}
