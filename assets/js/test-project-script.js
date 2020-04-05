jQuery(document).ready(function() {
    var htmlData = "";
    var result = "";
    var userId = "";
    var myTable = jQuery('#myTable').DataTable();
    var modal = jQuery("#myModal");
    var span = jQuery('.closeModal');
    getUserData(null);

    jQuery(document).on('click', 'a.clickableCell', function() {
        event.preventDefault();
        userId = jQuery(this).attr('data-id');
        getUserData(userId);
    });

    jQuery('.closeModal').click(function(){
        modal.hide();
    });
    
    jQuery(document).click = function(event) {
      if (event.target == modal) {
        modal.hide();
      }
    }

    function parseResponse(item,index)
    {
        myTable.row.add([
            "<a class='clickableCell' data-id='"+item.id+"' href='#'>"+item.id+"</a>",
            "<a class='clickableCell' data-id='"+item.id+"' href='#'>"+item.name+"</a>",
            "<a class='clickableCell' data-id='"+item.id+"' href='#'>"+item.username+"</a>"]
        ).draw();
    }

    function getUserData(id)
    {
        jQuery.ajax({
            beforeSend: function(){
                jQuery.mobile.showPageLoadingMsg();
            },
            type : "GET",
            url : ajaxurl,
            data : {
                userId: id,
                action: "tp_get_data"
            },
            success: function(response) {
                if(id !== null)
                {
                    return showModal(response);
                }
                else
                {
                    return response.forEach(parseResponse);
                }
            },
            complete:function(data){
                jQuery.mobile.hidePageLoadingMsg();
            }
        });
    }

    function showModal(response)
    {
        jQuery('#myModal #uid').text(response.id);
        jQuery('#myModal #name').text(response.name);
        jQuery('#myModal #username').text(response.username);
        modal.show();
    }
});