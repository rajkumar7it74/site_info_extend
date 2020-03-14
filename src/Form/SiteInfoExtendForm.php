<?php

namespace Drupal\site_info_extend\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

/**
 * Configure site information settings for this site.
 */
class SiteInfoExtendForm extends SiteInformationForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get system.site configurations.
    $site_config = $this->config('system.site');

    // Get original site information form from class SiteInformationForm.
    $form = parent::buildForm($form, $form_state);

    // Add a textfield of siteapikey to the site information form.
    $form['site_information']['siteapikey'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site API Key'),
      '#default_value' => empty($site_config->get('siteapikey')) ? 'No API Key yet' : $site_config->get('siteapikey'),
      '#description' => $this->t('The Site API Key.'),
    ];

    // Uodate site information "Save Configuration" button label to
    // "Update Configuration" only if siteapikey is available and is not empty.
    if (!empty($site_config->get('siteapikey'))) {
      $form['actions']['submit']['#value'] = $this->t('Update Configuration');
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Save system.site.siteapikey in site information configuration.
    $this->config('system.site')
      // Get siteapikey value from submitted form and set it to siteapikey
      // configuration field.
      ->set('siteapikey', $form_state->getValue('siteapikey'))
      ->save();

    // Passing remaining values of the original site information form which we
    // have extended, so that they are also saved.
    parent::submitForm($form, $form_state);
    // Show message of saving site information configuration values.
    $this->messenger()->addMessage(
      $this->t(
          'Site API Key has been saved with value: @siteapikey', [
            '@siteapikey' => $form_state->getValue('siteapikey'),
          ]
      ), 'status'
    );
  }

}
