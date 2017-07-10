<?php
class lottoAdminController extends lotto {
  function init() {

  }

  function procLottoAdminConfigChange() {
		$this->setMessage('success_updated');

		$returnUrl = Context::get('success_return_url') ? Context::get('success_return_url') : getNotEncodedUrl('', 'module', 'admin', 'act', 'dispLottoAdminConfig');
		$this->setRedirectUrl($returnUrl);
  }
}
?>