var spColumnsObj = [
{
    hidden: true,
    field: "price_date",
    title: "Buy Date",
    width: 60,
    groupHeaderTemplate: 'Buy Date : #= kendo.toString(value,"<u>ddd</u> - dd MMMM yyyy") #'
},
{
    field: "supplier_name",
    title: "Supplier Name",
    width: 80
},
{
    field: "product_name",
    title: "Product Name",
    width: 80
},
{
    field: "stock",
    title: "Stock (units)",
    width: 50,
    template: '#= stock # #= unit #'
},
{
    field: "local_price",
    title: "Price<br>Lei",
    width: 50,
    template: ' <small style="color:gray">'
+'<font title="Price Currency">#= currency_price #</font> * '
+'<font title="Currency Rate">#= currency_rate #</font>'
+'</small><br/>'
+' #= local_price #'
},
{
    field: "amount",
    title: "<b>Amount</b>",
    width: 50,
    template: '#= kendo.toString(amount, "n")#',
    groupHeaderTemplate: 'total: #= sum #',
    groupFooterTemplate: '<u>total: #= kendo.toString(sum, "n")#</u>',
    footerTemplate: '<b>total: #= kendo.toString(sum, "n")#</b>'
},
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
];