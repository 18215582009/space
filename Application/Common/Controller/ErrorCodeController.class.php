<?php
namespace Common\Controller;
use Think\Controller;
/**åå
 * @author --by xiewen
 */
class ErrorCodeController extends Controller {
	     const  ON  = 1 ; //状态值
	     const  OFF  = 0 ; //状态值
       const  SUCCESS = 200; //请求成功
       const  NOT_FOUND  = 404 ; //未找到数据
       const  BAD_REQUEST = 400 ;// 资源已经不再可用
       const  REQUEST_ERROR = 500;//请求错误
       const  UNAUTHORIZED = 401;//未授权
       const  FORBIDDEN = 403 ;//禁止访问
       const  UPLOAD_IMAGES = 10001;//请上传1-9张图片
       const  PUBLISH_FAILD = 10002 ;//上传失败
       const NOT_REPLY_SELF = 10003 ;//不能回复自己
       const COMMENT_FAILD = 10004 ;//评论失败
       const REPOST_ID_NOT_NULL = 10005;//转发id不能为空
       const REPOST_CONTENT_NOT_NULL  = 10006 ;//转发内容不能为空
       const FEED_ID_NOT_NULL = 10007 ;//分享id不能为空
       const NOT_DELETE_ANOTHER  = 10008;//不能删除,不是自己的
       const USER_IS_EXISTS = 10009;//用户不存在
       const USERID_NOT_NULL =  100010;//用户id不能为空
       const MESSAGE_ID_NOT_NULL = 100011;//消息id不能为空
       const FOLLOW_ALREADY = 100012 ;//已经关注该用户
       const CREATE_COMMENT_ERROR = 100013;//评论错误
       const CONTENTS_NOT_NULL = 100014 ;//内容不能为空
       const CREATE_INFO_FAILD = 100015;//创建内容失败
       const NOT_SEND_SELF = 100016;//不能私信自己
       const UPLOAD_IMAGES_NOT_NULL = 100017;// 图片上传不能为空
       const SHOP_ID_NOT_NULL = 100018; //商户id不能为空
       const FLISH_FAILD = 100019;//上传失败
       const PUBLISH_FEED_FAILD =  100020;//发布分享失败
       const NOT_MESSAGE_SELF = 100021;//不能私信自己
       const LNG_NOT_NULL = 100022;// 经度不能为空
       const LAT_NOT_NULL =100023;//纬度不能为空
       const NOT_IN_REGION = 100024;//不再坐标范围内
       const NOT_FOLLOW_SELF = 100025;//不能关注自己
       const FOLLOW_ID_NOT_NULL = 100026;//关注id不能为空
       const USERINFO_UPLOAD_FAILD = 100027;//个人信息上传失败
       const REGISTER_FAILD = 100028;//自动注册失败
       const WECHAT_REGISTER_FAILD = 100029;//自动注册微信失败


}



?>
