<?php

namespace OCA\Messenger\Controller;

use OCA\Messenger\DB\Config;
use OCA\Messenger\Db\FileChat;
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
     * @param $personalAccessToken
     * @param $userId
     * @return RedirectResponse
     */
    public function setupUrl($url, $personalAccessToken, $userId)
    {
        if ( ! ($url && $personalAccessToken && $userId)) {
            return new RedirectResponse(
                ($this->server->getURLGenerator())->linkToRoute('files.view.index')
            );
        }

        $url = rtrim($url, '/');

        $this->config->storeAdminData($url, $personalAccessToken, $userId);

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
