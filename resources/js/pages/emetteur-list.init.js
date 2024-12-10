const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var checkAll = document.getElementById("checkAll");
if (checkAll) {
    checkAll.onclick = function () {
        var checkboxes = document.querySelectorAll('.form-check-all input[type="checkbox"]');
        if (checkAll.checked == true) {
            Array.from(checkboxes).forEach(function (checkbox) {
                checkbox.checked = true;
                checkbox.closest("tr").classList.add("table-active");
            });
        } else {
            Array.from(checkboxes).forEach(function (checkbox) {
                checkbox.checked = false;
                checkbox.closest("tr").classList.remove("table-active");
            });
        }
    };
}

var perPage = 10;
var editlist = false;

//Table
var options = {
    valueNames: [
        "id",
        "nom",
        "ville",
        "adresse",
        "phone",
        "zip"
    ],
    page: perPage,
    pagination: true,
    plugins: [
        ListPagination({
            left: 2,
            right: 2
        })
    ]
};

// Init list
if (document.getElementById("customerList"))
    var customerList = new List("customerList", options).on("updated", function (list) {
        list.matchingItems.length == 0 ?
            (document.getElementsByClassName("noresult")[0].style.display = "block") :
            (document.getElementsByClassName("noresult")[0].style.display = "none");
        var isFirst = list.i == 1;
        var isLast = list.i > list.matchingItems.length - list.page;
        // make the Prev and Nex buttons disabled on first and last pages accordingly
        (document.querySelector(".pagination-prev.disabled")) ? document.querySelector(".pagination-prev.disabled").classList.remove("disabled"): '';
        (document.querySelector(".pagination-next.disabled")) ? document.querySelector(".pagination-next.disabled").classList.remove("disabled"): '';
        if (isFirst) {
            document.querySelector(".pagination-prev").classList.add("disabled");
        }
        if (isLast) {
            document.querySelector(".pagination-next").classList.add("disabled");
        }
        if (list.matchingItems.length <= perPage) {
            document.querySelector(".pagination-wrap").style.display = "none";
        } else {
            document.querySelector(".pagination-wrap").style.display = "flex";
        }

        if (list.matchingItems.length == perPage) {
            document.querySelector(".pagination.listjs-pagination").firstElementChild.children[0].click()
        }

        if (list.matchingItems.length > 0) {
            document.getElementsByClassName("noresult")[0].style.display = "none";
        } else {
            document.getElementsByClassName("noresult")[0].style.display = "block";
        }
    });

const xhttp = new XMLHttpRequest();
xhttp.onload = function () {
  var json_records = JSON.parse(this.responseText);
  Array.from(json_records).forEach(raw => {
    customerList.add({
      id: '<a href="javascript:void(0);" class="fw-medium link-primary">#VZ'+raw.id+"</a>",
      nom: raw.nom,
      ville: raw.ville.ville,
      adresse: raw.adresse ? raw.adresse : "",
      phone: raw.phone ? raw.phone : "",
      zip: raw.zip ? raw.zip : ""
    });
    customerList.sort('id', { order: "desc" });
    refreshCallbacks();
  });
  customerList.remove("id", '<a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a>');
}
xhttp.open("GET", "/emetteurJson");
xhttp.send();

isCount = new DOMParser().parseFromString(
    customerList.items.slice(-1)[0]._values.id,
    "text/html"
);

var isValue = isCount.body.firstElementChild.innerHTML;

var idField = document.getElementById("id-field"),
    nomField = document.getElementById("nom-field"),
    villField = document.getElementById("ville-field"),
    phoneFiled = document.getElementById("phone-field"),
    adresseField = document.getElementById("adresse-field"),
    zipField = document.getElementById("zip-field"),
    addBtn = document.getElementById("add-btn"),
    editBtn = document.getElementById("edit-btn"),
    removeBtns = document.getElementsByClassName("remove-item-btn"),
    editBtns = document.getElementsByClassName("edit-item-btn");
refreshCallbacks();
//filterContact("All");

function filterContact(isValue) {
    var values_status = isValue;
    customerList.filter(function (data) {
        var statusFilter = false;
        matchData = new DOMParser().parseFromString(
            data.values().status,
            "text/html"
        );
        var status = matchData.body.firstElementChild.innerHTML;
        if (status == "All" || values_status == "All") {
            statusFilter = true;
        } else {
            statusFilter = status == values_status;
        }
        return statusFilter;
    });

    customerList.update();
}

function updateList() {
    var values_status = document.querySelector("input[name=status]:checked").value;
    data = userList.filter(function (item) {
        var statusFilter = false;

        if (values_status == "All") {
            statusFilter = true;
        } else {
            statusFilter = item.values().sts == values_status;
            console.log(statusFilter, "statusFilter");
        }
        return statusFilter;
    });
    userList.update();
}

if (document.getElementById("showModal")) {
    document.getElementById("showModal").addEventListener("show.bs.modal", function (e) {
        if (e.relatedTarget.classList.contains("edit-item-btn")) {
            document.getElementById("exampleModalLabel").innerHTML = window.translations.editEmetteur;
            document.getElementById("showModal").querySelector(".modal-footer").style.display = "block";
            document.getElementById("add-btn").innerHTML = window.translations.editEmetteur;
        } else if (e.relatedTarget.classList.contains("add-btn")) {
            document.getElementById("exampleModalLabel").innerHTML = window.translations.addEmetteur;
            document.getElementById("showModal").querySelector(".modal-footer").style.display = "block";
            document.getElementById("add-btn").innerHTML = window.translations.addEmetteur;
        } else {
            document.getElementById("exampleModalLabel").innerHTML = "List Customer";
            document.getElementById("showModal").querySelector(".modal-footer").style.display = "none";
        }
    });
    ischeckboxcheck();

    document.getElementById("showModal").addEventListener("hidden.bs.modal", function () {
        clearFields();
    });
}
document.querySelector("#customerList").addEventListener("click", function () {
    ischeckboxcheck();
});

var table = document.getElementById("customerTable");
// save all tr
var tr = table.getElementsByTagName("tr");
var trlist = table.querySelectorAll(".list tr");

var count = 11;

var forms = document.querySelectorAll('.tablelist-form')
Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            if (
                nomField.value !== "" &&
                adresseField.value !== "" && !editlist
            ) {
                if(villeVal.getValue().value === ""){
                    Swal.fire({
                        title: window.translations.selectVille,
                        showCloseButton: true
                    });
                    return;
                }
                const data = {
                    nom: nomField.value,
                    ville_id: villField.value,
                    adresse: adresseField.value,
                    phone:  phoneFiled.value,
                    zip:  zipField.value
                }
                
                $.ajax({
                    url: "/emetteur",
                    method: "POST",
                    data: JSON.stringify(data),
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    beforeSend: ()=>{
                        $('#add-btn').html(`<div class="spinner-border text-white" style='width:1rem; height:1rem;' role="status" ><span class="sr-only">loading...</span></div>`)
                    },
                    complete: ()=>{
                        $('#add-btn').html(``)
                        $('#add-btn').text(window.translations.addEmetteur)
                    },
                    success: (res) =>{
                        toastr[res['alert-type']](res.message)
                        customerList.add({
                            id: '<a href="javascript:void(0);" class="fw-medium link-primary">#VZ' + res.data.id + "</a>",
                            nom: res.data.nom,
                            ville: res.data.ville.ville,
                            adresse: res.data.adresse,
                            phone: res.data?.phone ? res.data.phone : "",
                            zip: res.data?.zip ? res.data.zip : ""
                        });
                        customerList.sort('id', { order: "desc" });
                        document.getElementById("close-modal").click();
                        refreshCallbacks();
                        clearFields();
                        count++;
                    },
                    error: (xhr, status, error) => {
                        $('#add-btn').html(``)
                        $('#add-btn').text(window.translations.addEmetteur)
                        const err = xhr.responseJSON.errors
                        for(const key in err){
                            if(key === 'ville'){
                                Swal.fire({
                                    title: window.translations.selectVille,
                                    showCloseButton: true
                                });
                            }else{
                                const input = event.target.elements[key] 
                                if(err[key][0].split('.')[1] === 'required'){
                                    input.classList.add('is-invalid');
                                    $(input).next('.invalid-feedback').html(`<strong>${window.translations.thisFieldRequired}</strong>`);
                                }else{
                                    input.classList.add('is-invalid');
                                    $(input).next('.invalid-feedback').html(`<strong>${err[key]}</strong>`);
                                }
                            }
                        }
                    }
                });
            } else if (
                nomField.value !== "" && 
                adresseField.value !== "" && editlist
            ){

                if(villeVal.getValue().value === ""){
                    Swal.fire({
                        title: window.translations.selectVille,
                        showCloseButton: true
                    });
                    return;
                }
                var editValues = customerList.get({
                    id: idField.value,
                });
                Array.from(editValues).forEach(function (x) {
                    isid = new DOMParser().parseFromString(x._values.id, "text/html");
                    var selectedid = isid.body.firstElementChild.innerHTML;
                    if (selectedid == itemId) {
                         const data = {
                            nom: nomField.value,
                            ville_id: villField.value,
                            adresse: adresseField.value,
                            phone:  phoneFiled.value,
                            zip:  zipField.value
                        }
                        $.ajax({
                            url: `/emetteur/${itemId.slice(3)}`,
                            method: "PUT",
                            data: JSON.stringify(data),
                            headers:{
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            beforeSend: ()=>{
                                $('#add-btn').html(`<div class="spinner-border text-white" style='width:1rem; height:1rem;' role="status" ><span class="sr-only">loading...</span></div>`)
                            },
                            complete: ()=>{
                                $('#add-btn').html(``)
                                $('#add-btn').text(window.translations.addEmetteur)
                            },
                            success: (res) =>{
                                toastr[res['alert-type']](res.message)
                                x.values({
                                    id: '<a href="javascript:void(0);" class="fw-medium link-primary">#VZ' + res.data.id + "</a>",
                                    nom: res.data.nom,
                                    ville: res.data.ville.ville,
                                    adresse: res.data.adresse,
                                    phone: res.data?.phone ? res.data.phone : "",
                                    zip: res.data?.zip ? res.data.zip : ""
                                });
                                document.getElementById("close-modal").click();
                                refreshCallbacks();
                                clearFields();
                            },
                            error: (xhr, status, error) => {
                                $('#add-btn').html(``)
                                $('#add-btn').text(window.translations.addEmetteur)
                                const err = xhr.responseJSON.errors
                                for(const key in err){
                                    if(key === 'ville'){
                                        Swal.fire({
                                            title: window.translations.selectVille,
                                            showCloseButton: true
                                        });
                                    }else{
                                        const input = event.target.elements[key] 
                                        if(err[key][0].split('.')[1] === 'required'){
                                            input.classList.add('is-invalid');
                                            $(input).next('.invalid-feedback').html(`<strong>${window.translations.thisFieldRequired}</strong>`);
                                        }else{
                                            input.classList.add('is-invalid');
                                            $(input).next('.invalid-feedback').html(`<strong>${err[key]}</strong>`);
                                        }
                                    }
                                }
                            }
                        });
                    }
                });
            }
        }
    }, false)
})

var villeVal = new Choices(villField);
function isStatus(val) {
    switch (val) {
        case "Active":
            return (
                '<span class="badge bg-success-subtle text-success text-uppercase">' +
                val +
                "</span>"
            );
        case "Block":
            return (
                '<span class="badge bg-danger-subtle text-danger text-uppercase">' +
                val +
                "</span>"
            );
    }
}

function ischeckboxcheck() {
    Array.from(document.getElementsByName("checkAll")).forEach(function (x) {
        x.addEventListener("click", function (e) {
            if (e.target.checked) {
                e.target.closest("tr").classList.add("table-active");
            } else {
                e.target.closest("tr").classList.remove("table-active");
            }
        });
    });
}

function refreshCallbacks() {
    if (removeBtns)
    Array.from(removeBtns).forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.target.closest("tr").children[1].innerText;
            itemId = e.target.closest("tr").children[1].innerText;
            var itemValues = customerList.get({
                id: itemId,
            });

            Array.from(itemValues).forEach(function (x) {
                deleteid = new DOMParser().parseFromString(x._values.id, "text/html");
                var isElem = deleteid.body.firstElementChild;
                var isdeleteid = deleteid.body.firstElementChild.innerHTML;
                if (isdeleteid == itemId) {
                    console.log(itemId)
                    document.getElementById("delete-record").addEventListener("click", function () {
                        $.ajax({
                            url: `/emetteur/${itemId.slice(3)}`,
                            method: "DELETE",
                            headers:{
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            beforeSend: ()=>{
                                $('button#delete-record').html(`<div class="spinner-border text-white" style='width:1rem; height:1rem;' role="status" ><span class="sr-only">loading...</span></div>`)
                            },
                            complete: ()=>{
                                $('button#delete-record').html(``)
                                $('button#delete-record').text(window.translations.yesDeletedIt)
                            },
                            success: (res) =>{
                                toastr[res['alert-type']](res.message)
                                customerList.remove("id", isElem.outerHTML);
                                $("#btn-close").click();
                            },
                            error: (e) => {
                                console.log(e);
                            },
                        });
                    });
                }
            });
        });
    });

    if (editBtns)
        Array.from(editBtns).forEach(function (btn) {
            btn.addEventListener("click", function (e) {
                e.target.closest("tr").children[1].innerText;
                itemId = e.target.closest("tr").children[1].innerText;
                var itemValues = customerList.get({
                    id: itemId,
                });

                Array.from(itemValues).forEach(function (x) {
                    isid = new DOMParser().parseFromString(x._values.id, "text/html");
                    var selectedid = isid.body.firstElementChild.innerHTML;
                    if (selectedid == itemId) {
                        editlist = true;
                        idField.value = selectedid;
                        nomField.value = x._values.nom;
                        zipField.value = x._values.zip;
                        adresseField.value = x._values.adresse;
                        phoneFiled.value = x._values.phone;

                        selectOptionByContent(villeVal, x._values.ville)
                    }
                });
            });
        });
}

function clearFields() {
    nomField.value = "";
    zipField.value = "";
    adresseField.value = "";
    phoneFiled.value = "";
    villeVal.setChoiceByValue("");
    editlist = false;
}

function deleteMultiple() {
  ids_array = [];
  var items = document.getElementsByName('chk_child');
  Array.from(items).forEach(function (ele) {
    if (ele.checked == true) {
      var trNode = ele.parentNode.parentNode.parentNode;
      var id = trNode.querySelector('.id a').innerHTML;
      ids_array.push(id.slice(3));
    }
  });
  if (typeof ids_array !== 'undefined' && ids_array.length > 0) {
    if (confirm('Are you sure you want to delete this?')) {
        $.ajax({
            url: "/emetteur-deleteMany",
            method: "DELETE",
            data: {ids: ids_array},
            headers:{
                'X-CSRF-TOKEN': token
            },
            success: (res)=>{
                toastr[res['alert-type']](res.message)
                Array.from(ids_array).forEach(function (id) {
                    customerList.remove("id", `<a href="javascript:void(0);" class="fw-medium link-primary">#VZ${id}</a>`);
                });
            },
            error: (xhr, status, error) => {
                console.log(error.responseJSON.message)
            }
        })
      document.getElementById('checkAll').checked = false;
    } else {
      return false;
    }
  } else {
    Swal.fire({
      title: 'Please select at least one checkbox',
      confirmButtonClass: 'btn btn-info',
      buttonsStyling: false,
      showCloseButton: true
    });
  }
}



document.querySelectorAll(".listjs-table").forEach(function(item){
    item.querySelector(".pagination-next").addEventListener("click", function () {
        (item.querySelector(".pagination.listjs-pagination")) ? (item.querySelector(".pagination.listjs-pagination").querySelector(".active")) ?
         item.querySelector(".pagination.listjs-pagination").querySelector(".active").nextElementSibling.children[0].click(): '': '';
    });
});

document.querySelectorAll(".listjs-table").forEach(function(item){
    item.querySelector(".pagination-prev").addEventListener("click", function () {
        (item.querySelector(".pagination.listjs-pagination")) ? (item.querySelector(".pagination.listjs-pagination").querySelector(".active")) ?
         item.querySelector(".pagination.listjs-pagination").querySelector(".active").previousSibling.children[0].click(): '': '';
    });
});


// data- attribute example
var attroptions = {
    valueNames: [
        'name',
        'born',
        {
            data: ['id']
        },
        {
            attr: 'src',
            name: 'image'
        },
        {
            attr: 'href',
            name: 'link'
        },
        {
            attr: 'data-timestamp',
            name: 'timestamp'
        }
    ]
};

var attrList = new List('users', attroptions);
attrList.add({
    name: 'Leia',
    born: '1954',
    image: 'build/images/users/avatar-5.jpg',
    id: 5,
    timestamp: '67893'
});

// Existing List
var existOptionsList = {
    valueNames: ['contact-name', 'contact-message']
};
var existList = new List('contact-existing-list', existOptionsList);

// Fuzzy Search list
var fuzzySearchList = new List('fuzzysearch-list', {
    valueNames: ['name']
});

// pagination list
var paginationList = new List('pagination-list', {
    valueNames: ['pagi-list'],
    page: 3,
    pagination: true
});


function selectOptionByContent(choise, option){
    const choicesList = choise._currentState.choices;
    const optionMatch = choicesList.find(elm => elm.label == option);

    if(optionMatch){
        choise.setChoiceByValue(optionMatch.value)
    }else{
        console.error(`Option with text "${option}" not found.`);
    }
}
