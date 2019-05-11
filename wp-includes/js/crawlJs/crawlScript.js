var clickToLoadTestScore = function(){
    var data = {
        'action': 'load_test_score_data',
        'sbd': '40002568',  //$('#soBaoDanh').val(),
        'college': '0'
    };
    jQuery.post(ajaxUrl, data, function(response) {
        // var autoList = JSON.parse(response);
        // var content = '';
        console.log(response);
        // $('#table-content').append(content);
    });
}
clickToLoadTestScore();
