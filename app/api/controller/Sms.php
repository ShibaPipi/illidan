<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\api\controller;

use app\api\validate\User as UserValidate;
use app\BaseController;
use app\common\exception\HttpValidateException;
use app\common\exception\SmsException;
use app\common\service\Sms as SmsService;
use think\response\Json;

class Sms extends BaseController
{
    /**
     * @return Json
     * @throws HttpValidateException
     * @throws SmsException
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \ReflectionException
     */
    public function code(): Json
    {
        (new UserValidate)->scene('send_code')->execute()
        && SmsService::sendCode(input('telephone'), 6);

        return api_success('发送验证码成功');
    }
}
