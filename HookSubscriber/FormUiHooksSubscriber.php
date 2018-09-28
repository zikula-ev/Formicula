<?php

/*
 * This file is part of the Formicula package.
 *
 * Copyright Formicula Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zikula\FormiculaModule\HookSubscriber;

use Zikula\Bundle\HookBundle\Category\UiHooksCategory;
use Zikula\Bundle\HookBundle\HookSubscriberInterface;
use Zikula\Common\Translator\TranslatorInterface;

/**
 * UI hooks subscriber class.
 */
class FormUiHooksSubscriber implements HookSubscriberInterface
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * FormUiHooksSubscriber constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @inheritDoc
     */
    public function getOwner()
    {
        return 'ZikulaFormiculaModule';
    }
    
    /**
     * @inheritDoc
     */
    public function getCategory()
    {
        return UiHooksCategory::NAME;
    }
    
    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->translator->__('Form ui hooks subscriber');
    }

    /**
     * @inheritDoc
     */
    public function getEvents()
    {
        return [
            // Display hook for view/display templates.
            //UiHooksCategory::TYPE_DISPLAY_VIEW => 'zikulaformiculamodule.ui_hooks.forms.display_view',
            // Display hook for create/edit forms.
            UiHooksCategory::TYPE_FORM_EDIT => 'zikulaformiculamodule.ui_hooks.forms.form_edit',
            // Validate input from an item to be edited.
            UiHooksCategory::TYPE_VALIDATE_EDIT => 'zikulaformiculamodule.ui_hooks.forms.validate_edit',
            // Perform the final update actions for an edited item.
            //UiHooksCategory::TYPE_PROCESS_EDIT => 'zikulaformiculamodule.ui_hooks.forms.process_edit',
            // Validate input from an item to be deleted.
            //UiHooksCategory::TYPE_VALIDATE_DELETE => 'zikulaformiculamodule.ui_hooks.forms.validate_delete',
            // Perform the final delete actions for a deleted item.
            //UiHooksCategory::TYPE_PROCESS_DELETE => 'zikulaformiculamodule.ui_hooks.forms.process_delete'
        ];
    }
}