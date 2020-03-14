Site Info Extend
----------------

INTRODUCTION:
  This module helps in extending site information form and adding a
  new field site API Key.
  It provides a field Site API Key in site information form.

REQUIREMENTS:
  This module requires drupal core modules.
  * Entity

INSTALLATION:
  Install the module as you would normally install a contributed Drupal module.
  Visit https://www.drupal.org/node/1897420 for further information.

CONFIGURATION:
  1. Go to Administration > Configuration > Basic Site Settings.
  2. Site Information form is having a new field Site API Key from this module.
  3. Set Site API Key. If Site API Key is set then save button label
     'Save Configuration' is updated to value 'Update Configuration'.
  4. This module provides a url which responds a json representation of node
     only if node type is page and Site API Key is set. If any condition
     fails then it return access denied as response.
  5. Url is : /page_json/{siteapikey}/{nodeid}
