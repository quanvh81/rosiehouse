var njt_folder_in_content={};!function(n){njt_folder_in_content.render=function(t){var i="";if(t.length){n(".attachments").before('<div class="njt-filebird-container"><ul></ul></div>'),t.forEach(function(n){i+='<li data-id="'+n.term_id+'"><div class="item jstree-anchor"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"><path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z" fill="#8f8f8f"></path><path d="M0 0h24v24H0z" fill="none"></path></svg></span><span class="item-containt"><span class="folder-name">'+n.name+"</span></span></div></li>"}),n(".njt-filebird-container ul").html(i),njt_folder_in_content.action()}},njt_folder_in_content.action=function(){n(".njt-filebird-container .item").on("click",function(){n(".njt-filebird-container .item").removeClass("active"),n(this).addClass("active")}),n(".njt-filebird-container .item").on("dblclick",function(){var t=n(this).parent().data("id");n("#menu-item-"+t+" .jstree-anchor").trigger("click")}),n("body.wp-admin.upload-php").length>0&&ntWMC.dropFile(),n(".njt-filebird-container .item").bind({mouseenter:function(){var t=n(this),i=t.find(".item-containt").innerWidth(),e=t.find(".folder-name").innerWidth(),a=t.find(".folder-name").text();i<e+16&&tippy(t[0],{content:a,sticky:!0,offset:"0, 30",arrow:!0,zIndex:99999999,maxWidth:200})}})}}(jQuery);