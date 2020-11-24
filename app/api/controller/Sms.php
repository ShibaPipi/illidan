<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\api\controller;

use app\api\validate\User;
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
        $telephone = input('telephone', '', 'trim');
        $validate = validate(User::class)->scene('send_code');
        if (!$validate->check(compact('telephone'))) {
            throw new HttpValidateException(['msg' => $validate->getError()]);
        }

        if (!SmsService::sendCode($telephone, 6)) {
            throw new SmsException();
        }

        return api_success('发送验证码成功');
    }
}
