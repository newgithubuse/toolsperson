<?php

namespace App\Http\v1\Responses;
use Illuminate\Http\JsonResponse;
class Response
{
    private $version = 'v1';
    private $status = 200;
    private $logType = 'info';
    protected $log = false;
    /**
     * 基本回應
     * @param int $status
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return JsonResponse
     */
    public function jsonResponse($status, $code, $msg = '', $data = [])
    {
        $data = $this->format($code, $msg, $data);
        return new JsonResponse($data, $status);
    }
    /**
     * 基本格式
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return array
     */
    private function format($code, $msg, $data)
    {
        return [
            'code' => $code,
            'data' => $data,
            'msg'  => $msg,
            'time' => time(),
        ];
    }
    /**
     * 成功時的回傳
     * @param array $data
     * @return JsonResponse
     */
    public function success($data = [])
    {
        list($code, $msg) = $this->getInfo('SUCCESS');
        return $this->jsonResponse($this->status, $code, $msg, $data);
    }
    /**
     * 失敗時的回傳
     * @param array $data
     * @return JsonResponse
     */
    public function failed($data = [])
    {
        list($code, $msg) = $this->getInfo('FAILED');
        return $this->jsonResponse($this->status, $code, $msg, $data);
    }
    /**
     * 獲取回傳碼與訊息
     * @param string $key
     * @return array
     */
    private function getInfo($key)
    {
        $info = config("{$this->version}.codes.{$key}") ?? config("{$this->version}.codes.FAILED");
        return [$info['code'], $info['msg']];
    }
    /**
     * 設定回傳碼與訊息
     * @param string $key
     * @param int $code
     * @param string $msg
     */
    public function setInfo($key, $code, $msg)
    {
        config(["{$this->version}.codes.{$key}" => ['code' => $code, 'msg' => $msg]]);
    }
}