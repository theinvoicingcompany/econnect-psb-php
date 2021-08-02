<?php

namespace EConnect\Psb;

use Jumbojett\OpenIDConnectClient;

class Authentication
{
    private $config;
    private $oidc;
    private $validTill;
    private $token;

    public function __construct($config)
    {
        $this->config = $config;

        $identityUrl = str_replace("psb", "identity", $config->getHost());

        $this->oidc = new OpenIDConnectClient(
            $identityUrl,
            $config->getClientId(),
            $config->getClientSecret()
        );

        $this->oidc->addScope("ap");
    }

    public function login()
    {
        if ($this->validTill != null && $this->validTill < new \DateTime())
            return $this->token;

        $this->oidc->addAuthParam(array('username' =>  $this->config->getUsername()));
        $this->oidc->addAuthParam(array('password' =>  $this->config->getPassword()));

        $loginResponse = $this->oidc->requestResourceOwnerToken(TRUE);
        
        $date = new \DateTime();
        $date->add(new \DateInterval('PT' . $loginResponse->expires_in . 'S'));

        $this->validTill = $date;
        $this->token = $loginResponse->access_token;

        $this->config->setAccessToken($this->token);

        return $this->token;
    }
}
