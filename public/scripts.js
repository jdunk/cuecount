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

'use strict';
var COLORS = {
  RED: '#FD5061',
  YELLOW: '#FFCEA5',
  BLACK: '#29363B',
  WHITE: 'white',
  VINOUS: '#A50710'
};
var DURATION = 500;
var CNT = 10;
var PARENT_H = 50;
var BURST_R = 75;
var SHIFT = 300;
var makeDust = function makeDust() {
  var _ref, _ref2;
  var dir = arguments.length <= 0 || arguments[0] === undefined ? -1 : arguments[0];
  var parent = new mojs.Shape({
    left: 0, top: 0,width: 200,height: 50,radius: 0,x: { 0: dir * SHIFT },duration: 1.2 * DURATION,isShowStart: true,isTimelineLess: true,isForce3d: true
  });
  parent.el.style['overflow'] = 'hidden';
  var burst = new mojs.Burst({
    parent: parent.el,
    count: CNT,
    top: PARENT_H + BURST_R,
    degree: 90,
    radius: BURST_R,
    angle: dir === -1 ? (_ref = {}, _ref[-90] = 40, _ref) : (_ref2 = {}, _ref2[0] = -130, _ref2),
    children: {
      fill: '#FD5061',
      delay: dir === -1 ? 'stagger(' + DURATION + ', -' + DURATION / CNT + ')' : 'stagger(' + DURATION / CNT + ')',
      radius: 'rand(8, 25)',
      direction: -1,
      isSwirl: true,
      isForce3d: true
    }
  });

  var fadeBurst = new mojs.Burst({
    parent: parent.el,
    count: 2,
    degree: 0,
    angle: -1 * dir * 75,
    radius: { 0: 100 },
    top: '90%',
    timeline: { delay: .8 * DURATION },
    children: {
      fill: '#FD5061',
      pathScale: [.65, 1],
      radius: 'rand(12, 15)',
      direction: [dir, -1 * dir],
      isSwirl: true,
      isForce3d: true
    }
  });

  var timeline = new mojs.Timeline();
  timeline.add(parent, burst, fadeBurst);

  return { parent: parent, timeline: timeline };
};

var circle = new mojs.Shape({
  left: 0, top: 0,
  strokeWidth: 10,
  fill: 'none',
  radius: 150,
  scale: { 0: 1 },
  opacity: { 1: 0 },
  shape: 'circle',
  stroke: '#FD5061',
  strokeWidth: 10,
  fill: 'none',
  duration: 1.5 * DURATION,
  isForce3d: true,
  isTimelineLess: true
});

var cloud = new mojs.Burst({
  left: 0, top: 0,
  radius: { 4: 49 },
  angle: 45,
  count: 12,
  children: {
    radius: 10,
    fill: '#FD5061',
    scale: { 1: 0, easing: 'sin.in' },
    pathScale: [.7, null],
    degreeShift: [13, null],
    duration: [500, 700],
    isShowEnd: false,
    isForce3d: true
  }
});

var burst = new mojs.Burst({
  left: 0, top: 0,
  radius: { 0: 280 },
  count: 2,
  angle: 90,
  children: {
    shape: 'rect',
    fill: COLORS.VINOUS,
    radius: 15,
    duration: DURATION,
    isForce3d: true
  }
});

var burst2 = new mojs.Burst({
  left: 0, top: 0,
  count: 5,
  radius: { 0: 150 },
  angle: 90,
  children: {
    shape: 'line',
    stroke: COLORS.VINOUS,
    strokeWidth: 5,
    strokeLinecap: 'round',
    radius: 25,
    // angle:    {  0: 360  },
    scale: 1,
    scaleX: { 1: 0 },
    duration: DURATION,
    isForce3d: true
  }
});

var timeline = new mojs.Timeline();
timeline.add(circle, cloud, burst, burst2);


var submit_ani = document.getElementsByName('post_answer3');

for (var i=0;i<submit_ani.length; i++) {

    submit_ani[i].addEventListener('click', function (e) {
      var x = e.pageX,
          y = e.pageY;

      var coords = { x: x , y: y };
      circle.tune(coords);cloud.tune(coords);
      burst.tune(coords);burst2.tune(coords);
     
      timeline.replay();
    });

}

var submit_ani_2 = document.getElementsByName('post_answer1');

for (var i=0;i<submit_ani_2.length; i++) {

    submit_ani_2[i].addEventListener('click', function (e) {
      var x = e.pageX,
          y = e.pageY;

      var coords = { x: x , y: y };
      circle.tune(coords);cloud.tune(coords);
      burst.tune(coords);burst2.tune(coords);
     
      timeline.replay();
    });

}
