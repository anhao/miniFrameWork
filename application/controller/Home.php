<?php
defined('BASHPATH') OR exit('error');

class Home extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //$title= 'test';
        $data['title']='糗事百科';

        //用户
        $data['user']=$this->user;

        //分类
        $data['cate']=Db::lists('cate',array());

        //文章
        $data['cid'] = (int)(get('cid'));
        if($data['cid']){
            $where['cid']=$data['cid'];
        }else{
            $where['cid']=$data['cid']=1;
        }
        $where['status'] = 1;
        $data['page'] = max(1,(int)(get('page')));
        $order ='addtime DESC';
        $num=2;
        $data['article']=Db::pagination('article',$where,$data['page'],$num,$order);
        FrameWork::view('index', $data);

    }

    public function view()
    {
        dump(get());
    }

    public function helps()
    {
        $arr = ['user' => 'anhao', 'pass' => 'anhao'];
        dump($arr);
    }

    //
    public function db()
    {
        $where = ['tg_id' => 1001, 'tg_username' => 'anhaoyl1'];
        $res = Db::item('tg_user', $where);
        dump($res);
    }

    //列表查询
    public function lists()
    {
        $where = [];
        $order = 'id asc';
        $res = Db::lists('tg_user', $where, $order);
        dump($res);
    }

    //自定义索引
    /* public function diylist(){
         $user_lists = [
                 1=>['id'=>1,'gid'=>1,'username'=>'张三'],
             2=>['id'=>2,'gid'=>2,'username'=>'李四'],
             3=>['id'=>3,'gid'=>2,'username'=>'张武'],
         ];
         $group_lists = [
             1=>['gid'=>1,'title'=>'VIP用户'],
             2=>['gid'=>2,'title'=>'VIP高级'],
             3=>['gid'=>3,'title'=>'VIP特级'],
         ];
         foreach ($user_lists as $key=>$item){
             $group_name = isset($group_lists[$item['gid']])?$group_lists[$item['gid']]['title']:'';
             $user_lists[$key]['group_name']=$group_name;
         }

         dump($user_lists);
         echo '<hr>';
         dump($group_lists);
     }*/
    public function cates()
    {
        $where = ['tg_sex' => '女'];
        $res = Db::cates('tg_user', $where, 'tg_id', ' tg_id asc');
        dump($res);
    }

    //记录总数
    public function count()
    {
//        $where =['tg_sex'=>'男'];
        $where = '';
        $res = Db::totals('tg_user', $where);
        dump($res);
    }

    //分页
    public function page()
    {
        $where = [];
        $page = 2;
        $res = Db::pagination('tg_user', $where, $page, 5);
        dump($res);
    }

    public function in()
    {
//        $data = ['tg_username' => 'anhao', 'tg_sex' => '男'];
        $data = ['username'=>'anhao1','password'=>'a76ff72861ed59e5a4e8176a0a16905f'];
        $res = Db::insert('user', $data);
        dump($res);
    }

    public function del()
    {
        $where = ['tg_id' => '1031'];
        $res = Db::delete('tg_user', $where);
        json($res);
    }

    public function update(){
        $where = ['tg_id'=>1028];
        $data = ['tg_username'=>'sysb11031'];
        $res = Db::update('tg_user',$data,$where);
        dump($res);
    }
    //鏈式操作
    public function sysdb()
    {
//        $where = [];
        $db = new Sysdb();
      /*  $res = $db->table('tg_user')->where(array('tg_id' => 1002))->item();
        $res2 = $db->table('tg_user')->item();
        dump($res);
        dump($res2);*/
//      $res = $db->table('tg_user')->data(array('tg_username'=>'sysdb','tg_sex'=>'女'))->insert();
      $res = $db->table('tg_user')->where(array('tg_sex'=>"男"))->lists();
        dump($res);
    }
}