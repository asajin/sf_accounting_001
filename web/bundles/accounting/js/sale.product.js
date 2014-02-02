
var saleTransportObj = {
    read:  {
        url: saleUrlObj.read,
        dataType: "json",
        cache: false
    },
    update: {
        url: saleUrlObj.create,
        dataType: "json",
        type: "PUT"
    },
    destroy: {
        url: saleUrlObj.destroy,
        dataType: "json",
        type: "DELETE"
    },
    create: {
        url: saleUrlObj.create,
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

var saleSchemaObj = {
    model: {
        id: "id",
        fields: {
            price_date: {
                type: "date"
            },
            product: {
                defaultValue: {
                    id: 0,
                    name: "Product",
                    code: "Code",
                    unit: {
                        defaultValue: {
                            id: 0,
                            name: "Unit"
                        }
                    }
                }
            },
            customer: {
                defaultValue: {
                    id: 0,
                    name: "Customer"
                }
            },
            unit: {
                type: "string"
            },
            quantity: {
                type: "string"
            },
            sale_price: {
                type: "number"
            },
            local_price: {
                type: "number"
            },
            amount: {
                type: "number"
            },
            real_amount: {
                type: "number"
            }
        }
    },
    parse:function (data) {
        $.each(data, function (idx, elem) {
            if(typeof elem.price_date == "object") {
                elem.price_date = new Date(elem.price_date.date);
            }
            if(elem.customer == undefined) {
                elem.customer = {id:0, name:''};
            }
            elem.amount = Math.round(elem.sale_price * elem.quantity *100)/100;
            elem.real_amount = Math.round(elem.local_price * elem.quantity *100)/100;
        });
        return data;
    }
};

var saleSourceObj = new kendo.data.DataSource({
    transport: saleTransportObj,
    batch: true,
    pageSize: 20,
    schema: saleSchemaObj,
    aggregate: [{
        field: "amount",
        aggregate: "sum"
    }]
});

$(document).ready(function() {
newColumnsObj.loadDropdowns();
$("#grid").kendoGrid({
    dataSource: saleSourceObj,
    height: 500,
    scrollable: true,
    sortable: true,
    filterable: true,
    pageable: {
        pageSizes: true,
        refresh: true
        //input: true
        //numeric: false
    },
    toolbar: ["create"],
    editable: "popup",
    columns: [
        {
            field: "price_date",
            title: "Date",
            width: 60,
            template: '#= kendo.toString(price_date,"dd MMMM yyyy") #'
        },
        {
            field: "customer",
            title: "Client",
            width: 30,
            template: '#= customer.name #',
            editor: function(container, options) {
                newColumnsObj.customersDropdown = $('<input required data-text-field="name" data-value-field="id" data-bind="value:' + options.field + '"/>')
                .appendTo(container)
                .kendoDropDownList({
                    autoBind: false,
                    dataSource: newColumnsObj.customers
                });

                $('<button id="newCustomer" class="k-button">Add</button>')
                .appendTo(container);

                $("#newCustomer").click( function (e) {
                    e.preventDefault();
                    var win = customerFormOptions.window.data("kendoWindow");
                    win.center();
                    win.open();
                });
            }
        },
        {
            field: "code",
            title: "Code",
            width: 15,
            template: '#= product.code #',
            editor: function(container, options){
                $('<input type="text" class="k-input k-textbox" name="code" data-bind="value:product.code">')
                .appendTo(container).attr('readonly', true);
            }
        },
        {
            field: "product",
            title: "Product Name",
            width: 80,
            editor: function(container, options) {
                newColumnsObj.productsDropdown = $('<input required data-text-field="name" data-value-field="id" data-bind="value:' + options.field + '"/>')
                .appendTo(container)
                .kendoDropDownList({
                    autoBind: false,
                    dataSource: newColumnsObj.products
                }).change(function(){
                    options.model.set('sale_price', options.model.product.last_sale_price );
                    options.model.set('code', options.model.product.code );
                    options.model.set('local_price', options.model.product.last_local_price );
                    options.model.set('amount', Math.round(options.model.quantity * options.model.product.last_sale_price *100)/100 );
                    options.model.set('real_amount', Math.round(options.model.quantity * options.model.product.last_local_price *100)/100 );
                });

                $('<button id="open" class="k-button">Add</button>')
                .appendTo(container);

                $("#open").click( function (e) {
                    productForm.open();
                });
            },
            template: '#= product.name #'
        },
        newColumnsObj.unit,
        {
            field: "quantity",
            title: "Count",
            width: 20,
            editor: function(container, options) {
                $('<input type="text" class="k-input k-textbox" name="quantity" data-bind="value:' + options.field + '">')
                .appendTo(container).blur(function(){
                    options.model.set('amount', Math.round(options.model.quantity * options.model.sale_price *100)/100 );
                    options.model.set('real_amount', Math.round(options.model.quantity * options.model.local_price *100)/100 );
                });
            }
        },
        {
            field: "sale_price",
            title: "Price",
            width: 20,
            editor: function(container, options) {
                $('<input type="text" class="k-input k-textbox" name="sale_price" data-bind="' + options.field + '">')
                .appendTo(container).blur(function(){
                    options.model.set('amount', Math.round(options.model.quantity * options.model.sale_price *100)/100 );
                    options.model.set('real_amount', Math.round(options.model.quantity * options.model.local_price *100)/100 );
                });
            }
        },
        {
            field: "amount",
            title: "Amount",
            width: 20,
            editor: function(container, options){
                $('<input type="text" class="k-input k-textbox" name="amount" data-bind="value:' + options.field + '">')
                .appendTo(container).attr('readonly', true);
            }
        },
        {
            field: "real_amount",
            title: "Real amount",
            width: 20,
            editor: function(container, options){
                $('<input type="text" class="k-input k-textbox" name="real_amount" data-bind="value:' + options.field + '">')
                .appendTo(container).attr('readonly', true);
            }
        },
        {
            command: ["edit", "destroy"],
            title: "&nbsp;",
            width: "45px"
        }
    ]
});
});
