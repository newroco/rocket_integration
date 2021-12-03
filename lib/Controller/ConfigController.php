<?php

namespace OCA\RocketIntegration\Controller;

use OCA\RocketIntegration\DB\Config;
use OCA\RocketIntegration\Db\FileChat;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\RedirectResponse;
use OCP\IRequest;
use OCP\IServerContainer;

class ConfigController extends Controller {
    protected $config;
    protected $appName;
    protected $server;

    public function __construct($AppName, IRequest $request, IServerContainer $server)
    {
        parent::__construct($AppName, $request);

        $this->config = new Config();
        $this->server = $server;
        $this->appName = $AppName;
    }

    /**
     * Requires admin.
     *
     * @NoCSRFRequired
     * @param $url
     * @param $customOauthName
     * @param $personalAccessToken
     * @param $userId
     * @return RedirectResponse
     */
    public function setupUrl($url, $customOauthName, $personalAccessToken, $userId)
    {
        if ( ! ($url && $personalAccessToken && $userId)) {
            return new RedirectResponse(
                ($this->server->getURLGenerator())->linkToRoute('files.view.index')
            );
        }

        $url = rtrim($url, '/');

        if ( ! $customOauthName) {
            $customOauthName = '';
        }

        $this->config->storeAdminData($url, $customOauthName, $personalAccessToken, $userId);

        return new RedirectResponse(
            ($this->server->getURLGenerator())->linkToRoute($this->appName . '.page.index')
        );
    }

    /**
     * Requires admin.
     *
     * @NoCSRFRequired
     * @param $customOauthName
     * @return RedirectResponse
     */
    public function updateCustomOAuthName($customOauthName)
    {
        $this->config->storeCustomOAuthName($customOauthName);

        return new RedirectResponse(
            ($this->server->getURLGenerator())->linkToRoute($this->appName . '.page.index')
        );
    }

    /**
     * Requires admin.
     *
     * @NoCSRFRequired
     * @return RedirectResponse
     */
    public function resetConfig()
    {
        $this->config->resetAdminData();

        (new FileChat())->deleteAll();

        return new RedirectResponse(
            ($this->server->getURLGenerator())->linkToRoute('files.view.index')
        );
    }
}
