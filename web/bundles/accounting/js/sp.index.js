var spSourceObj = {
    type: "json",
    transport : {
        read: {
            url: spIndexUrlObj.read,
            dataType: "json",
            cache: false
        }
    },
    schema: spSchemaObj,
    pageSize: 10,
    group: {
        field: "price_date", 
        aggregates: [{
            field: "amount", 
            aggregate: "sum"
        }]
    },
    aggregate: [{
        field: "amount", 
        aggregate: "sum"
    }]
};

$(document).ready(function() {

    $("#grid").kendoGrid({
        dataSource: spSourceObj,
        height: 500,
        scrollable: true,
        sortable: true,
        filterable: {
            extra: false,
            operators: {
                string: {
                    contains: "Contains"
                }
            }
        },
        pageable: {
            pageSizes: true,
            refresh: true
        },
        columns: [

        {
            hidden: true,
            field: "price_date",
            title: "Buy Date",
            width: 60,
            groupHeaderTemplate: 'Buy Date : #= kendo.toString(value,"<u>ddd</u> - dd MMMM yyyy") #'
        },
        spColumnsObj.supplier_name,
        spColumnsObj.product_name,
        spColumnsObj.stock,
        spColumnsObj.local_price,
        spColumnsObj.amount,
        {
            hidden: true,
            field: "currency_price",
            title: "Price<br>Currency",
            width: 50
        },
        {
            hidden: true,
            field: "currency_rate",
            title: "Change Rate<br>(Currency/Lei)",
            width: 50
        }
        ]
    });

});