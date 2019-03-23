var clickToLoadTestScore = function(){
    var data = {
        'action': 'load_test_score_data',
        'sbd': '036392',  //$('#soBaoDanh').val(),
        'college': '01'
    };
    jQuery.post(ajaxUrl, data, function(response) {
        var autoList = JSON.parse(response);
        var content = '';
        console.log(response);
        $('#table-content').append(content);
    });
}
clickToLoadTestScore();
