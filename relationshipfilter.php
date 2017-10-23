<?php

require_once 'relationshipfilter.civix.php';
use CRM_Relationshipfilter_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function relationshipfilter_civicrm_config(&$config) {
  _relationshipfilter_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function relationshipfilter_civicrm_xmlMenu(&$files) {
  _relationshipfilter_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function relationshipfilter_civicrm_install() {
  _relationshipfilter_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function relationshipfilter_civicrm_postInstall() {
  _relationshipfilter_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function relationshipfilter_civicrm_uninstall() {
  _relationshipfilter_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function relationshipfilter_civicrm_enable() {
  _relationshipfilter_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function relationshipfilter_civicrm_disable() {
  _relationshipfilter_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function relationshipfilter_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _relationshipfilter_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function relationshipfilter_civicrm_managed(&$entities) {
  _relationshipfilter_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function relationshipfilter_civicrm_caseTypes(&$caseTypes) {
  _relationshipfilter_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function relationshipfilter_civicrm_angularModules(&$angularModules) {
  _relationshipfilter_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function relationshipfilter_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _relationshipfilter_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

function relationshipfilter_civicrm_searchColumns( $objectName, &$headers,  &$values, &$selector ) {
  CRM_Core_Error::Debug_var('$objectName', $objectName);
}

function relationshipfilter_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Contact_Form_Search_Advanced' && $form->_searchPane == "relationship") {
    $templatePath = realpath(dirname(__FILE__)."/templates");
    $form->addEntityRef('select_relation_target_name', ts('Select Target Contact'), array(
      'create' => FALSE,
      'api' => array('extra' => array('email')),
    ));
    CRM_Core_Region::instance('page-body')->add(array(
      'template' => "{$templatePath}/relationshipfilter.tpl"
    ));

  }
}

function relationshipfilter_civicrm_preProcess($formName, &$form) {
  if ($formName == 'CRM_Contact_Form_Search_Advanced'
    && !empty($form->_submitValues['select_relation_target_name'])
    && is_numeric($form->_submitValues['select_relation_target_name'])) {

    $form->_submitValues['relation_target_name'] = civicrm_api3('Contact', 'getvalue', array(
      'return' => "sort_name",
      'id' => $form->_submitValues['select_relation_target_name'],
    ));
  }
}


// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function relationshipfilter_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function relationshipfilter_civicrm_navigationMenu(&$menu) {
  _relationshipfilter_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _relationshipfilter_civix_navigationMenu($menu);
} // */
