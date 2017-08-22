function addFriend(id, obj){
    if(id != ''){
        alert("teste");

        $(obj).closest('.sugestaoitem').fadeOut('slow');

        $.ajax({
            type: 'POST',
            url: 'ajax/add_friend',
            data: {id:id},
            success: function(obj){
                console.log(obj);
            }
        });
    }
}

function aceitarFriend(id, obj){

    if(id != ''){
        alert("teste");

        $(obj).closest('.requisaoitem').fadeOut('slow');

        $.ajax({
            type: 'POST',
            url: 'ajax/aceitar_friend',
            data: {id:id},
            success: function(obj){
                console.log(obj);
            }
        });
    }
}