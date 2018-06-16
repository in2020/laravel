function Hbs(){
    this.bind = function($template,data,$printElement){
        var source   = $template.html();
        var template = Handlebars.compile(source);
        var html    = template(data);
        $printElement.append(html);
    }

    this.bindList = function ($template,listData,$printElement){
        var data = null;
        $printElement.empty();
        for(var i in listData){
            data = listData[i];
            this.bind($template,data,$printElement);
        }
    }
}