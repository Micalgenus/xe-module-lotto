<?php
class lottoAdminView extends lotto {
  function init() {
    $this->setTemplatePath($this->module_path . 'tpl');
  }

  function dispLottoAdminConfig() {
    $this->setTemplateFile('config');
  }

  function dispLottoAdminModules() {
		$list = executeQuery('lotto.getModulesList');

    if ($list->toBool()) {
      if (!$list->data) {
        $modules_list = [ '모듈이 존재하지 않습니다.' ];
      } else if ($list->data->module_srl) {
        $modules_list = array($list->data);
      } else {
        $modules_list = $list->data;
      }
    } else {
      $modules_list = [ '모듈이 존재하지 않습니다.' ];
    }

    Context::set('modules_list', $modules_list);

    $lotto = Context::get('lotto');

    $this->setTemplateFile('modules');
  }
}
?>