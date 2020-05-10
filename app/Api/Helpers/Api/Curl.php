<?php
/**
 * Created by PhpStorm.
 * User: GE62
 * Date: 2018/7/11
 * Time: 17:05
 */

namespace App\Api\Helpers\Api;


trait Curl
{

    protected $curl_url;

    protected $curl_data;


    /**
     * @return mixed
     */
    public function getCurlUrl()
    {
        return $this->curl_url;
    }

    /**
     * @param mixed $curl_url
     */
    public function setCurlUrl($curl_url)
    {
        $this->curl_url = $curl_url;
    }

    /**
     * @return mixed
     */
    public function getCurlData()
    {
        return $this->curl_data;
    }

    /**
     * @param mixed $curl_data
     */
    public function setCurlData($curl_data)
    {
        $this->curl_data = $curl_data;
    }


    public function getCurl($url)
    {
        if (empty($url)) {
            return false;
        } else {
            $this->setCurlUrl($url);
        }
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $this->curl_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        //打印获得的数据
        return $output;
    }

    public function postCurl($url, $data)
    {
        if (empty($url) || empty($data)) {
            return false;

        } else {
            $this->setCurlUrl($url);
            $this->setCurlData($data);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->curl_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->curl_data);
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        return $output;
    }

}