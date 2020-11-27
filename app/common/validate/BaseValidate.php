<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/26
 */
declare(strict_types=1);

namespace app\common\validate;

use app\common\exception\HttpValidateException;
use think\Validate;

class BaseValidate extends Validate
{
    /**
     * 执行验证
     * @return bool
     * @throws HttpValidateException
     */
    public function execute(): bool
    {
        $params =  request()->param();
        if (!$this->check($params)) {
            throw new HttpValidateException([
                'msg' => is_array($this->error) ? implode('; ', $this->error) : $this->error
            ]);
        }
        return true;
    }
}
