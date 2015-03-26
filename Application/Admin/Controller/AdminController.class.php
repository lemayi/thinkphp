<?php

namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller {
    
    protected function _initialize(){
        $this->redirect('public/login');
    }

}