$("#frmLogin").validate({
    submitHandler: function (form) {
        itemData = new FormData(form);
        Core.post('auth/login', itemData)
        .then(function (res) {
            console.log(res.data);
            if(res.data.err==false) {
                Core.showToast('Acceso correcto.');
                setTimeout(function() {
                    if(res.data.dashboard==true) {
                        window.location.href = $('#route_dashboard').val();
                    } else {
                        if(res.data.referenced==true){
                            console.log($('#domainHost').val() + '/share?code='+res.data.code+'&id='+res.data.id+'&type='+res.data.type);
                            window.location.href = $('#domainHost').val() + '/auth/share?code='+res.data.code+'&id='+res.data.id+'&type='+res.data.type;
                        }
                        else{
                            window.location.href = $('#route_members').val();
                        }
                    }
                },1500);
            }else{
                Core.showToast('error','Datos de acceso incorrectos, intente nuevamente.');
            }
        })
        .catch(function (err) {
            Core.showToast('error','No ha sido posible acceder a su cuenta, por favor intente nuevamente.');
        });
    }
});

init();

function init() {
    $('#email').val('admin@admin.com')
    $('#password').val('password');
}
