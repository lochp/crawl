<?php
function table_install(){
    global $wpdb;

    $table_name = $wpdb->prefix . "test_score"; 
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      soBaoDanh text,
      toan text,
      nguVan text,
      ngoaiNgu text,
      vaLy text,
      hoaHoc text,
      sinhHoc text,
      diemTb1 text,
      lichSu text,
      diaLy text,
      gdcd text,
      diemTb2 text,
      PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

// table_install();

function insert_into_test_score_table($data){
    global $wpdb;
    $table_name = $wpdb->prefix . "test_score";
    $wpdb->insert( $table_name, $data);
}

function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
           window.ajaxUrl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'myplugin_ajaxurl');

// include custom jQuery
function include_handle_auto_js() {
	wp_deregister_script('jquery');
    wp_enqueue_script('jquery', '/wp-includes/js/crawlJs/jquery.min.js', array(), null, true);
    wp_enqueue_script('crawlScript', '/wp-includes/js/crawlJs/crawlScript.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'include_handle_auto_js');

function load_test_score_data(){
    $sbd = $_POST['sbd'];
    $college = $_POST['college'];
    $data = crawl_data($sbd, $college);
    echo json_encode($data);

    wp_die();
}

add_action( 'wp_ajax_load_test_score_data', 'load_test_score_data' );

function getSslPage($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function parseToArray($xpath,$class){
	$xpathquery="//span[@class='".$class."']";
	$elements = $xpath->query($xpathquery);

	if (!is_null($elements)) {
		$resultarray=array();
		foreach ($elements as $element) {
		    $nodes = $element->childNodes;
		    foreach ($nodes as $node) {
		      $resultarray[] = $node->nodeValue;
		    }
		}
		return $resultarray;
	}
}

function buildUrl($q, $college, $area){
    // $url = 'https://diemthi.vnexpress.net/index/result?q=64001347&college=64&area=2';
    $url = 'https://diemthi.vnexpress.net/index/result?q=' . $q . '&college=' . $college . '&area=' . $area;
    return $url;
}

function crawl_data($sbd, $college){
    require_once( dirname( dirname( __FILE__ ) ) . '/vnexpressData/simple_html_dom.php' );
    $url = buildUrl($sbd, $college, 2);
    $r = getSslPage($url);
    $arr = array();
    if (strlen($r) > 100){
        $r = substr($r, 18, strlen($r) - 2);
        $html = str_get_html('<html><body>'.$r.'</body></html>');
        $j = 0;
        foreach($html->find('a') as $e){
            $arr[$j++] = (string)$e->nodes[0];
        }
        $i = 0;
        foreach($html->find('td') as $e){
            if ($i >= 17){
                if ($e->nodes[0] != '<\/td>'){
                    $arr[$j++] = (string)$e->nodes[0];
                }else{
                    $arr[$j++] = '';
                }
            }
            $i++;
        }
    }
    return $arr;
}