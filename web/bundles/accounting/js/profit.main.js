var profitSourceObj = {
    type: "json",
    transport : {
        read: {
            url:profitUrlObj.read,
            cache: false
        }
    },
    schema: {
        model: {
            fields: {
                month: {type: "string"},
                products_sales: {type: "number"},
                products_costs: {type: "number"},
                direct_charges: {type: "number"},
//                indirect_charges: {type: "number"},
                profit: {type: "number"}
            }
        }
    },
    pageSize: 10
};

$(document).ready(function() {

    $("#grid").kendoGrid({
        dataSource: profitSourceObj,
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
            field: "month",
            title: "Month",
            width: 30
        },
        {
            field: "products_sales",
            title: "Products sales",
            width: 40
        },
        {
            field: "products_costs",
            title: "Products Costs",
            width: 30
        },
        {
            field: "direct_charges",
            title: "Direct Charges",
            width: 30
        },
//        {
//            field: "Indirect charges",
//            title: "indirect_charges",
//            width: 30
//        },
        {
            field: "profit",
            title: "Profit",
            width: 30
        }
        ]
    });
});

