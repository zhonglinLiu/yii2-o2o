<?php
namespace app\Module\bis\controllers;
use app\controllers\common\BaseController;
class CommonController extends BaseController{
	 protected $field = 'bis';
     protected $allowAction = [
           'login/index',
     ];
     protected $redirect = 'login/index';

}