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
            sale_price: {
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
        newColumnsObj.sale_price,
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