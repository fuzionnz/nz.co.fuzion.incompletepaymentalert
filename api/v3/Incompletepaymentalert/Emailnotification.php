<?php
use CRM_Incompletepaymentalert_ExtensionUtil as E;

/**
 * Incompletepaymentalert.Emailnotification API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_incompletepaymentalert_Emailnotification_spec(&$spec) {
}

/**
 * Incompletepaymentalert.Emailnotification API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_incompletepaymentalert_Emailnotification($params) {
  if (empty($params['toEmail'])) {
    return;
  }
  CRM_Incompletepaymentalert_Alert::sendNotification($params);
}
