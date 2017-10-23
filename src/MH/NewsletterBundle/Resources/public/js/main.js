$(document).ready(function () {
    $(".post-sortable").sortable({
        cursor: "move",
        update: function () {
            var order_serialize = $(this).sortable("serialize", {key: "posts[]"});

            $.ajax({
                type: "POST",
                url: "{{ path('mh_newsletter_post_order') }}",
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
                url: "{{ path('mh_newsletter_rubrique_order') }}",
                data: order_serialize,
                error: function () {
                    console.log('error');
                }
            });
        }
    });

    $('[data-toggle="tooltip"]').tooltip();

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
                            case 'mh_newsletterbundle_post_edit':
                                $panel.find('.link-title').html($form.find('#mh_newsletterbundle_post_edit_titre').val());
                                $panel.find('.content-update').html($form.find('#mh_newsletterbundle_post_edit_content').val());
                                $panel.find('.link-content').attr("href", $form.find('#mh_newsletterbundle_post_edit_lien').val());
                                $panel.find('.link-text-content').html($form.find('#mh_newsletterbundle_post_edit_textelien').val());
                                break;
                            case 'mh_newsletterbundle_post_delete':
                                $panel.parent().fadeOut(1500, function () {
                                    $(this).remove();
                                });
                                break;
                            case 'mh_newsletterbundle_post_add':
                                $panel = $($btn.parents('.panel-success')[0]);
                                console.log($panel);
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
                                    "                                            <div id=\"newpostid\" class=\"panel-collapse collapse\">\n" +
                                    "                                                <div class=\"panel-body\">\n" +
                                    "                                                    <div class=\"col-md-10 col-xs-9\">\n" +
                                    "                                                        <div class=\"content-update\">\n" +
                                    "                                                        \n" +
                                    "                                                        </div><br>\n" +
                                    "                                                        <a id=\"link-content-new\" href=\"#\" target=\"_blank\" style=\"display: inline-block;text-decoration: none;font-family: Helvetica, Arial, sans-serif;color: #2c87c3;\">\n" +
                                    "                                                           <span id=\"link-text-content-new\" style=\"color: #2c87c3;text-decoration: none;\"> Lire</span></a>\n" +
                                    "                                                                                                            </div>\n" +
                                    "                                                </div>\n" +
                                    "                                            </div>\n" +
                                    "                                        </div>\n" +
                                    "                                        <br>\n";
                                var $test = $("<li class='toto' id='post_new_id'></li>").append($newPost);

                                $test.find('.link-title').html($form.find('#mh_newsletterbundle_post_add_titre').val());
                                $test.find('.content-update').html($form.find('#mh_newsletterbundle_post_add_content').val());
                                $test.hide().appendTo($panel.find('ul')).fadeIn(1500);
                                $("#post_new_id").attr("id", "post_"+data.id);
                                $("#newpostid").attr("id", "post"+data.id+"rubrique"+data.rubrique);
                                $("#link-content-new").attr("href", $form.find('#mh_newsletterbundle_post_add_lien').val()).attr('class', "link-content").attr('id', null);// not working
                                $("#link-text-content-new").html($form.find('#mh_newsletterbundle_post_add_textelien').val()).attr('class', "link-text-content").attr('id', null); // not working
                                $("#newposthref").attr("href", "#post"+data.id+"rubrique"+data.rubrique).attr('id', null);
                                $("#href_delete").attr("href", Routing.generate('mh_newsletter_post_delete', { id: data.id, newsletter_id: data.newsletter_id, rubrique_id: data.rubrique_id })).attr('id', null);
                                $("#href_edit").attr("href", Routing.generate('mh_newsletter_post_edit', { id: data.id, newsletter_id: data.newsletter_id, rubrique_id: data.rubrique_id })).attr('id', null);
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
