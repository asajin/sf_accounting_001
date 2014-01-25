var chargesColumns = {
    charges : [],
    chargesDropDown : [],
    columns : [
    {
        field: "price_date",
        title: "price_date",
        width: 30,
        template: '#= kendo.toString(price_date,"dd MMMM yyyy") #'
    },
    {
        field: "charge",
        title: "Charge",
        width: 100,
        template: '#= charge.name #',
        editor: function(container, options) {
            chargesColumns.chargeDropDown(container, options)
        }
    },
    {
        field: "quantity",
        title: "quantity",
        width: 15,
        template: '#= quantity #'
    },
    {
        field: "local_price",
        title: "Buy Price",
        width: 30
    },
    {
        field: "buy_amount",
        title: "buy_amount",
        width: 30
    },
    {
        command: ["edit", "destroy"],
        title: "&nbsp;",
        width: "45px"
    }
    ],
    init : function() {
        chargesColumns.loadDropdowns();
    },
    loadDropdowns : function(callback) {
        $.ajax({
            type: "GET",
            url: chargesUrlObj.load,
            dataType: "json",
            cache: false
        }).done(function( data ) {
            chargesColumns.charges = data['charges'];
            if(jQuery.isFunction(callback)) {
                callback();
            }
        });
    },
    chargeDropDown : function(container, options) {
        chargesColumns.chargesDropDown = $('<input required data-text-field="name" data-value-field="id" data-bind="value:' + options.field + '"/>')
        .appendTo(container)
        .kendoDropDownList({
            autoBind: false,
            dataSource: chargesColumns.charges
        });

        $('<button id="newCharge" class="k-button">Add</button>')
        .appendTo(container);

        $("#newCharge").click( function (e) {
            e.preventDefault();
            var win = $("#chargeNew").data("kendoWindow");
            win.center();
            win.open();
        });
    }
};