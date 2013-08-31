var newColumnsObj = {
    productsDropdown:null,
    suppliersDropdown:null,
    unitsDropdown:null,
    products: [],
    suppliers: [],
    units: [],
    customers: [],

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
            }).change(function(){
                options.model.set('sale_price', options.model.product.last_sale_price );
            });

            $('<button id="open" class="k-button">Add</button>')
            .appendTo(container);

            $("#open").click( function (e) {
                productForm.open();
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
    sale_price:{
        field: "sale_price",
        title: "SalePrice<br>Lei",
        width: 50,
        editor: function(container, options){
            $('<input type="text" class="k-input k-textbox" name="sale_price" data-bind="value:' + options.field + '">')
            .appendTo(container);
        }
    },
    local_price:{
        field: "local_price",
        title: "BuyPrice<br>Lei",
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
        title: "Buy Amount",
        width: 50,
        groupFooterTemplate: 'total: <i>#= Math.round(sum*100)/100#</i>',
        footerTemplate: 'total: <b>#= Math.round(sum*100)/100#</b>',
        editor: function(container, options){
            $('<input type="text" class="k-input k-textbox" name="amount" data-bind="value:' + options.field + '">')
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
            newColumnsObj.customers = data['customers'];
            if(jQuery.isFunction(callback)) {
                callback();
            }
        });

    }
};