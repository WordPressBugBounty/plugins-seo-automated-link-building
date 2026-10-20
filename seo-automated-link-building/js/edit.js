jQuery(function ($) {
  var $pageSearch = $('[name="pagesearch"]');

  // Die Vorschlagsliste ist absolut am Suchfeld positioniert und schließt sich
  // beim blur. Nicht jeder Browser (z. B. Firefox) löst blur aus, wenn ein
  // fokussiertes Feld ausgeblendet wird. Daher beim Ausblenden explizit schließen.
  var closePageSuggestions = function () {
    $('.autocomplete-suggestions').hide();
    if (document.activeElement === $pageSearch[0]) {
      $pageSearch[0].blur();
    }
  };

  var selectedPage = null;

  // Kategorie-Bedingung: Kategorieauswahl nur bei "selected", Hinweis bei "same",
  // wenn das Ziel keine Kategorien haben kann (Seite, eigene URL, ...)
  var updateCategoryCondition = function () {
    var mode = $('#ilm-category-mode').val();
    var useCustomUrl = $('#ilm-target-url').is(':visible');
    var targetWithoutCategories = useCustomUrl
      || (selectedPage && $.inArray(selectedPage.type, seoAutomatedLinkBuildingEdit.categoryPostTypes || []) === -1);
    $('#ilm-category-selection').toggle(mode === 'selected');
    $('#ilm-category-target-hint').toggle(mode === 'same' && !!targetWithoutCategories);
  };

  var setPageResult = function (page) {
    selectedPage = page || null;
    if (page) {
      $('[name="page"]').val(page.id);
      $('#page-result').show();
      $('#page-result .text').text(page.title);
      $('#no-page-result').hide();
      closePageSuggestions();
    } else {
      $('[name="page"]').val('');
      $('#page-result').hide();
      $('#no-page-result').show();
    }
    updateCategoryCondition();
  };

  var warn = function ($form, message) {
    showAdminNotice($form, message, 'error');
    $('html, body').animate({ scrollTop: Math.max(0, $form.offset().top - 60) }, 200);
  };

  $('.seo-automated-link-building-form').on('submit', function (e) {
    var $form = $(this);
    var title = $.trim($form.find('[name="title"]').val());
    if (!title) {
      warn($form, seoAutomatedLinkBuildingEdit.titleWarning);
      e.preventDefault();
      e.stopPropagation();
      return;
    }

    var $urlInput = $form.find('[name="url"]');
    if ($urlInput.is(':visible')) {
      var url = $.trim($form.find('[name="url"]').val());
      if (!url) {
        warn($form, seoAutomatedLinkBuildingEdit.urlWarning);
        e.preventDefault();
        e.stopPropagation();
        return;
      }
    } else {
      var page = $.trim($form.find('[name="page"]').val());
      if (!page) {
        warn($form, seoAutomatedLinkBuildingEdit.pageWarning);
        e.preventDefault();
        e.stopPropagation();
        return;
      }
    }

    var keywords = taggle.getTagValues();
    if (!keywords.length) {
      warn($form, seoAutomatedLinkBuildingEdit.keywordsWarning);
      e.preventDefault();
      e.stopPropagation();
      return;
    }

    var $categoryMode = $form.find('[name="category_mode"]');
    if (!$categoryMode.prop('disabled') && $categoryMode.val() === 'selected'
      && !$form.find('[name="category_ids[]"]:checked').length) {
      warn($form, seoAutomatedLinkBuildingEdit.categoriesWarning);
      e.preventDefault();
      e.stopPropagation();
      return;
    }
  });

  $('#ilm-category-mode').on('change', updateCategoryCondition);

  $pageSearch.autoComplete({
    minChars: 0,
    // cache deaktiviert, da Firefox die Suchergebnisse sonst nach Auswahl nicht ausblendet
    cache: false,
    source: function (term, response) {
      try {
        xhr.abort();
      } catch (e) {
      }
      xhr = $.post(seoAutomatedLinkBuildingEdit.adminAjax, {
        action: 'seo_automated_link_building_find_pages',
        search: term
      }, function (data) {
        // Eine verspätete Antwort würde die Liste sonst am ausgeblendeten Feld öffnen.
        if ($pageSearch.is(':visible')) {
          response(data);
        }
      }, 'json');
    },
    renderItem: function (item, search) {
      return $('<div class="autocomplete-suggestion">')
        .attr('data-id', item.id)
        .attr('data-type', item.type)
        .attr('data-title', item.title)
        .text(item.title + ' (' + item.type + ')')
        .wrap('<div>')
        .parent()
        .html();
    },
    onSelect: function (e, term, item) {
      setPageResult(item.data());
      e.preventDefault();
    },
  });

  // Umschaltung Seitenauswahl <-> eigene URL
  var selectTarget = function (useCustomUrl) {
    if (useCustomUrl) {
      closePageSuggestions();
    }
    $('#ilm-target-page').toggle(!useCustomUrl);
    $('#ilm-target-url').toggle(useCustomUrl);
    $('#useCustomUrl').toggleClass('is-active', useCustomUrl);
    $('#useWebsitePage').toggleClass('is-active', !useCustomUrl);
    updateCategoryCondition();
  };

  $('#useCustomUrl').on('click', function (e) {
    e.preventDefault();
    selectTarget(true);
  });

  $('#useWebsitePage').on('click', function (e) {
    e.preventDefault();
    selectTarget(false);
  });

  $('#page-result-exit').on('click', function () {
    setPageResult(null);
  });

  $('.numToUnlimited').on('click', function () {
    $('input[name=num]').val('-1');
  });

  setPageResult(seoAutomatedLinkBuildingEdit.page);

  // tags support
  var taggle = new Taggle('seo-automated-link-building-keywords', {
    placeholder: seoAutomatedLinkBuildingEdit.replaceHint,
    tags: seoAutomatedLinkBuildingEdit.keywords || [],
    hiddenInputName: 'keywords[]',
    submitKeys: [9, 13],
    delimiter: '\t',
    preserveCase: true,
  });
});
