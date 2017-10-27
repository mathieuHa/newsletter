$(document).ready(function () {

    $(".post-sortable").sortable({
        cursor: "move",
        update: function () {
            var order_serialize = $(this).sortable("serialize", {key: "posts[]"});

            $.ajax({
                type: "POST",
                url: Routing.generate('mh_newsletter_post_order'),
                data: order_serialize,
                error: function () {
                    console.log('error');
                }
            });
        }
    });
    $(".rubrique-sortable").sortable({
        cursor: "move",
        update: function () {
            var order_serialize = $(this).sortable("serialize", {key: "rubriques[]"});

            $.ajax({
                type: "POST",
                url: Routing.generate('mh_newsletter_rubrique_order'),
                data: order_serialize,
                error: function () {
                    console.log('error');
                }
            });
        }
    });

    var $postFormModal = $('#post-form-modal');

    var loading = '<div class="text-center"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>';


    $postFormModal.on('show.bs.modal', function (e) {
        console.log("Open the new One");
        var $btn = $(e.relatedTarget);

        var $modalContent = $postFormModal.find('#post-content');

        $modalContent.html(loading);

        $modalContent.load($btn.attr("href"), function () {
            var tab = [];
            var addname = $("input:first").val();

            $("form textarea").each(function(){
                tab.push(new SimpleMDE({
                    spellChecker: false,
                    forceSync: true,
                    element: this
                }));
            });

            $postFormModal.find('form').submit(function (e) {

                var $form = $(this);

                $.ajax({
                    type: "POST",
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    success: function (data) {
                        console.log(data);
                        console.log("Name : " + $form.attr('name'));
                        var $panel = $($btn.parents('.panel-info')[0]);
                        switch ($form.attr('name')) {
                            case 'mh_newsletterbundle_rubrique_edit':
                                console.log("In rubrique edit");
                                $panel = $($btn.parents('.panel-success')[0]);
                                console.log($form.find('#mh_newsletterbundle_rubrique_edit_name').val());
                                $panel.find('.link-title-rubrique').html($form.find('#mh_newsletterbundle_rubrique_edit_name').val());
                                break;
                            case 'mh_newsletterbundle_post_edit':
                                $panel.find('.link-title').html($form.find('#mh_newsletterbundle_post_edit_titre').val());
                                $panel.find('.content-update').html($form.find('#mh_newsletterbundle_post_edit_content').val());
                                $panel.find('.link-content').attr("href", $form.find('#mh_newsletterbundle_post_edit_lien').val());
                                $panel.find('.link-text-content').html($form.find('#mh_newsletterbundle_post_edit_textelien').val());
                                break;
                            case 'mh_newsletterbundle_post_delete':
                                $panel.parent().fadeTo("slow", 0.00, function(){
                                    $(this).slideUp("slow", function() {
                                        $(this).remove();
                                    });
                                });
                                break;
                            case 'mh_newsletterbundle_rubrique_delete':
                                $panel = $($btn.parents('.panel-success')[0]);
                                $panel.parent().fadeTo("slow", 0.00, function(){
                                    $(this).slideUp("slow", function() {
                                        $(this).remove();
                                    });
                                });
                                break;
                            case 'mh_newsletterbundle_post_add':
                                $panel = $($btn.parents('.panel-success')[0]);
                                $newPost ="                                   <div class=\"panel panel-info\">\n" +
                                    "                                            <div class=\"panel-heading\">\n" +
                                    "                                                <h4 class=\"panel-title\">\n" +
                                    "                                                    <a id=\"newposthref\" class=\"link-title\" data-toggle=\"collapse\" data-parent=\"#accordion7\" href=\"#\">\n" +
                                    "                                                        aaaa</a>\n" +
                                    "                                                    <div class=\"btn btn-group-xs pull-right\">\n" +
                                    "                                                    <a id=\"href_edit\" class=\"btn btn-warning\" title=\"Modifier\" data-toggle=\"modal\" data-target=\"#post-form-modal\" data-remote=\"false\" href=\"#\"><i class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"> Modifier</i></a>\n" +
                                    "                                                    <a id=\"href_delete\" class=\"btn btn-danger\" title=\"Supprimer\" data-toggle=\"modal\" data-target=\"#post-form-modal\" data-remote=\"false\" href=\"#\"><i class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"> Supprimer</i></a>\n" +
                                    "                                                    </div>\n" +
                                    "                                                </h4>\n" +
                                    "                                                <br>\n" +
                                    "                                            </div>\n" +
                                    "                                            <div id=\"newpostid\" class=\"panel-collapse collapsed\">\n" +
                                    "                                                <div class=\"panel-body\">\n" +
                                    "                                                    <div class=\"col-md-10 col-xs-9\">\n" +
                                    "                                                        <div class=\"content-update\">\n" +
                                    "                                                        \n" +
                                    "                                                        </div><br>\n" +
                                    "                                                        <a id=\"link-content-new\" href=\"#\" target=\"_blank\" style=\"display: inline-block;text-decoration: none;font-family: Helvetica, Arial, sans-serif;color: #2c87c3;\">\n" +
                                    "                                                           <span id=\"link-text-content-new\" style=\"color: #2c87c3;text-decoration: none;\"></span></a>\n" +
                                    "                                                                                                            </div>\n" +
                                    "                                                </div>\n" +
                                    "                                            </div>\n" +
                                    "                                        </div>\n" +
                                    "                                        <br>\n";
                                var $test = $("<li class='toto' id='post_new_id'></li>").append($newPost);
                                $test.find('.link-title').html($form.find('#mh_newsletterbundle_post_add_titre').val());
                                $test.find('.content-update').html($form.find('#mh_newsletterbundle_post_add_content').val());
                                $test.hide().appendTo($panel.find('ul')).slideDown('slow');
                                $("#post_new_id").attr("id", "post_"+data.id);
                                $("#newpostid").attr("id", "post"+data.id+"rubrique"+data.rubrique_id);
                                $("#link-content-new").attr("href", $form.find('#mh_newsletterbundle_post_add_lien').val()).attr('class', "link-content").attr('id', null);// not working
                                $("#link-text-content-new").html($form.find('#mh_newsletterbundle_post_add_textelien').val()).attr('class', "link-text-content").attr('id', null); // not working
                                $("#newposthref").attr("href", "#post"+data.id+"rubrique"+data.rubrique_id).attr('id', null);
                                $("#href_delete").attr("href", Routing.generate('mh_newsletter_post_delete', { id: data.id })).attr('id', null);
                                $("#href_edit").attr("href", Routing.generate('mh_newsletter_post_edit', { id: data.id })).attr('id', null);
                                break;
                            case 'mh_newsletterbundle_rubrique_add':
                                $panel = $($btn.parents('.panel-group')[0]);
                                $newRubrique = "" +
                                    "                <div class=\"panel panel-success\">\n" +
                                    "\n" +
                                    "                    <div class=\"panel-heading\">\n" +
                                    "                        <h4 class=\"panel-title\">\n" +
                                    "                            <a class=\"link-title-rubrique\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#\">\n" +
                                    "                                </a>\n" +
                                    "                        </h4>\n" +
                                    "                    </div>\n" +
                                    "                    <div id=\"rubriquenew\" class=\"panel-collapse collapsed\">\n" +
                                    "                        <div class=\"panel-body\">\n" +
                                    "                            <div class=\"panel-group\" id=\"accordionnew\">\n" +
                                    "                                <ul class=\"list-unstyled post-sortable ui-sortable\">\n" +
                                    "\n" +
                                    "                                </ul>\n" +
                                    "                            </div>\n" +
                                    "\n" +
                                    "                            <div class=\"row\">\n" +
                                    "                                <div class=\"col-lg-9 col-md-6 col-xs-6\">\n" +
                                    "                                    <a id=\"newpostinrub\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#post-form-modal\" data-remote=\"false\" href=\"#\">new Post</a>\n" +
                                    "                                </div>\n" +
                                    "                                <div class=\"col-lg-3 col-md-6 col-xs-6\">\n" +
                                    "                                    <a id=\"newrubedit\" class=\"btn btn-warning\" title=\"Modifier\" data-toggle=\"modal\" data-target=\"#post-form-modal\" data-remote=\"false\" href=\"#\"><i class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"> Modifier</i></a>\n" +
                                    "                                    <a id=\"newrubdelete\"class=\"btn btn-danger\" title=\"Modifier\" data-toggle=\"modal\" data-target=\"#post-form-modal\" data-remote=\"false\" href=\"#\"><i class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"> Supprimer</i></a>\n" +
                                    "                                </div>\n" +
                                    "                            </div>\n" +
                                    "                        </div>\n" +
                                    "                    </div>\n" +
                                    "                </div>\n" +
                                    "                <br>";
                                $rubrique = $("<li class='ui-sortable' id='new_rubrique_id'></li>").attr('id', 'rubrique_'+data.id).append($newRubrique);
                                $rubrique.find('.link-title-rubrique').html($form.find('#mh_newsletterbundle_rubrique_add_name').val()).attr('href', '#rubrique'+data.id);
                                $rubrique.hide().appendTo($panel.find('#add_rubrique_ul')).slideDown('slow');
                                $("#newpostinrub").attr("href", Routing.generate('mh_newsletter_post_add', { id: data.id })).attr('id', null);
                                $("#rubriquenew").attr('id','rubrique'+data.id);
                                $("#accordionnew").attr('id', 'accordion'+data.id);
                                $("#newrubedit").attr("href", Routing.generate('mh_newsletter_rubrique_edit', { id: data.id })).attr('id', null);
                                $("#newrubdelete").attr("href", Routing.generate('mh_newsletter_rubrique_delete', { id: data.id })).attr('id', null);
                                break;
                        }
                        console.log(data);
                        $postFormModal.modal('hide');
                    },
                    error :function(data){
                        console.log(data);
                    }
                });
                e.preventDefault();
            })
        });

    }).on('shown.bs.modal', function () {

    });

});