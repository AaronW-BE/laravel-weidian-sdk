<?php


namespace Heymom\Weidian;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Config\Repository;
use Psr\SimpleCache\InvalidArgumentException;

class Client
{
    private $cmd;
    private $method = "GET";
    private $params = [];
    private $url = "";

    private $token = null;
    private $expire = 0;

    /**
     * @var Repository
     */
    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function getSelfToken()
    {
        $client = new \GuzzleHttp\Client();
        $this->params = [
            "grant_type" => "client_credential",
            "appkey" => $this->config->get("weidian.appkey"),
            "secret" => $this->config->get("weidian.secret")
        ];
        $this->url = "https://oauth.open.weidian.com/token";
        $request = $client->request("post", $this->url, [
            'form_params' => $this->params
        ]);
        if ($request->getStatusCode() == 200) {
            $content = $request->getBody()->getContents();
            if ($content) {
                $contentArr = json_decode($content, true);
                if ($contentArr['status']['status_code'] == 0) {
                    return $contentArr['result'];
                }
            }
            return $content;
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getCmd()
    {
        return $this->cmd;
    }

    /**
     * @param mixed $cmd
     */
    public function setCmd($cmd): void
    {
        $this->cmd = $cmd;
    }

    public function request($cmd, $params, $version = "1.0")
    {
        $this->cmd = $cmd;
        $this->url = $this->config->get("weidian.wd_api");
        $this->params = [
            'param' => json_encode($params),
            'public' => json_encode([
                'method' => $cmd,
                'access_token' => $this->getToken(),
                'format' => 'json',
                'version' => $version
            ])
        ];

        $this->method = "POST";
        return $this;
    }

    /**
     * @return null
     * @throws \Exception
     * @throws InvalidArgumentException
     */
    public function getToken()
    {
        $token = cache('weidian_access_token');

        if ($token) {
            $this->token = $token;
        }else{
            $token = $this->getSelfToken();
            cache()->put('weidian_access_token', $token['access_token'], $token['expire_in'] - 60 * 60);
            $this->token = $token;
        }
        return $this->token;
    }


    /**
     * @param $token
     * @return $this
     * @throws \Exception
     */
    public function setToken($token)
    {
        $this->token = $token;
        cache()->put('weidian_access_token', $token['access_token'], $token['expire_in'] - 60 * 60);
        return $this;
    }


    /**
     * @return string|null
     * @throws \Exception
     */
    public function send()
    {
        $client = new \GuzzleHttp\Client();
        try {
            $request = $client->request($this->method, $this->url, [
                "form_params" => $this->params
            ]);
            if ($request->getStatusCode() == 200) {
                $content = $request->getBody()->getContents();
                if ($content) {
                    $contentArr = json_decode($content, true);
                    if ($contentArr['status']['status_code'] == 0) {
                        return $contentArr['result'];
                    }
                    throw new \Exception(json_encode($contentArr));
                }
            }
            return null;
        } catch (GuzzleException $e) {
            info($e);
            return 'err';
        }
    }
}