route = "web/settings/profile";
$('#frmUpdate').validate({
    submitHandler: function (form) {
    itemData = new FormData(form);
    //Axios Http Post Request
    Core.post(route+'/update', itemData).then(function(res) {
        Core.showToast('success','Registro editado exitosamente');
        window.location.href = (urlWeb +'/'+route);
    }).catch(function(err) {
        Core.showToast('error',err.response.data.error.message);
    });
}});

function imagePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#frmUpdate img[id=avatar]').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

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
        console.log(res);
        $('#city').empty();
        $('#city').html("<option>Choose a City</option>");
        $.each(res.data.cities, function(key, value) {
            $("#city").append(`<option value="${value.id}">${value.name}</option>`);
        });
    });
  });
