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
                code: {
                    type: "string"
                },
                name: {
                    type: "string"
                },
                unit: {
                    defaultValue: {
                        id: 0,
                        name: "Unit"
                    }
                },
                description: {
                    type: "string"
                }
            }
        },
        parse:function (data) {
            productForm.window.data("kendoWindow").close();
            newColumnsObj.loadDropdowns(function () {
                newColumnsObj.productsDropdown.data('kendoDropDownList').setDataSource(newColumnsObj.products);
                newColumnsObj.productsDropdown.data('kendoDropDownList').refresh();
            });
            return data;
        }
    }
});

var productForm = {
    model: false,
    modelObj: {
        code: "",
        name: "",
        unit: {},
        Units: [],
        description: "",
        productsSource: productSourceObj,
        save: function() {
            this.productsSource.add({
                code:this.code,
                name:this.name,
                unit:this.unit.id,
                description:this.description
            });
            this.productsSource.sync();
        },
        cancel: function(e) {
            e.preventDefault();
            productForm.window.data("kendoWindow").close();
        },
        unitAdd: function(e) {
            e.preventDefault();
            var win = $("#unitNew").data("kendoWindow");
            win.center();
            win.open();
        }
    },
    window: null,
    init: function() {
        productForm.window.show()
        productForm.window.kendoWindow({
            visible: false,
            modal: true,
            title: "Create product",
            actions: ["Refresh", "Maximize", "Close"]
        });
        productForm.modelObj.unit = newColumnsObj.units[0];
        productForm.modelObj.Units = newColumnsObj.units;
        productForm.model = kendo.observable(productForm.modelObj);
        kendo.bind($("#productForm"), productForm.model);
    },
    open: function() {
        var window = productForm.window.data("kendoWindow");
        if(window == undefined) {
            productForm.init();
            window = productForm.window.data("kendoWindow");
        }
        window.center();
        window.open();
    }
};

$(document).ready(function() {
    productForm.window = $("#productNew");
});
