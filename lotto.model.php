<?php
class lottoModel extends lotto {
  function init() {
  }

  function triggerModuleListInSitemap(&$obj) {
    array_push($obj, 'lotto');
  }
}