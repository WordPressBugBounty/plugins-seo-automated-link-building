<?php
/**
 * Internal Links Manager
 * Copyright (C) 2021 webraketen GmbH
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You can read the GNU General Public License here: <https://www.gnu.org/licenses/>.
 * For questions related to this program contact post@webraketen-media.de
 */

namespace SeoAutomatedLinkBuilding;

if ( is_admin() && ! class_exists('\WP_List_Table') ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php'; // @codeCoverageIgnore
}

class StatisticList extends \WP_List_Table
{

    public function prepare_items()
    {
        $this->process_bulk_action();

        $columns  = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$columns, $hidden, $sortable];

        $search = isset($_POST['s']) ? sanitize_text_field( wp_unslash( $_POST['s'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing
        $active = isset($_REQUEST['active']) ? $_REQUEST['active'] === '1' : null; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        $select = Statistic::query()
            ->order_by('created_at', 'desc')
            ->limit(100);
        if(!empty($search)) {
            $select = $select->where('title', 'LIKE', '%' . Statistic::wpdb()->esc_like($search) . '%');
        }
        if(!is_null($active)) {
            $select = $select->where('active', $active);
        }
        $this->items = $select->get();
    }

    public function get_columns()
    {
        return [
            'title' => __('Title'),
            'link_id' => 'Link ID',
            'destination_url' => __('Destination Url', Plugin::$domain),
            'source_url' => __('Source Url', Plugin::$domain),
            'created_at' => __('Date', Plugin::$domain),
        ];
    }

    public function get_bulk_actions()
    {
        return [];
    }

    public function process_bulk_action()
    {
        $action = $this->current_action();
	    if ( ! $action ) {
		    return;
	    }

	    if ($action === 'reset') {
		    check_admin_referer( 'bulk-action-reset-statistic' );

		    Statistic::query()->delete()->execute();
		    add_action('admin_notices', function () {
			    echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__('Statistik wurde zurückgesetzt.', Plugin::$domain) . '</p></div>';
		    });
	    }
    }

    protected function column_default($item, $column_name)
    {
        return '<input type="checkbox" name="post[]" value="all" checked>' . $item->{$column_name};
    }

	protected function column_title($item)
	{
		return sprintf(
			'<strong>%s</strong>',
			esc_html($item->title)
		);
	}

	protected function column_source_url($item)
	{
		$url = (string) $item->source_url;

		return sprintf(
			'<a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
			esc_url($url),
			esc_html($url)
		);
	}

	protected function column_destination_url($item)
	{
		$url = (string) $item->destination_url;

		return sprintf(
			'<a href="%s" target="_blank" rel="noopener noreferrer">%s</a>',
			esc_url($url),
			esc_html($url)
		);
	}

    public function no_items() {
        esc_html_e( 'No Statistic available.', Plugin::$domain );
    }

    public function preDisplay()
    {
        $this->prepare_items();
    }

    public function display()
    {
	    $base = admin_url("admin.php?page=seo-automated-link-building-statistic");
	    $reset_url = add_query_arg(['action' => 'reset'], $base);
	    $reset_url = wp_nonce_url($reset_url, "bulk-action-reset-statistic");

	    echo '<a href="' . esc_url($reset_url) . '" class="button button-danger" onclick="return confirm(\''
	         . esc_js(__('This action cannot be undone. Are you sure?', Plugin::$domain)) . '\')">'
	         . esc_html(__('Reset statistics', Plugin::$domain)) . '</a>';

	    $this->search_box(__('Search'), Plugin::$domain);
        parent::display();
    }

}
