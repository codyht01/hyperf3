<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

#[Constants]
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("Server Error！")
     */
    const SERVER_ERROR = 500;
    /**
     * @Message ("系统参数错误")
     */
    const SYSTEM_INVALID = 700;
    /**
     * 返回正常
     */
    const STATUS_SUCCESS = 1;
    /**
     * 返回错误
     */
    const STATUS_ERROR = 0;
    /**
     * 没有登录
     */
    const STATUS_NO_LOGIN = 401;
    /**
     * 数据正常
     */
    const MYSQL_SUCCESS = 1;
    /**
     * 数据关闭
     */
    const MYSQL_ERROR = 0;
    /**
     * 数据删除
     */
    const MYSQL_DELETE = -1;
}
