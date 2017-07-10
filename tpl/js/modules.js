jQuery(function($) {
  $('#modules').change(function() {
    var opt = $('option:selected', this);

    var url = location.origin + location.pathname;
    var params = location.search;
    if (opt.val() != 0) {
      if (!params) {
        params = '?' + $.param({'lotto': opt.val()});
      } else if (!params.match(/lotto=(\d+)/)) {
        params = params + '&' + $.param({'lotto': opt.val()});
      } else {
        params = params.replace(/lotto=(\d+)/, $.param({'lotto': opt.val()}));
      }
    } else {
      params = params.replace(/&lotto=(\d+)/,'');
      params = params.replace(/\?lotto=(\d+)/,'');
    }

    location = url + params;
  });

  $('#addLotto').click(function() {
    var $tbody = $('._LottoList');
    var index = 'new'+ new Date().getTime();

    $tbody.find('._template').clone(true)
      .removeClass('_template')
      .find('input').removeAttr('disabled').end()
      .find('input:radio').val(index).end()
      .find('input[name="group_srls[]"]').val(index).end()
      .show()
      .appendTo($tbody)
      .find('.lang_code').xeApplyMultilingualUI();

    return false;
  });
});