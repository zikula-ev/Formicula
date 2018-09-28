<?php

/*
 * This file is part of the Formicula package.
 *
 * Copyright Formicula Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\FormiculaModule\Container;

use Symfony\Component\Routing\RouterInterface;
use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Core\LinkContainer\LinkContainerInterface;
use Zikula\PermissionsModule\Api\ApiInterface\PermissionApiInterface;

class LinkContainer implements LinkContainerInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var PermissionApiInterface
     */
    private $permissionApi;

    /**
     * LinkContainer constructor.
     *
     * @param TranslatorInterface    $translator    TranslatorInterface service instance
     * @param RouterInterface        $router        RouterInterface service instance
     * @param PermissionApiInterface $permissionApi PermissionApi service instance
     */
    public function __construct(
        TranslatorInterface $translator,
        RouterInterface $router,
        PermissionApiInterface $permissionApi
    ) {
        $this->translator = $translator;
        $this->router = $router;
        $this->permissionApi = $permissionApi;
    }

    /**
     * get Links of any type for this extension
     * required by the interface
     *
     * @param string $type
     * @return array
     */
    public function getLinks($type = LinkContainerInterface::TYPE_ADMIN)
    {
        $method = 'get' . ucfirst(strtolower($type));
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return [];
    }

    /**
     * get the Admin links for this extension
     *
     * @return array
     */
    private function getAdmin()
    {
        $links = [];

        if (!$this->permissionApi->hasPermission('ZikulaFormiculaModule::', '::', ACCESS_ADMIN)) {
            return $links;
        }

        $links[] = [
            'url' => $this->router->generate('zikulaformiculamodule_contact_view'),
            'text' => $this->translator->__('View contacts', 'zikulaformiculamodule'),
            'icon' => 'group'
        ];
        $links[] = [
            'url' => $this->router->generate('zikulaformiculamodule_contact_edit'),
            'text' => $this->translator->__('Add contact', 'zikulaformiculamodule'),
            'icon' => 'user-plus'
        ];
        $links[] = [
            'url' => $this->router->generate('zikulaformiculamodule_submission_view'),
            'text' => $this->translator->__('View submissions', 'zikulaformiculamodule'),
            'icon' => 'envelope'
        ];
        $links[] = [
            'url' => $this->router->generate('zikulaformiculamodule_config_config'),
            'text' => $this->translator->__('Settings', 'zikulaformiculamodule'), 
            'icon' => 'wrench',
            'links' => [
                [
                    'url' => $this->router->generate('zikulaformiculamodule_config_config'),
                    'text' => $this->translator->__('Settings', 'zikulaformiculamodule'), 
                    'icon' => 'wrench'
                ],
                [
                    'url' => $this->router->generate('zikulaformiculamodule_config_clearcache'),
                    'text' => $this->translator->__('Clear captcha image cache', 'zikulaformiculamodule'), 
                    'icon' => 'eraser'
                ]
            ]
        ];

        return $links;
    }

    /**
     * set the BundleName as required by the interface
     *
     * @return string
     */
    public function getBundleName()
    {
        return 'ZikulaFormiculaModule';
    }
}
