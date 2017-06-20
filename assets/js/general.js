/*global woocommerce_admin_meta_boxes */
jQuery( function( $ ) {

    // Add rows.
    $( 'button.add_attribute' ).on( 'click', function() {

    	var type = $(this).data("type");
        if(type == "") {
            alert("Please select attribute");
        } else {
            if(type == "userattribute") {
                $(".matrixdata-wrapper .fu-metaboxes .user_attributes table tbody tr.nodata").remove();
                var $row = $(".matrixdata-wrapper .fu-metaboxes .user_attributes table tbody tr").first().clone();
                $row.removeClass("hidden");
                $(".matrixdata-wrapper .user_attributes table tbody").append($row);
            }
        }
        return false;
    });

    $(".user_attributes").on("click", ".remove_attribute", function () {
        $(this).closest("tr").remove();
    });
});
