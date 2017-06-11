<?php
namespace tests\models;
use app\models\User;

class UsersTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $model;

    protected function _before()
    {
        $this->model = new User;
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {
        $data = [
            'username'=>'liu',
            'password'=>'123456',
        ];
        $this->model->scenario = 'login';
        $this->model->setAttributes($data);
        expect_that($this->model->validate());
       /* $flog = $this->model->setAttributes($data) ? true : false;
        $this->assertFalse($flog,'错误');*/
    }
}