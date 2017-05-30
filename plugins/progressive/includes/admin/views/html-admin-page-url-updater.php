<?php
/**
 * Admin View: Page - Addons
 *
 * @var string $view
 * @var object $addons
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
?>
<div class="wrap  url-updater">
  <h1><?php echo get_admin_page_title(); ?></h1>

  <div class="card  card--url-updater">
    <p>This plugin will search the post content for the old url and replace it with the new url. This will fix the visual composer and media library uploads in the content of pages and posts.</p>
    <p>Insert the old url and the new url below to begin.</p>
    <h2>Enter URL's</h2>
    <form method="POST">
      <?php wp_nonce_field( Progressive_Url_Updater::NONCE, Progressive_Url_Updater::NONCE ); ?>
      <table class="form-table  url-updater__form">
        <tr>
          <th scope="row">
            <label for="oldurl">Old URL</label>
          </th>
          <td>
            <input name="oldurl" type="url" id="oldurl" aria-describedby="oldurl" value="" placeholder="http://youroldurl.com" class="regular-text code">
            <p class="description" id="home-description">Enter the address of your old url here.</p>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="newurl">New URL</label>
          </th>
          <td>
            <input name="newurl" type="url" id="newurl" aria-describedby="newurl" value="<?php echo home_url(); ?>" class="regular-text code">
            <p class="description" id="home-description">Enter the address of your new url here.</p>
          </td>
        </tr>
      </table>
      <p class="submit"><input type="submit" name="progressive-url-submit" id="submit" class="button button-primary" value="Update URL's"><br>
        <small>Caution this can not be undone.</small>
      </p>
    </form>
  </div>
</div>