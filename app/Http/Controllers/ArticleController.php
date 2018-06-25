<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleModel;
use App\funsModel;

class ArticleController extends Controller
{

    public function Like_zan(Request $request)
    {
        $user_id = $request->input("user_id");
        $page = $request->input("page");
        $sear = new ArticleModel();
        $ret = $sear->Like_zan($user_id,$page);
        if($ret == FALSE){
            $res = array(
                "errNo" => "0003",
                "errMsg" => "系统错误"
            );
            $this->_response($res);
        }elseif(isset($ret['errNo'])){
            $this->_response($ret);
        }

        $res = array(
            "errNo" => 0,
            "errMsg" => "点赞成功",
            "data" => $ret
        );

        
        $this->_response($res);
    }
    /**
     * 搜索关键字
     * Author Liuran
     * Date 2018-04-09
     * Route::post('/CheckCode/search', 'CheckCodeController@search');
     */
    public function search(Request $request){

        $keyword = $request->input("keyword");
        $user_id = $request->input("user_id");
       // var_dump($keyword);die;
         if(empty($keyword)){
            $res = array(
                "errNo" => "0003",
                "errMsg" => "缺少关键字"
            );
            $this->_response($res);
        } 
        $sear = new funsModel();
        $arr = $sear->search($keyword,$user_id);


        if($arr == FALSE){
            $res = array(
                "errNo" => "0002",
                "errMsg" => "未找到相关游戏"
            );
            $this->_response($res);
        }

        $res = array(
            "errNo" => 0,
            "errMsg" => "success",
            "data" => $arr
        );
          $this->_response($res);
    }

/**
 * 历史搜索 
 * Author Amber
 * Date 2018-06-21
 * Params [params]
 * @param string $value [description]
 */
    public function history_Search(Request $request)
    {
        $user_id = intval($request->input("user_id"));
        $sear = new funsModel();
        $arr = $sear->history_Search($user_id);
        if($arr == FALSE){
            $res = array(
                "errNo" => "0002",
                "errMsg" => "历史记录为空,快搜索吧~"
            );
            $this->_response($res);
        }

        $res = array(
            "errNo" => 0,
            "errMsg" => "success",
            "data" => $arr
        );
          $this->_response($res);


    }

/**
 * 增加阅读量 
 * Author Amber
 * Date 2018-06-12
 * Params [params]
 * @param Request $request [description]
 */
    public function addArticleRead(Request $request)
    {
        $article_id = intval($request->input("article_id"));
        $ArticleModel = new ArticleModel();

        $ret = $ArticleModel->addArticleRead($article_id);
        if($ret == FALSE){
            $res = array(
                "errNo" => "0003",
                "errMsg" => "系统错误"
            );
            $this->_response($res);
        }elseif(isset($ret['errNo'])){
            $this->_response($ret);
        }

        $res = array(
            "errNo" => 0,
            "errMsg" => "success"
        );

        $this->_response($res);

    }
    /*
    获取短文章详情
     */
    public function getD_ArtInfo(Request $request)
    {
          $article_id = intval($request->input("article_id"));

        if(empty($article_id)){
            $res = array(
                "errNo" => "0002",
                "errMsg" => "缺少必要的参数"
            );
            $this->_response($res);
        }

        $ArticleModel = new ArticleModel();

        $ret = $ArticleModel->getD_ArtInfo($article_id);

        if($ret == FALSE){
            $res = array(
                "errNo" => "0003",
                "errMsg" => "系统错误"
            );
            $this->_response($res);
        }elseif(isset($ret['errNo'])){
            $this->_response($ret);
        }

        $res = array(
            "errNo" => 0,
            "errMsg" => "success",
            "data" => $ret
        );

        $this->_response($res);
    }
    /*
    获取文章详情
     */
    public function getArticleInfo(Request $request)
    {
        $article_id = intval($request->input("article_id"));

        if(empty($article_id)){
            $res = array(
                "errNo" => "0002",
                "errMsg" => "缺少必要的参数"
            );
            $this->_response($res);
        }

        $ArticleModel = new ArticleModel();

        $ret = $ArticleModel->getArticleInfo($article_id);

        if($ret == FALSE){
            $res = array(
                "errNo" => "0003",
                "errMsg" => "系统错误"
            );
            $this->_response($res);
        }elseif(isset($ret['errNo'])){
            $this->_response($ret);
        }

        $res = array(
            "errNo" => 0,
            "errMsg" => "success",
            "data" => $ret
        );

        $this->_response($res);
    }

    
    /**
 * 短文章详情页 + 游戏模块
 * Author Amber
 * Date 2018-06-12
 * Params [params]
 * @param string $value [description]
 */
    public function getD_ArtInfo_game($value='')
    {
        
    }

    public function shorts()
    {
        return view('rbac/shorts');
    }

    public function shorts_add()
    {
        echo 1;die;
    }

}