$("#frmLogin").validate({
    submitHandler: function (form) {
        itemData = new FormData(form);
        Core.post('auth/login', itemData)
        .then(function (res) {
  //          console.log(res.data);
            if(res.data.err==false) {
                Core.showToast('Acceso correcto.');
                setTimeout(function() {
                    window.location.href = res.data.url;
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

$('#frmRegister').validate({
    submitHandler: function (form) {
        itemData = new FormData(form);
      //  console.log(itemData);
        Core.post('auth/register', itemData)
        .then(function (res) {
            console.log(res);
            if(res.data.err==false) {
                Core.showToast('success', 'Cuenta creada correctamente.');
                setTimeout(function() {
                    window.location.href = res.data.url;
                },1500);
            }else{
                Core.showToast('error','No ha sido posible crear su cuenta, por favor intente nuevamente.');
            }
        })
        .catch(function (err) {
            Core.showToast('error','No ha sido posible crear su cuenta, por favor intente nuevamente.');
        });
    }
});


$('#country').on('change', function() {
    var id = this.value;
    axios.get("/states/"+id).then(function(res) {
        $('#state').empty();
        $('#state').html("<option>Choose a State</option>");
            $.each(res.data.states, function(key, value) {
                $("#state").append(`<option value="${value.id}">${value.name}</option>`);
        });
    });
});

$('#state').on('change',function() {
    var id = this.value;
    axios.get("/cities/"+id).then(function(res) {
      //  console.log(res);
        $('#city').empty();
        $('#city').html("<option>Choose a City</option>");
        $.each(res.data.cities, function(key, value) {
            $("#city").append(`<option value="${value.id}">${value.name}</option>`);
        });
    });
  });


$('#frmRecovery').validate({
    submitHandler: function (form) {
        itemData = new FormData(form);
        Core.post('auth/forgot-password', itemData)
        .then(function (res) {
            console.log(res);
            if(res.data.err==false) {
                Core.showToast('success', 'Cuenta creada correctamente.');
                setTimeout(function() {
                        window.location.href = res.data.url;
                },1500);
            }else{
                Core.showToast('error','No ha sido posible crear su cuenta, por favor intente nuevamente.');
            }
        })
        .catch(function (err) {
            Core.showToast('error','No ha sido posible crear su cuenta, por favor intente nuevamente.');
        });
    }
});

init();

function init() {
    $('#email').val('admin@admin.com')
    $('#password').val('password');
}
