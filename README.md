# Think-php-Group-buying
基于thinkphp5的团购网站

### 需求分析
- 系统模块
    - 商家平台
        - 商家入驻申请 
            - ajax应用
            - 更具地址获取经纬度
            - 图片上传
            - 邮件发送
        - 商家登录
            - session综合运用
        - 门店管理
            - 新增门店
            - 门店列表
            - 编辑门店
        - 商品管理
            - 添加商品
            - 商品列表            
    - 主平台
        - 分类管理
            - 添加分类
            - 分类列表
            - 分类排序
            - 修改状态
            - 修改分类
            - 删除分类
            - 获取子栏目
            - 分页处理
        - 城市管理
        - 商家管理
            - 商户入驻申请审批
            - 商户列表
        - 团购商品商品管理
            - 商家提交的商品列表
            - 商家提交的商品审批
            - 商品列表
            - 商品搜索
            - 分页 排序 修改状态
        - 推荐位管理
            - 增删改查
        - 会员管理
            - 增删改查
        - 订单管理
            - 增删改查
    - 前台模块
        - 首页
        - 商品列表页
        - 商品详情页
        - 订单确认页
        - 微信支付
        - 消费劵
        - 登录注册
- 表的设计
    - 表的创建
    ![表的设计](./README/IMG/database1.png)        

>TP5 WEBSERVER
``` 
php -S localhost:8181 router.php

nohup php -S localhost:8181 router.php &
ps aux | grep 8181

php think make:controller index/Test
```    
> 自动化模块搭建 `build.php`
``` 
php think build
```
> 前端模块页面搭建
``` 
Controller>Index.php
view>index>index.html --> public>[footer|header|main]
[css|js|img] --> public>static>[]>css|js|img
```
### 主后台生活服务类模块
- 添加分类
``` 
模板form表单数据->控制器->validate校验->model->入库
{:url('控制器')}
控制接受参数
input('post.');
request()->post();
```
- validate
``` 
namespace app\admin\validate;
use think\Validate;
class Category extends Validate
{
    protected $rule = [
        ['name','require|max:10','分类名不能为空|分类名不能超过10个字符'],#id,规则,提示词
        ['parent_id','number'],
        ['id','number'],
        ['status','number|in:-1,0,1','状态必须为数字|状态范围不合法'], #in 范围-1,0,1
        ['listorder','number'],
    ];
//    场景设置
    protected $scene = [
        'add' => ['name','parent_id'],//添加功能场景设置
        'listorder' => ['id','listorder'],//排序
    ];
}

    public function save()
    {
//        print_r($_POST);
//        dump(input('post.'));
//        dump(request()->post());
        $data = input('post.');
//        $data['status'] = 10;
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){ #return bool
            $this->error($validate->getError());
        }
//        dump($data);
        //把$data 提交到 model层
    }
    $validate->check($data) 可以直接调用不设置场景默认全部校验
```
- model-save 分类数据保存
``` 
        //把$data 提交到 model层
        $res = $this->obj->add($data); #1 or 0
        if ($res){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
        
        protected $autoWriteTimestamp = true;#自动time
            public function add($data)
            {
                $data['status'] = 1;
        //        $data['create_time'] = time();
                return $this->save($data);
            }
```
- TP5分页机制
``` 
model部分
        $result =  $this->where($data)
                    ->order($order)
//                    ->select();
                    ->paginate(2); #listRows每页现实多少条
html部分
    <div class="cl pd-5 bg-1 bk-gray mt-20 tp5-o2o">{$categorys->render()}</div>      
```
- 编辑功能
> 查询数据-> 填充模板-> 提交数据->update
``` 
    <input type="hidden" name="id" value="{$category.id}">
    category判断if !empty(id) ->save()
```
- 排序功能
> ajax异步处理
``` 
table 一个排序参数
然后 model层 通过order实现排序
```
- 修改状态
> model save(状态的数组值,条件)

### 商户模块
- 商家入驻申请-数据准备
- 商户入驻申请-图片上传处理
``` 
上传插件 uploadify
编写image.js
编写图片上传API接口实现异步上传
use think\Controller;
use think\Request;
use think\File;
class Image extends Controller
{
    public function upload()
    {
        $file = Request::instance()->file('file');
        //给定一个dir
        $info = $file->move('upload');#在入口文件public文件下new dir
//        dump($info);
        if($info && $info->getPathname())
        {
            return show(1,'success','/'.$info->getPathname());
        }
        return show(0,'upload,error');
    }
}
js>
js定位到上传file get file ajax到php 得到requestUrl 写入html hidden内容
```
- 商户入驻申请-数据库入库
    - 利用validate机制进行数据校验 
    - 3类数据库入库(商家基本信息,总店信息,商家账号信息)
    ``` 
    当商家信息入库时获取商家信息id
    当店铺信息入库时获取写入商家id获得店铺id
    当账号信息入库时写入商家id和店铺id
    ```
    - 商户入驻申请Model层code复用
    - 提示页面开发
- 主后台入驻列表开发
> 商户入驻申请->主后台入驻列表页->查询->审核 
``` 
{:url}->controller->model->view
```   
- 主后台商户列表
>审核通过->商户列表页呈现
- TP5 session 处理后台登录
``` 
session('bisAccount',$ret,'bis');//key,value,作用域[如实例作用域为BIS模块]
use think\Controller;
class Login extends Controller
{
    public function index()
    {
        if (request()->isPost()){
            //处理登录逻辑
            //获取相关数据
            $data = input('post.');
            //通过用户名 获取用户相关信息

            //严格校验 此处省略
            $ret = model('BisAccount')->get(['username'=>$data['username']]);
            if (!$ret || $ret->status!=1){
                $this->error($ret->status.'该用户不存在或者用户未被审核通过');
            }
            if($ret->password != md5($data['password'].$ret->code)){
                $this->error('该用户不存在或者用户未被审核通过');
            }
            model('BisAccount')->updateById(['last_login_time'=>time()],$ret->id);
            //保存用户信息
            session('bisAccount',$ret,'bis');//key,value,作用域[如实例作用域为BIS模块]
            $this->success('登录成功',url('index/index'));
        }else{
            //获取session值
            $account = session('bisAccount','','bis');
            if ($account && $account->id){
                return $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }
    }

    public function loginout()
    {
        $account = session('bisAccount','','bis');
        if ($account && $account->id){
            session(null, 'bis');
            $this->redirect('login/index');
        }
    }
}
```
>注释避免重复执行:
``` 
    public $account;
    //获取session
    public function getLoginUser()
    {
        if (!$this->account){
            $this->account = session('bisAccount','','bis');
        }
        return $this->account;
    }
```
- 门店管理
    - 商户管理员添加门店
    - 列表页,门店查看,下架等操作
    - 主后台管理员审核
- 团购模块设计    
    





    
    
        