function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}
 
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
 
function cpfCnpj(v){
 
  
    v=v.replace(/\D/g,"")
 
    if (v.length <= 14) { //CPF
 
      
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
 
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
 

        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
 
    } else { //CNPJ
 
 
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")
 
    
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
 
       
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
 
       
        v=v.replace(/(\d{4})(\d)/,"$1-$2")
 
    }
 
    return v
 
}

function cadastro_fornecedor(value) {
   
    $.ajax({
        type: "POST",
        data: $('#'+value).serialize(),
        url: "{{ route('cadastro_fornecedor') }}",
        success: function (msg) {
        


        }
    });
}

function Pesquisar(value) {
    alert(value)
    $.ajax({
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "id": value
        },
        url: "{{ route('baixar_planilha') }}",
        success: function (msg) {
            window.location.assign(msg);
        }
    });
    }