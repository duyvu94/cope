function showNotification(type, message){

    $.notify({
        icon: "info",
        message: message
    
    },{
        type: type,
        timer: 4000,
        placement: {
            from: 'top',
            align: 'right'
        }
    });
    }