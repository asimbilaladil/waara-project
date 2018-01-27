    // Write on keyup event of keyword input element
    $("#search").keyup(function() {
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#table tbody tr"), function() {
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();
        });
    });


    // Write on keyup event of keyword input element
    $("#filterByAge").change(function() {
        _this = this;
        // Show only matching TR, hide rest of them
        var ageGroup = $(_this).val();
        var userRole = $("#filterByType").val();
        var counter = 1;
        var rowCount = $('#table tr').length;
        if (userRole == 'select' || ageGroup == 'select') {
            if (ageGroup != 'select') {

                $.each($("#table tbody tr"), function() {
                    if ($(this).text().toLowerCase().indexOf(ageGroup.toLowerCase()) === -1) {

                        if (ageGroup == 'select') {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                        counter++;
                    } else
                        $(this).show();
                });
            } else if (userRole != 'select') {

                $.each($("#table tbody tr"), function() {
                    if ($(this).text().toLowerCase().indexOf(userRole.toLowerCase()) === -1) {

                        if (userRole == 'select') {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                        counter++;
                    } else
                        $(this).show();
                });
            } else if (userRole == 'select') {

                $.each($("#table tbody tr"), function() {
                    if ($(this).text().toLowerCase().indexOf(userRole.toLowerCase()) === -1) {

                        if (userRole == 'select') {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                        counter++;
                    } else
                        $(this).show();
                });
            }

        } else {
            $.each($("#table tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf(ageGroup.toLowerCase()) === -1 || $(this).text().toLowerCase().indexOf(userRole.toLowerCase()) === -1) {

                    if (ageGroup == 'select') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                    counter++;
                } else
                    $(this).show();
            });
        }


        if (ageGroup == 'select') {
          if(userRole != 'select'){
             $('#totalUser').text('Total Users: ' + (rowCount - counter));
          } else {
            $('#totalUser').text('Total Users: ' + (rowCount - 1));
          }
            
        } else {
            $('#totalUser').text('Total Users: ' + (rowCount - counter));
        }
    });




    // Write on keyup event of keyword input element
    $("#filterByType").change(function() {
        _this = this;
        // Show only matching TR, hide rest of them
        var userRole = $(_this).val();
        var ageGroup = $("#filterByAge").val();
        var counter = 1;
        var rowCount = $('#table tr').length;
        if (userRole == 'select' || ageGroup == 'select') {
            if (ageGroup != 'select') {

                $.each($("#table tbody tr"), function() {
                    if ($(this).text().toLowerCase().indexOf(ageGroup.toLowerCase()) === -1) {

                        if (ageGroup == 'select') {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                        counter++;
                    } else
                        $(this).show();
                });
            } else if (userRole != 'select') {

                $.each($("#table tbody tr"), function() {
                    if ($(this).text().toLowerCase().indexOf(userRole.toLowerCase()) === -1) {

                        if (userRole == 'select') {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                        counter++;
                    } else
                        $(this).show();
                });
            } else if (userRole == 'select') {

                $.each($("#table tbody tr"), function() {
                    if ($(this).text().toLowerCase().indexOf(userRole.toLowerCase()) === -1) {

                        if (userRole == 'select') {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                        counter++;
                    } else
                        $(this).show();
                });
            }


        } else {
            $.each($("#table tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf(userRole.toLowerCase()) === -1 || $(this).text().toLowerCase().indexOf(ageGroup.toLowerCase()) === -1) {

                    if (userRole == 'select') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                    counter++;
                } else
                    $(this).show();
            });
        }


        if (userRole == 'select') {
           if(ageGroup != 'select'){
             $('#totalUser').text('Total Users: ' + (rowCount - counter));
          } else {
            $('#totalUser').text('Total Users: ' + (rowCount - 1));
          }
            

        } else {
            $('#totalUser').text('Total Users: ' + (rowCount - counter));
        }
    });