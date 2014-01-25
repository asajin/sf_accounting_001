var chargesTransport = {
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
};

var chargesModel = {
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
};

var chargesSchema = {
    model: chargesModel,
    parse:function (data) {
        $.each(data, function (idx, elem) {
            if(typeof elem.price_date == "object") {
                elem.price_date = new Date(elem.price_date.date);
            }
        });
        return data;
    }
};

var chargesSourceObj = {
    serverFiltering: true,
    type: "json",
    transport : chargesTransport,
    schema: chargesSchema,
    pageSize: 10
};
