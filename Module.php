<?php
namespace bannerMessage;

use Omeka\Module\AbstractModule;
use Omeka\Permissions\Assertion\HasSitePermissionAssertion;
use Laminas\Form\Fieldset;
use Laminas\EventManager\Event;
use Laminas\Mvc\MvcEvent;
use Laminas\EventManager\SharedEventManagerInterface;

class Module extends AbstractModule
{
    
    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach(
            'Omeka\Form\SiteSettingsForm',
            'form.add_elements',
            [$this, 'addSiteEnableCheckbox']
        );

        $controllers = [
            'Omeka\Controller\Site\Item',
            'Omeka\Controller\Site\ItemSet',
            'Omeka\Controller\Site\Media',
            'Omeka\Controller\Site\Page',
        ];

        foreach ($controllers as $controller) {          
            $sharedEventManager->attach($controller, 'view.layout', [$this, 'addBannerHead']);
        }
    }

    public function addSiteEnableCheckbox($event)
    {
        $siteSettings = $this->getServiceLocator()->get('Omeka\Settings\Site');
        $form = $event->getTarget();

        $fieldset = new Fieldset('banner_message');
        $fieldset->setLabel('Content warning'); // @translate

        $enabled = $siteSettings->get('content_banner_enable');
        $fieldset->add([
            'name' => 'content_banner_enable',
            'type' => 'checkbox',
            'options' => [
                'label' => 'Enable content banner', // @translate
            ],
            'attributes' => [
                'value' => $enabled
            ]
        ]);

        $form->add($fieldset);
    }
    
    public function addBannerHead($event)
    {
        $siteSettings = $this->getServiceLocator()->get('Omeka\Settings\Site');
        $enabled = $siteSettings->get('content_banner_enable', 'view.show.before');
        $eventName = $event->getName();
        $view = $event->getTarget();
        if ($enabled == 1) {
            $view->headLink()->appendStylesheet($view->assetUrl('warning-style.css', 'BannerMessage'));
            $view->headScript()->appendFile($view->assetUrl('warning-positioning.js', 'BannerMessage'));
            $view->htmlElement('body')->appendAttribute('class', 'content-warning-banner');
        }       
    }
}

?>
