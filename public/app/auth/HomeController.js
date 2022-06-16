$("#frmLogin").validate({
    submitHandler: function (form) {
        itemData = new FormData(form);
        Core.post('auth/login', itemData)
        .then(function (res) {
            console.log(res.data);
            if(res.data.err==false) {
                Core.showToast('Acceso correcto.');
                setTimeout(function() {
                    location.reload();
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


$('#country').on('change', function() {
    var id = this.value;
    axios.get("/states/"+id).then(function(res) {
        $('#state').empty();
        $('#state').html("<option>Choose a State</option>");
            $.each(res.data, function(key, value) {
                $("#state").append(`<option value="${value.id}">${value.name}</option>`);
        });
    });
});

$('#state').on('change',function() {
    var id = this.value;
    axios.get("/states/"+id).then(function(res) {
        $('#city').empty();
        $('#city').html("<option>Choose a City</option>");
        $.each(res.data, function(key, value) {
            $("#city").append(`<option value="${value.id}">${value.name}</option>`);
        });
    });
  });

init();

function init() {
    $('#email').val('admin@admin.com')
    $('#password').val('password');
}
