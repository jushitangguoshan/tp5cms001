<?php
/**
 * xfree_lipstick模块微站定义
 *
 * @author Mob658447422108
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Xfree_lipstickModuleSite extends WeModuleSite {

    public function __construct()
    {
        // 引入公共文件
        require_once 'func.php';
    }


	public function doMobileIndex() {
        //这个操作被定义用来呈现 功能封面
        global $_GPC, $_W;

        load()->func('tpl');
        include $this->template('index');
	}

    public function doMobileDemo() {
        //这个操作被定义用来呈现 功能封面
        global $_GPC, $_W;

        $set = $this->get_shareset();   // 分享设置
        $_share = array('title'   => $set['share_title'], 'imgUrl'  => $set['share_img'], 'desc' => $set['share_desc']); // 分享文案

        load()->func('tpl');
        include $this->template('demo');
    }


	public function doMobileGame() {
		//这个操作被定义用来呈现 功能封面
        global $_GPC, $_W;

        $set = $this->get_shareset(); // 分享设置
        $_share = array('title'   => $set['share_title'], 'imgUrl'  => $set['share_img'], 'desc' => $set['share_desc']);  // 分享文案

        if ($set['need_follow'] == 1 && (empty($_W['openid']) || $_W['fans']['follow'] != 1)) {
            // 先关注公众号才能正式参与游戏
            message('请先关注公众号再来参加活动吧！',  $this->createMobileUrl('about'), 'error');
        }

        load()->func('tpl');
        include $this->template('play');
    }



    public function doMobileAbout() {
        //这个操作被定义用来呈现 引导关注
        global $_GPC, $_W;

        if (!empty($_W['openid']) && $_W['fans']['follow'] == 1) {
            message('您已经关注公众号',  $this->createMobileUrl('game'), 'success');
        }

        $set = $this->get_shareset(); // 分享设置
        $_share = array('title'   => $set['share_title'], 'imgUrl'  => $set['share_img'], 'content' => $set['share_desc']);  // 分享文案

        // 没有引导关注链接 到about关注页
        load()->func('tpl');
        include $this->template('about');
    }


    public function doWebIndex(){
        //这个操作被定义用来呈现 管理中心导航菜单
        global $_W, $_GPC;

        $set = $this->get_sysset();

        load()->func('tpl');
        include $this->template('index');
    }


    public function doWebSetting(){
        //这个操作被定义用来呈现 管理中心导航菜单
        global $_GPC;

        // 接口操作
        $op = $_GPC['op'] ? $_GPC['op'] : 'base';

        switch ($op) {
            case 'base':
            default:
                // 粉丝列表页
                $this->webSettingBase();
                break;
        }
    }


    private function webSettingBase(){
        // 基本设置
        global $_GPC, $_W;

        // 获取设置
        $set = $this->get_sysset();

        if(checksubmit('submit')) {
            $data = $_GPC['set']; // 获取打包值

            empty($data['name']) && message('请填写应用名');
            $data['need_follow'] == 1 && empty($data['qrcode']) && message('请选择公众号二维码');

            if(empty($set)){
                $data['uniacid'] = $_W['uniacid'];

                $ret = pdo_insert(TABLE_SYSSET, $data);
                if (!empty($ret)) {
                    $id = pdo_insertid();
                }
            } else {
                $ret = pdo_update(TABLE_SYSSET, $data, array('id'=>$set['id']));
            }

            if (!empty($ret)) {
                message('基础设置成功', 'refresh', 'success');
            } else {
                message('基础设置失败', 'refresh', 'error');
            }
        }

        // 输出页面
        load()->func('tpl');
        include $this->template('setting_base');
    }


    private function get_sysset(){
        // 获取系统配置
        global $_W;

        return  pdo_fetch("SELECT * FROM " . tablename(TABLE_SYSSET) . " WHERE uniacid = :uniacid limit 1", array(':uniacid' => $_W['uniacid']));
    }


    private function get_shareset(){
        // 获取分享配置
        global $_W;

        $set =  pdo_fetch("SELECT * FROM " . tablename(TABLE_SYSSET) . " WHERE uniacid = :uniacid limit 1", array(':uniacid' => $_W['uniacid']));

        // 应用名
        if(empty($set['name'])) $set['name'] = $_W['page']['title'];

        // 分享文案
        if(empty($set['share_title'])) $set['share_title'] = $set['name'];
        if(empty($set['share_desc'])) $set['share_desc'] = '火爆抖音的口红机游戏，快来挑战吧。';
        if(empty($set['share_img'])){
            $set['share_img'] = $_W['current_module']['logo'];
        } else {
            $set['share_img'] = tomedia($set['share_img']);
        }

        return $set;
    }
}