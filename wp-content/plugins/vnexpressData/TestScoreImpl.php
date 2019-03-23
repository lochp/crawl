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

// include custom jQuery
function include_handle_auto_js() {
	wp_deregister_script('jquery');
    wp_enqueue_script('jquery', '/wp-includes/js/crawlJs/jeasyui/jquery.min.js', array(), null, true);
    wp_enqueue_script('crawlScript', '/wp-includes/js/crawlJs/crawlScript.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'include_handle_auto_js');

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
    $url = 'https://diemthi.vnexpress.net/index/result?q=' . $q . '&college=' . $college . '&area=' . $area;
    return $url;
}

function crawl_data(){
    // $url = 'https://diemthi.vnexpress.net/index/result?q=64001347&college=64&area=2';
    require_once( dirname( dirname( __FILE__ ) ) . '/vnexpressData/simple_html_dom.php' );
    for($p = 1; $p <=65; $p ++){
        for ($index = 0; $index <= 999999; $index++){
            $college = $p;
            if ($college < 10){
                $college = '0'.$college;
            }else{
                $college = ''.$college;
            }

            $qIdx = $index.'';
            if ($index < 10){
                $qIdx = '00000'.$index;
            }else if ($index < 100){
                $qIdx = '0000'.$index;
            }else if ($index < 1000){
                $qIdx = '000'.$index;
            }else if ($index < 10000){
                $qIdx = '00'.$index;
            }else if ($index < 100000){
                $qIdx = '0'.$index;
            }

            $qSearch = $college.$qIdx;

            $url = buildUrl($qSearch, $college, 2);
            $r = getSslPage($url);
            if (strlen($r) > 100){
                $r = substr($r, 18, strlen($r) - 2);
                $html = str_get_html('<html><body>'.$r.'</body></html>');
                
                $j = 0;
                $arr = array();
                foreach($html->find('a') as $e){
                    $arr[$j++] = $e->nodes[0];
                }
                
                $i = 0;
                foreach($html->find('td') as $e){
                    if ($i >= 17){
                        if ($e->nodes[0] != '<\/td>'){
                            $arr[$j++] = $e->nodes[0];
                        }else{
                            $arr[$j++] = '';
                        }
                    }
                    $i++;
                }
                
                insert_into_test_score_table(array(
                    'soBaoDanh' => $arr[0],
                    'toan' => $arr[1],
                    'nguVan' => $arr[2],
                    'ngoaiNgu' => $arr[3],
                    'vaLy' => $arr[4],
                    'hoaHoc' => $arr[5],
                    'sinhHoc' => $arr[6],
                    'diemTb1' => $arr[7],
                    'lichSu' => $arr[8],
                    'diaLy' => $arr[9],
                    'gdcd' => $arr[10],
                    'diemTb2' => $arr[11],
                ));
            }
        }
    }
}

// crawl_data();