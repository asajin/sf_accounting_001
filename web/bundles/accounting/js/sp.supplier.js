var supplierSourceObj = new kendo.data.DataSource({
    transport: {
        create: {
            url: newUrlObj.createSupplier,
            dataType: "json",
            type: "PUT"
        },
        parameterMap: function(options, operation) {
            if (operation == "create") {
                return {
                    models: kendo.stringify(options.models)
                };
            }
        }
    },
    batch: true,
    schema: {
        model: {
            id: "id",
            fields: {
                address: {type: "string"},
                name: {type: "string"},
                description: {type: "string"}
            }
        },
        parse:function (data) {
            console.log('success parse start suppliers');
            $("#supplierNew").data("kendoWindow").close();
            newColumnsObj.loadDropdowns(function(){
                newColumnsObj.suppliersDropdown.data('kendoDropDownList').setDataSource(newColumnsObj.suppliers);
                newColumnsObj.suppliersDropdown.data('kendoDropDownList').refresh();
            });
//            newColumnsObj.suppliers.push(data);
            console.log('success parse end suppliers');
            return data;
        }
    }
});

$(document).ready(function() {

    kendo.bind($("#supplierForm"), kendo.observable({
        name: "",
        address: "",
        description: "",
        supplierSource: supplierSourceObj,
        save: function() {
            console.log('update');
            this.supplierSource.add({
                name:this.name,
                address:this.address,
                description:this.description
            });
            this.supplierSource.sync();
            console.log('success sync');
        },
        cancel: function(e) {
            e.preventDefault();
            $("#supplierNew").data("kendoWindow").close();
        }
    }));

    $("#supplierNew").kendoWindow({
        visible: false,
        modal: true,
        title: "Create supplier",
        actions: ["Close"]
    });

});
