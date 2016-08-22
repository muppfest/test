$(document).ready(function() {
    
    //Example 1
    $('#filer_input').filer({
		showThumbs: true
    });
    
    //Example 2
    $("#filer_input2").filer({
        limit: 5,
        maxSize: 20,
        extensions: Array('jpg','png','gif','bmp'),
        changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Flytta & Släpp bilderna här</h3> <span style="display:inline-block; margin: 15px 0">eller</span></div><a class="jFiler-input-choose-btn dgray">Bläddra bland filer</a></div></div>',
        showThumbs: true,
        theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        },
        dragDrop: {
            dragEnter: null,
            dragLeave: null,
            drop: null,
        },
        uploadFile: {
            url: "./inc/upload.php",
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            beforeSend: function(){},
            success: function(data, itemEl, listEl, boxEl, newInputEl, inputEl, id){
                var new_file_name = JSON.parse(data), 
                filerKit = inputEl.prop("jFiler");
                filerKit.files_list[id].name = new_file_name;
        //filerKit.files_list[id].file.name = new_file_name; <-- false
    },
            error: null,
            statusCode: null,
            onProgress: null,
            onComplete: null,
        },
        files: null,
        addMore: false,
        clipBoardPaste: true,
        excludeName: null,
        beforeRender: null,
        afterRender: null,
        beforeShow: null,
        beforeSelect: null,
        onSelect: null,
        afterShow: null,
        onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){

            var filerKit = inputEl.prop("jFiler"),
            file_name = filerKit.files_list[id].name;

            $.post('./inc/remove_file.php', {file: file_name});
        },
        onEmpty: null,
        options: null,
        captions: {
            button: "Välj bilder.",
            feedback: "Välj bilder att ladda upp.",
            feedback2: "Bilderna är valda.",
            drop: "Släpp filen här för att ladda upp den.",
            removeConfirmation: "Är du säker på att du vill ta bord bilden?",
            errors: {
                filesLimit: "Endast {{fi-limit}} bilder är tillåtet att ladda upp.",
                filesType: "Endast bilder är tillåtna att laddas upp.",
                filesSize: "{{fi-name}} är för stor! Bilder upp till {{fi-maxSize}} MB får laddas upp.",
                filesSizeAll: "Filen är för stor! Filer upp till {{fi-maxSize}} MB får laddas upp."
            }
        }
    });
    
});
