function createWarehouse(count) {
    
var firstNames = ["Nancy", "Andrew", "Janet", "Margaret", "Steven", "Michael", "Robert", "Laura", "Anne", "Nige"],
    lastNames = ["Davolio", "Fuller", "Leverling", "Peacock", "Buchanan", "Suyama", "King", "Callahan", "Dodsworth", "White"],
    cities = ["Seattle", "Tacoma", "Kirkland", "Redmond", "London", "Philadelphia", "New York", "Seattle", "London", "Boston"],
    titles = ["Accountant", "Vice President, Sales", "Sales Representative", "Technical Support", "Sales Manager", "Web Designer",
    "Software Developer", "Inside Sales Coordinator", "Chief Techical Officer", "Chief Execute Officer"],
    birthDates = [new Date("2012/12/31"), new Date("1952/02/19"), new Date("1963/08/30"), new Date("1937/09/19"), new Date("1955/03/04"), new Date("1963/07/02"), new Date("1960/05/29"), new Date("1958/01/09"), new Date("1966/01/27"), new Date("1966/03/27")],
    unitsList = ['l','un','m','ml','g','mg'],
    pricesList = [12.34,23.43,12.12,32.87,16.32,28.43,17.76,37,84,95],
    stockList = [34,23,12,76,34,56,15,37,84,95];

    var data = [],
        now = new Date();
    for (var i = 0; i < count; i++) {
        var firstName = firstNames[Math.floor(Math.random() * firstNames.length)],
            lastName = lastNames[Math.floor(Math.random() * lastNames.length)],
            birthDate = birthDates[Math.floor(Math.random() * birthDates.length)],
            unitRandom = unitsList[Math.floor(Math.random() * unitsList.length)],
            priceRandom = pricesList[Math.floor(Math.random() * pricesList.length)],
            stockRandom = stockList[Math.floor(Math.random() * stockList.length)],
            stockRandom2 = stockList[Math.floor(Math.random() * stockList.length)],
            stockRandom3 = stockList[Math.floor(Math.random() * stockList.length)],
            stockRandom4 = stockList[Math.floor(Math.random() * stockList.length)];

        data.push({
            id: i + 1,
            product_group: lastName,
            code: '1000'+i,
            product_name: firstName,
            unit: unitRandom,
            price:priceRandom,
            first_stock: stockRandom,
            first_amount: stockRandom,
            first_date: new Date("2012/10/31"),
            income_stock: stockRandom2,
            income_amount: 0,
            expense_stock: stockRandom3,
            expense_amount: 0,
            last_stock: stockRandom4,
            last_amount: 0,
            last_date: new Date("2012/11/30")
        });
    }
    return data;
}