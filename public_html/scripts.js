$(document).ready(function() {
    $(".echoMessage").delay(3000).fadeOut(500);
});

function form_show(id,id2) {
    div = document.getElementById(id);
    div.style.display = "block";
	div2 = document.getElementById(id2);
    div2.style.display = "none";
}

var loadFile = function(event) {
    oldimg = $('.preview').attr('src');
    var preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    newimg = preview.src;
    if(newimg.indexOf('/null') > -1) { preview.src = oldimg; }
};

var loadFile_L = function(event) {
    oldimg_L = $('.preview_L').attr('src');
    var preview_L = document.getElementById('preview_L');
    preview_L.src = URL.createObjectURL(event.target.files[0]);
    newimg_L = preview_L.src;
    if(newimg_L.indexOf('/null') > -1) { preview_L.src = oldimg_L; }
};

var loadFile_R = function(event) {
    oldimg_R = $('.preview_R').attr('src');
    var preview_R = document.getElementById('preview_R');
    preview_R.src = URL.createObjectURL(event.target.files[0]);
    newimg_R = preview_R.src;
    if(newimg_R.indexOf('/null') > -1) { preview_R.src = oldimg_R; }
};
 
function results_show(e) {
    $(e.currentTarget).css("display","none");
    var changeDisplay = $('#vote_result_animation', $(e.currentTarget).closest("article"));
    $(changeDisplay).css("display","block");    
    var post_answer_text1 = $(e.currentTarget).siblings("input[name='post_answer_text1']").val();
    var post_answer_text2 = $(e.currentTarget).siblings("input[name='post_answer_text2']").val();
    var post_answer_text3 = $(e.currentTarget).siblings("input[name='post_answer_text3']").val();
    close_target = $('#doughnutChart', $(e.currentTarget).closest("article"));
    $(close_target).drawDoughnutChart([
        { title: "Answer_1", value: Number(post_answer_text1),  color: "#BC98D3" },
        { title: "Answer_2", value: Number(post_answer_text2),   color: "#EADAE5" },
        { title: "Answer_3", value: Number(post_answer_text3),   color: "#FF4D4D" }
    ]);
}   

/*function changeImg(e) { 
    var current_image_path = $(e.currentTarget).siblings(".hidden_twitterId").val();
    var base_url = window.location.origin;
    var str_change = base_url+'/'+current_image_path;
    str_change = str_change.replace(/ +/g,"");
    $('meta[name="twitter:image"]').attr('content',str_change);
}
function tweetCurrentPage(e) { 
    var twitter_content = $(e.currentTarget).siblings(".hidden_twitterContent").val();
    var twitter_id = $(e.currentTarget).attr('id');
    var base_url = window.location.origin;
    var str = base_url+'/feed.php?id='+twitter_id;
    str = str.replace(/ +/g,"");    
    window.open("https://twitter.com/intent/tweet?url="+str+"&text="+twitter_content, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
    return false;
}*/