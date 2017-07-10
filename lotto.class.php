<?php
class lotto extends ModuleObject {
  
  function moduleInstall() {
  }

  function checkUpdate() {
    // $DB = DB::getInstance();

    // $oModule = getModel('module');
    // $module_info = $oModule->getModuleInfoByMid('lotto');
    $oModuleModel = &getModel('module');
    // if (!$module_info->module_srl) return true;
    if (!$oModuleModel->getTrigger('menu.getModuleListInSitemap', 'lotto', 'model', 'triggerModuleListInSitemap', 'after')) return true;
    return false;
  }
  
  function moduleUpdate() {
    // $DB = DB::getInstance();

    // // Module 등록
    // $oModule = getModel('module');
    // $module_info = $oModule->getModuleInfoByMid('lotto');
    // if (!$module_info->module_srl) {
    //   $this->InsertModule();
    // }

    // SiteMap 추가
    $oModuleModel = &getModel('module');
    $oModuleController = &getController('module');
    if (!$oModuleModel->getTrigger('menu.getModuleListInSitemap', 'lotto', 'model', 'triggerModuleListInSitemap', 'after')) {
      $oModuleController->insertTrigger('menu.getModuleListInSitemap', 'lotto', 'model', 'triggerModuleListInSitemap', 'after');
    }
  }

  function moduleUninstall() {
  }

  function recompileCache() {
  }

  function InsertModule() {
    /* Create mid */
    $oModuleController = getController('module');
    $args = new stdClass();
    $args->mid = 'lotto';
    $args->module = 'lotto';
    $args->browser_title = '포인트 로또';
    $args->site_srl = 0;
    $args->skin = 'default';
    $args->order_type = 'desc';
    $output = $oModuleController->insertModule($args);
    
    // Set Browser Title
    if ($output->toBool()) {
      $oModule = getModel('module');
      $module_info = $oModule->getModuleInfoByMid('lotto');

      $args = new stdClass();
      $args->module_srl = $module_info->module_srl;
      $args->browser_title = "포인트 로또";
      $oModuleController->updateModule($args);
    }
  }
}
?>
