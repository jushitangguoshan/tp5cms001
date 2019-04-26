<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('account/account-header', TEMPLATE_INCLUDEPATH)) : (include template('account/account-header', TEMPLATE_INCLUDEPATH));?>
<div id="js-account-manage-base" ng-controller="AccountManageBase" ng-cloak>
	<div class="alert alert-info we7-page-alert" ng-if="account.isconnect == 0">
		<p><i class="wi wi-info-sign"></i>接入状态：未接入。</p>
		<p><i class="wi wi-info-sign"></i>解决方案：进入微信公众平台，依次选择: 开发者中心 -> 修改配置，然后将对应公众号在平台的url和token复制到微信公众平台对应的选项，公众平台会自动进行检测</p>
	</div>
	<table class="table we7-table table-hover table-form">
		<col width="140px" />
		<col />
		<col width="100px" />
		<tr>
			<th class="text-left" colspan="3">公众号设置</th>
		</tr>
		<tr>
			<td class="table-label">头像</td>
			<td><img ng-src="{{other.headimgsrc}}" width="75px" height="75px" /></td>
			<td class="text-right"><div class="link-group"><a href="javascript:;" ng-click="changeImage('headimgsrc','<?php  echo $uniacid;?>')">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">二维码</td>
			<td><img ng-src="{{other.qrcodeimgsrc}}" ng-if="other" width="75px" height="75px"></td>
			<td class="text-right"><div class="link-group"><a href="javascript:;" ng-click="changeImage('qrcodeimgsrc','<?php  echo $uniacid;?>')">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">公众号名称</td>
			<td ng-bind="account.name"></td>
			<td class="text-right"><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#name" ng-click="editInfo('name', account.name)">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">帐号</td>
			<td ng-bind="account.account"></td>
			<td class="text-right"><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#account" ng-click="editInfo('account', account.account)">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">原始ID</td>
			<td ng-bind="account.original"></td>
			<td class="text-right"><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#original" ng-click="editInfo('original', account.original)">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">类型</td>
			<td ng-if="account.level == 1">普通订阅号</td>
			<td ng-if="account.level == 2">普通服务号</td>
			<td ng-if="account.level == 3">认证订阅号</td>
			<td ng-if="account.level == 4">认证服务号/认证媒体/政府订阅号</td>
			<td ng-if="account.level == 0">---</td>
			<td class="text-right"><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#level" ng-click="editInfo('level', account.level)">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">接入方式</td>
			<td ng-if="account.type == 1">普通接入</td>
			<td ng-if="account.type == 3">授权接入</td>
			<td class="text-right" >
				<div class="link-group" ng-if="authstate && authurl">
					<a href="javascript:;" data-toggle="modal" data-target="#jointype" ng-click="editInfo('type', account.type)">修改</a>
				</div>
			</td>
		</tr>
		
		<tr>
			<td class="table-label">到期时间</td>
			<td><span ng-bind="account.end"></span><span class="color-gray"></span></td>
			<td class="text-right">
				<div class="link-group" ng-if="founder || owner">
					<a href="javascript:;" data-toggle="modal" data-target="#endtype" ng-click="editInfo('endtype', account.endtype)">修改</a>
					
				</div>
			</td>
		</tr>
		<tr>
			<td class="table-label">本地附件空间</td>
			<td>
				<span ng-if="account.attachment_limit != -1">{{account.attachment_limit}}M</span>
				<span ng-if="account.attachment_limit == -1">不限</span>
			</td>
			<td class="text-right">
				<div class="link-group" ng-if="founder || owner">
					<a href="javascript:;" data-toggle="modal" data-target="#attachment_limit" ng-click="editInfo('attachment_limit', account.attachment_limit)">修改</a>
				</div>
			</td>
		</tr>
		<tr>
			<td class="table-label">已用附件空间</td>
			<td><span ng-bind="account.attachment_size"></span><span>M</span></td>
			<td ></td>
		</tr>
	</table>
	<div class="modal fade" id="attachment_limit" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改公众号附件空间大小</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="number" ng-model="middleAccount.attachment_limit" class="form-control"/>
						<span class="help-block">请输入单位为 M 的内存值，设置为 -1 时不限空间。</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="httpChange('attachment_limit')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="name" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改公众号名称</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="middleAccount.name" class="form-control" placeholder="公众号名称" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="httpChange('name')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="account" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改公众号账号</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="middleAccount.account" class="form-control" placeholder="公众号账号" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="httpChange('account')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="original" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改公众号原始ID</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="middleAccount.original" class="form-control" placeholder="公众号原始ID" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="httpChange('original')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="level" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改公众号类型</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<select class="we7-select" ng-model="middleAccount.level">
							<option value="1" ng-selected="middleAccount.level == 1">普通订阅号</option>
							<option value="2" ng-selected="middleAccount.level == 2">普通服务号</option>
							<option value="3" ng-selected="middleAccount.level == 3">认证订阅号</option>
							<option value="4" ng-selected="middleAccount.level == 4">认证服务号/认证媒体/政府订阅号</option>
						</select>
						<span class="help-block">注意：即使公众平台显示为“未认证”, 但只要【公众号设置】/【账号详情】下【认证情况】显示资质审核通过, 即可认定为认证号.</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="httpChange('level')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="endtype" role="dialog">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">设置到期时间</div>
				</div>
				<div class="modal-body">
					<div class="form-group" ng-if="middleAccount.endtype == 1 || founder">
						<input id="endtype-1" type="radio" name="endtype" value="2" ng-model="middleAccount.endtype" ng-checked="middleAccount.endtype == 2"><label for="endtype-1">设置期限</label>
						<input id="endtype-2" type="radio" name="endtype" value="1" ng-model="middleAccount.endtype" ng-checked="middleAccount.endtype == 1"><label for="endtype-2" class="hidden">永久</label>
					</div>
					<div class="form-group" ng-show="middleAccount.endtype == 2">
						<?php  echo tpl_form_field_date('endtime', $account['endtime']);?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="httpChange('endtime')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="jointype" role="dialog">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改接入方式</div>
				</div>
				<div class="modal-body text-center">
					<input id="type-1" type="radio" name="jointype" value="1" ng-model="middleAccount.type" ng-checked="middleAccount.type == 1">
					<label class="radio-inline" for="type-1">普通接入</label>
					<input id="type-2" type="radio" name="jointype" value="3" ng-model="middleAccount.type" ng-checked="middleAccount.type == 3">
					<label class="radio-inline" for="type-2">授权接入</label>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="httpChange('jointype')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>

	<table class="table we7-table table-hover">
		<col width="140px " />
		<col />
		<col width="100px" />
		<tr><th class="text-left" colspan="3">自定义菜单通讯设置</th></tr>
		<tr>
			<td class="table-label">AppId</td>
			<td ng-bind="account.key"></td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#key"  ng-click="editInfo('key', account.key)">修改</a></div></td>
		</tr>
		<tr>
			<td class="table-label">AppSecret</td>
			<td ng-bind="account.secret"></td>
			<td><div class="link-group"><a href="javascript:;" data-toggle="modal" data-target="#secret"  ng-click="editInfo('secret', account.secret)">修改</a></div></td>
		</tr>
	</table>
	<div class="modal fade" id="key" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改公众号AppId</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="middleAccount.key" class="form-control" placeholder="公众号AppId" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="httpChange('key')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="secret" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改公众号AppSecret</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" ng-model="middleAccount.secret" class="form-control" placeholder="公众号AppSecret" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="httpChange('secret')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<table class="table we7-table ">
		<col width="160px" />
		<col />
		<col width="230px"/>
		<tr><th class="text-left" colspan="3">公众平台通信</th></tr>
		<tr>
			<td class="table-label">URL<p>(服务器地址)</p></td>
			<td>
				<a href="javascript:;" class="we7-padding-right" ng-bind="other.serviceUrl"></a>
			</td>
			<td>
				<div class="link-group"><a href="javascript:;" id="copy-0" clipboard supported="supported" text="other.serviceUrl" on-copied="success('0')">点击复制</a></div>
			</td>
		</tr>
		<tr>
			<td class="table-label">Token<p>(令牌)</p></td>
			<td>
				<a href="javascript:;" class="we7-padding-right" ng-bind="account.token"></a>
			</td>
			<td>
				<div class="link-group">
					<a href="javascript:;" data-toggle="modal" data-target="#token">修改</a>
					<a href="javascript:;" data-dismiss="modal" ng-click="httpChange('token')">生成新的</a>
					<a href="javascript:;" id="copy-1" clipboard supported="supported" text="account.token" on-copied="success('1')">点击复制</a>
				</div>
			</td>
		</tr>
		<tr>
			<td class="table-label">EncodingAESKey<p>(消息加解密密钥)</p> </td>
			<td>
				<a href="javascript:;" class="we7-padding-right" ng-bind="account.encodingaeskey"></a>
			</td>
			<td>
				<div class="link-group">
					<a href="javascript:;" data-toggle="modal" data-target="#encodingaeskey">修改</a>
					<a href="javascript:;" data-dismiss="modal" ng-click="httpChange('encodingaeskey')">生成新的</a>
					<a href="javascript:;" id="copy-2" clipboard supported="supported" text="account.encodingaeskey" on-copied="success('2')">点击复制</a>
				</div>
			</td>
		</tr>
	</table>
	<div class="modal fade" id="token" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改token</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" id="newtoken" class="form-control" placeholder="请填写新的公众号消息校验Token" />
						<span class="help-block">与公众平台接入设置值一致，必须为英文或者数字，长度为3到32个字符. 请妥善保管, Token 泄露将可能被窃取或篡改平台的操作数据.</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('token', 'edit')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="encodingaeskey" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="we7-modal-dialog modal-dialog we7-form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<div class="modal-title">修改EncodingAESKey</div>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" id="newencodingaeskey" class="form-control" placeholder="请填写新的公众号消息加解密Key" />
						<span class="help-block">与公众平台接入设置值一致，必须为英文或者数字，长度为43个字符. 请妥善保管, EncodingAESKey 泄露将可能被窃取或篡改平台的操作数据.</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="httpChange('encodingaeskey', 'edit')">确定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	angular.module('accountApp').value('config', {
		founder : <?php  if($_W['isfounder']) { ?>true<?php  } else { ?>false<?php  } ?>,
		owner : <?php  if($state == 'owner') { ?>true<?php  } else { ?>false<?php  } ?>,
		account: <?php echo !empty($account) ? json_encode($account) : 'null'?>,
		uniaccount: <?php echo !empty($uniaccount) ? json_encode($uniaccount) : 'null'?>,
		headimgsrc: "<?php  echo $headimgsrc?>",
		qrcodeimgsrc: "<?php  echo $qrcodeimgsrc?>",
		authstate: "<?php  echo $_W['setting']['platform']['authstate']?>",
		authurl: <?php echo !empty($authurl) ? json_encode($authurl) : 'null'?>,
		links: {
			basePost: "<?php  echo url('account/post/base', array('acid' => $acid, 'uniacid' => $uniacid, 'account_type' => ACCOUNT_TYPE))?>",
			siteroot: "<?php  echo $_W['siteroot']?>",
		},
	});
	angular.bootstrap($('#js-account-manage-base'), ['accountApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>