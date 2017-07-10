<?php
class lottoView extends lotto {
  function init() {
    // 사용자 템플릿 파일의 경로 설정 (skins)
    $template_path = sprintf("%sskins/%s/", $this->module_path, $this->module_info->skin);

    if(!is_dir($template_path) || !$this->module_info->skin) {
      $this->module_info->skin = 'default';
      $template_path = sprintf("%sskins/%s/", $this->module_path, $this->module_info->skin);
    }
    
    // 템플릿 경로 등록
    $this->setTemplatePath($template_path);
  }

  function dispLottoBuy() {
    
    $lotto = $this->module_info->module_srl;

    $args = new stdClass();
    $args->module_srl = $lotto;
    $lotto_list = executeQuery('lotto.getLottoListByModule', $args);
    if ($lotto_list->toBool()) {
      if (gettype($lotto_list->data) == 'object') {
        Context::set('lotto_list', array($lotto_list->data));
      } else {
        Context::set('lotto_list', $lotto_list->data);
      }
    } else {
      Context::set('lotto_list', array());
    }
    
    $oPointModel = &getModel('point');

    $logged_info = Context::get('logged_info');
    if(!$logged_info->member_srl) return $this->stop('msg_not_permitted');
    
    $logged_info->point = $oPointModel->getPoint($logged_info->member_srl);
    Context::set('logged_info',$logged_info);

    $this->setTemplateFile('buy');
  }
}
?>