// assets/js/admin-notices.js
(function (wp, $) {
    const { __ } = wp.i18n;

    /**
     * Zeigt eine WP-Admin-Notice im übergebenen Container (z. B. Formular).
     *
     * @param {jQuery} $container - jQuery-Objekt, in dem die Notice angezeigt wird.
     * @param {string} message - Anzuzeigender Text.
     * @param {string} type - Typ: 'error' | 'warning' | 'success' | 'info'.
     */
    window.showAdminNotice = function ($container, message, type = 'error') {
        // alte Notices entfernen
        $container.find('.notice').remove();

        // Notice-Klassen nach Typ bestimmen
        const cls = {
            error: 'notice notice-error',
            warning: 'notice notice-warning',
            success: 'notice notice-success',
            info: 'notice notice-info'
        }[type] || 'notice notice-info';

        const $notice = $(`
            <div class="${cls} is-dismissible" role="alert">
                <p>${message}</p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">${__('Dismiss this notice.', 'seo-automated-link-building')}</span>
                </button>
            </div>
        `);

        // Notice im Container einfügen
        $container.prepend($notice);

        // Dismiss-Button aktiv machen
        $notice.on('click', '.notice-dismiss', function () {
            $notice.remove();
        });

        // Scrollen zum Container (optional)
        //window.scrollTo({ top: $container.offset().top - 40, behavior: 'smooth' });
    };
})(window.wp, jQuery);
