
let whichOne; 
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const statusOfType = $("#choices-single-no-search");

window.onload = ()=>{
    if(document.getElementById("choices-single-no-search").value == 'ENTRANT'){
        whichOne = 'exp';
        $("button#addDestination").prop("disabled", true);
        desVal.disable()
    }else{
        whichOne = 'des';
        $("button#addExpediteur").prop("disabled", true);
        expVal.disable()
    }
}


var nameField = document.getElementById("name-field"),
    address = document.getElementById("address-field"),
    telephone = document.getElementById("telephone-field"),
    email = document.getElementById("email-field");

if(document.getElementById("showModal")){
    document.getElementById("showModal").addEventListener("hidden.bs.modal", function () {
        clearFields();
    });
}

statusOfType.on('change', function(e){
    if(e.target.value == "SORTANT"){
        desVal.enable();
        $("button#addDestination").prop("disabled", false);
        expVal.disable();
        $("button#addExpediteur").prop("disabled" , true);
    }else{
        $("button#addDestination").prop("disabled", true);
        desVal.disable()
        $("button#addExpediteur").prop("disabled" , false);
        expVal.enable();
    }
})

$("#addDestination").on("click", ()=> {
    whichOne = 'des';
    $("#submitButton").text(window.translations.addDes)
    $("#exampleModalLabel").text(window.translations.addDes)
})
$("#addExpediteur").on("click", ()=> {
    whichOne = 'exp'
    $("#submitButton").text(window.translations.addExp)
    $("#exampleModalLabel").text(window.translations.addExp)
});

const handleForm = (e) => {
    e.preventDefault()
    const data = {
        nom : nameField.value,
        ville : ville.value,
        phone : telephone.value,
        email : email.value,
        adresse : address.value,
    }
    if(ville.value == ""){
        Swal.fire({
            title: window.translations.selectVille,
            confirmButtonClass: 'btn btn-info',
            buttonsStyling: false,
            showCloseButton: true
        });
        return ;
    }

    console.log(data);
    $.ajax({
        url: `/${whichOne == "des" ? 'destination' : 'expediteur'}`,
        type: "POST",
        data,
        headers:{
            'X-CSRF-TOKEN' : token,
        },
        beforeSend: ()=>{
            $("#submitButton").html(`
                <div style='width:1rem; height:1rem;' class="spinner-border text-white" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            `);
        },
        complete: ()=>{
            $("#submitButton").html(whichOne == 'des' ? window.translations.addDes : window.translations.addExp);
        },
        success: (res) => {
            toastr.success(res.message)
            if(whichOne == "des"){
                let elements = desVal.config.choices
                elements.push({value: res.data.id , label: res.data.nom, selected: true, disabled: false, placeholder: false})
                desVal.clearStore(); 
                desVal.setChoices(elements, 'value', 'label', false);
            }else{
                let elements = expVal.config.choices
                elements.push({value: res.data.id , label: res.data.nom, selected: true, disabled: false, placeholder: false})
                expVal.clearStore(); 
                expVal.setChoices(elements, 'value', 'label', false);
            }
        },
        error: (e) =>{
            const errorMessage = e.responseJSON.message
            toastr.error('Something Wrong :( ', errorMessage);
        }
    })

    clearFields()
    $('#close-modal').click()
}

console.log($('#destinationForm'));
$('#addForm').on('submit', (e) => handleForm(e));



const clearFields = () => {
    nameField.value = "";
    telephone.value = "";
    address.value = "";
    email.value = "";
    villeVal.setChoiceByValue("");
}

