Dropzone.options.importForm = {
  dictDefaultMessage: seoAutomatedLinkBuildingImport.importHint,
  error: function(file, response) {
    //console.error(response);
    if(response.message.length > 0) {
      let error_message = '<div class="import-results">';
      error_message += response.message.join('');
      error_message += '</div>';
      const form = document.querySelector("#import-form");
      form.insertAdjacentHTML("afterend", error_message);
    }
  },
  success: function(file, response) {
    console.log(file, response);
    window.location.href = seoAutomatedLinkBuildingImport.redirectUrl;
  }
};

jQuery(function($) {
  $('.export').on('click', function() {
    const ext = $('input[name=ext]:checked').val();
    const separator = $('select[name=separator]').val();
    const mimetype = ext === 'csv' ? 'text/csv' : 'application/json';
    $.post(seoAutomatedLinkBuildingImport.adminAjax, {
      action: 'seo_automated_link_building_export_links',
      ext: ext,
      separator: separator
    }, function(data) {
      var blob = new Blob([
          new Uint8Array([0xEF, 0xBB, 0xBF]), // UTF-8 BOM
          data,
        ],
        { type: mimetype + ";charset=utf-8" }
      );
      download(blob, 'internal-link-manager.' + ext, mimetype);
    });
  });
});
