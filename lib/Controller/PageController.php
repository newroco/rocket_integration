<?php

namespace OCA\Messenger\Controller;

use OCA\Messenger\AppInfo\Application;
use OCA\Messenger\Db\Config;
use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\ContentSecurityPolicy;
use OCP\IServerContainer;

class PageController extends Controller {
    protected $config;
    protected $appName;
    protected $server;

	public function __construct($AppName, IRequest $request, IServerContainer $server) {
		parent::__construct($AppName, $request);

		$this->config = new Config();
		$this->server = $server;
		$this->appName = Application::APP_ID;
	}

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index() {
	    $rocketChatUrl = $this->config->getUrl();

	    if ( ! $rocketChatUrl) {
            return new DataResponse(['message' => 'Not found!'], 404);
        }

		$response = new TemplateResponse($this->appName, 'index', [
		    'url' => $rocketChatUrl,
        ]);

        $policy = new ContentSecurityPolicy();
        $policy->addAllowedChildSrcDomain('*');
        $policy->addAllowedFrameDomain('*');

        $response->setContentSecurityPolicy($policy);

        return $response;
	}

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     * @param $chat
     * @param $new
     * @return DataResponse|TemplateResponse
     */
    public function file($chat, $new) {
        $rocketChatUrl = $this->config->getUrl();

        if ( ! $rocketChatUrl) {
            return new DataResponse(['message' => 'Not found!'], 404);
        }

        $response = new TemplateResponse($this->appName, 'index', [
            'url' => $rocketChatUrl . "/group/{$chat}?layout=embedded",
            'new' => $new,
        ]);

        $policy = new ContentSecurityPolicy();
        $policy->addAllowedChildSrcDomain('*');
        $policy->addAllowedFrameDomain('*');

        $response->setContentSecurityPolicy($policy);

        return $response;
    }
}
