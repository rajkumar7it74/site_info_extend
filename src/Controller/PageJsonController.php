<?php

namespace Drupal\site_info_extend\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\node\NodeInterface;

/**
 * Class PageJsonController.
 *
 * @package Drupal\site_info_extend\Controller\PageJsonController
 */
class PageJsonController {

  /**
   * Function to process node data and return json response.
   *
   * @param \Drupal\node\NodeInterface $node
   *   Node object.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   Json response.
   */
  public function getPageJson(NodeInterface $node) {
    // Get siteapikey from request url.
    $siteapikey = \Drupal::request()->get('siteapikey');
    // Get siteapikey from site information configuration.
    $site_api_key = \Drupal::config('system.site')->get('siteapikey');

    // Check node type is page with matching siteapikey from url & siteapikey
    // from site information configuration.
    if ($node->getType() == 'page' && ($siteapikey == $site_api_key)) {
      // Get node title.
      $title = $node->getTitle();
      // Get node body field value.
      $body = $node->get('body')->value;
      // Create a array having keys data, status, error where data is having
      // node data and status is ok. If fails above condition, then error will
      // be access denied.
      $json_array = [
        'data' => [
          'title' => $title,
          'body' => $body,
        ],
        'status' => 'ok',
      ];
    }
    // If above condition get fail then array will having error index
    // with access denied message.
    else {
      $json_array['error'] = 'access denied';
    }
    // Converts above result array in json response and return this response.
    return new JsonResponse($json_array);
  }

}
