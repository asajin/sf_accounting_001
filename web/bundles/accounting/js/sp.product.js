var productSourceObj = new kendo.data.DataSource({
    transport: {
        create: {
            url: newUrlObj.createProduct,
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
                code: {type: "string"},
                name: {type: "string"},
                unit: {type: "string"},
                description: {type: "string"}
            }
        },
        parse:function (data) {
            //          console.log('success parse start');
            $("#productNew").data("kendoWindow").close();
            newColumnsObj.loadDropdowns(function () {
                newColumnsObj.productsDropdown.data('kendoDropDownList').setDataSource(newColumnsObj.products);
                newColumnsObj.unitsDropdown.data('kendoDropDownList').setDataSource(newColumnsObj.units);
                newColumnsObj.productsDropdown.data('kendoDropDownList').refresh();
                newColumnsObj.unitsDropdown.data('kendoDropDownList').refresh();
            });
//            newColumnsObj.products.push(data);
            //          console.log('success parse end');
            return data;
        }
    }
});

$(document).ready(function() {

    kendo.bind($("#productForm"), kendo.observable({
        code: "",
        name: "",
        unit: "",
        description: "",
        productsSource: productSourceObj,
        save: function() {
            console.log('update');
            this.productsSource.add({
                code:this.code,
                name:this.name,
                unit:this.unit,
                description:this.description
            });
            this.productsSource.sync();
            console.log('success sync');
        },
        cancel: function(e) {
            e.preventDefault();
            $("#productNew").data("kendoWindow").close();
        }
    }));

    $("#productNew").kendoWindow({
        visible: false,
        modal: true,
        title: "Create product",
        actions: ["Refresh", "Maximize", "Close"]
    });

});
