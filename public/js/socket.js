const host = 'http://localhost:8890'
const socket = io.connect(host)
const companion_id = $('#companion-id').attr('data-id')

socket.on('message', function (data){
    data = JSON.parse(data)
    if(companion_id == data.user_id){
        $('#messages').append(
            '<div class="row">' +
                '<div class="col-md-9 col-9">'+
                   '<div class="shadow p-3 mb-5 bg-white rounded">'+
                        '<div class="row">'+
                            '<div class="col-md-8 col-8">'+
                                '<h6>'+ data.user_name +'</h6>'+
                            '</div>'+
                            '<div class="col-md-4 col-4">'+
                                '<h6 style="text-align:right">'+ data.created_at +'</h6>'+
                            '</div>'+
                        '</div>'+
                        '<p>'+ data.message +'</p>'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-3 col-3"></div>'+
            '</div>'
        )
    }else{
        $('#messages').append(
            '<div class="row">' +
                '<div class="col-md-3 col-3"></div>'+
                '<div class="col-md-9 col-9">'+
                   '<div class="shadow p-3 mb-5 bg-white rounded">'+
                        '<div class="row">'+
                            '<div class="col-md-8 col-8">'+
                                '<h6>'+ data.user_name +'</h6>'+
                            '</div>'+
                            '<div class="col-md-4 col-4">'+
                                '<h6 style="text-align:right">'+ data.created_at +'</h6>'+
                            '</div>'+
                        '</div>'+
                        '<p>'+ data.message +'</p>'+
                    '</div>'+
                '</div>'+
            '</div>'
        )
    }  
})