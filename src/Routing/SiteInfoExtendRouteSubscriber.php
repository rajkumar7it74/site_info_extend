<?php

namespace Drupal\site_info_extend\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class SiteInfoExtendRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Alter form for the system.site_information_settings route
    // to Drupal\site_info_extend\Form\SiteInfoExtendForm.
    if ($route = $collection->get('system.site_information_settings')) {
      // Set default form to new form class.
      $route->setDefault('_form', 'Drupal\site_info_extend\Form\SiteInfoExtendForm');
    }
  }

}
