<?php

function add_dashboard_sfam_widget()
{
    wp_add_dashboard_widget('sfam_dashboard_widget', 'Having problem with this website?', 'sfam_dashboard_widget_function');
}

function sfam_dashboard_widget_function($post, $callback_args)
{

    $html = '<p>Your administrator contact: <strong>Loïc Herr</strong> <a href="mailto:loic.herr@sfam.eu">loic.herr@sfam.eu</a></p>';
    echo $html;
}

add_action('wp_dashboard_setup', 'add_dashboard_sfam_widget', 1);

//Remove metaboxes dashboard

function remove_dashboard_meta()
{
    remove_meta_box('dashboard_primary', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}

add_action('admin_init', 'remove_dashboard_meta');

/*
  Metabox latest updates
*/

function idx_latest_updates()
{
    $argAll = array(
        'post_type' => 'any',
        'posts_per_page' => 15,
        'post_status' => 'any',
        'orderby' => 'modified',
        'order' => 'desc'
    );

    $updates = \Timber\Timber::get_posts($argAll);

    $lines = '';

    foreach ($updates as $object) {
        if (wp_get_post_revisions($object) != null) {
            $author_ID = array_values(wp_get_post_revisions($object))[0]->post_author;
            $author = get_userdata($author_ID);
            $author_name = $author->data->display_name;
        } elseif ($object->post_author != '') {
            $author_ID = $object->post_author;
            $author = get_userdata($author_ID);
            $author_name = $author->data->display_name;
        } else {
            $author_name = '';
        }

        $lines .= "<tr><td><a href='".get_edit_post_link($object->id)."'>".$object->post_title."</a></td><td>".$object->post_modified."</td><td>".$author_name."</td></tr>";
    }

    $html = "
<table>
    <thead>
        <tr>
            <th>Objet</th>
            <th>Date de maj</th>
            <th>Auteur</th>
        </tr>
    </thead>
    <tbody>
        ".$lines."
    </tbody>
</table>
";
    echo $html;
}

function idx_add_dashboard_lastest_news()
{
    wp_add_dashboard_widget('idx_updates_dashboard', 'Dernières mises à jour', 'idx_latest_updates');
}

if (is_admin() && wp_get_current_user()->roles[0] == 'administrator'){
    add_action('wp_dashboard_setup', 'idx_add_dashboard_lastest_news', 1);
}
