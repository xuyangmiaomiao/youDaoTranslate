<?php

	/**
	* 有道翻译API 二次封装 简化请求参数
	* http://fanyi.youdao.com/openapi
	* 请求频率限制为每小时1000次
	* @webSite 		http://www.xuyangjie.cn/
	* @email		xuyangmiaomiao@gmail.com
	* @time 		2014年9月20日 11:15:07
	* @author		许杨淼淼
	*/
	class youDaoTranslate{
	
		/**
		* 组装请求的地址
		*
		*/
		static private function createUrl($APIKEY, $KEYFROM, $DOCTYPE, $TYPE, $VERSION, $ONLY, $Q){
			
			$Q = urlencode($Q);
			$url = "http://fanyi.youdao.com/openapi.do?keyfrom=$KEYFROM&key=$APIKEY&type=$TYPE&doctype=$DOCTYPE&version=$VERSION&q=$Q";
			return $url;
		}
		
		/**
		* 获得结果
		*
		*/
		static private function getData($url){
			
			$result = file_get_contents($url);
			return $result;
		}
		
		/**
		* 唯一入口文件
		* 输出结果
		*/
		static public function index($APIKEY, $KEYFROM, $DOCTYPE, $TYPE, $VERSION, $ONLY, $Q){
		
			$url = self::createUrl($APIKEY, $KEYFROM, $DOCTYPE, $TYPE, $VERSION, $ONLY, $Q);
			$data = self::getData($url);
			echo $data;
		}
		
	}
	
	isset($_GET['doctype']) ? $DOCTYPE = $_GET['doctype'] : $DOCTYPE = 'json';	// 返回结果的数据格式,默认JSON
	isset($_GET['q']) ? $Q = $_GET['q'] : $Q = '';								// 要翻译的文本,字符长度不能超过200个字符
	isset($_GET['only']) ? $ONLY = $_GET['only'] : $ONLY = '';					// dict表示只获取词典数据，translate表示只获取翻译数据，默认为都获取
	$TYPE = 'data'; 															// 返回结果的类型，固定为data
	$VERSION = '1.1'; 															// 版本，当前最新版本为1.1
	$APIKEY = '341860372';
	$KEYFROM = 'baidudu';
	youDaoTranslate::index($APIKEY, $KEYFROM, $DOCTYPE, $TYPE, $VERSION, $ONLY, $Q);
?>