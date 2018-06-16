var gDeletingImg = new Array();
function toggleDeletingImg(id, $this){
    if(gDeletingImg[id] == undefined) gDeletingImg[id] = true;
    else gDeletingImg[id] = gDeletingImg[id]?false:true;

    if(gDeletingImg[id]) $this.css('opacity','0.2');
    else $this.css('opacity','1');
}

function setDeletingImage(frmId){
    for(var i in gDeletingImg){
        if(gDeletingImg[i]) {
            $('<input>').attr({
                type: 'hidden',
                name: 'deletingImages[]',
                value: i
            }).appendTo('#'+frmId);
        }
    }
    return true;
}

function addFileInputs(){
    for(var i = 0 ; i < 5 ; i++){
        if($('input[name="imgs[]"').length >= 30){
            alert('한번에 최대 30개까지 등록 가능 합니다. ');
            break;
        }
        $('<input>').attr({
            type: 'file',
            name: 'imgs[]'
        }).appendTo('#div_more_imgs');

    }
}