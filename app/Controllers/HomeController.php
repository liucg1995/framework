<?php
/**
 * \HomeController
 */


class HomeController extends BaseController
{

    public function home()
    {
       $artical = Article::paginate(1);
       echo  View::getView()->make('index', ['b' => $artical])->render();
//        require dirname(__FILE__).'/../views/home.php';

        /**
         * 发送邮件
         */

//        $this->mail = Mail::to([ '164445438@qq.com'])
//
//            ->from('liu <liu33443344@163.com>')
//
//            ->title('Fuck Me!')
//
//            ->content('<h1>Hello~~</h1>');

//        Redis::set('key','value',20,'s');
//
//        echo Redis::get('key');
    }
}