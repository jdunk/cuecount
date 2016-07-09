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
function show_vote_results(e,submit_id) {
    e.preventDefault();
    // == == == SHOW RESULTS
    $(e.currentTarget).parents('form.vote_form').css("display","none");
    $($('#vote_result_animation', $(e.currentTarget).closest("article"))).css("display","block");
    // == == == PUT INDIVIDUAL RESULTS IN BOTTOM
    $($('.vote_result_1', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_L']").val());
    $($('.vote_result_2', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_O']").val());
    $($('.vote_result_3', $(e.currentTarget).closest("div.vote_wrap"))).text($(e.currentTarget).siblings("input[name='post_answer_R']").val());
    // == == == UPDATE PERCENTAGES
    $($('#doughnutChart', $(e.currentTarget).closest("article"))).drawDoughnutChart([
        { title: "Answer_1", value: Number($(e.currentTarget).siblings("input[name='post_answer_text1']").val()), color: "#FF4949" },
        { title: "Answer_2", value: Number($(e.currentTarget).siblings("input[name='post_answer_text2']").val()), color: "#E1ABD1" },
        { title: "Answer_3", value: Number($(e.currentTarget).siblings("input[name='post_answer_text3']").val()), color: "#C48FEA" }
    ]);
    var input_id = $(e.currentTarget).attr('id');
    if ( submit_id = 'post_1' ) {
        var post_answer1 = $("input[name='post_answer1']").val();
        jQuery.ajax({
            type: 'POST',
            url: /*baseURI+*/'feed.php',
            data: {input_id: input_id, post_answer1: post_answer1},
            cache: false,
            success: function() {}
        });
    } 
    if ( submit_id = 'post_2' ) {
        var post_answer2 = $("input[name='post_answer2']").val();
        jQuery.ajax({
            type: 'POST',
            url: /*baseURI+*/'feed.php',
            data: {input_id: input_id, post_answer2: post_answer2},
            cache: false,
            success: function(){}
        });
    } 
    if ( submit_id = 'post_3' ) {
        var post_answer3 = $("input[name='post_answer3']").val();
        jQuery.ajax({
            type: 'POST',
            url: /*baseURI+*/'feed.php',
            data: {input_id: input_id, post_answer3: post_answer3},
            cache: false,
            success: function(){}
        });
    } 
}

function results_show(e) {
    $(e.currentTarget).css("display","none");
    var changeDisplay = $('#vote_result_animation', $(e.currentTarget).closest("article"));
    $(changeDisplay).css("display","block");    
    var post_answer_text1 = $(e.currentTarget).siblings("input[name='post_answer_text1']").val();
    var post_answer_text2 = $(e.currentTarget).siblings("input[name='post_answer_text2']").val();
    var post_answer_text3 = $(e.currentTarget).siblings("input[name='post_answer_text3']").val();
    close_target = $('#doughnutChart', $(e.currentTarget).closest("article"));
    $(close_target).drawDoughnutChart([
        { title: "Answer_1", value: Number(post_answer_text1),  color: "#FF4949" },
        { title: "Answer_2", value: Number(post_answer_text2),   color: "#DEE8EA" },
        { title: "Answer_3", value: Number(post_answer_text3),   color: "#C48FEA" }
    ]);
}   

function changeImg(e) { 
    var current_image_path = $(e.currentTarget).attr('id');   
    $('meta[name="twitter:image"]').attr('content', current_image_path);    
}