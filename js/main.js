//Segun documentacion de Datatables
$(document).ready(function(){
    //$('#example').DataTable();

    $table = $('#person').DataTable({
        /* 
        CARGAR BOTONES O ELEMENTO QUE NO SE ITERAN
        */
        "columnDefs"    : [{
            "targets"           : -1,
            "data"              : null,
            "defaultContent"    : "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEdit'>Edit</button><button class='btn btn-danger btnDel'>Delete</button></div></div>"
        }],

        /* 
        TRADUCIENDO EL LENGUAJE
        */
        "language" : {
            "lengthMenu"    : "Mostrar _MENU_ registros",
            "zeroRecords"   : "No se encontraron resultados",
            "info"          : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty"     : "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered"  : "(filtrado de un todal de _MAX_ registros)",
            "sSearch"       : "Buscar:",
            "oPaginate"     : {
                "sFirst"    : "Primero",
                "sLast"     : "Ultimo",
                "sNext"     : "Siguiente",
                "sPrevious" : "Anterios"
            },
            "sProcessing"   : "Procesando...",
        }
    });

    var $modalC = $('#modalCrud');
    /* 
    BOTON btnNew
    */
    $('#btnNew').click(function(){
        //alert('Click bntNew');
        $('#formPerson').trigger('reset');
        $('.modal-header').css({"background-color" : "LightSeaGreen",
            "color" : "WhiteSmoke",
            "font-weight"  : "bold",
        });
        $('.modal-title').text("Add New Person");
        $modalC.modal('show');
        id = null;
        opcion = 1; //Create
    });

    /* 
    BOTON btnEdit
    */
    let rowDt
    $(document).on("click", ".btnEdit", function(){
        rowDt   = $(this).closest("tr");
        id      = parseInt(rowDt.find('td:eq(0)').text());
        name    = rowDt.find('td:eq(1)').text();
        country = rowDt.find('td:eq(2)').text();
        age     = parseInt(rowDt.find('td:eq(3)').text());

        $('#name').val(name);
        $('#country').val(country);
        $('#age').val(age);
        opcion = 2; //Edit

        $('.modal-header').css({"background-color" : "DodgerBlue",
            "color" : "WhiteSmoke",
            "font-weight"  : "bold",
        });
        $('.modal-title').text("Edit Person");
        $modalC.modal('show');
    });

    /* 
    BOTON btnDel
    */

    $(document).on("click", ".btnDel", function(){
        rowDt   = $(this);
        id      = parseInt($(this).closest("tr").find('td:eq(0)').text());
        
        //console.log(id);
        opcion = 3; //Delete

        let answer = confirm("Esta seguro que desa borrar el registro " + id + "?");

        if(answer){
            $.ajax({
                type: "POST",
                url: "db/crud.php",
                data: {opcion : opcion, id : id},
                dataType: "json",
                success: function () {
                    $table.row(rowDt.parents("tr")).remove().draw();
                }
            });
        }
    });

    /* 
    CAPTURAR Y MANDAR LOS DATOS DEL FORMULARIO AL BACKEND
    */

    $('#formPerson').submit(function(e){
        e.preventDefault();
        //$id = $.trim('#id').val();
        name = $.trim($('#name').val());
        country = $.trim($('#country').val());
        age = $.trim($('#age').val());

        

        $.ajax({
            type: "POST",
            url: "db/crud.php",
            data: {name : name, country : country, age : age, id : id, opcion : opcion},
            dataType: "json",
            success: function (data) {
                //lo que se recibe
                if(data.length != 0){
                    //console.log(id, name, country, age);
                    id = data[0].id;
                    name = data[0].name;
                    country = data[0].country;
                    age = data[0].age;

                    if(opcion == 1){
                        $table.row.add([id,name,country,age]).draw();
                    }else{
                        $table.row(rowDt).data([id,name,country,age]).draw();
                    }
                }else{
                    alert("No data returned");
                }
            },
        });

        $modalC.modal("hide");
    });
    
});
