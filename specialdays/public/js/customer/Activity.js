function Activity(){
    this.activities = null;

    this.Activity = function(){

    }


    this.bindList = function($template,$printElement,filter,onSuccess){

        var activities = this.activities;

        if(activities == null) return false;

        var listData = activities.data;

        var hbs = new Hbs();

        Handlebars.registerHelper('typeIcon', function (type) {
            var typeIcon = '';
            switch (type) {
                case 1:
                    typeIcon = '/images/icon-drawing-l@2x.png';
                    break;
                case 2:
                    typeIcon = '/images/icon-drawing-l@2x.png';
                    break;
                case 3:
                    typeIcon = '/images/icon-mud@2x.png';
                    break;
                case 4:
                    typeIcon = '/images/icon-wood@2x.png';
                    break;
                case 5:
                    typeIcon = '/images/icon-drawing-l@2x.png';
                    break;
                case 6:
                    typeIcon = '/images/icon-drawing-l@2x.png';
                    break;
                default:
                    typeIcon = '/images/icon-drawing-l@2x.png';
                    break;

            }
            return typeIcon;
        });

        if(filter == null){
            hbs.bindList($template, listData, $printElement);
        }else{
            var data = null;
            var hasData = false;
            $printElement.empty();
            for(var i in listData){
                data = listData[i];
                if(this.isFilterData(filter, data)){
                    hbs.bind($template,data,$printElement);
                    hasData = true;
                }
            }

            if(!hasData){
                $printElement.html("<li><p style='line-height: 200px;text-align: center'>No Data</p></li>");
            }
        }

        if(typeof onSuccess =='function'){
            onSuccess();
        }
    };


    this.showList = function($template,$printElement,dbFilter ,onSuccess){
        /*this.getData(this.bindList($template,$printElement,filter,onSuccess),filter);*/

        var this_ = this;
        $.getJSON('http://api.specialdays.kr/v1/activities?callback=?', dbFilter, function(json) {
            this_.activities = json.activities;
            this_.bindList($template,$printElement,null,onSuccess);
        });
    };

    this.showListWithFilter = function($template,$printElement,filter ,onSuccess){
        this.bindList($template,$printElement,filter,onSuccess);
    }


    this.isFilterData = function(filter, activity){

        if(filter == null ) return true;

        var activityType = filter.activity_type_id;

        if(activity.activity_type_id == activityType){
            return true;
        } else {
            return false;
        }
    };
}