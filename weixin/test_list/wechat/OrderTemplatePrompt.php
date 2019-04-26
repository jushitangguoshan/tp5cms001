<?php
require_once "WxApi.php";
class OrderTemplatePrompt extends WxApi
{
    //设置模板所属行业
    protected $industryUrl ="https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=%s";
    //获取设置的行业信息
    protected $getIndustryInfoUrl = "https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=%s";
    //获取模板id
    protected $getTemplateIdUrl = "https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=%s";
    //获取模板列表
    protected $getTemplateListUrl = "https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=%s";
    //发送模板
    protected $sendTemplateMessageUrl = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=%s";
    public $access_token;
    public function __construct()
    {
        $this->access_token = (new WxApi())->getAccessToken();
        $this->industryUrl = sprintf($this->industryUrl,$this->access_token);
        $this->getIndustryInfoUrl = sprintf($this->getIndustryInfoUrl,$this->access_token);
        $this->getTemplateIdUrl = sprintf($this->getTemplateIdUrl,$this->access_token);
        $this->getTemplateListUrl = sprintf($this->getTemplateListUrl,$this->access_token);
        $this->sendTemplateMessageUrl = sprintf($this->sendTemplateMessageUrl,$this->access_token);
    }
    
    /** 设置模板行业id
     * @param array $data 关联数组
     * @return mixed 结果集
     */
    public function setIndustryId(array $data)
    {
        $jsonData = json_encode($data);
         return $this->https_request($this->industryUrl,$jsonData);
    }
    
    /**获取设置的行业信息
     * @return mixed
     */
    public function getIndustryInfo()
    {
        return $this->https_request($this->getIndustryInfoUrl);
    }
    
    /**获取模板ID
     * @param $templataNumber 模板编号
     * @return mixed
     */
    public function getTemplateId($templateNumber)
    {
        return $this->https_request($this->getTemplateIdUrl,$templateNumber);
    }
    
    /**获取模板列表
     * @return mixed
     */
    public function getTemplateList()
    {
        return $this->https_request($this->getTemplateListUrl);
    }
    
    /**发送模板消息
     * @param array $data
     * @return mixed
     */
    public function sendTemplateMessage(array $data)
    {
        $json = json_encode($data);
        return $this->https_request($this->sendTemplateMessageUrl,$json);
    }
}
$template=new OrderTemplatePrompt();
$data = [
        "touser"=>"o-MnH1J7vt94WhpuEPf6z3u5YcOs",
        "template_id"=>"ORF_ADpA52PSh9OpFFZ0v3KTLc32wf-tDPMQeLVfSyc",
        "url"=>"www.anniluohaixing.xyz",
        "data"=>[
                "username"=>[
                    "value"=>"xxxxx",
                    "color"=>"#173177"
                ],
                "goodsname"=>[
                    "value"=>"襄梦老襄阳手工锅巴400g爆辣香辣麻辣味歪网红小吃咪大米散装零食",
                    "color"=>"#173177"
                ],
                "goodsprice"=>[
                    "value"=>"118.8元",
                    "color"=>"#173177"
                ]
            ]
];
header("content-type:text/html;charset=utf-8");
$res = $template->getTemplateList();
var_dump(json_decode($res,true));



