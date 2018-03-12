<script>

    function isEditAllowed() {
        var session = '<?php echo json_encode($this->session->userdata()) ?>';

        session = JSON.parse(session);

        var type = session["type"];
        var majalisAdminIds = session["majalisAdminIds"];
        var isMajalisAdmin = session["isMajalisAdmin"];
        var majalis = session["majalis"];
        var majalisIdPage = $("#majalisId").val();

        console.log('type', type);
        console.log('majalisAdminIds', majalisAdminIds);
        console.log('isMajalisAdmin', isMajalisAdmin);
        console.log('majalis', majalis);
        console.log('majalisIdPage', majalisIdPage);
    
        isAllowed(majalisAdminIds, majalisIdPage, type, '.majalisForm');

        isAllowed(null, null, type, '.waaraDuty');

        for (var item in majalis) {

            isAllowed(majalisAdminIds, majalis[item], type, '.majalisId_' + majalis[item]);            
        }
    }

    function isAllowed(array, id, type, viewClass) {

        if (type == 'Super Admin') {
            $(viewClass).show();
            return true;
        } else {

            if (array && array.indexOf(id) > -1) {
                $(viewClass).show();
            } else {
                $(viewClass).hide();
                return false;
            }

        }        

    }

</script>