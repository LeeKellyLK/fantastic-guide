<?php
/**
 * Plugin Name:       LK Data Portal Feed
 * Plugin URI:        https://leekelly.me
 * Description:       Created to allow FTP Feed database information to be managed from Wordpress.
 * Version:           0.01
 * Requires at least: N/A
 * Requires PHP:      N/A
 * Author:            Lee Kelly
 * Author URI:        https://leekelly.me
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       lk-portal-feed
 * Domain Path:       /languages
 */

add_action('admin_menu', 'lk_portal_feed_menu');
function lk_portal_feed_menu() {
    add_submenu_page( 'edit.php?post_type=product', 'Product Data Feed', 'Product Data Feed', 'manage_options', __FILE__.'/custom', 'lk_feed_render_custom_page');
}

function lk_feed_render_custom_page(){
    include_once(plugin_dir_path( __FILE__ ) . 'include/config.php');

    $sql = "SELECT * FROM `woo_products` LIMIT 10";

    $result = $woo_conn->query($sql);
    echo $conn->error;

    $products = array();

    foreach($result as $items){

        $sku = $items['sku'];
        $wc_id = $items['wc_id'];
        $pricing = $items['price'];
        $stock = $items['stock'];

        $product = array(
            'sku' => $sku,
            'wc_id' => $wc_id,
            'pricing' => $pricing,
            'stock' => $stock
        );

        $products = array_merge($products, array($product));
    }
    // $products = json_encode($products);
    // echo "<pre>";
    // print_r($products);
    // echo "</pre>";

    ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

    <div class='wrap'>
        <h2>Product Data Feed</h2>
        <p>Hopefull this shows up right.</p>
        <table id="woo-products" class="display">
            <thead>
                <tr style="text-align: left;">
                    <th>SKU</th>
                    <th>Woocommerce ID</th>
                    <th>Pricing</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $row){
                echo "<tr>";
                    echo "<td>". $row['sku'] ."</td>";
                    echo "<td>". $row['wc_id'] ."</td>";
                    echo "<td>£". $row['pricing'] ."</td>";
                    echo "<td>". $row['stock'] ."</td>";
                echo "</tr>";
                } ?>
            </tbody>
        </table>
        <script>
            var php_var = '<?php echo $products; ?>';
            $(document).ready( function () {
                $('#woo-products').DataTable( {
                    data: php_var;
                });
            } );
        </script>
    </div>
    <?php
}

add_action('admin_menu','lk_portal_feed_menu');



?>