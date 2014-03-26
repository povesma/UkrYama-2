<?php
/**
 * HTTP Request v1.0 by Denik
 * Parametres:
 *  - (string) or (array)[url] - site url
 *  - [method] - POST | GET
 *  - [data] - array of post data
 *  - [port] - connection port
 *  - [timeout] - timeout connection
 *  - [redirect] - true, allow redirects in headers
 *  - [return] - content|headers|array - type of return data, default - content
 *  - [cookie] - allow to set cookies
 *  - [referer] - allow to set referer url
 **/
class HTTP{
public function http_request($params)
{
    if( ! is_array($params) )
    {
        $params = array(
            'url' => $params,
            'method' => 'GET'
        );
    }
    
    if( $params['url']=='' ) return FALSE;
    
    if( ! isset($params['method']) ) $params['method'] = (isset($params['data'])&&is_array($params['data'])) ? 'POST' : 'GET';
    $params['method'] = strtoupper($params['method']);
    if( ! in_array($params['method'], array('GET', 'POST')) ) return FALSE; 
    
    /* Приводим ссылку в правильный вид */
    $url = parse_url($params['url']);
    if( ! isset($url['scheme']) ) $url['scheme'] = 'http';
    if( ! isset($url['path']) ) $url['path'] = '/';
    if( ! isset($url['host']) && isset($url['path']) )
    {
        if( strpos($url['path'], '/') )
        {
            $url['host'] = substr($url['path'], 0, strpos($url['path'], '/'));
            $url['path'] = substr($url['path'], strpos($url['path'], '/'));
        }
        else
        {
            $url['host'] = $url['path'];
            $url['path'] = '/';	
        }
    }
    $url['path'] = preg_replace("/[\\/]+/", "/", $url['path']);
    if( isset($url['query']) ) $url['path'] .= "?{$url['query']}";
    
    $port = isset($params['port']) ? $params['port']
            : ( isset($url['port']) ? $url['port'] : ($url['scheme']=='https'?443:80) );
    
    $timeout = isset($params['timeout']) ? $params['timeout'] : 30;
    if( ! isset($params['return']) ) $params['return'] = 'content';
    
    $scheme = $url['scheme']=='https' ? 'ssl://':'';
    $fp = @fsockopen($scheme.$url['host'], $port, $errno, $errstr, $timeout);
    if( $fp )
    {
        /* Mozilla */
        if( ! isset($params['User-Agent']) ) $params['User-Agent'] = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16";
        
        $request = "{$params['method']} {$url['path']} HTTP/1.0\r\n";
        $request .= "Host: {$url['host']}\r\n";
        $request .= "User-Agent: {$params['User-Agent']}"."\r\n";
        if( isset($params['referer']) ) $request .= "Referer: {$params['referer']}\r\n";
        if( isset($params['cookie']) )
        {
            $cookie = "";
            if( is_array($params['cookie']) ) {foreach( $params['cookie'] as $k=>$v ) $cookie .= "$k=$v; "; $cookie = substr($cookie,0,-2);}
            else $cookie = $params['cookie'];
            if( $cookie!='' ) $request .= "Cookie: $cookie\r\n";
        }
        $request .= "Connection: close\r\n";
        if( $params['method']=='POST' )
        {
            if( isset($params['data']) && is_array($params['data']) )
            {
                foreach($params['data'] AS $k => $v)
                    $data .= urlencode($k).'='.urlencode($v).'&';
                if( substr($data, -1)=='&' ) $data = substr($data,0,-1);
            }
            $data .= "\r\n\r\n";
            
            $request .= "Content-type: application/x-www-form-urlencoded\r\n";
            $request .= "Content-length: ".strlen($data)."\r\n";
        }
        $request .= "\r\n";
        
        if( $params['method'] == 'POST' ) $request .= $data;
        
        @fwrite ($fp,$request); /* Send request */
        
        $res = ""; $headers = ""; $h_detected = false;
        while( !@feof($fp) )
        {
            $res .= @fread($fp, 1024); /* читаем контент */
    
            /* Проверка наличия загловков в контенте */
            if( ! $h_detected && strpos($res, "\r\n\r\n")!==FALSE )
            {
                /* заголовки уже считаны - корректируем контент */
                $h_detected = true;
                
                $headers = substr($res, 0, strpos($res, "\r\n\r\n"));
                $res = substr($res, strpos($res, "\r\n\r\n")+4);
                
                /* Headers to Array */
                if( $params['return']=='headers' || $params['return']=='array'
                    || (isset($params['redirect']) && $params['redirect']==true) )
                {
                    $h = explode("\r\n", $headers);
                    $headers = array();
                    foreach( $h as $k=>$v )
                    {
                        if( strpos($v, ':') )
                        {
                            $k = substr($v, 0, strpos($v, ':'));
                            $v = trim(substr($v, strpos($v, ':')+1));
                        }
                        $headers[strtoupper($k)] = $v;
                    }
                }
                if( isset($params['redirect']) && $params['redirect']==true && isset($headers['LOCATION']) )
                {
                    $params['url'] = $headers['LOCATION'];
                    if( !isset($params['redirect-count']) ) $params['redirect-count'] = 0;
                    if( $params['redirect-count']<10 )
                    {
                        $params['redirect-count']++;
                        $func = __FUNCTION__;
                        return @is_object($this) ? $this->$func($params) : $func($params);
                    }
                }
                if( $params['return']=='headers' ) return $headers;
            }
        }
        
        @fclose($fp);
    }
    else return FALSE;/* $errstr.$errno; */
    
    if( $params['return']=='array' ) $res = array('headers'=>$headers, 'content'=>$res);
    
    return $res;
}
}
?>
