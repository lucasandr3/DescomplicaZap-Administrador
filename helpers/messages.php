<?php

function set_flash($type,$message)
{
    if($type == 'error') {
        $_SESSION['error'] = '<div class="alert alert-success alert-wth-icon alert-dismissible fade show" style="margin-bottom:30px;" role="alert">
        <span class="alert-icon-wrap"><i class="zmdi zmdi-block"></i></span>'.$message.
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>';
    } else {
        $_SESSION['success'] = '<div class="alert alert-success alert-wth-icon alert-dismissible fade show" style="margin-bottom:30px;" role="alert">
        <span class="alert-icon-wrap"><i class="zmdi zmdi-check-circle"></i></span>'. $message. 
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>';
    }
}

function get_flash()
{
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        echo $_SESSION['error'];
        $_SESSION['error'] = '';
    }

    if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
        echo $_SESSION['success'];
        $_SESSION['success'] = '';
    }
}