function Cadastrar_Produto(value) {
    
    $.ajax({
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "id": value
        },
        url: "{{ route('arquivar_ct') }}",
        success: function (msg) {
            if(msg == 'deu certo'){
                mensagem = "Operaçao Finalizada";
                load_fim(mensagem);
                setTimeout(() => { location.reload();}, 2000);
            }else{
                load_fim(msg);
                window.location.assign(msg);
            }


        }
    });
}

function Pesquisar_fornecedor(form) {
    var ser = $("#"+form).serializeArray();
    alert(ser)
    var csrf = "{{ csrf_token() }}"
    $.ajax({
        url: "{{ route('baixar_planilha') }}",
        type: 'post',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': csrf,
        },
        data: {
            "_token": csrf,
            data : ser
        },
        success: function(data) {
         console.log(data)
        },
        error: function(data){
         console.log('error');
        },
    });
    }