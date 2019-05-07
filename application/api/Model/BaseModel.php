<?php
/**
 * Created by PhpStorm.
 * User: a6340
 * Date: 2018/03/23
 * Time: 14:58
 */

namespace app\api\Model;


use think\Model;
use traits\model\SoftDelete;

class BaseModel extends Model {
    use SoftDelete;
    protected $autoWriteTimestamp = true;
    protected $deleteTime = 'delete_time';
}