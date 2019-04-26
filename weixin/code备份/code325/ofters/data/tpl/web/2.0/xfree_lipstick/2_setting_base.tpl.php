<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<ul class="nav nav-tabs">
    <li class="active"><a href="<?php  echo $this->createWebUrl('setting')?>">基础设置</a></li>
</ul>

<div class="main">
    <form action="" method="post" class="form-horizontal form" id="form">
        <div class="panel panel-default">
            <div class="panel-heading">基本设置（必填）</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">应用名<font class="text-danger">*</font></label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="set[name]" class="form-control" value="<?php  echo $set['name'];?>" placeholder="请输入应用名..."  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">是否需要关注微信<font class="text-danger">*</font></label>
                    <div class="col-xs-12 col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" name="set[need_follow]" value="0" <?php  if($set['need_follow'] == 0) { ?>checked="checked"<?php  } ?>>否，不需要关注微信也可以玩
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="set[need_follow]" value="1" <?php  if($set['need_follow'] != 0 || $set === false) { ?>checked="checked"<?php  } ?>>是，关注微信才可以玩【正式游戏】
                        </label>
                    </div>
                </div>
                <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>注意！</strong>使用引导关注，判断是否关注公众号，需要<strong class="text-danger">【微信认证服务号】</strong>，不然无法通过关注判断。
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">公众号二维码<font class="text-danger">*</font></label>
                    <div class="col-xs-12 col-sm-8">
                        <?php  echo tpl_form_field_image('set[qrcode]', $set['qrcode']);?>
                        <div class="help-block">公众号二维码。</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">微信分享自定义（非必填）</div>
            <div class="panel-body">
                <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>注意！</strong>配置自定义微信分享内容，需要<strong class="text-danger">【微信认证订阅号】</strong>或 <strong class="text-danger">【微信认证订阅号】</strong>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">自定义分享标题</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="set[share_title]" class="form-control" value="<?php  echo $set['share_title'];?>" placeholder="请输入朋友圈分享标题...（默认为应用名）"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享描述</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="set[share_desc]" class="form-control" value="<?php  echo $set['share_desc'];?>" placeholder="请输入朋友圈分享标题...（默认：火爆抖音的口红机游戏，快来挑战吧。）"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享图标</label>
                    <div class="col-xs-12 col-sm-8">
                        <?php  echo tpl_form_field_image('set[share_img]', $set['share_img']);?>
                        <div class="help-block">默认：应用的图标。</div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-wxapp-bottom navbar-fixed-bottom" role="navigation">
            <div class="container">
                <div class="pager">
                    <input type="hidden" name="id" value="<?php  echo $set['id'];?>"/>
                    <input name="submit" type="submit" value="全部提交" class="btn btn-primary"/>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
                </div>
            </div>
        </nav>
    </form>
</div>

<script>
    require(['jquery', 'util'], function($, util){
        $(function(){
            $('#form').submit(function(){
                if($('input[name="set[name]"]').val() == ''){
                    util.message('请填写应用名称.');
                    return false;
                }

                if($('input[name="set[qrcode]"]').val() == '' && $('input[name="set[need_follow]"]:checked').val() == 1){
                    util.message('请选择一个公众号二维码');
                    return false;
                }
                return true;
            });
        });
    });
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>