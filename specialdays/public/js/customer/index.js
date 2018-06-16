var activity = new Activity();

var listSlider = $('.listSlider').bxSlider({
    auto: false,
    autoControls: false,
    stopAutoOnClick: true,
    pager: true,
    pagerCustom: '#bx-pager',
    controls: false
});


$(function(){


    activity.showList($('#hbs_activity'),$('.listSlider > .all > ul'),null,activityListOnSuccess);


    $('#here').change(function(){
       var filter = {};
       filter.subway_id = $('#here').val();
       activity.showList($('#hbs_activity'),$('.listSlider > .all > ul'),filter,activityListOnSuccess);
   });
});

function activityListOnSuccess(){

    activity.showListWithFilter($('#hbs_activity'),$('.listSlider > .art > ul'),{'activity_type_id':1},null);
    activity.showListWithFilter($('#hbs_activity'),$('.listSlider > .craft > ul'),{'activity_type_id':2},null);
    activity.showListWithFilter($('#hbs_activity'),$('.listSlider > .pottery > ul'),{'activity_type_id':3},null);
    activity.showListWithFilter($('#hbs_activity'),$('.listSlider > .woodwork > ul'),{'activity_type_id':4},null);
    activity.showListWithFilter($('#hbs_activity'),$('.listSlider > .sing > ul'),{'activity_type_id':5},null);


    listSlider.reloadSlider();
}