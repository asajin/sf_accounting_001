var newTransportObj = {
    read:  {
        url: newUrlObj.read,
        dataType: "json",
        cache: false
    },
    update: {
        url: newUrlObj.create,
        dataType: "json",
        type: "PUT"
    },
    destroy: {
        url: newUrlObj.destroy,
        dataType: "json",
        type: "DELETE"
    },
    create: {
        url: newUrlObj.create,
        dataType: "json",
        type: "PUT"
    },
    parameterMap: function(options, operation) {
        if (operation !== "read" && options.models) {
            return {
                models: kendo.stringify(options.models)
            };
        }
    }
};

var newSchemaObj = {
    model: {
        id: "id",
        fields: {
            price_date: {
                type: "date"
            },
            supplier: {
                defaultValue: {
                    id: 0,
                    name: "Supplier"
                }
            },
            product: {
                defaultValue: {
                    id: 0,
                    name: "Product",
                    unit: {
                        defaultValue: {
                            id: 0,
                            name: "Unit"
                        }
                    }
                }
            },
            unit: {
                type: "string"
            },
            stock: {
                type: "string"
            },
            currency_price: {
                type: "number"
            },
            local_price: {
                type: "number"
            },
            amount: {
                type: "number"
            },
            currency_rate: {
                type: "number"
            }
        }
    },
    parse:function (data) {
        $.each(data, function (idx, elem) {
            if(typeof elem.price_date == "object")
            {
                elem.price_date = new Date(elem.price_date.date);
            }
            elem.amount = Math.round(elem.local_price * elem.stock *100)/100;
        });
        return data;
    }
};

var newDataSourceObj = new kendo.data.DataSource({
    transport: newTransportObj,
    batch: true,
    pageSize: 20,
    schema: newSchemaObj,
    aggregate: [{
        field: "amount",
        aggregate: "sum"
    }]
});

var newColumnsObj = {
    productsDropdown:null,
    suppliersDropdown:null,
    unitsDropdown:null,
    products: [],
    suppliers: [],
    units: [],

    supplier: {
        field: "supplier",
        title: "Supplier Name",
        width: 80,
        editor: function(container, options) {
            newColumnsObj.suppliersDropdown =  $('<input required data-text-field="name" data-value-field="id" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoDropDownList({
                autoBind: false,
                dataSource: newColumnsObj.suppliers
            });

            $('<button id="supplierAdd" class="k-button">Add</button>')
            .appendTo(container);

            $("#supplierAdd").click( function (e) {
                var win = $("#supplierNew").data("kendoWindow");
                win.center();
                win.open();
            });
        },
        template: '#= supplier.name #'
    },
    product:{
        field: "product",
        title: "Product Name",
        width: 80,
        editor: function(container, options) {
            newColumnsObj.productsDropdown = $('<input required data-text-field="name" data-value-field="id" data-bind="value:' + options.field + '"/>')
            .appendTo(container)
            .kendoDropDownList({
                autoBind: false,
                dataSource: newColumnsObj.products
            });//.change(function(){});

            $('<button id="open" class="k-button">Add</button>')
            .appendTo(container);

            $("#open").click( function (e) {
                var win = $("#productNew").data("kendoWindow");
                win.center();
                win.open();
            });
        },
        template: '#= product.name #'
    },
    unit:{
        field: "unit",
        title: "Units",
        width: 20,
        editor: function(container, options) {
            $('<input type="text" class="k-input k-textbox" name="unit" data-bind="value:product.unit.name">')
            .appendTo(container).attr('readonly', true);
            
//            newColumnsObj.unitsDropdown = $('<input type="text" data-text-field="name" data-value-field="id" data-bind="value:product.unit"/>')
//            .appendTo(container)
//            .kendoDropDownList({
//                autoBind: false,
//                dataSource: newColumnsObj.units
//            });
//
//            $('<button id="unitAdd" class="k-button">Add</button>')
//            .appendTo(container);
//
//            $("#unitAdd").click( function (e) {
//                var win = $("#unitNew").data("kendoWindow");
//                win.center();
//                win.open();
//            });
        },
        template: '#= product.unit.name #'
    },
    stock: {
        field: "stock",
        title: "Stock",
        width: 30,
        template: '#= stock #',
        editor: function(container, options){
            $('<input type="text" class="k-input k-textbox" name="stock" data-bind="value:' + options.field + '">')
            .appendTo(container).blur(function(){
                var amount = options.model.stock * options.model.local_price;
                options.model.set('amount', newColumnsObj.round(amount) );
            });
        }
    },
    currency_price:{
        field: "currency_price",
        title: "Price<br>Currency",
        width: 50,
        editor: function(container, options){
            $('<input type="text" class="k-input k-textbox" name="stock" data-bind="value:' + options.field + '">')
            .appendTo(container).blur(function(){
                if(options.model.currency_price > 0) {
                    options.model.set('currency_rate', Math.round((options.model.local_price/options.model.currency_price) *100)/100 );
                }
                options.model.set('local_price', Math.round((options.model.currency_rate * options.model.currency_price) *100)/100 );
                options.model.set('amount', Math.round(options.model.stock * options.model.local_price *100)/100 );
            });
        }
    },
    local_price:{
        field: "local_price",
        title: "Price<br>Lei",
        width: 50,
        editor: function(container, options){
            $('<input type="text" class="k-input k-textbox" name="stock" data-bind="value:' + options.field + '">')
            .appendTo(container).blur(function(){
                options.model.set('amount', Math.round(options.model.stock * options.model.local_price *100)/100 );
                if(options.model.currency_price > 0) {
                    options.model.set('currency_rate', Math.round((options.model.local_price/options.model.currency_price) *100)/100 );
                }
            });
        }
    },
    amount:{
        field: "amount",
        title: "Amount",
        width: 50,
        groupFooterTemplate: 'total: <i>#= Math.round(sum*100)/100#</i>',
        footerTemplate: 'total: <b>#= Math.round(sum*100)/100#</b>',
        editor: function(container, options){
            $('<input type="text" class="k-input k-textbox" name="stock" data-bind="value:' + options.field + '">')
            .appendTo(container).attr('readonly', true);
        }
    },
    currency_rate:{
        field: "currency_rate",
        title: "Change Rate<br>(Currency/Lei)",
        width: 50,
        editor: function(container, options){
            $('<input type="text" class="k-input k-textbox" name="stock" data-bind="value:' + options.field + '">')
            .appendTo(container).blur(function(){
                options.model.set('local_price', Math.round((options.model.currency_rate * options.model.currency_price) *100)/100 );
                options.model.set('amount', Math.round(options.model.stock * options.model.local_price *100)/100 );
            });
        }
    },
    round:function(value) {
        return Math.round(value *100)/100;
    },
    loadDropdowns: function(callback) {
        $.ajax({
            type: "GET",
            url: newUrlObj.load,
            dataType: "json",
            cache: false
        }).done(function( data ) {
            newColumnsObj.products = data['products'];
            newColumnsObj.suppliers = data['suppliers'];
            newColumnsObj.units = data['units'];
            if(jQuery.isFunction(callback)) {
                callback();
            }
        });

    }
};

$(document).ready(function() {

    newColumnsObj.loadDropdowns();

    $("#grid").kendoGrid({
        dataSource: newDataSourceObj,
        height: 500,
        scrollable: true,
        sortable: true,
        filterable: true,
        pageable: {
            pageSizes: true,
            refresh: true
        },
        toolbar: ["create"],
        columns: [
        {
            hidden : true,
            field: "price_date",
            title: "Buy Date",
            width: 60
        },
        newColumnsObj.supplier,
        newColumnsObj.product,
        newColumnsObj.unit,
        newColumnsObj.stock,
        newColumnsObj.currency_price,
        newColumnsObj.currency_rate,
        newColumnsObj.local_price,
        newColumnsObj.amount,
        {
            command: ["edit", "destroy"],
            title: "&nbsp;",
            width: "75px"
        }
        ],
        editable: "popup",
        edit: function(e) {
            if (e.model.isNew() == false) {
                $('[name="amount"]').attr("readonly", true);
            }
        }
    });

});