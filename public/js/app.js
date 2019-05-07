pagination();
// update clients
$('#update').on('click', function()  {updateClients();});
$('#update-btn').on('click', function()  {updateClients();});
//export clients
$('#exportBtn').on('click', function () {
    console.log('Export initialize...');
    var bookId          = null;
    var subscribeInit   = false;
    var url             = '/export';

    bookId = $('#exportBookSelect').val();//get book id

    if ( $('#exportSubscribeSelect').prop('checked')) {
        subscribeInit = true;
    }
    showMask(true);

    $.ajax({
        method: 'POST', // Type of response and matches what we said in the route
        url: url, // This is the url we gave in the route
        data:       {'bookId':bookId, 'subscribeInit':subscribeInit},
        headers:    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

        success: function(data) {
            showMask(false);

            if(data.msg != null) {
                $('#msgText').html(data.msg);
                $('#msg').toast('show');
            }
        },

        error: function(response) {
            showMask(false);
            console.log(response);
            $('#msgText').html('Извените за неудобвства. Пожалуйста повторите вход в приложение с магазина.');
            $('#msg').toast('show');
        }
    });
});



function pagination(page=1) {
    var block = $('#userGroups');
    var url = '/getUsers';
    if(block.length !== 0){
        showMask(true);
        $.ajax({
            method:     'POST', // Type of response and matches what we said in the route
            url:        url,       // This is the url we gave in the route
            data:       {'page':page},
            headers:    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

            success: function(data) {
                showMask(false);
                if(data.clients != null) {
                    showClients(data.clients,data.countClients);
                    showPagination(Math.ceil(data.totalPages));
                }
            },

            error: function(response) {
                console.log(response);
                showMask(false);
                $('#msgText').html('Извините за неудобства. Система временно недоступна!');
                $('#msg').toast('show');
            }
        });

    }
}

function showPagination(totalPages){
    $('#page').twbsPagination({
        totalPages: totalPages,
        visiblePages: 6,
        next: '<span aria-hidden="true">&rsaquo;</span>',
        prev: '<span aria-hidden="true">&lsaquo;</span>',
        first:'<span aria-hidden="true">&laquo;</span>',
        last:'<span aria-hidden="true">&raquo;</span>',
        onPageClick: function (event, page) {
            pagination(page);
        }

    });
}
/////////////////////////////////////////////////////////////
function showClients(clients, totalClients=0){
    if(totalClients !== 0){
        $('#countClients').html(totalClients);
    }
    $('#userGroups').empty();
    $.each(clients, function (index, value) {
        var subscribe ='<span class="badge badge-unsubscribe" data-toggle="tooltip" title="Не подписан"></span>';
        if(value.subscribe == 1){
            subscribe='<span class="badge badge-subscribe" data-toggle="tooltip" title="Подписан"></span>';
        }
        $('#userGroups').append(
            '<li class="list-group-item d-flex justify-content-between align-items-center panel py-2 fadeIn wow">\n' +
            '<div class="col-md-4 text-left">\n'+
            '<span class="user-ico d-md-inline-block d-none"></span>\n'+
            '<span class="user-name">'+subscribe+value.name+'</span>\n'+
            '</div>\n' +
            '<span class="user-email col-md-4 text-left">'+value.email+'</span>\n'+
            '<span class="user-phone col-md-4 text-left">'+value.phone+'</span>\n'+
            '</li>');
    });
}
function showMask(active = true){
    var mask = '<section id="mask-group" class="mask-group">\n' +
        '    <div  class="mask">\n' +
        '        <div class="spinner-grow " role="status">\n' +
        '            <span class="sr-only">Loading...</span>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</section>\n';
    if(active == true){
        $('body').append(mask);
    }
    else{
        $('#mask-group').remove();
    }
}

function updateClients(){

    console.log('Update initialize...');
    var url  = '/update';
    showMask(true);

    $.ajax({
        method: 'POST', // Type of response and matches what we said in the route
        url: url, // This is the url we gave in the route
        headers:    {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

        success: function(data) {
            showMask(false);
            if(data.msg != null) {
                showPagination(Math.ceil(data.totalPages));
                console.log('show pagination');
                $('#msgText').html(data.msg);
                $('#msg').toast('show');
                $('#alert').remove();
                $('#update-btn').remove();
                $('#update').css('display','inline-block');
                $('#export-btn').css('display','inline-block');

            }
        },

        error: function(response) {
            showMask(false);
            console.log(response);
            $('#msgText').html('Пожалуйста повторите действие спустя 5 мин.');
            $('#msg').toast('show');
        }

    });
}