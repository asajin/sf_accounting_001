var spColumnsObj = {
    price_date : {
        field: "price_date",
        title: "Buy Date",
        template: '#= kendo.toString(price_date,"dd MMMM yyyy") #'
    },
    supplier_name: {
        field: "supplier_name",
        title: "Supplier Name"
//        width: 80
    },
    product_name: {
        field: "product_name",
        title: "Product Name"
//        width: 80
    },
    stock: {
        field: "stock",
        title: "Stock (units)",
        //width: 50,
        template: '#= stock # #= unit #'
    },
    local_price: {
        field: "local_price",
        title: "Price<br>Lei",
        //width: 50,
        template: ' <small style="color:gray">'
    +'<font title="Price Currency">#= currency_price #</font> * '
    +'<font title="Currency Rate">#= currency_rate #</font>'
    +'</small><br/>'
    +' #= local_price #'
    },
    amount: {
        field: "amount",
        title: "<b>Amount</b>",
        //width: 50,
        template: '#= kendo.toString(amount, "n")#',
        groupHeaderTemplate: 'total: #= sum #',
        groupFooterTemplate: '<u>total: #= kendo.toString(sum, "n")#</u>',
        footerTemplate: '<b>total: #= kendo.toString(sum, "n")#</b>'
    },
    currency_price: {
        field: "currency_price",
        title: "Price<br>Currency",
        template: ' #= currency_price # * '
    +'<font title="Currency Rate">#= currency_rate #</font>'
    },
    currency_rate: {
        field: "currency_rate",
        title: "Change Rate<br>(Currency/Lei)"
    }
};