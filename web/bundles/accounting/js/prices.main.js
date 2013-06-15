var pricesSourceObj = {
    type: "json",
    transport : {
        read: pricesUrlObj.read
    },
    schema: {
        model: {
            fields: {
                id: {type: "number"},
                code: {type: "string"},
                name: {type: "string"},
                unit: {type: "string"},
                last_stock: {type: "number"},
                last_price: {type: "number"}
            }
        }
    },
    pageSize: 10
};

$(document).ready(function() {

    $("#grid").kendoGrid({
        dataSource: pricesSourceObj,
        height: 350,
        scrollable: true,
        sortable: true,
        filterable: true,
        pageable: {
            pageSizes: true,
            refresh: true
        },
        columns: [
        {
            field: "code",
            title: "Code",
            width: 30
        },
        {
            field: "name",
            title: "Name",
            width: 100
        },
        {
            field: "unit",
            title: "Units",
            width: 15
        },
        {
            field: "last_stock",
            title: "Stock",
            width: 20
        },
        {
            field: "last_price",
            title: "Price",
            width: 30
        }
        ]
    });
});

