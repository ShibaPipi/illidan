<?php
/**
 * 阿里云短信服务
 * Created By 皮神
 * Date: 2020/11/24
 */
declare(strict_types=1);

namespace app\common\library\sms;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use think\facade\Log;

class Ali implements SmsInterface
{
    /**
     * 发送短信验证码
     * @param string $phone
     * @param int $code
     * @return bool
     * @throws ClientException
     */
    public static function sendCode(string $phone, int $code): bool
    {
        AlibabaCloud::accessKeyClient(config('ali_cloud.sms.access_key_id'), config('ali_cloud.sms.access_key_secret'))
            ->regionId(config('ali_cloud.sms.region_id'))
            ->asDefaultClient();
        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host(config('ali_cloud.sms.host'))
                ->options([
                    'query' => [
                        'RegionId' => config('ali_cloud.sms.region_id'),
                        'PhoneNumbers' => $phone,
                        'SignName' => config('ali_cloud.sms.sign_name'),
                        'TemplateCode' => config('ali_cloud.sms.template_code'),
                        'TemplateParam' => json_encode(compact('code')),
                    ],
                ])
                ->request();

            Log::info("Ali-sms-sendCode-to-{$phone}-result: " . json_encode($result->toArray()));
        } catch (ClientException $e) {
            Log::error("Ali-sms-sendCode-to-{$phone}-ClientException: " . $e->getErrorMessage());
            return false;
        } catch (ServerException $e) {
            Log::error("Ali-sms-sendCode-to-{$phone}-ServerException: " . $e->getErrorMessage());
            return false;
        }
        return isset($result['Code']) && 'OK' === $result['Code'];
    }
}
