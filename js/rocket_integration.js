(function ($, window, document) {
    var url = OC.generateUrl('/apps/rocket_integration/file');

    $(document).ready(function () {
        if ($('#dir').length > 0) {
            OCA.Files.fileActions.registerAction({
                name: 'open-rocket',
                displayName: 'Rocket',
                mime: 'all',
                order: 1,
                permissions: OC.PERMISSION_ALL,
                type: OCA.Files.FileActions.TYPE_DROPDOWN, // @TODO MUST CHECK THIS.
                icon: OC.imagePath('rocket_integration', 'rocket-logo-black.png'),
                actionHandler: function (filename, context) {
                    openMessenger(filename, context.$file, false);
                }
            });

            OCA.Files.fileActions.registerAction({
                name: 'new-discussion-messenger',
                displayName: 'New discussion',
                mime: 'all',
                order: 1,
                permissions: OC.PERMISSION_ALL,
                type: OCA.Files.FileActions.TYPE_DROPDOWN,
                icon: OC.imagePath('rocket_integration', 'rocket-logo-black.png'),
                actionHandler: function (filename, context) {
                    openMessenger(filename, context.$file, true);
                }
            });
        }
    });

    /**
     * Open chat for file.
     *
     * @param fileName
     * @param $file
     * @param isNewDiscussion
     */
    function openMessenger(fileName, $file, isNewDiscussion) {
        var data = {
            id: $file.attr('data-id'),
            name: $file.attr('data-file'),
            isGroupFolder: $file.attr('data-mounttype') === 'group' ? '1' : '0',
            isNewDiscussion: isNewDiscussion ? '1' : '0',
        };

        $.ajax({
            url: url,
            type: "post",
            data: data,
            success: function (data) {
                var win = window.open(data.redirect, '_blank');

                win.focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Something went wrong');
            },
        });
    }
})($, window, document);
