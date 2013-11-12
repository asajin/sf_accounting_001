var chargesSourceObj = {
    serverFiltering: true,
    type: "json",
//    batch: true,
    transport : {
        read: {
            url:chargesUrlObj.read,
            cache: false
        },
        update: {
            url: chargesUrlObj.create,
            dataType: "json",
            type: "PUT"
        },
        create: {
            url: chargesUrlObj.create,
            dataType: "json",
            type: "PUT"
        }
    },
    schema: {
        model: {
            id: "id",
            fields: {
                id: {type: "number"},
                price_date: {
                    type: "date"
                },
                charge: {
                    defaultValue: {
                        id: 0,
                        name: "Charge"
                    }
                },
                quantity: {
                    type: "string"
                },
                local_price: {
                    type: "number"
                },
                buy_amount: {
                    type: "number"
                }
            }
        },
        parse:function (data) {
            $.each(data, function (idx, elem) {
                if(typeof elem.price_date == "object") {
                    elem.price_date = new Date(elem.price_date.date);
                }
            });
            return data;
        }
    },
    pageSize: 10
};

function spPriceDateFilterRange(priceDateStartValue, priceDateEndValue) {
    var fieldFilter = {
        logic: 'and',
        filters: [
        {
            field: 'price_date',
            operator: "gte",
            value: priceDateStartValue
        },
        {
            field: 'price_date',
            operator: "lte",
            value: priceDateEndValue
        }
        ]
    };
    $("#grid").data("kendoGrid").dataSource.filter(fieldFilter);
}

$(document).ready(function() {
    var today = new Date();
    $("#monthpicker").kendoDatePicker({
        value: today,
        // defines the start view
        start: "year",

        // defines when the calendar should return date
        depth: "year",

        // display month and year in the input
        format: "MMMM yyyy"
    });

    $('#month_search').click(function(){

        var priceDateValue = $("#monthpicker").data("kendoDatePicker").value();
        var monthDate = new Date(priceDateValue);
        var nextMonthDate = new Date(priceDateValue);
        nextMonthDate.setMonth(monthDate.getMonth() + 1);

        spPriceDateFilterRange(priceDateValue, nextMonthDate);
    });
    
    var charges = {};
    $.ajax({
        type: "GET",
        url: chargesUrlObj.load,
        dataType: "json",
        cache: false
    }).done(function( data ) {
        charges = data['charges'];
    });
    
    $("#grid").kendoGrid({
        dataSource: chargesSourceObj,
        height: 350,
        scrollable: true,
        sortable: true,
        filterable: false,
        pageable: {
            pageSizes: true,
            refresh: true
        },
        toolbar: ["create"],
        editable: "popup",
        columns: [
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
                
                $('<input required data-text-field="name" data-value-field="id" data-bind="value:' + options.field + '"/>')
                .appendTo(container)
                .kendoDropDownList({
                    autoBind: false,
                    dataSource: charges
                });

                $('<button id="newCharge" class="k-button">Add</button>')
                .appendTo(container);

                $("#newCharge").click( function (e) {
//                    productForm.open();
                });
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
            title: "local_price",
            width: 30
        },
        {
            field: "buy_amount",
            title: "buy_amount",
            width: 30
        }
        ]
    });
});
