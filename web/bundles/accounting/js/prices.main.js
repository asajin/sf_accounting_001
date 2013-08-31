var pricesSourceObj = {
    type: "json",
    transport : {
        read: {
            url:pricesUrlObj.read,
            cache: false
        }
    },
    schema: {
        model: {
            fields: {
                id: {type: "number"},
                code: {type: "string"},
                name: {type: "string"},
                unit: {
                        defaultValue: {
                            id: 0,
                            name: "Unit"
                        }},
                last_sale_price: {type: "number"}
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
            width: 15,
            template: '#= unit.name #'
        },
        {
            field: "last_sale_price",
            title: "Sale Price",
            width: 30
        }
        ]
    });
});

