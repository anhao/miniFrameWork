<?php

class Article extends Base
{
    public function publish()
    {
        $data['cates'] = Db::cates('cate', array(), 'cid');
        FrameWork::view('article', $data);
    }

    public function dopublish()
    {
        if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {
            // ajax 请求的处理方式
            $data['title'] = trim(post('title'));
            $data['cid'] = trim((int)post('cate'));
            $data['content'] = trim(post('content'));
            if ($data['title'] == '') {
                exit(json(['code' => 1, 'msg' => '帖子标题不能为空']));
            }
            if ($data['cid'] <= 0) {
                exit(json(['code' => 1, 'msg' => '帖子分类不能为空']));
            }
            $cate = Db::item('cate', array('cid' => $data['cid']));
            if (!$cate) {
                exit(json(['code' => 1, 'msg' => '分类错误']));
            }
            if ($data['content'] == '') {
                exit(json(['code' => 1, 'msg' => '帖子内容不能为空']));
            }
//        $data['content'] = htmlspecialchars($data['content']);
            $data['uid'] = $this->user['uid'];
            $data['status'] = 1;
            $data['addtime'] = time();
            $res = Db::insert('article', $data);
            if ($res['status'] == 0) {
                exit(json(['code' => 1, 'msg' => '发帖失败']));
            }
            exit(json(['code' => 0, 'msg' => '发帖成功']));
        }else{
            exit(json(['err'=>'错误，不是ajax请求']));
        }
    }

}